<?php
class Currency extends WidShopAppModel {
	var $name = 'Currency';
	public $validate = array(
		'currency' => array(
		'rule' => 'notEmpty',
		'message' => 'Please enter currency'
		),
		'symbol' => array(
		'rule' => 'notEmpty',
		'message' => 'Please enter symbol'
		)
	);
	public function getCurrentCurrency(){
		$currency = $this->find('first', array('fields' => 'symbol'));
		return $currency['Currency']['symbol'];
	}
}
?>