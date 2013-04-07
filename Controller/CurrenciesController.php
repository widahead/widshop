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
				$this->Currency->updateAll(array('status' => 0));
				$this->request->data['Currency']['id'] = $this->request->data['Currency']['currency'];
				$this->request->data['Currency']['status'] = 1;
				if($this->Currency->save($this->request->data)) {
					$this->Session->setFlash(__('Currency detail saved successfully'));
					$this->redirect(array('controller' =>'currencies', 'action' => 'index'));
					exit;
				}
			}
		}
		$c_selected = null;
		if(empty($this->request->data)) {
			$c_selected = $this->Currency->getCurrentCurrencyId();
		}
		$this->set('c_selected', $c_selected);
		$currency_list = array();
		$currency_list = $this->Currency->find('list', array('fields' => array('country')));
		$this->set('currency_list', $currency_list);

	}
	public function beforeFilter() {
		parent::beforeFilter();
	}
}