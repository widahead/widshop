<?php 
/**
* This is based on order creted by users.
* Here all types of order listed.
* Currenlty it is in development mode
*/

class OrdersController extends WidShopAppController {
	var $name = 'Orders';
	public function confirm($hashId) {
		$this->layout = 'default';
		$product = $this->RewriteUrl->getProductDetailByHashId($hashId);
		if(isset($product))  {
			$this->set('product', $product);
		} else {
			$this->Session->setFlash(__('Invalid order, Please try again'));
			$this->redirect(SITE_URL);
			exit;
		}
	}
	public function listOrder() {
		$orders = array();
		$orders = $this->Order->find('list');
	}
	public function makeOrder() {
		$orderSuccessPayment = 1;
		$user_id = 1;
		/*** Code here to make payment */

			// Use this block to make payment

		/** End block **/
		if($orderSuccessPayment) {
			App::uses('CakeEmail', 'Network/Email');
			$email = new CakeEmail();
			$email->template('buyer_order');
			$email->emailFormat('html');
			$email->to(TEST_EMAIL);
			$email->from(ADMIN_EMAIL);
			$email->subject('Order from XXX');
			$email->viewVars( array('username' => 'test',
							'product_name' => 'product_name',
							'amount' => 'amount'
			));
			if($email->send()) {
				$this->Session->setFlash('Thank you for you order.');
			}
			$this->redirect(SITE_URL);
			exit;
		}
	}
	public function beforeFilter() {
		parent::beforeFilter();
	}
}