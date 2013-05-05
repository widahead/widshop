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
	<?php echo $this->Form->Create('Order')?>
	<?php echo $this->Form->hidden('amount', array('value' => $product['amount']));?>
	<?php echo $this->Form->hidden('hash_key', array('value' => $hash_id));?>
	<div>
		<div style="text-align:left;"><h3>Shipping Information</h3></div>
		<div style="float:left; width:100px;">First Name</div>
		<div style="float:left; margin-left:10px;"><?php echo $this->Form->input('first_name', array('label' => false));?></div>
		<div style="float:left; width:150px;">Last Name</div>
		<div style="float:left; margin-left:10px;"><?php echo $this->Form->input('last_name', array('label' => false));?></div>
		<div style="clear:both"></div>
		<div style="float:left; width:100px; margin-top:20px;">Address</div>
		<div style="float:left; margin-left:10px;margin-top:20px;"><?php echo $this->Form->input('address', array('label' => false));?></div>
		<div style="float:left; width:150px; margin-top:20px;">City</div>
		<div style="float:left; margin-left:10px;margin-top:20px;"><?php echo $this->Form->input('city', array('label' => false));?></div>
		<div style="clear:both"></div>

		<div style="float:left; width:100px; margin-top:20px;">County</div>
		<div style="float:left; margin-left:10px;margin-top:20px;"><?php echo $this->Form->input('county', array('label' => false));?></div>
		<div style="float:left; width:140px; margin-top:20px;">Postal Code</div>
		<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('postalcode', array('label' => false));?></div>
		<div style="clear:both;"></div>
	</div>
	<hr style="margin-top:50px;"/>
	<div class="payment_box">
		<h2> Payment</h2>
		<div style="float:left;">
			<?php echo $this->Form->input('payment_type', array('type' => 'radio','options'=> array('ExpressCheckout' => 'Express Checkout', 'DoDirectPayment' => 'Paypal Direct Payment'), 'legend' => false, 'default' => 'ExpressCheckout', 'class' => 'paymnt_opt'));?>

		</div>
		<div style="float:left; display:none;" id="paypal_card_box">
			<div style="float:left; width:100px;">Card Type</div>
			<div style="float:left; margin-left:20px;"><?php echo $this->Form->input('ctype', array('label' => false));?></div>
			<div style="float:left; width:150px;">Card Number</div>
			<div style="float:left;"><?php echo $this->Form->input('cnumber', array('label' => false));?></div>
			<div style="clear:both"></div>
			<div style="float:left; width:100px; margin-top:20px;">Card Code</div>
			<div style="float:left; margin-left:20px;margin-top:20px;"><?php echo $this->Form->input('c_secure_code', array('label' => false));?></div>
			<div style="float:left; width:200px; margin-top:20px;">Expire On</div>
			<div style="float:left; margin-left:20px;margin-top:20px;">
				<div style="float:left;">
					<?php echo $this->Form->input('exp_year', array('label' => false, 'style' => 'width:100px;', 'default' => 'Year'));?>
				</div>
				<div style="float:left; margin-left:20px;">
				<?php echo $this->Form->input('exp_month', array('label' => false, 'style' => 'width:100px;', 'default' => 'Month'));?>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style='text-align:right;'>
		<?php echo $this->Form->submit('Place Order');?>
	</div>
	<?php echo $this->Form->End(); ?>
</div>