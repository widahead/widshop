<?php 
/**
* This is based on order creted by users.
* Here all types of order listed.
* Currenlty it is in development mode
*/

class OrdersController extends WidShopAppController {
	var $name = 'Orders';
	var $uses = array('WidShop.Order', 'WidShop.Payment');
	var $components = array('WidShop.Paypal');
	public function confirm($hashId = null) {
		$this->layout = 'default';
		if($this->request->isPost()) {
			$this->Order->set($this->request->data);
			if($this->Order->validates()) {
				$this->makeOrder($this->request->data);
			}
			$hashId = $this->request->data['Order']['hash_key'];
		} else {
			if($this->Session->check('order.user')) {
				$this->request->data = $this->Session->read('order.user');
				unset($this->request->data['Order']['amount']);
				unset($this->request->data['Order']['hash_key']);
			}
		}
		$product = $this->RewriteUrl->getProductDetailByHashId($hashId);
		if(isset($product))  {
			$this->set('product', $product);
			$this->set('hash_id', $hashId);
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
	public function makeOrder($order_info = array()) {
		$user_id = 1;
		$paymentArr = array();
		$paymentArr['Payment']['user_id'] = $user_id;
		$paymentArr['Payment']['processed_at'] = date('Y-m-d H:i:s', time());
		if($this->Payment->save($paymentArr)) {
			$info=array();
			$info['FIRSTNAME']=$order_info['Order']['first_name'];
			$info['LASTNAME']=$order_info['Order']['last_name'];
			$info['ADDRESS']=$order_info['Order']['address'];
			$info['CITY']=$order_info['Order']['city'];
			$info['COUNTRY']=$order_info['Order']['county'];
			$info['STATE']=$order_info['Order']['county'];
			$info['ZIP']=$order_info['Order']['postalcode'];
			$this->Session->write('order.user', $order_info);
			$info['CARDNUMBER']=$order_info['Order']['cnumber'];				
			$info['CARDTYPE']=$order_info['Order']['ctype'];
			$info['CARDCODE']=$order_info['Order']['c_secure_code'];
			$info['EXPDATE']=$order_info['Order']['exp_month'].$order_info['Order']['exp_year'];
			$info['EXPMONTH']=$order_info['Order']['exp_month'];
			$info['EXPYEAR']=$order_info['Order']['exp_year'];
			$info['AMOUNT']=$order_info['Order']['amount'];
			$info['INVOICEID']=$this->Payment->id;
			$info['RETURN_URL']=SITE_URL.'orders/order_success';
			$info['CANCEL_URL']= SITE_URL.'orders/order_cancel';
			$info['EMAIL']=TEST_EMAIL;
			$paymentArr['Payment']['id'] = $this->Payment->id;
			$isValidatePrd = $this->validatePaymentPrice($order_info['Order']);
			if(!$isValidatePrd) {
				$this->Session->setFlash('The transaction could not be loaded,Internal Error');
				$this->redirect(SITE_URL);
				exit;
			}
			if($this->request->data['Order']['payment_type'] == 'DoDirectPayment') {
				$gatewayresponse=$this->Paypal->processPayment($info,'DoDirectPayment');
			} else if($this->request->data['Order']['payment_type'] == 'ExpressCheckout') {
					$tokenArr = $this->Paypal->processPayment($info,'SetExpressCheckout');
					if($tokenArr['ACK'] == 'Success' ) {
						$paymentArr['Payment']['token'] = $tokenArr['TOKEN'];
						$paymentArr['Payment']['timestamp'] = $tokenArr['TIMESTAMP'];
						$paymentArr['Payment']['correlationid'] = $tokenArr['CORRELATIONID'];
						$this->update_payment($tokenArr, $paymentArr, false, false);
						$this->redirect(PAYPAL_URL. $tokenArr['TOKEN'].'&useraction=commit');
						exit;
					}
			} else {
				$this->Session->setFlash('Invalid Payment Type Selection, Try Again');
				$this->redirect(SITE_URL);
				exit;
			}
			if(isset($gatewayresponse['ACK']) && $gatewayresponse['ACK']=='Success') {
				$paymentArr['Payment']['amount'] = $order_info['Order']['amount'];
				$paymentArr['Payment']['token'] = $gatewayresponse['TOKEN'];
				$paymentArr['Payment']['timestamp'] = $gatewayresponse['TIMESTAMP'];
				$paymentArr['Payment']['correlationid'] = $gatewayresponse['CORRELATIONID'];
				$paymentArr['Payment']['transaction_id'] = $gatewayresponse['TRANSACTIONID'];
				$this->update_payment($gatewayresponse, $paymentArr, true);
				//$this->sendMail($isValidatePrd);
			} else {
				$this->update_payment($gatewayresponse, $paymentArr, false);
			}
		} else {
			$this->Session->setFlash('Unable to update the payment.');
		}
		$this->redirect(SITE_URL);
		exit;
	}
	public function beforeFilter() {
		parent::beforeFilter();
	}
	public function sendMail($prdArr = array()) {
		if(!empty($prdArr)) {
			App::uses('CakeEmail', 'Network/Email');
			$email = new CakeEmail();
			$email->template('buyer_order');
			$email->emailFormat('html');
			$email->to(TEST_EMAIL);
			$email->from(ADMIN_EMAIL);
			$email->subject('Order from XXX');
			$email->viewVars( array('username' => 'test',
							'product_name' => $prdArr['name'],
							'amount' => $prdArr['amount']
			));
			if($email->send()) {
				$this->Session->setFlash('Thank you for you order.');
			}
		}
	}

	/** 
	* Check payment is equvalent to payment value 
	* validate with current price and product price
	*/
	public function validatePaymentPrice($orderArr = array()) {
		if(empty($orderArr) || !isset($orderArr['hash_key'])) {
			return false;
		}
		$this->Offer->unbindModel(array('hasOne' => array('RewriteUrl')));
		$this->Service->unbindModel(array('hasOne' => array('RewriteUrl')));
		$checkPrd = $this->RewriteUrl->getUrlRewriteinfoByIdentity($orderArr['hash_key']);
		if(empty($checkPrd)) {
			return false;
		}
		return $this->$checkPrd['controller_name']->find('first', array(
				'conditions' => array(
					'id' => $checkPrd[strtolower($checkPrd['controller_name']).'_id'],
					'amount' => $orderArr['amount']
				)
			));
	}
	private function update_payment($gatewayresponse, $paymentArr = array(), $status = 0, $completed = true) {
		$paymentArr['Payment']['status'] = $status;
		$this->Payment->save($paymentArr);
		if(!$completed) {
			return;
		}
		if($status) {
			$this->Session->delete('order.user');
			$this->Session->setFlash('Your Payment is successfully processed.');
			$this->redirect(SITE_URL);
		} else {
			if(isset($gatewayresponse['L_LONGMESSAGE0'])) {
				$this->Session->setFlash($gatewayresponse['L_LONGMESSAGE0']);
			} else {
				$this->Session->setFlash('The transaction could not be loaded,Internal Error');
			}
			if($this->Session->check('order.user')) {
				$order = $this->Session->read('order.user');
				if(isset($order['Order']['hash_key'])) {
					$this->redirect(array('plugin' => 'WidShop','controller' => 'orders', 'action' => 'confirm', $order['Order']['hash_key']));
					exit;
				}
			}
			$this->redirect(SITE_URL);
		}
		exit;
	}
	
	public function order_cancel() {
		
	}

	public function order_success() {
		$token = $this->request->query['token'];
		$paymentArr = $this->Payment->getpaymentByToken($token);
		$token_resp = $this->Paypal->processPayment($token,'GetExpressCheckoutDetails');
		if($token_resp['ACK'] == 'Success') {
			$token_resp['AMOUNT'] = $token_resp['AMT'];
			$token_resp['PAYERID'] = $this->request->query['PayerID'];
			$gatewayresponse =  $this->Paypal->processPayment($token_resp,'DoExpressCheckoutPayment');
			$paymentArr['Payment']['transaction_id'] = $gatewayresponse['TRANSACTIONID'];
			if($gatewayresponse['ACK'] == 'Success') {
				$this->update_payment($gatewayresponse, $paymentArr, true);
			} else {
				$this->update_payment($gatewayresponse, $paymentArr, false);
			}
		} else {
			$this->update_payment($gatewayresponse, $paymentArr, false);
		}
	}
}