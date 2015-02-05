<div class="citizens view">
<h2><?php  __(CITIZEN);?></h2>
	<?php echo $this->Form->button('Print', array('type' => 'button', 'onclick' => "var child=window.open('../../citizens/viewPdf/" . $citizen['Citizen']['ssn_no']. "', 'Select', 'height=800, width=750, scrollbars=yes');", 'target' => '_blank'));?>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(CITIZENSHIP_NO); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizen['Citizen']['citizenship_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(PERMANENT_ADDRESS); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $address['Address']['district_id']; ?></br>
			<?php if( $address['Address']['vms_options']=='VDC') echo VDCS; ?></br>
			<?php echo $nepaliNumber->toggleNumberLang($address['Address']['ward_no'], 'nepali'); ?></br>
			<?php echo $address['Address']['zone_id']; ?></br>
			<?php //echo $address['Address']['state']; ?>
			<?php echo $address['Address']['vms_id']; ?></br>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(BIRTH_PLACE); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $birthaddress['Address']['district_id']; ?></br>
			<?php if($birthaddress['Address']['vms_options']=='VDC') echo VDCS; ?></br>
			<?php echo $nepaliNumber->toggleNumberLang($birthaddress['Address']['ward_no'], 'nepali'); ?></br>
			<?php echo $birthaddress['Address']['zone_id']; ?></br>
			<?php //echo $birthaddress['Address']['state']; ?>
			<?php echo $birthaddress['Address']['vms_id']; ?></br>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(BIRTH_DATE); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $nepaliCalendar->convertToNepaliDate($citizen['Citizen']['birth_date']);?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(FIRST_NAME); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizen['Citizen']['first_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(LAST_NAME); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizen['Citizen']['last_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(PREPARED_BY); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizen['Citizen']['prepared_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(VERIFIED_BY); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizen['Citizen']['verified_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(ISSUED_BY); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $citizen['Citizen']['issued_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(ISSUED_DATE); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $nepaliCalendar->convertToNepaliDate($citizen['Citizen']['issued_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.EDIT, true), array('action' => 'edit', $citizen['Citizen']['ssn_no'])); ?> </li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.DELETE, true), array('action' => 'delete', $citizen['Citizen']['ssn_no']), null, sprintf(__('Are you sure you want to delete # %s?', true), $citizen['Citizen']['ssn_no'])); ?> </li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.LISTS, true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(ADD.' '.CITIZEN.' '.ADDS, true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('controller' => 'citizen_relations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(CREATE.' '.RELATION.' '.ADDS, true), array('controller' => 'citizen_relations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __(CITIZEN.' '.RELATION);?></h3>
	<?php if (!empty($citizen['ssn_no'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __(RELATIONWITH); ?></th>
		<th><?php __(RELATIVE); ?></th>
		<th><?php __(RELATION); ?></th>
		<th class="actions"><?php //__(ACTIONS);?></th>
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
			<td class="actions">
				<?php //echo $this->Html->link(__(VIEW, true), array('controller' => 'citizen_relations', 'action' => 'view', $ssnNo['ssn_no'])); ?>
				<?php //echo $this->Html->link(__(EDIT, true), array('controller' => 'citizen_relations', 'action' => 'edit', $ssnNo['ssn_no'])); ?>
				<?php //echo $this->Html->link(__(DELETE, true), array('controller' => 'citizen_relations', 'action' => 'delete', $ssnNo['ssn_no']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ssnNo['ssn_no'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Ssn No', true), array('controller' => 'citizen_relations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>