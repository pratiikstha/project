<div class="personalAccounts view">
<h2><?php  __('Personal Account');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Personal Account Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['personal_account_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ssn No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['ssn_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Designation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['designation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact Person'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['contact_person']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Registered Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['registered_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pan No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['pan_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vat No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['vat_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Delete Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['delete_flag']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reg Timestamp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['reg_timestamp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reg Ssn No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['reg_ssn_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mod Timestamp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['mod_timestamp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mod Ssn No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['mod_ssn_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account Name 1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['bank_account_name_1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['bank_account_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account Name 2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['bank_account_name_2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Account Id 2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $personalAccount['PersonalAccount']['bank_account_id_2']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Personal Account', true), array('action' => 'edit', $personalAccount['PersonalAccount']['personal_account_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Personal Account', true), array('action' => 'delete', $personalAccount['PersonalAccount']['personal_account_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $personalAccount['PersonalAccount']['personal_account_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Personal Accounts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personal Account', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Day Books', true), array('controller' => 'day_books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day Book', true), array('controller' => 'day_books', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Day Books');?></h3>
	<?php if (!empty($personalAccount['DayBook'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Day Book Id'); ?></th>
		<th><?php __('Received From'); ?></th>
		<th><?php __('Personal Account Id'); ?></th>
		<th><?php __('Received By'); ?></th>
		<th><?php __('Transaction Date'); ?></th>
		<th><?php __('Transaction Amount'); ?></th>
		<th><?php __('Posted On'); ?></th>
		<th><?php __('Voucher Id'); ?></th>
		<th><?php __('Account Id'); ?></th>
		<th><?php __('Discount Amount'); ?></th>
		<th><?php __('Fine Amount'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($personalAccount['DayBook'] as $dayBook):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $dayBook['day_book_id'];?></td>
			<td><?php echo $dayBook['received_from'];?></td>
			<td><?php echo $dayBook['personal_account_id'];?></td>
			<td><?php echo $dayBook['received_by'];?></td>
			<td><?php echo $dayBook['transaction_date'];?></td>
			<td><?php echo $dayBook['transaction_amount'];?></td>
			<td><?php echo $dayBook['posted_on'];?></td>
			<td><?php echo $dayBook['voucher_id'];?></td>
			<td><?php echo $dayBook['account_id'];?></td>
			<td><?php echo $dayBook['discount_amount'];?></td>
			<td><?php echo $dayBook['fine_amount'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'day_books', 'action' => 'view', $dayBook['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'day_books', 'action' => 'edit', $dayBook['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'day_books', 'action' => 'delete', $dayBook['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dayBook['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Day Book', true), array('controller' => 'day_books', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
