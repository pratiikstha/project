<div class="vouchers form">
<?php echo $this->Form->create('Voucher');?>
	<fieldset>
		<legend><?php __('Add Voucher'); ?></legend>
	<?php
		echo $voucherTypes[3]; //$this->Form->input('voucher_type_id');
		
		
		echo $this->Form->input('entered_by');
		echo $this->Form->input('checked_by');
		echo $this->Form->input('posted_by');
		echo $this->Form->input('entered_date');
		echo $this->Form->input('checked_date');
		echo $this->Form->input('posted_date');
		echo $this->Form->input('narration');
	?>
	
	<legend>Dr</legend>
	<?php
		echo $this->Form->select('transaction_1_account_id', $bankAccounts);
		echo $this->Form->select('transaction_2_account_id', $releases);
		echo $this->Form->text('transaction_amount');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Vouchers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Vouchers', true), array('controller' => 'vouchers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Voucher', true), array('controller' => 'vouchers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Voucher Types', true), array('controller' => 'voucher_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Voucher Type', true), array('controller' => 'voucher_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions', true), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction', true), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>