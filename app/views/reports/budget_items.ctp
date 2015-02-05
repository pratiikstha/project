<div class="accounts form">
<?php echo $this->Form->create('Account');?>
<?php echo $form->hidden('account_type', array('value' => 'budget_items'));?>
<?php echo $form->hidden('level', array('value' => $level));?>
	<fieldset>
		<legend><?php __('Add Account'); ?></legend>
		<div>
	<?php
		echo $this->Form->label('Budget Code');
		echo $this->Form->text('budget_code', array('size'=>'5', 'maxlength'=>'5', 'label' => 'Budget Code'));
		
		echo $this->Form->label('Item Name');
		echo $this->Form->text('account_name', array('label' => 'Account Head'));
	?>
	</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Common'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Balances', true), array('controller' => 'balances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Balance', true), array('controller' => 'balances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions', true), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction', true), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Budget Item', true), array('action' => 'add', 'budget_items'));?></li>
		<li><?php echo $this->Html->link(__('New Budget', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
	</ul>
</div>