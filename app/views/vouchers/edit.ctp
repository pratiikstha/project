<div class="vouchers form">
<?php echo $this->Form->create('Voucher');?>
	<fieldset>
		<legend><?php __('Edit Voucher'); ?></legend>
	<?php
		echo $this->Form->input('voucher_id');
		echo $this->Form->input('reverse_voucher_no');
		echo $this->Form->input('voucher_type_id');
		echo $this->Form->input('entered_by');
		echo $this->Form->input('checked_by');
		echo $this->Form->input('posted_by');
		echo $this->Form->input('entered_date');
		echo $this->Form->input('checked_date');
		echo $this->Form->input('posted_date');
		echo $this->Form->input('narration');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Voucher.voucher_id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Voucher.voucher_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Vouchers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Vouchers', true), array('controller' => 'vouchers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Voucher', true), array('controller' => 'vouchers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Voucher Types', true), array('controller' => 'voucher_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Voucher Type', true), array('controller' => 'voucher_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions', true), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction', true), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>