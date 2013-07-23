<h2>Containable behaviour, pagination, sorting and search</h2>
<div style="float:right">
<form name="search" action="projects/index">
	Search: <input type="text" name="search" id="search" placeholder="Project Name" value="<?php echo urldecode(trim(@$_GET['search'])); ?>" class="searchbox"/> <input type="submit" value="Go">
	<?php
	if(trim(@$_GET['search'])) {
		?>
		<a href="projects/index" style="color:#0033FF;text-decoration:underline;padding-left:54px;">reset</a>
		<?php
	}
	?>
</form>
</div>
<div style="float:left">
<?php if(count($projects)) { ?>
Sort by <?php echo $this->paginator->sort('Project.name', 'Name'); ?>, <?php echo $this->paginator->sort('Project.created', 'Date'); ?>
<?php 
}
?>
</div>
<table style="width:100%" class="tbl_client" cellpadding="2" cellspacing="2">
	<?php
	if(count($projects)) {
	$owner = ""; $count = 1;
	foreach($projects as $data) { 
	$count++;
	
	$rowcol = "#FFF";
	if($count%2 == 0) { $rowcol= "#F0F0F0"; } 
	?>
	<tr height="30px" style="background:<?php echo $rowcol; ?>;">
		<td valign="top"><?php echo $data['Project']['name']; ?></td>
		<td valign="top"><a href="<?php echo $data['Project']['link']; ?>" target="_blank"><?php echo $data['Project']['link']; ?></a></td>
		<td valign="top"><?php echo date('M d, Y',strtotime($data['Project']['created'])); ?></td>
		<td valign="top" width="45%"><?php echo $data['Project']['description']; ?></td>
	</tr>
	<?php 
	} 
	if(count($projects) > 2) {
	?>
	<tr>
		<td colspan="4" align="right">
			Page <?php echo $this->paginator->counter(); ?>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td colspan="4" align="right">
			<!-- Shows the page numbers -->
			<?php echo $this->paginator->numbers(); ?>
			<!-- Shows the next and previous links -->
			<?php
			echo $this->paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
			echo $this->paginator->next(' Next »', null, null, array('class' => 'disabled'));
			?>
			<!-- prints X of Y, where X is current page and Y is number of pages -->
		</td>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="4" align="right" style="color:#FF0000">
			<?php
			if(trim(@$_GET['search'])) {
				echo "No results found";
			}
			else {
				echo "Clients not yet added.";
			}
			?>
		</td>
	</tr>
	<?php } ?>
	<?php
	if(trim(@$_GET['search'])) {
		?>
		<tr>
			<td colspan="4" align="right">
				<a href="projects/index" style="color:#0033FF;text-decoration:underline;padding-left:54px;">View All</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>