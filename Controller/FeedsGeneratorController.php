<?php 
class FeedsGeneratorController extends WidShopAppController {
	var $name = 'FeedsGenerator';
	public function admin_index() {
		$products = $this->Service->find('all');
		$productCollection = array();
		$counter = 0;		
		$xml = new SimpleXMLElement('<xml/>');
		foreach($products as $product){
			$productXML = $xml->addChild('product');
			$productXML->addChild('name', $product['Service']['name']);
			$productXML->addChild('image_url', SITE_URL.'img/'.$product['Service']['image']);
			$productXML->addChild('product_url', SITE_URL.'service/'.$product['RewriteUrl']['url_key']);
			$productXML->addChild('amount', $product['Service']['amount']);
			$counter++;
			if(isset($product['Offer']) && count($product['Offer']) > 0) {
				foreach($product['Offer'] as $offer) {
					$productXML = $xml->addChild('product');
					$productXML->addChild('name', $offer['name']);
					$productXML->addChild('image_url', SITE_URL.'img/'.$offer['image']);
					$productXML->addChild('product_url', SITE_URL.'offer/'.$this->RewriteUrl->getUrlKeyByControllerAndId('Offer', 'offer_id', $offer['id']));
					$productXML->addChild('amount', $offer['amount']);
					$counter++;
				}
			}
		}
		header('Content-type: text/xml'); 
		print($xml->asXML());
		exit;
	}
	public function beforeFilter() {
		parent::beforeFilter();
	}
}