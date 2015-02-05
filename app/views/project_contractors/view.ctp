<div class="projectContractors view">
<h2><?php  __('Project Contractor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Contractor Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectContractor['ProjectContractor']['project_contractor_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($projectContractor['Project']['project_title'], array('controller' => 'projects', 'action' => 'view', $projectContractor['Project']['project_id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Personal Account'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($projectContractor['PersonalAccount']['name'], array('controller' => 'personal_accounts', 'action' => 'view', $projectContractor['PersonalAccount']['personal_account_id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Start Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectContractor['ProjectContractor']['start_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Delete Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectContractor['ProjectContractor']['delete_flag']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project Contractor', true), array('action' => 'edit', $projectContractor['ProjectContractor']['project_contractor_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Project Contractor', true), array('action' => 'delete', $projectContractor['ProjectContractor']['project_contractor_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectContractor['ProjectContractor']['project_contractor_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Project Contractors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Contractor', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personal Accounts', true), array('controller' => 'personal_accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personal Account', true), array('controller' => 'personal_accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
