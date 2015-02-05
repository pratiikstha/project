<div class="projectContractors index">
	<h2><?php __('Project Contractors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('project_contractor_id');?></th>
			<th><?php echo $this->Paginator->sort('project_id');?></th>
			<th><?php echo $this->Paginator->sort('personal_account_id');?></th>
			<th><?php echo $this->Paginator->sort('start_date');?></th>
			<th><?php echo $this->Paginator->sort('delete_flag');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($projectContractors as $projectContractor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $projectContractor['ProjectContractor']['project_contractor_id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($projectContractor['Project']['project_title'], array('controller' => 'projects', 'action' => 'view', $projectContractor['Project']['project_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($projectContractor['PersonalAccount']['name'], array('controller' => 'personal_accounts', 'action' => 'view', $projectContractor['PersonalAccount']['personal_account_id'])); ?>
		</td>
		<td><?php echo $projectContractor['ProjectContractor']['start_date']; ?>&nbsp;</td>
		<td><?php echo $projectContractor['ProjectContractor']['delete_flag']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $projectContractor['ProjectContractor']['project_contractor_id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $projectContractor['ProjectContractor']['project_contractor_id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $projectContractor['ProjectContractor']['project_contractor_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectContractor['ProjectContractor']['project_contractor_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Project Contractor', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personal Accounts', true), array('controller' => 'personal_accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personal Account', true), array('controller' => 'personal_accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>