<div class="projects index">
	<h2><?php __('Projects');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('project_id');?></th>
			<th><?php echo $this->Paginator->sort('project_title');?></th>
			<th><?php echo $this->Paginator->sort('project_approve_date');?></th>
			<th><?php echo $this->Paginator->sort('project_start_date');?></th>
			<th><?php echo $this->Paginator->sort('estimated_end_date');?></th>
			<th><?php echo $this->Paginator->sort('estimated_cost');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('delete_flag');?></th>
			<th><?php echo $this->Paginator->sort('reg_timestamp');?></th>
			<th><?php echo $this->Paginator->sort('reg_ssn_no');?></th>
			<th><?php echo $this->Paginator->sort('mod_timestamp');?></th>
			<th><?php echo $this->Paginator->sort('mod_ssn_no');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($projects as $project):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $project['Project']['project_id']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['project_title']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['project_approve_date']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['project_start_date']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['estimated_end_date']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['estimated_cost']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['status']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['delete_flag']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['reg_timestamp']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['reg_ssn_no']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['mod_timestamp']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['mod_ssn_no']; ?>&nbsp;</td>
		<td><?php echo $project['Project']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $project['Project']['project_id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $project['Project']['project_id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $project['Project']['project_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['Project']['project_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Project', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Project Details', true), array('controller' => 'project_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Detail', true), array('controller' => 'project_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Project Contractors', true), array('controller' => 'project_contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Contractor', true), array('controller' => 'project_contractors', 'action' => 'add')); ?> </li>
	</ul>
</div>