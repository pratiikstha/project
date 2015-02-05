<div class="registrations index">
	<h2><?php __('Registrations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('registration_id');?></th>
			<th><?php echo $this->Paginator->sort('day_book_id');?></th>
			<th><?php echo $this->Paginator->sort('concerned_party_1');?></th>
			<th><?php echo $this->Paginator->sort('concerned_party_2');?></th>
			<th><?php echo $this->Paginator->sort('applied_by');?></th>
			<th><?php echo $this->Paginator->sort('registration_type');?></th>
			<th><?php echo $this->Paginator->sort('incident_date');?></th>
			<th><?php echo $this->Paginator->sort('country');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('certificate_no');?></th>
			<th><?php echo $this->Paginator->sort('registration_date');?></th>
			<th><?php echo $this->Paginator->sort('verified_by');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($registrations as $registration):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $registration['Registration']['registration_id']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['day_book_id']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['concerned_party_1']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['concerned_party_2']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['applied_by']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['registration_type']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['incident_date']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['country']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['address']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['certificate_no']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['registration_date']; ?>&nbsp;</td>
		<td><?php echo $registration['Registration']['verified_by']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $registration['Registration']['registration_id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $registration['Registration']['registration_id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $registration['Registration']['registration_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $registration['Registration']['registration_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Registration', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Day Books', true), array('controller' => 'day_books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day Book', true), array('controller' => 'day_books', 'action' => 'add')); ?> </li>
	</ul>
</div>