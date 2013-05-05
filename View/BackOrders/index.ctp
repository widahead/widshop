<div id="right_block"><?php echo $this->element('right_block'); ?></div>
<div> Expired Offers List</div>
<hr/>
<div id="content_block">
	<?php if(count($bcOrders) <= 0) { ?>
		<div style="text-align:center;width: 660px;">No Product Found</div>
	<?php } ?>
	<ul class="product_box">
	<?php 
		$productCounter = 1;
		foreach($bcOrders as $bcOrder){ ?>
		<li class="product">
				<div class="title"><?php echo $bcOrder['Offer']['name'];?></div>
				<div class="product_image">
					<?php if(isset($bcOrder['Offer']['one_day_deal'])) { ?>
						<div class="offer">
							<?php echo $this->Html->Image('/wid_shop/img/save_image.png');?>
						</div>
					<?php } ?>
					<div class="product_image_resize">
						<?php echo $this->Image->resize($bcOrder['Offer']['image'], 180, 180, true);?>
					</div>
				</div>
				<div>
					<div class="price">
						<?php echo $this->Number->currency($bcOrder['Offer']['amount'], $currency_code);?>
					</div>
				</div>
				<div>
					<?php echo $this->Html->image('/wid_shop/img/order_now_button.png', array('url' => array('controller' => 'back_orders', 'action' => 'backOrderView', 'slug' =>$bcOrder['RewriteUrl']['url_key'])))?>
				</div>
		</li>
		<?php 
			if($productCounter % 3 == 0) {
				echo '<div style="clear:both"></div></ul><ul class="product_box siblings">';
			}
			$productCounter++;
		}
	?>
	</ul>
</div>
<div style="clear:both"></div>