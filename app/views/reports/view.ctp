<div class="accounts view">
<h2><?php  __('Account');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['account_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pcode'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['pcode']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Acount Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['user_acount_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Account Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['account_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['created_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entered By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['entered_by']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Budget Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['budget_item']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Opening Bal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['opening_bal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cur Bal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['cur_bal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Remarks'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['remarks']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Level'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['level']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $account['Account']['is_active']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account', true), array('action' => 'edit', $account['Account']['account_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Account', true), array('action' => 'delete', $account['Account']['account_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $account['Account']['account_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Balances', true), array('controller' => 'balances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Balance', true), array('controller' => 'balances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts', true), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions', true), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction', true), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Balances');?></h3>
	<?php if (!empty($account['Balance'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Balance Id'); ?></th>
		<th><?php __('Year'); ?></th>
		<th><?php __('Account Id'); ?></th>
		<th><?php __('Closing Balance'); ?></th>
		<th><?php __('Opening Balance'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($account['Balance'] as $balance):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $balance['balance_id'];?></td>
			<td><?php echo $balance['year'];?></td>
			<td><?php echo $balance['account_id'];?></td>
			<td><?php echo $balance['closing_balance'];?></td>
			<td><?php echo $balance['opening_balance'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'balances', 'action' => 'view', $balance['balance_id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'balances', 'action' => 'edit', $balance['balance_id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'balances', 'action' => 'delete', $balance['balance_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $balance['balance_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Balance', true), array('controller' => 'balances', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Accounts');?></h3>
	<?php if (!empty($account['Account'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Account Id'); ?></th>
		<th><?php __('Pcode'); ?></th>
		<th><?php __('User Acount Code'); ?></th>
		<th><?php __('Account Name'); ?></th>
		<th><?php __('Created Date'); ?></th>
		<th><?php __('Entered By'); ?></th>
		<th><?php __('Budget Item'); ?></th>
		<th><?php __('Opening Bal'); ?></th>
		<th><?php __('Cur Bal'); ?></th>
		<th><?php __('Remarks'); ?></th>
		<th><?php __('Level'); ?></th>
		<th><?php __('Is Active'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($account['Account'] as $account):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $account['account_id'];?></td>
			<td><?php echo $account['pcode'];?></td>
			<td><?php echo $account['user_acount_code'];?></td>
			<td><?php echo $account['account_name'];?></td>
			<td><?php echo $account['created_date'];?></td>
			<td><?php echo $account['entered_by'];?></td>
			<td><?php echo $account['budget_item'];?></td>
			<td><?php echo $account['opening_bal'];?></td>
			<td><?php echo $account['cur_bal'];?></td>
			<td><?php echo $account['remarks'];?></td>
			<td><?php echo $account['level'];?></td>
			<td><?php echo $account['is_active'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'accounts', 'action' => 'view', $account['account_id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'accounts', 'action' => 'edit', $account['account_id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'accounts', 'action' => 'delete', $account['account_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $account['account_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Account', true), array('controller' => 'accounts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Transactions');?></h3>
	<?php if (!empty($account['Transaction'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Transaction Id'); ?></th>
		<th><?php __('Voucher Id'); ?></th>
		<th><?php __('Account Id'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Drcr'); ?></th>
		<th><?php __('Remarks'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($account['Transaction'] as $transaction):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $transaction['transaction_id'];?></td>
			<td><?php echo $transaction['voucher_id'];?></td>
			<td><?php echo $transaction['account_id'];?></td>
			<td><?php echo $transaction['amount'];?></td>
			<td><?php echo $transaction['drcr'];?></td>
			<td><?php echo $transaction['remarks'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'transactions', 'action' => 'view', $transaction['transaction_id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'transactions', 'action' => 'edit', $transaction['transaction_id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'transactions', 'action' => 'delete', $transaction['transaction_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $transaction['transaction_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Transaction', true), array('controller' => 'transactions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
