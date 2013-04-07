<div>
	<div style="float:left;">
		<div> 
			<?php echo $this->Image->resize($service['image'], 200, 200, true);?>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="float:left;margin-left:50px;">
		<h3><?php echo $service['name']?></h3>
		<div style="float:left;">
			Price <?php echo $this->Number->currency($service['amount'], $currency_code);?>
		</div>
		<div style="float:left; margin-left:20px;">
			<?php echo $this->Html->image('/wid_shop/img/buy.png', array('url' => array('controller' =>'orders', 'action' => 'confirm', $service['identity'])), array('style' => 'text-decoration:none;'))?>
		</div>
	
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
	<hr style="margin-top:10px;">
	<div style="text-align:left;">
		<div>Description: </div>
		<div style="margin-top:10px;"><?php echo $service['description']?></div>
	<div>
</div>