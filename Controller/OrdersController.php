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
			/*
			$request_params = array
               (
               'METHOD' => 'DoDirectPayment', 
               'USER' => 'widahead-facilitator_api1.gmail.com', 
               'PWD' => '1364985630', 
               'SIGNATURE' => 'AjbkUZZpMOw92mhGqtiMwaO9CZwqAQUfpCKIZX82rl79LcaQC-zAiEHL', 
               'VERSION' => '98.0', 
               'PAYMENTACTION' => 'Sale',                
               'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
               'CARDTYPE' => 'MasterCard', 
               'CARDNUMBER' => '5522340006063638',
				'EXPMONTH' => '04',
				'EXPYEAR' => '2018',
               'EXPDATE' => '042018',        
               'CARDCODE' => '456', 
               'FIRSTNAME' => 'Tester', 
               'LASTNAME' => 'Testerson', 
               'ADDRESS' => '707 W. Bay Drive', 
               'CITY' => 'Largo', 
               'STATE' => 'FL',              
               'COUNTRY' => 'US', 
               'ZIP' => '33770', 
               'AMOUNT' => '100.00', 
               'CURRENCYCODE' => 'USD', 
               'DESC' => 'Testing Payments Pro',
				'EMAIL' =>TEST_EMAIL,
				'INVOICEID' =>$this->Payment->id
               );
			*/
			$info['FIRSTNAME']=$order_info['Order']['first_name'];
			$info['LASTNAME']=$order_info['Order']['last_name'];
			$info['ADDRESS']=$order_info['Order']['address'];
			$info['CITY']=$order_info['Order']['city'];
			$info['COUNTRY']=$order_info['Order']['county'];
			$info['STATE']='FL';
			$info['ZIP']=$order_info['Order']['postalcode'];
			$info['CARDNUMBER']=$order_info['Order']['cnumber'];				
			$info['CARDTYPE']=$order_info['Order']['ctype'];
			$info['CARDCODE']=$order_info['Order']['c_secure_code'];			
			$info['EXPDATE']=$order_info['Order']['exp_month'].$order_info['Order']['exp_year'];
			$info['EXPMONTH']=$order_info['Order']['exp_month'];
			$info['EXPYEAR']=$order_info['Order']['exp_year'];
			$info['AMOUNT']=$order_info['Order']['amount'];
			$info['INVOICEID']=$this->Payment->id;
			$info['EMAIL']=TEST_EMAIL;
			$paymentArr['Payment']['id'] = $this->Payment->id;
			$isValidatePrd = $this->validatePaymentPrice($order_info['Order']);
			if(!$isValidatePrd) {
				$this->Session->setFlash('The transaction could not be loaded,Internal Error');
				$this->redirect(SITE_URL);
				exit;
			}
			$gatewayresponse=$this->Paypal->processPayment($info,'DoDirectPayment');
			if(isset($gatewayresponse['ACK']) && $gatewayresponse['ACK']=='Success') {
				$paymentArr['Payment']['status'] = 1;
				$paymentArr['Payment']['amount'] = $order_info['Order']['amount'];
				$this->Payment->save($paymentArr);
				$this->Session->setFlash('Your Payment is successfully processed.');
				//$this->sendMail($isValidatePrd);
			} else {
				if(isset($gatewayresponse['L_LONGMESSAGE0']))
					$this->Session->setFlash($gatewayresponse['L_LONGMESSAGE0']);
				else
					$this->Session->setFlash('The transaction could not be loaded,Internal Error');
				$paymentArr['Payment']['status'] = 0;
				$this->Payment->save($paymentArr);
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
}