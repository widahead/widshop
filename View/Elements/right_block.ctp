<div id="right_block_content">
	<span> Category </span>
	<hr style="margin:10px"/>
	<ul class="list">
		<?php 
		echo '<li>'. $this->Html->link('Home', array('controller' => 'pages', 'action' => 'display')).'</li>';
		echo '<li>'. $this->Html->link('Back Order', array('controller' => 'back_orders', 'action' => 'index')).' <span class="back_order_new">New<span></li>';
		foreach($categories as $category => $categorylink) {
			echo '<li>'. $this->Html->link(ucwords(strtolower($category)), array('controller' => 'pages', 'action' => 'product', $categorylink)).'</li>';
	} ?>
	</ul>
</div>