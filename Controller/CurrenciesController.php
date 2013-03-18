<?php 
class CurrenciesController extends WidShopAppController {
	public $layout = 'admin';
	public function index() {
		$this->Currency->set($this->request->data);
		if(isset($this->request->data) && !empty($this->request->data)) {
			if($this->Currency->validates()) {
				if($this->Currency->save($this->request->data)) {
					$this->Session->setFlash('Currency detail saved successfully');
					$this->redirect('/currencies/');
				}
			}
		}
		if(empty($this->request->data))
				$this->request->data = $this->Currency->find('first');

	}
	public function beforeFilter() {
		parent::beforeFilter();
	}
}