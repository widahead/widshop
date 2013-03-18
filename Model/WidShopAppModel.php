<?php
/** 
* We manage url when we create any service and offers.
* We create unique url.
*/
App::uses('RewriteUrl', 'Model');
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
		if(!$id) {
			$this->data['RewriteUrl']['url_key'] = $this->createSlug($RewriteUrl, $this->data[$this->name]['name']);
		}
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