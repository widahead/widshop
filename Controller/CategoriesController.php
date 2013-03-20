<?php
/** 
* Create category for product
* Manage category and perform operation like edit and delete
* These categories are showing on left panel of view page as menu.
**/
class CategoriesController extends WidShopAppController {
	var $name = 'Categories';
	public $layout = 'admin';
	var $paginate;
	function admin_index() {
		$this->paginate=array('limit' => 10,'order' => array('id' => 'desc'));
		$categories =$this->paginate('Category');
		$this->set('categories', $categories);
	}
	function admin_addCategory() {
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->Category->set($this->request->data);
			if($this->Category->validates()) {
				$this->request->data['Category']['description'] = htmlentities($this->request->data['Category']['description']);
				if($this->Category->save($this->request->data)) {
					$this->Session->setFlash(__('Category created successfully'));
					$this->redirect(array('controller' => 'categories', 'action' => 'index'));
					exit;
				}
			}
		}
	}
	function admin_editCategory($id = null) {
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->Category->set($this->request->data);
			if($this->Category->validates()) {
				$this->request->data['Category']['description'] = htmlentities($this->request->data['Category']['description']);
				if($this->Category->save($this->request->data)) {
					$this->Session->setFlash(__('Category updated successfully'));
					$this->redirect(array('controller' => 'categories', 'action' => 'index'));
					exit;
				}
			}
		}
		if(empty($this->request->data)) {
			$this->request->data = $this->Category->findById($id);
		}
	}
	public function delete($id = null) {
		if(isset($id)) {
			$offer_id_array = array();
			$offer_id = array();
			$this->Offer->unbindModel(array('hasOne' => array('RewriteUrl')));
			$serviceIds = $this->Service->find('list',array(
						'conditions' => array('category_id' => $id), 
						'fields' => array('id'))
					);
			foreach ($serviceIds as $serviceId) {
				$offer_id = $this->Offer->find('list', array(
					'conditions' => array('FIND_IN_SET('.$serviceId.', service_id)'),
					'fields' => array('id')
				));
				$offer_id_array = array_unique(array_merge($offer_id_array, $offer_id));
			}
			if(!empty($offer_id_array)) {
					$this->Offer->deleteAll(array('Offer.id' => $offer_id_array));
				}
			$this->RewriteUrl->deleteAll(array(
					'OR' => array(
						'RewriteUrl.service_id' => $serviceIds,
						'RewriteUrl.offer_id' => $offer_id_array
					)));
			
			$this->Service->deleteAll(array('category_id' => $id));
			$this->Category->delete($id);
			$this->Session->setFlash(__('Category deleted successfully'));
		}
		$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		exit;
	}
	public function beforeFilter() {
		parent::beforeFilter();
	}
}