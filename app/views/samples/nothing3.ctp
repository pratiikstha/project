<table>
	<?php for ($i = 1; $i <= 1000; $i++) {?>
	<tr>
		<td><?php echo $i ;?></td>
		<td><?php echo $numberToWord->convert($i, 'eng');?></td>
		<td><?php echo $numberToWord->convert($i);?></td>
	</tr>
	<?php } ?>
	<?php while ($i <= 9999999999) {?>
	<tr>
		<td><?php echo $i ;?></td>
		<td><?php echo $numberToWord->convert($i, 'eng');?></td>
		<td><?php echo $numberToWord->convert($i);?></td>
		<?php  $i = $i*10?>
	</tr>
	<?php } ?>
	<tr>
		<td>99999999999</td>
		<td><?php echo $numberToWord->convert(99999999999, 'eng');?></td>
		<td><?php echo $numberToWord->convert(99999999999);?></td>
	</tr>
</table>
<font size="-1">DUMMY PAGE</font>