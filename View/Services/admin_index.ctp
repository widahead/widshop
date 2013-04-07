<?php if(empty($services)) {
	echo 'There is not any service added yet, Click '. $this->Html->link('HERE', array('controller' => 'services', 'action' => 'manageService')).' to add offer.';
	return;
}
?>
<div align="right"><?php echo $this->Html->link('Add Service', array('controller' => 'services', 'action' => 'manageService'));?></div>
<table cellspacing="0" cellpadding="2" width="100%" border="0">
		<tr>
			<th align="left" class="th_black">Image</th>
			<th align="left" class="th_black">Category Name</th>
			<th align="left" class="th_black">Service Name</th>
			<th align="left" class="th_black">Description</th>
			<th align="left" style="border:0px;" class="th_black">Action</th>
		</tr>
	<?php
	foreach($services as $service) {
		echo "<tr style='background-color: rgb(240, 247, 231);'>
				<td style='border-left: 1px solid rgb(134, 133, 133);'>".$this->Image->resize($service['Service']['image'], 100, 100, true)."</td>
				<td>".$service['Service']['categoryName']."</td>
				<td>".$service['Service']['name']."</td>
				<td>".$service['Service']['description']."</td>";
			echo "<td>";
			/*echo $this->Html->link('Delete', array('controller' => 'services', 'action' => 'delete', $service['Service']['id']));
			echo " / ";*/
			echo "<td>".$this->Html->link('Edit', array('controller' => 'services', 'action' => 'manageService', $service['Service']['id']));
		echo "</td>";
	echo "</tr>";
	} ?>
</table>