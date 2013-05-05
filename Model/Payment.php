<?php
class Payment extends WidShopAppModel {
	var $name = 'Payment';
	public function getpaymentByToken($token = null) {
		$payment = $this->find('first', array(
							'conditions' => array(
								'token' => $token
							)
						)
					);
		return $payment;
	}
}
?>