<div>
	<?php echo $this->Form->create('Category');?>
	<?php echo $this->Form->input('id', array('type' => 'hidden','label' => false));?>
	<div style="float:left; width:200px;">Category Name</div>
	<div style="float:left; margin-left:20px;"><?php echo $this->Form->input('name', array('label' => false));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px; margin-top:20px;">Description</div>
	<div style="float:left; margin-left:20px;margin-top:20px;">
		<?php echo $this->Form->input('description', array('label' => false, 'maxlength' => '500'));?>
		<p style="text-align:right"> 500 Words limit </p>
	</div>	<div style="clear:both"></div>
	<div style="margin-top:20px; float:left;"><?php echo $this->Form->submit('Save', array('label' => false));?>
	<?php echo $this->Form->end();?>
</div>