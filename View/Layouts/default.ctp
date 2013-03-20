<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script type="text/javascript">
	var JS_BASE_URL = "<?php echo SITE_URL ?>";
	</script>

	<?php echo $this->Html->charset(); ?>
	<?php echo $this->Html->meta('keywords','Cakephp product plugin, Cakephp product module, Cakephp product');?>
	<title>
		WidShop! CakePHP based Shopping mart
	</title>
	<?php
		echo $this->Html->css('/wid_shop/css/wid_shop');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h3>Under Development ...</h3>
		</div>
		<div id="content" align="center">
			<div style="text-align:right;"> FeedBack Or Contact On <b>widahead@gmail.com</b></div>
			<div style="width:1000px;"> 
				<div>
					<div style="float:right; margin-left:20px;">
						<a href="http://www.widahead.com/users/login">Download Code</a>
					</div>
					<div style="float:right; margin-left:20px;"><?php echo $this->Html->link('Features', array('controller' => 'pages', 'action' => 'work'));?></div>
					<div style="float:right;"><?php echo $this->Html->link('Admin Panel', array('admin' => true, 'controller' => 'categories', 'action' => 'index'));?></div>
					<div style="clear:both"></div>
				</div>
				<h2 style="text-align:left;">CakePHP product management</h2>
				<div style="margin-top:20px">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
