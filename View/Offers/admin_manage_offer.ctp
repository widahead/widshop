<div>
	<?php echo $this->Form->create('Offer', array("enctype"=>"multipart/form-data"));?>
	<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
	<div style="float:left; width:200px;">Service Name</div>
	<div style="float:left; margin-left:20px;"><?php 
		$selectedOffers = array();
		if(isset($this->request->data['Offer']['service_id']) && !is_array($this->request->data['Offer']['service_id']))
			$selectedOffers = explode(',', $this->request->data['Offer']['service_id']);
		else if(isset($this->request->data['Offer']['service_id']) && is_array($this->request->data['Offer']['service_id']))
			$selectedOffers = $this->request->data['Offer']['service_id'];
		echo $this->Form->input('service_id', array('type' => 'select', 'label' => false, 'multiple' => 'multiple', 'selected' => $selectedOffers));
	?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px;margin-top:20px;">Offer Name</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('name', array('label' => false));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Description</div>
	<div style="float:left; margin-left:20px;margin-top:20px;">
		<?php echo $this->Form->input('description', array('label' => false, 'maxlength' => '500'));?>
		<p style="text-align:right"> 500 Words limit </p>
	</div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">One Day Deal</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('one_day_deal', array('label' => false, 'type' => 'select', 'options' => array('0' => 'No', '1' => 'Yes')));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Start Date</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('start_date', array('label' => false));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">End Date</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('end_date', array('label' => false));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Total Amount</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('tot_amount', array('label' => false, 'type' => 'text'));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Service Amount</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('amount', array('label' => false, 'type' => 'text'));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Service Image</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('image', array('label' => false , 'type' => 'file'));?></div>
	<div style="float:left;">
		<?php if(!empty($this->request->data['Offer']['image']))
			echo $this->Image->resize($this->request->data['Offer']['image'], 50, 50, true);?>
	</div>
	<?php 
		 if(!empty($this->request->data['Offer']['image']))
			echo $this->Form->input('old_image', array('type' => 'hidden', 'value' =>@$this->request->data['Offer']['image'], 'label' => false));?>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Thumb Image</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('thumb1', array('label' => false , 'type' => 'file'));?></div>
	<?php 
		if(!empty($this->request->data['Offer']['thumb1']))
			echo $this->Form->input('old_thumb1', array('type' => 'hidden', 'value' =>@$this->request->data['Offer']['thumb1'], 'label' => false));?>
	<div style="float:left;">
		<?php if(!empty($this->request->data['Offer']['thumb1']))
				echo $this->Image->resize($this->request->data['Offer']['thumb1'], 50, 50, true);
		?>
	</div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Thumb Image</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('thumb2', array('label' => false , 'type' => 'file'));?></div>
	<?php if(!empty($this->request->data['Offer']['thumb2']))
			echo $this->Form->input('old_thumb2', array('type' => 'hidden', 'value' =>@$this->request->data['Offer']['thumb2'], 'label' => false));?>	
	<div style="float:left;"><?php 
		if(!empty($this->request->data['Offer']['thumb2']))
			echo $this->Image->resize($this->request->data['Offer']['thumb2'], 50, 50, true);?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Meta tag Keyword</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('keyword', array('label' => false, 'maxlength' => '500'));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Meta tag Description</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('meta_tag_description', array('label' => false, 'maxlength' => '500'));?></div>
	<div style="clear:both"></div>
	<div style="margin-top:20px; float:left;"><?php echo $this->Form->submit('Save', array('label' => false));?>
	<?php echo $this->Form->end();?>
</div>