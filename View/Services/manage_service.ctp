<div>
	<?php echo $this->Form->create('Service', array("enctype"=>"multipart/form-data"));?>	
	<div style="float:left; width:200px;">Category Name</div>
	<div style="float:left; margin-left:20px;"><?php echo $this->Form->input('category_id', array('type' => 'select', 'options' => $categories, 'label' => false, 'empty' => 'Choose One'));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px;margin-top:20px;">Service Name</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('name', array('label' => false));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Description</div>
	<div style="float:left; margin-left:20px;margin-top:20px;">
		<?php echo $this->Form->input('description', array('label' => false, 'maxlength' => '500'));?>
		<p style="text-align:right"> 500 Words limit </p>
	</div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Service Amount</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('amount', array('label' => false, 'type' => 'text'));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Service Image</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('image', array('label' => false , 'type' => 'file'));?></div>
	<div style="float:left;"><?php 
		if(isset($this->request->data['Service']['id']) && !empty($this->request->data['Service']['id']) && !empty($this->request->data['Service']['image']['name']))
			echo $this->Image->resize($this->request->data['Service']['image'], 100, 100, true);
		?>
	</div>
	<div style="clear:both"></div>
	<div style="margin-top:20px; float:left;"><?php echo $this->Form->submit('Save', array('label' => false));?>
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'label' => false));?>
	<?php echo $this->Form->input('old_image', array('type' => 'hidden', 'value' =>@$this->request->data['Service']['image'], 'label' => false));?>
	<?php echo $this->Form->end();?>
</div>