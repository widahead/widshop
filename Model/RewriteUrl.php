<?php
class RewriteUrl extends WidShopAppModel {
	var $name = 'RewriteUrl';
	public function getUrlKeyByControllerAndId($controller = null, $fieldIdName = null, $id){
		 $urlKey = $this->find('first', array('conditions' => array('controller_name' => $controller, $fieldIdName => $id), 'fields' => array('url_key')));
		 return $urlKey['RewriteUrl']['url_key'];
	}
	public function getProductDetailByHashId($hashId) {
		$HashDetail = $this->find('first', array('conditions' => array('identity' => $hashId), 'fields' => array('controller_name', 'service_id', 'offer_id')));
		App::import('Model', "WidShop.".$HashDetail['RewriteUrl']['controller_name']);
		$productDetail = new $HashDetail['RewriteUrl']['controller_name'];
		$productInfo = array();
		if(!empty($HashDetail['RewriteUrl']['service_id']))
			$productInfo = $productDetail->findById($HashDetail['RewriteUrl']['service_id']);
		else
			$productInfo = $productDetail->findById($HashDetail['RewriteUrl']['offer_id']);
		if(isset($productInfo[$HashDetail['RewriteUrl']['controller_name']]['start_date']) && $productInfo[$HashDetail['RewriteUrl']['controller_name']]['start_date']  < time('Y-m-d H:i:s') && $productInfo[$HashDetail['RewriteUrl']['controller_name']]['end_date']  > time('Y-m-d H:i:s')) {
			return false;
		}
		return $productInfo[$HashDetail['RewriteUrl']['controller_name']];
	}
	public function getUrlRewriteinfoByIdentity($identity) {
		$checkPrd = $this->find('first', array(
					'conditions' => array('identity' =>$identity),
					'fields' => array('controller_name', 'service_id', 'offer_id')
				));
		if(empty($checkPrd)) {
			return null;
		}
		return $checkPrd['RewriteUrl'];
	}
}
?>