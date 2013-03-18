<?php
/**
* Pages::product listed the products and offers. 
* Here we list normat product / services, Offers, 
* one day deal based on category or all products with SEO enabled urls.
*/
App::uses('AppController', 'Controller');
class PagesController extends WidShopAppController {
	public $name = 'Pages';
	public function display() {
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	public function product($category_title = null) {
		$products = array();
		$conditions = array();
		if(isset($category_title)) {
			$cat_id = $this->Category->getCategoryIdByTitle($category_title);
			$conditions = array('category_id' => $cat_id);
		}
		$products = $this->Service->find('all', array('conditions' => $conditions));
		$productCollection = array();
		$counter = 0;
		foreach($products as $product){
			if(isset($product['Offer']) && count($product['Offer']) > 0) {
				foreach($product['Offer'] as $offer) {
					$productCollection[$counter] = $offer;
					$productCollection[$counter]['product_url'] = 'offers';
					$productCollection[$counter]['urlSlug'] = $this->RewriteUrl->getUrlKeyByControllerAndId('Offer', 'offer_id', $offer['id']);
					$counter++;
				}
			} else {
				$productCollection[$counter] = $product['Service'];
				$productCollection[$counter]['product_url'] = 'services';
				$productCollection[$counter]['urlSlug'] = $product['RewriteUrl']['url_key'];
				$counter++;
			}
		}
		$offer_products = $this->Offer->find('all', array('conditions' => array('is_bundle' => true, 'start_date <= NOW() AND end_date >= NOW()')));
		if(isset($offer_products) && count($offer_products) > 0) {
			foreach($offer_products as $offer) {
				$productCollection[$counter] = $offer['Offer'];
				$productCollection[$counter]['product_url'] = 'offers';
				$productCollection[$counter]['urlSlug'] = $this->RewriteUrl->getUrlKeyByControllerAndId('Offer', 'offer_id', $offer['Offer']['id']);
				$counter++;
			}
		}
		$this->set('productCollection',$productCollection);		
	}
	public function beforeFilter() {
		/** Get all links that are showing on left part of the view */
		$categories = $this->Category->getAllCategoryLinks();
		$this->set('categories', $categories);
		parent::beforeFilter();
	}

	public function work() {
		
	}
}