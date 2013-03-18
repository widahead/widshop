<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends WidShopAppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
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
			$category = $this->Category->find('first', array('conditions' => array('url_key' => $category_title), 'fields' => 'id'));
			$conditions = array('category_id' => $category['Category']['id']);
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
		$categories = $this->Category->getAllCategoryLinks();
		$this->set('categories', $categories);
		parent::beforeFilter();
	}

	public function work() {
		
	}
}