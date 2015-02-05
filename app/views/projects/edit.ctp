<div class="projects form">
<?php echo $this->Form->create('Project');?>
	<fieldset>
		<legend><?php __('Edit Project'); ?></legend>
	<?php
		echo $this->Form->input('project_id');
		echo $this->Form->input('project_title');
		echo $this->Form->input('project_approve_date');
		echo $this->Form->input('project_start_date');
		echo $this->Form->input('estimated_end_date');
		echo $this->Form->input('estimated_cost');
		echo $this->Form->input('status');
		echo $this->Form->input('delete_flag');
		echo $this->Form->input('reg_timestamp');
		echo $this->Form->input('reg_ssn_no');
		echo $this->Form->input('mod_timestamp');
		echo $this->Form->input('mod_ssn_no');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Project.project_id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Project.project_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Project Details', true), array('controller' => 'project_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Detail', true), array('controller' => 'project_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Project Contractors', true), array('controller' => 'project_contractors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project Contractor', true), array('controller' => 'project_contractors', 'action' => 'add')); ?> </li>
	</ul>
</div>