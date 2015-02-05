<div class="projectDetails form">
<?php echo $this->Form->create('ProjectDetail');?>
	<fieldset>
		<legend><?php __('Add Project Detail'); ?></legend>
	<?php
		echo $this->Form->input('project_details_id');
		echo $this->Form->input('project_id');
		echo $this->Form->input('fiscal_year');
		echo $this->Form->input('allocated_budget');
		echo $this->Form->input('actual_expense');
		echo $this->Form->input('status');
		echo $this->Form->input('remarks');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Project Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>