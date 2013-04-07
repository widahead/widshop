<?php
class Order extends WidShopAppModel {
	var $name = 'Order';
	public $validate = array(
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'User name can not be blank'
		),
		'address' => array(
			'rule' => 'notEmpty',
			'message' => 'Please Enter Shipping Address.'
		),
		'city' => array(
			'rule' => 'notEmpty',
			'message' => 'Please Enter Shipping City.'
		),
		'county' => array(
			'rule' => 'notEmpty',
			'message' => 'Please Enter Shipping County.'
		),
		'postalcode' => array(
			'rule' => 'notEmpty',
			'message' => 'Please Enter Shipping PostalCode.'
		)
	);
}
?>