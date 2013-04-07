<?php
class Currency extends WidShopAppModel {
	var $name = 'Currency';
	public $validate = array(
		'currency' => array(
			'rule' => 'notEmpty',
			'message' => 'Please select currency'
		)
	);
	public function getCurrentCurrencyCode(){
		$currency = $this->find('first', 
					array(
						'conditions' => array('status' => true),
						'fields' => 'currency_code'
						)
					);
		return $currency['Currency']['currency_code'];
	}

	public function getCurrentCurrencyId(){
		$currency = $this->find('first', 
					array(
						'conditions' => array('status' => true),
						'fields' => 'id'
						)
					);
		return $currency['Currency']['id'];
	}
}
?>