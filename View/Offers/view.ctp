<?php echo $this->Html->Script('/wid_shop/js/timer'); ?>
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
			<?php if($offer['one_day_deal']) { ?>
			<div class="timeToLeft">
				<div id="holder">
					<div id="timer">
						<div id="countdown">
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/bkgd.gif', array('height' => '21', 'width' => '16', 'name' => 'h1'))?>
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/bkgd.gif', array('height' => '21', 'width' => '16', 'name' => 'h2'))?>
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/colon.png', array('id' => 'colon2', 'width' => '9', 'name' => 'g1'))?>
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/bkgd.gif', array('height' => '21', 'width' => '16', 'name' => 'm1'))?>
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/bkgd.gif', array('height' => '21', 'width' => '16', 'name' => 'm2'))?>
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/colon.png', array('id' => 'colon3', 'width' => '9', 'name' => 'j1'))?>
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/bkgd.gif', array('height' => '21', 'width' => '16', 'name' => 's1'))?>
							<?php echo $this->Html->image('/wid_shop/img/digital-numbers/bkgd.gif', array('height' => '21', 'width' => '16', 'name' => 's2'))?>
						</div>
					</div>
				</div>
			</div>
			<?php }  ?>
			<br class="clear"/>
			<div id="priceDescription">
				<div id="actualAmount"> 
					<div> Total Amount </div>
					<hr />
					<div> <?php echo $currency.''.$offer['tot_amount']?></div>
				</div>
				<div id="saveAmount">
					<div> You Save </div>
					<hr />
					<div> <?php echo $currency.''.($offer['tot_amount'] - $offer['amount'])?></div>
				</div>
				<div id="currentAmount"> 
					<div> Current Amount  </div>
					<hr />
					<div> <?php echo $currency.''.$offer['amount']?></div>
				</div>
				<br class="clear"/>
			</div>
		</div>
		<div style="text-align:right; padding:10px;">
			<?php echo $this->Html->image('/wid_shop/img/buy.png', array('url' => array('controller' =>'orders', 'action' => 'confirm', $offer['identity'])), array('style' => 'text-decoration:none;'))?>
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
					echo '<div>'.$this->Html->link($service['Service']['name'], array('controller' => 'service', 'action' =>$service['RewriteUrl']['url_key'])).'</div>';
				}
			?>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
<script type="text/javascript">
<!--
	<?php if($offer['one_day_deal']) { ?>
		countdown(<?php echo date('Y');?>,<?php echo date('m');?>,<?php echo date('d');?>,<?php echo date('H');?>,<?php echo date('i');?>);
	<?php } ?>
//-->
</script>