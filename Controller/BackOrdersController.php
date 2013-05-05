<?php 
class BackOrdersController extends WidShopAppController {
	var $name = 'BackOrders';
	public function index() {
		$bcOrders = $this->Offer->getExpiredOfferList();
		$this->set('bcOrders', $bcOrders);
	}
	public function backOrderView($slug = null) {
		$offerDetail = $this->Offer->getOfferDetailBySlug($slug, false);
		if(isset($offerDetail)) {
			$serviceCapt = $this->Service->find('all', array('conditions' => array('Service.id' => explode(',', $offerDetail['service_id'])), 'fields' => array('Service.name', 'RewriteUrl.url_key')));
			$this->set('serviceList', $serviceCapt);
			$this->set('offer', $offerDetail);
		} else {
			$this->Session->setFlash(__('Invalid url'));
			$this->redirect(SITE_URL);
			exit;
		}
	}
	public function confirm($hashId = null) {
		if($this->request->isPost()) {
			$this->BackOrder->set($this->request->data);
			$hashId = $this->request->data['BackOrder']['hash_key'];
			if($this->BackOrder->validates()) {
				$this->request->data['BackOrder']['service_id'] = $this->RewriteUrl->getOffersServiceIdByHashId($hashId);
				$this->request->data['BackOrder']['created_at'] = date('Y-m-d H:i:s', time());
				$this->request->data['BackOrder']['updated_at'] = date('Y-m-d H:i:s', time());
				$this->BackOrder->Save($this->request->data, false);
				$this->Session->setFlash(__('Thank you to make order. We will send mail when we activate this service/offer.'));
				$this->redirect(SITE_URL);
				exit;
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
}