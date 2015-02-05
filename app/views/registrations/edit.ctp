<div class="registrations form">
<?php echo $this->Form->create('Registration');?>
	<fieldset>
		<legend><?php __('Edit Registration'); ?></legend>
	<?php
		echo $this->Form->input('registration_id');
		echo $this->Form->input('day_book_id');
		echo $this->Form->input('concerned_party_1');
		echo $this->Form->input('concerned_party_2');
		echo $this->Form->input('applied_by');
		echo $this->Form->input('registration_type');
		echo $this->Form->input('incident_date');
		echo $this->Form->input('country');
		echo $this->Form->input('address');
		echo $this->Form->input('certificate_no');
		echo $this->Form->input('registration_date');
		echo $this->Form->input('verified_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Registration.registration_id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Registration.registration_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Registrations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Day Books', true), array('controller' => 'day_books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day Book', true), array('controller' => 'day_books', 'action' => 'add')); ?> </li>
	</ul>
</div>