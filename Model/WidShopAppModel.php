<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('RewriteUrl', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class WidShopAppModel extends AppModel {
	public function afterSave(){
		if(!in_array($this->name, array('Service', 'Offer')))
			return;
		App::import('Model', 'WidShop.RewriteUrl');
		$RewriteUrl = new RewriteUrl();
		$modelNameId = strtolower($this->name);
		$id = $RewriteUrl->find('first', array('conditions' => array('controller_name' =>$this->name, $modelNameId."_id" =>$this->data[$this->name]['id'])));
		if($id)
			$this->data['RewriteUrl']['id'] = $id['RewriteUrl']['id'];
		$this->data['RewriteUrl'][$modelNameId."_id"] = $this->data[$this->name]['id'];
		$this->data['RewriteUrl']['controller_name'] = $this->name;
		if(!$id)
			$this->data['RewriteUrl']['url_key'] = $this->createSlug($RewriteUrl, $this->data[$this->name]['name']);
		$this->data['RewriteUrl']['identity'] = sha1(time());
		unset($this->data[$this->name]);
		$RewriteUrl->save($this->data);
	}
	public function createSlug($model = null, $string = null, $id = null) {
		$slug = Inflector::slug($string, '-');
		$slug = strtolower($slug);
		$i = 0;
		$params = array(
		  'conditions' => array('url_key' => $slug), 
		  'fields' => array('url_key'));
			while (count($model->find('all', $params)))  {
		  $i++;
		  $params['conditions']['url_key'] = $slug."-".$i;
		}
		if ($i) $slug .= "-".$i;
		return $slug.EXT;
	}
}