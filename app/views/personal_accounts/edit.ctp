<div class="personalAccounts form">
<?php echo $this->Form->create('PersonalAccount');?>
	<fieldset>
		<legend><?php __('Edit Personal Account'); ?></legend>
	<?php
		echo $this->Form->input('personal_account_id');
		echo $this->Form->input('type');
		echo $this->Form->input('ssn_no');
		echo $this->Form->input('designation');
		echo $this->Form->input('name');
		echo $this->Form->input('contact_person');
		echo $this->Form->input('registered_date');
		echo $this->Form->input('pan_no');
		echo $this->Form->input('vat_no');
		echo $this->Form->input('delete_flag');
		echo $this->Form->input('reg_timestamp');
		echo $this->Form->input('reg_ssn_no');
		echo $this->Form->input('mod_timestamp');
		echo $this->Form->input('mod_ssn_no');
		echo $this->Form->input('bank_account_name_1');
		echo $this->Form->input('bank_account_id');
		echo $this->Form->input('bank_account_name_2');
		echo $this->Form->input('bank_account_id_2');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PersonalAccount.personal_account_id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PersonalAccount.personal_account_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Personal Accounts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Day Books', true), array('controller' => 'day_books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day Book', true), array('controller' => 'day_books', 'action' => 'add')); ?> </li>
	</ul>
</div>