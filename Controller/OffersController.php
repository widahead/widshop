<?php 
/** 
* Create offer for services and we can manage these offers.
* We can create normal offer with single and multiple products.
* We can manage one day deal or also hour based deals 
*/
class OffersController extends WidShopAppController {
	var $name = 'Offers';
	public $layout = 'admin';
	function admin_index(){
		$this->paginate=array('limit' => 10,'order' => array('id' => 'desc'));
		$offers =$this->paginate('Offer');
		$this->set('offers', $offers);	
	}	
	public function admin_manageOffer($id = null) {
		$this->Offer->set($this->request->data);
		if(isset($this->request->data) && !empty($this->request->data)) {
			if($this->Offer->validates()) {
				$this->request->data['Offer']['service_id'] = implode(',', $this->request->data['Offer']['service_id']);
				if(!empty($this->request->data['Offer']['image']['name'])) {
					$this->request->data['Offer']['image'] = $this->uploadImage($this->request->data['Offer']['image']);
				} else if(isset($this->request->data['Offer']['old_image'])) {
					$this->request->data['Offer']['image'] = $this->request->data['Offer']['old_image'];
				} else {
					$this->request->data['Offer']['image'] = null;
				}
				if(!empty($this->request->data['Offer']['thumb1']['name'])) {
					$this->request->data['Offer']['thumb1'] = $this->uploadImage($this->request->data['Offer']['thumb1']);
				} else if(isset($this->request->data['Offer']['old_thumb1'])) {
					$this->request->data['Offer']['thumb1'] = $this->request->data['Offer']['old_thumb1'];
				} else {
					$this->request->data['Offer']['thumb1'] = null;
				}
				if(!empty($this->request->data['Offer']['thumb2']['name'])) {
					$this->request->data['Offer']['thumb2'] = $this->uploadImage($this->request->data['Offer']['thumb2']);
				}
				else if(isset($this->request->data['Offer']['old_thumb2'])) {
					$this->request->data['Offer']['thumb2'] = $this->request->data['Offer']['old_thumb2'];
				} else {
					$this->request->data['Offer']['thumb2'] = null;
				}
				if($this->request->data['Offer']['one_day_deal']) {
					$this->request->data['Offer']['end_date'] = date('Y-m-d H:i:s', (strtotime($this->request->data['Offer']['start_date']['month'].'/'. $this->request->data['Offer']['start_date']['day'].'/'.$this->request->data['Offer']['start_date']['year']) + (60 * 60 *24 - 1)));
					
					$this->request->data['Offer']['start_date'] = date('Y-m-d H:i:s', (strtotime($this->request->data['Offer']['start_date']['month'].'/'. $this->request->data['Offer']['start_date']['day'].'/'.$this->request->data['Offer']['start_date']['year'])));
				}
				if(count(explode(',', $this->request->data['Offer']['service_id'])) > 1)
					$this->request->data['Offer']['is_bundle'] = 1;
				else
					$this->request->data['Offer']['is_bundle'] = 0;

				$this->request->data['Offer']['description'] = htmlentities($this->request->data['Offer']['description']);
				if($this->Offer->save($this->request->data)) {
					$this->Session->setFlash(__('Offer created successfully'));
					$this->redirect(array('controller' =>'offers', 'action' => 'index'));
					exit;
				}
			}
			else {
				$offerDetailToRemainStatus = $this->Offer->findById($id);
				$this->request->data['Offer']['image'] = $offerDetailToRemainStatus['Offer']['image'];
				$this->request->data['Offer']['thumb1'] = $offerDetailToRemainStatus['Offer']['thumb1'];
				$this->request->data['Offer']['thumb2'] = $offerDetailToRemainStatus['Offer']['thumb2'];
			}
		}
		if(empty($this->request->data) && isset($id)) {
			$this->request->data = $this->Offer->findById($id);
		}
	}
	public function BeforeFilter() {
		parent::beforeFilter();
		$services = array();
		$services = $this->Service->getAllServices();
		$this->set('services', $services);
	}
	function uploadImage($imageName){
		if(isset($imageName['name'])) {
			$image = str_replace(' ', '_',$imageName['name']);
			move_uploaded_file($imageName['tmp_name'], ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.IMAGES_URL.DS.OFFER_IMG_URL.DS.$image);
			return OFFER_IMG_URL.'/'.$image;
		}
		else
			return '';
	}
	public function view($slug = null) {
		$this->layout = 'default';
		$offerDetail = $this->Offer->getOfferDetailById($slug);
		if(isset($offerDetail)) {
			$serviceCapt = $this->Service->find('all', array('conditions' => array('Service.id' => explode(',', $offerDetail['service_id'])), 'fields' => array('Service.name', 'RewriteUrl.url_key')));
			$this->set('serviceList', $serviceCapt);
			$this->set('offer', $offerDetail);
		} else {
			$this->Session->setFlash(__('Invalid url'));
			$this->redirect(SITE_URL);
			exit;
		}
	}
	public function admin_delete($id) {
		if(isset($id)){
			$this->Offer->delete($id);
			$this->Session->setFlash(__('Offer deleted successfully'));
		}
		$this->redirect(array('controller' =>'offers', 'action' => 'index'));
		exit;
	}
}