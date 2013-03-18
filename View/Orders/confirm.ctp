<div>
	<div style="float:left;" class="order_product_desc">
		<?php echo $this->Image->resize($product['image'], 100, 100, true);?>
	</div>
	<div class="order_product">
		<div class="title"><?php echo $product['name']?></div>
		<div class="price"><?php echo $currency.''.$product['amount']?></div>
	</div>
	<div style="clear:both;"></div>
	<hr style="margin-top:20px;"/>
	<?php echo $this->Form->Create('Order', array('action' => 'makeOrder'))?>
	<div>
		<div style="text-align:left;"><h3>Shipping Information</h3></div>
		<div style="float:left; width:100px;">User Name</div>
		<div style="float:left; margin-left:10px;"><?php echo $this->Form->input('name', array('label' => false));?></div>
		<div style="float:left; width:150px;">Address</div>
		<div style="float:left; margin-left:10px;"><?php echo $this->Form->input('address', array('label' => false));?></div>
		<div style="clear:both"></div>
		<div style="float:left; width:100px; margin-top:20px;">County</div>
		<div style="float:left; margin-left:10px;margin-top:20px;"><?php echo $this->Form->input('county', array('label' => false));?></div>
		<div style="float:left; width:140px; margin-top:20px;">Postal Code</div>
		<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('postalcode', array('label' => false));?></div>
		<div style="clear:both;"></div>
	</div>
	<hr style="margin-top:50px;"/>

	<div>
		<div style="text-align:left;"><h3>Card Information</h3></div>
		<div style="float:left; width:100px;">Card Type</div>
		<div style="float:left; margin-left:20px;"><?php echo $this->Form->input('ctype', array('label' => false));?></div>
		<div style="float:left; width:150px;">Card Holder Name</div>
		<div style="float:left;"><?php echo $this->Form->input('cname', array('label' => false));?></div>
		<div style="clear:both"></div>
		<div style="float:left; width:100px; margin-top:20px;">Card Number</div>
		<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('cnumber', array('label' => false));?></div>
		<div style="float:left; width:200px; margin-top:20px;">Expire On</div>
		<div style="float:left; margin-left:20px;margin-top:20px;">
			<div style="float:left;">
				<?php echo $this->Form->input('expire_year', array('label' => false, 'style' => 'width:100px;'));?>
			</div>
			<div style="float:left; margin-left:20px;">
			<?php echo $this->Form->input('expire_month', array('label' => false, 'style' => 'width:100px;'));?>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style='text-align:right;'>
		<?php echo $this->Form->submit('Place Order');?>
	</div>
	<?php echo $this->Form->End(); ?>
</div>