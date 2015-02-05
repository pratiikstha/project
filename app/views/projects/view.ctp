<div class="projects view">
<h2><?php  __('Project');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['project_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['project_title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Approve Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['project_approve_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Start Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['project_start_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estimated End Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['estimated_end_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estimated Cost'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['estimated_cost']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Delete Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['delete_flag']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reg Timestamp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['reg_timestamp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reg Ssn No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['reg_ssn_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mod Timestamp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['mod_timestamp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mod Ssn No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['mod_ssn_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project', true), array('action' => 'edit', $project['Project']['project_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Project', true), array('action' => 'delete', $project['Project']['project_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['Project']['project_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Project Details', true), array('controller' => 'project_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Detail', true), array('controller' => 'project_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Project Contractors', true), array('controller' => 'project_contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Contractor', true), array('controller' => 'project_contractors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Project Details');?></h3>
	<?php if (!empty($project['ProjectDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Project Details Id'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th><?php __('Fiscal Year'); ?></th>
		<th><?php __('Allocated Budget'); ?></th>
		<th><?php __('Actual Expense'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Remarks'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['ProjectDetail'] as $projectDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $projectDetail['project_details_id'];?></td>
			<td><?php echo $projectDetail['project_id'];?></td>
			<td><?php echo $projectDetail['fiscal_year'];?></td>
			<td><?php echo $projectDetail['allocated_budget'];?></td>
			<td><?php echo $projectDetail['actual_expense'];?></td>
			<td><?php echo $projectDetail['status'];?></td>
			<td><?php echo $projectDetail['remarks'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'project_details', 'action' => 'view', $projectDetail['project_detail_id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'project_details', 'action' => 'edit', $projectDetail['project_detail_id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'project_details', 'action' => 'delete', $projectDetail['project_detail_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectDetail['project_detail_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Project Detail', true), array('controller' => 'project_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Project Contractors');?></h3>
	<?php if (!empty($project['ProjectContractor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Project Contractor Id'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th><?php __('Personal Account Id'); ?></th>
		<th><?php __('Start Date'); ?></th>
		<th><?php __('Delete Flag'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['ProjectContractor'] as $projectContractor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $projectContractor['project_contractor_id'];?></td>
			<td><?php echo $projectContractor['project_id'];?></td>
			<td><?php echo $projectContractor['personal_account_id'];?></td>
			<td><?php echo $projectContractor['start_date'];?></td>
			<td><?php echo $projectContractor['delete_flag'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'project_contractors', 'action' => 'view', $projectContractor['project_contractor_id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'project_contractors', 'action' => 'edit', $projectContractor['project_contractor_id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'project_contractors', 'action' => 'delete', $projectContractor['project_contractor_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectContractor['project_contractor_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Project Contractor', true), array('controller' => 'project_contractors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
