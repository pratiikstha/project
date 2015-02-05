<body onload="print();window.close();">
<div>
<h2><?php  __(CITIZEN);?></h2>
	<dl>
		<?php __(CITIZENSHIP_NO); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $citizen['Citizen']['citizenship_no']; ?>
		</br>
		<?php __(PERMANENT_ADDRESS); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $address['Address']['district_id']; ?>&nbsp;<?php if( $address['Address']['vms_options']=='VDC') echo VDCS; ?>&nbsp;<?php echo $nepaliNumber->toggleNumberLang($address['Address']['ward_no'], 'nepali'); ?><?php echo $address['Address']['zone_id']; ?>&nbsp;<?php echo $address['Address']['vms_id']; ?></br>
		</br>
		<?php __(BIRTH_PLACE); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $birthaddress['Address']['district_id']; ?>&nbsp;<?php if($birthaddress['Address']['vms_options']=='VDC') echo VDCS;?>&nbsp;<?php echo $nepaliNumber->toggleNumberLang($birthaddress['Address']['ward_no'], 'nepali'); ?>&nbsp;<?php echo $birthaddress['Address']['zone_id']; ?>&nbsp;<?php //echo $birthaddress['Address']['state']; ?><?php echo $birthaddress['Address']['vms_id']; ?>
		</br>
		<?php __(BIRTH_DATE); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nepaliCalendar->convertToNepaliDate($citizen['Citizen']['birth_date']); ?>
		</br>
		<?php __(FIRST_NAME); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $citizen['Citizen']['first_name']; ?>
		</br>
		<?php __(LAST_NAME); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $citizen['Citizen']['last_name']; ?>
		</br>
		<?php __(PREPARED_BY); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $citizen['Citizen']['prepared_by']; ?>
		</br>
		<?php __(VERIFIED_BY); ?>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $citizen['Citizen']['verified_by']; ?>
		</br>
		<?php __(ISSUED_BY); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $citizen['Citizen']['issued_by']; ?>
		</br>
		<?php __(ISSUED_DATE); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nepaliCalendar->convertToNepaliDate($citizen['Citizen']['issued_date']); ?>
	</dl>
</div>
<div class="related">
	<h3><?php __(CITIZEN.' '.RELATION);?></h3>
	<?php if (!empty($citizen['ssn_no'])):?>
	<table cellpadding = "1" cellspacing = "2" border = "1">
	<tr>
		<th><?php __(RELATIONWITH); ?></th>
		<th><?php __(RELATIVE); ?></th>
		<th><?php __(RELATION); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($citizen['ssn_no'] as $ssnNo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ssnNo['ssn_no'];?></td>
			<td><?php echo $ssnNo['relative'];?></td>
			<td><?php echo $ssnNo['relation_id'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
</body>