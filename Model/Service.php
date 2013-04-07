<?php
class Service extends WidShopAppModel {
	var $name = 'Service';
	var $hasOne = array('WidShop.RewriteUrl');
	var $hasMany = array (  
			'Offer' => array(
				'className' => 'WidShop.Offer', 'foreignKey' => 'service_id',
				'conditions' => array('start_date <= NOW() AND end_date >= NOW()')
            ) 
        ); 
	
	public $validate = array(
		'category_id' => array(
			'rule' => array('comparison', '>' , '0'),
			'message' => 'Please select category'
		),
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter name'
		),
		'amount' => array(
			'rule' => 'numeric',
			'message' => 'Please enter numeric value'
		), 
		'description' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter description'
		),
		'image' => array(
			'rule' =>  array('validateImgExt'),
			'message' => 'Image should have jpg, png, jpeg or gif format.'
		),

	);
	public function getAllServices() {
		$serviceArray = array();
		$services = array();
		$serviceArray = $this->find('all', array('fields' => array('id', 'name')));
		foreach($serviceArray as $key => $service)
			$services[$service['Service']['id']] = $service['Service']['name'];
		return $services;
	}
	public function getServiceDetailById($slug){
		$serviceDetail = $this->find('all', array('conditions' => array('RewriteUrl.url_key' => $slug)));
		if (count($serviceDetail) != 0) {
			$serviceDetail[0]['Service']['identity'] = $serviceDetail[0]['RewriteUrl']['identity'];
			return $serviceDetail[0]['Service'];
		}
		return null;
	}
	public function afterSave(){
		parent::afterSave();
	}
}
?>