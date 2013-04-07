<div>
	<?php echo $this->Form->create('Currency');?>
	<div style="float:left; width:200px;">Select Country</div>
	<div style="float:left; margin-left:20px;">
		<?php echo $this->Form->input('currency', array('label' => false, 'type' => 'select', 'options' => $currency_list, 'empty' => 'Choose One', 'selected' => $c_selected));?>
	</div>
	<div>This will load Currency according to country. </div>
	<div style="clear:both"></div>
	<div style="margin-top:20px; float:left;"><?php echo $this->Form->submit('Save', array('label' => false));?>
	<?php echo $this->Form->end();?>
</div>