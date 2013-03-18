<?php
class Offer extends WidShopAppModel {
	var $name = 'Offer';
	public $hasOne = array('WidShop.RewriteUrl');
	public $validate = array(
		'service_id' => array(
		'rule' => array('comparison', '>' , '0'),
		'message' => 'Please select category'
		),
		'name' => array(
		'rule' => 'notEmpty',
		'message' => 'Please enter name'
		),			
		'description' => array(
		'rule' => 'notEmpty',
		'message' => 'enter name'
		),			
		'start_date' => array(
			'Rule-1' => array(
				'rule' =>  array('validateDateTime'),
				'message' => ' Date must be greter than today'
			)
		),
		'amount' => array(
		'rule' => 'numeric',
		'message' => 'Please enter numeric value'
		)
	);
	public function validateDateTime() {
		if((strtotime($this->data['Offer']['start_date']) >= strtotime($this->data['Offer']['end_date'])) && !$this->data['Offer']['one_day_deal']) {
			return  $this->validate['start_date']['Rule-2']['message'] = 'End Date time must be greter than end Start date time';
		}
		else 
			return true;
	}
	public function getOfferDetailById($slug) {
		$conditions = array();
		$conditions[] = 'RewriteUrl.url_key  =  "'.$slug.'"';
		$conditions[] = 'start_date	  <  "'.date('Y-m-d H:i:s').'"';
		$conditions[] = 'end_date	  >  "'.date('Y-m-d H:i:s').'"';
		$condition = implode(' AND ', $conditions);
		$offerDetail = $this->find('all', array('conditions' => array($condition)));
		if (count($offerDetail) != 0) {
			$offerDetail[0]['Offer']['identity'] = $offerDetail[0]['RewriteUrl']['identity'];
			return $offerDetail[0]['Offer'];
		}
		return null;
	}
}
?>