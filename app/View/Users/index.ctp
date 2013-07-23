<h2>Fat Model and Skinny Controller</h2>
<table style="width:100%" class="tbl_client" cellpadding="2" cellspacing="2">
	<?php
	$owner = ""; $count = 1;
	foreach($users as $data) { 
	$count++;
	
	$rowcol = "#FFF";
	if($count%2 == 0) { $rowcol= "#F0F0F0"; } 
	?>
	<tr height="30px" style="background:<?php echo $rowcol; ?>;">
		<td valign="top"><?php echo $data['name']; ?></td>
		<td valign="top"><?php echo $data['email']; ?></td>
		<td valign="top">
			<?php
			foreach($data['Project'] as $proj) {
				echo $proj['name'].", ";
				echo "<a href='".$proj['link']."' target='_blank'>".$proj['link']."</a>, ";
				echo $proj['created'];
				echo "<br/>";
			}
			?>
		</td>
	</tr>
	<?php 
	}
	?>
</table>
<?php
echo "<b>Categories: </b>".$categories;
?>