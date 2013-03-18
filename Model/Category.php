<?php
class Category extends WidShopAppModel {
	var $name = 'Category';
	public $validate = array(
		'name' => array(
		'rule' => 'notEmpty',
		'message' => 'Please enter name'
		),
		'description' => array(
		'rule' => 'notEmpty',
		'message' => 'Please enter description'
		)
	); 
	function getCategoryNameById($id) {
		$category = $this->findById($id);
		return $category['Category']['name'];
	}
	public function getAllCategories() {
		$categoryArray = array();
		$categoryArray = $this->find('list', array('fields' => array('id', 'name')));
		return $categoryArray;
	}
	public function getAllCategoryLinks() {
		$categoryArray = array();
		$categoryArray = $this->find('list', array('fields' => array('name', 'url_key')));
		return $categoryArray;
	}
	
	public function getAllCategory() {
		return $this->find('list');
	}
	public function afterSave(){
		$slug = parent::createSlug($this, $this->data['Category']['name']);
		$this->data['Category']['url_key'] = $slug ;
		$this->updateAll(array('url_key' => "'".$slug."'"), array('id' => $this->data['Category']['id']));
	}
	public function getCategoryIdByTitle($title = null) {
		$category = $this->find('first', array('conditions' => array('url_key' => $title), 'fields' => 'id'));
		return $category['Category']['id'];
	}
}
?>