<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript">
<!--
	var JS_BASE_URL = "<?php echo SITE_URL ?>";
//-->
</script>
<head>
	<?php 
	echo $this->Html->Script('/wid_shop/js/jquery-1.4.2.min'); 
	echo $this->Html->Script('/wid_shop/js/script');
	
	?>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css('/wid_shop/css/wid_shop');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Header part</h1>
		</div>
		<div id="content" align="center">
			<div style="width:1000px;"> 
				<div>
					<div style="float:left; padding-left:10px;"><?php echo $this->Html->link('Manage Category', array('controller' => 'categories', 'action' => 'index'));?></div>
					<div style="float:left; padding-left:10px;"><?php echo $this->Html->link('Manage Service', array('controller' => 'services', 'action' => 'index'));?></div>
					<div style="float:left; padding-left:10px;"><?php echo $this->Html->link('Manage Offer', array('controller' => 'offers', 'action' => 'index'));?></div>
					<div style="float:left; padding-left:10px;"><?php echo $this->Html->link('Manage Currency', array('controller' => 'currencies', 'action' => 'index'));?></div>
					<div style="float:left; padding-left:10px;"><?php echo $this->Html->link('Feed Reader', array('controller' => 'feeds_generator'));?></div>
					
					<div style="float:right; padding-left:10px;"><?php echo $this->Html->link('Home', array('controller' => 'pages', 'action' => 'display'));?></div>
					<div style="clear:both"></div>
				</div>
				<div style="margin-top:20px">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
