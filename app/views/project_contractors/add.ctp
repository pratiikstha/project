<div class="projectContractors form">
<?php echo $this->Form->create('ProjectContractor');?>
	<fieldset>
		<legend><?php __('Add Project Contractor'); ?></legend>
	<?php
		echo $this->Form->input('project_id');
		echo $this->Form->input('personal_account_id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('delete_flag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Project Contractors', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personal Accounts', true), array('controller' => 'personal_accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personal Account', true), array('controller' => 'personal_accounts', 'action' => 'add')); ?> </li>
	</ul>
</div>