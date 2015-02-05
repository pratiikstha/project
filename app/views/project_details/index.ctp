<div class="projectDetails index">
	<h2><?php __('Project Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('project_details_id');?></th>
			<th><?php echo $this->Paginator->sort('project_id');?></th>
			<th><?php echo $this->Paginator->sort('fiscal_year');?></th>
			<th><?php echo $this->Paginator->sort('allocated_budget');?></th>
			<th><?php echo $this->Paginator->sort('actual_expense');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('remarks');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($projectDetails as $projectDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $projectDetail['ProjectDetail']['project_details_id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($projectDetail['Project']['project_title'], array('controller' => 'projects', 'action' => 'view', $projectDetail['Project']['project_id'])); ?>
		</td>
		<td><?php echo $projectDetail['ProjectDetail']['fiscal_year']; ?>&nbsp;</td>
		<td><?php echo $projectDetail['ProjectDetail']['allocated_budget']; ?>&nbsp;</td>
		<td><?php echo $projectDetail['ProjectDetail']['actual_expense']; ?>&nbsp;</td>
		<td><?php echo $projectDetail['ProjectDetail']['status']; ?>&nbsp;</td>
		<td><?php echo $projectDetail['ProjectDetail']['remarks']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $projectDetail['ProjectDetail']['project_detail_id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $projectDetail['ProjectDetail']['project_detail_id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $projectDetail['ProjectDetail']['project_detail_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectDetail['ProjectDetail']['project_detail_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Project Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>