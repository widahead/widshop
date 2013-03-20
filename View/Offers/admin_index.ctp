<?php if(empty($offers)) {
	echo 'There is not any offer  added yet, Click '. $this->Html->link('HERE', array('controller' => 'offers', 'action' => 'manageOffer')).' to add offer. You can create Single offer, Offer with multiple products and one day deals.';
	return;
}
?>
<div align="right"><?php echo $this->Html->link('Add Offer', array('controller' => 'offers', 'action' => 'manageOffer'));?></div>
<table cellspacing="0" cellpadding="2" width="100%" border="0">
	<tr>
		<th align="left" class="th_black">Image</th>
		<th align="left" class="th_black">offer Name</th>
		<th align="left" class="th_black">Description</th>
		<th align="left" style="border:0px;" class="th_black">Action</th>
	</tr>
<?php
	foreach($offers as $offer) {
		echo "<tr style='background-color: rgb(240, 247, 231);'>
				<td style='border-left: 1px solid rgb(134, 133, 133);'>".$this->Image->resize($offer['Offer']['image'], 100, 100, true)."</td>
				<td>".$offer['Offer']['name']."</td>
				<td>".$offer['Offer']['description']."</td>";
			echo "<td>";
				echo $this->Html->link('Delete', array('controller' => 'offers', 'action' => 'delete', $offer['Offer']['id']));
				echo " / ";
				echo $this->Html->link('Edit', array('controller' => 'offers', 'action' => 'manageOffer', $offer['Offer']['id']));
		echo "</td>";
	echo "</tr>";
	} ?>
</table>