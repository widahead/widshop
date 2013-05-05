<?php
class BackOrder extends WidShopAppModel {
	var $name = 'BackOrder';
	public $validate = array(
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please Enter First Name'
		),
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter name'
		),
		'min_price' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please Enter Minimum amount'	
			),
			'rule2' => array(
				'rule' => 'numeric',
				'message' => 'Please enter numeric value'
			)
		), 
		'max_price' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please Enter Maximum amount'	
			),
			'rule2' => array(
				'rule' => 'numeric',
				'message' => 'Please enter numeric value'
			)
		),
		'email' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please Enter Maximum amount'	
			),
			'rule2' => array(
				'rule' =>  'email',
				'message' => 'Please enter valid email'
			)		
		)
	);
}