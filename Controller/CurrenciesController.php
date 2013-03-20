<?php 
/** 
* Setup currency symbol 
*/
class CurrenciesController extends WidShopAppController {
	public $layout = 'admin';
	public function admin_index() {
		$this->Currency->set($this->request->data);
		if(isset($this->request->data) && !empty($this->request->data)) {
			if($this->Currency->validates()) {
				if($this->Currency->save($this->request->data)) {
					$this->Session->setFlash(__('Currency detail saved successfully'));
					$this->redirect(array('controller' =>'currencies', 'action' => 'index'));
					exit;
				}
			}
		}
		if(empty($this->request->data)) {
			$this->request->data = $this->Currency->find('first');
		}

	}
	public function beforeFilter() {
		parent::beforeFilter();
	}
}