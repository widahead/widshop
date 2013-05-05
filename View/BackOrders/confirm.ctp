<div>
	<div style="float:left;" class="order_product_desc">
		<?php echo $this->Image->resize($product['image'], 100, 100, true);?>
	</div>
	<div class="order_product">
		<div class="title"><?php echo $product['name']?></div>
		<div class="price">
			<?php echo $this->Number->currency($product['amount'], $currency_code)?>
		</div>
	</div>
	<div style="clear:both;"></div>
	<hr style="margin-top:20px;"/>
	<?php echo $this->Form->Create('BackOrder')?>
	<?php echo $this->Form->hidden('act_amount', array('value' => $product['amount']));?>
	<?php echo $this->Form->hidden('hash_key', array('value' => $hash_id));?>
	<div>
		<div style="text-align:left;"><h3>Shipping Information</h3></div>
		<div style="float:left; width:100px;">First Name</div>
		<div style="float:left; margin-left:10px;"><?php echo $this->Form->input('f_name', array('label' => false));?></div>
		<div style="float:left; width:150px;">Last Name</div>
		<div style="float:left; margin-left:10px;"><?php echo $this->Form->input('l_name', array('label' => false));?></div>
		<div style="clear:both"></div>
		<div style="float:left; width:100px; margin-top:20px;">Email</div>
		<div style="float:left; margin-left:10px;margin-top:20px;"><?php echo $this->Form->input('email', array('label' => false));?></div>
		<div style="clear:both"></div>
		<div style="text-align:left; color:red; margin-top:20px; margin-left:100px;">Min And Max limit of amount you can afford</div>
		<div style="float:left; width:100px; margin-top:20px;">Min Price</div>
		<div style="float:left; margin-left:10px;margin-top:20px;"><?php echo $this->Form->input('min_price', array('type' => 'text', 'label' => false));?></div>
		<div style="float:left; width:140px; margin-top:20px;">Max Price</div>
		<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('max_price', array('type' => 'text', 'label' => false));?></div>
		<div style="clear:both;"></div>
	</div>
	<div style='text-align:right;'>
		<?php echo $this->Form->submit('Book Order');?>
	</div>
	<?php echo $this->Form->End(); ?>
</div>