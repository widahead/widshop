<?php if(empty($offers)) {
	echo 'There is not any offer  added yet, Click '. $this->Html->link('HERE', array('controller' => 'offers', 'action' => 'adminManageOffer')).' to add offer. You can create Single offer, Offer with multiple products and one day deals.';
	return;
}
?>
<div align="right"><?php echo $this->Html->link('Add Offer', array('controller' => 'offers', 'action' => 'adminManageOffer'));?></div>
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
		echo "<td><a href='".SITE_URL."offers/delete/".$offer['Offer']['id']."'>Delete</a>";
		echo " / <a href='".SITE_URL."offers/adminManageOffer/".$offer['Offer']['id']."'>Edit</a></td>";
		echo "</tr>";
	}
?>
</table>