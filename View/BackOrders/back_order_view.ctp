<div>
	<div style="float:left;" class="productImg">
			<div><?php echo $this->Image->resize($offer['image'], 100, 100, true);?></div>
			<div><?php echo $this->Image->resize($offer['thumb1'], 100, 100, true);?></div>
			<div><?php echo $this->Image->resize($offer['thumb2'], 100, 100, true);?></div>
	</div>
	<div class="productDetail" style="float:left;margin-left:20px;">
		<div class="productInfo">
			<div class="productTitle">
				<h3><?php echo $offer['name']?></h3>
			</div>
			<br class="clear"/>
			<div id="priceDescription">
				<div id="actualAmount"> 
					<div> Total Amount </div>
					<hr />
					<div> 
						<?php echo $this->Number->currency($offer['tot_amount'], $currency_code); ?>
					</div>
				</div>
				<div id="saveAmount">
					<div> You Save </div>
					<hr />
					<div> 
						<?php echo $this->Number->currency($offer['tot_amount'] - $offer['amount'],  $currency_code);?>
					</div>
				</div>
				<div id="currentAmount"> 
					<div> Current Amount  </div>
					<hr />
					<div> <?php echo $this->Number->currency($offer['amount'], $currency_code)?></div>
				</div>
				<br class="clear"/>
			</div>
		</div>
		<div style="text-align:right; padding:10px;">
			<?php echo $this->Html->link('Back Order', array('controller' =>'back_orders', 'action' => 'confirm', $offer['identity']), array('class' => 'button'))?>
		</div>
		<div style="text-align:left;">
			<div>Description: </div>
			<div style="margin-top:10px;"><?php echo $offer['description']?></div>
		<div>
		<hr style="margin-top:15px;"/>
		<div style="padding-top:5px;">
			<h5 style="text-decoration:underline; margin-bottom:5px;"> Services Included </h5>
			<?php 
				foreach($serviceList as $service) {
					echo '<div>'.$this->Html->link($service['Service']['name'], array('controller' => 'services', 'action' =>'view', 'slug' =>$service['RewriteUrl']['url_key'])).'</div>';
				}
			?>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>