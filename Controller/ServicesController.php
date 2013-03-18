<?php 
class ServicesController extends WidShopAppController {
	public $layout = 'admin';
	public function index() {
		$this->paginate=array('limit' => 10,'order' => array('id' => 'desc'));
		$services =$this->paginate('Service');
		$i = 0;
		foreach($services as $service) {
			$services[$i]['Service']['categoryName'] = $this->Category->getCategoryNameById($service['Service']['category_id']);
			$i++;
		}
		$this->set('services', $services);		
	}
	public function manageService($id = null) {
		$this->Service->set($this->request->data);
		if(isset($this->request->data) && !empty($this->request->data)) {
			if($this->Service->validates()) {
				if(!empty($this->request->data['Service']['image']['name'])) {
					$image = str_replace(' ', '_',$this->request->data['Service']['image']['name']);
					move_uploaded_file($this->request->data['Service']['image']['tmp_name'], '../webroot/img/services/'.$image);
					$this->request->data['Service']['image']  = SERVICE_IMG_URL.'/'.$image;
				}
				elseif(isset($id)) {
					$this->request->data['Service']['image'] = $this->request->data['Service']['old_image'];
				}
				else
					$this->request->data['Service']['image'] = null;
				$this->request->data['Service']['description'] = htmlentities($this->request->data['Service']['description']);
				if($this->Service->save($this->request->data)) {
					$this->Session->setFlash('Service created successfully');
					$this->redirect('/services/');
				}
			}
		}
		if(isset($id) && empty($this->request->data))
			$this->request->data = $this->Service->findById($id);
	}
	public function delete($id) {
		if(isset($id)){
			$this->Offer->unbindModel(array('hasOne' => array('RewriteUrl')));
			$this->Offer->deleteAll(array('FIND_IN_SET('.$id.', service_id)'));
			$this->Service->delete($id);
			$this->Session->setFlash('Service deleted successfully');
		}
		$this->redirect('/services/');
	}

	public function BeforeFilter(){
		parent::beforeFilter();
		$categories = array();
		$categories = $this->Category->getAllCategories();
		$this->set('categories', $categories);
	}
	public function view($slug = null){
		$serviceDetail = array();
		$this->layout = 'default';
		$serviceDetail = $this->Service->getServiceDetailById($slug);
		$this->set('service', $serviceDetail);
	}
	public function getCalculatedPrice() {
		$this->Service->unbindModel(array('hasOne' => array('RewriteUrl')),false);
		$clculatedServiceAmount = $this->Service->find('first', array('conditions' => array('id' => $this->request->data['serviceId']), 'fields' => array('SUM(amount) as amount')));
		echo ($clculatedServiceAmount[0]['amount']);
		exit;
	}
}