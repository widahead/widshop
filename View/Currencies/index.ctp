<div>
	<?php echo $this->Form->create('Currency');?>
	<?php echo $this->Form->input('id', array('type' => 'hidden','label' => false));?>
	<div style="float:left; width:200px;">Currency Name</div>
	<div style="float:left; margin-left:20px;"><?php echo $this->Form->input('currency', array('label' => false));?></div>
	<div style="clear:both"></div>
	<div style="float:left; width:200px;margin-top:20px;">Symbol Code (In HTML)</div>
	<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('symbol', array('label' => false, 'maxlength' => '10'));?></div>
	<div style="clear:both"></div>
	<div style="margin-top:20px; float:left;"><?php echo $this->Form->submit('Save', array('label' => false));?>
	<?php echo $this->Form->end();?>
</div>