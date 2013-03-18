<div align="right"><?php echo $this->Html->link('Add Category', array('controller' => 'categories', 'action' => 'addCategory'));?></div>
<table cellspacing="0" cellpadding="2" width="100%" border="0">
		<tr>
			<th align="left" class="th_black">Name</th>
			<th align="left" class="th_black">Description</th>
			<th align="left" style="border:0px;" class="th_black">Action</th>
		</tr>
	<?php
		foreach($categories as $category)
		{
			echo "<tr style='background-color: rgb(240, 247, 231);'>
				<td style='border-left: 1px solid rgb(134, 133, 133);'>".$category['Category']['name']."</td>
				<td>".$category['Category']['description']."</td>";
			echo "<td><a href='".SITE_URL."categories/delete/".$category['Category']['id']."'>Delete</a> / ";
			echo "<a href='".SITE_URL."categories/editCategory/".$category['Category']['id']."'>Edit</a></td>";
			echo "</tr>";
		}
	?>
</table>