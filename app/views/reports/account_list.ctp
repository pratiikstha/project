<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __(BANK . ACCOUNT . MANY)?></h3></td>
					<td class="a-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table width="100%">
		<tr>
			<td width="20%">
				<?php echo $this->element('account_left_menu')?>
			</td>
			<td>
				<div class="accounts index">
				<h2><?php if(isset($parent_name)) { echo $parent_name; } else { echo 'Accounts'; }?></h2> 
				<table cellpadding="0" cellspacing="0">
				<tr>
						<th><?php echo ACCOUNT . ' ' . NAME; ?></th>
						<th><?php echo BALANCE;?></th>
						<th class="actions"><?php //__(ACTIONS);?></th>
				</tr>
				<?php
				$i = 0;
				foreach ($accounts as $account):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
				?>
				<tr<?php echo $class; ?>>
					<td><?php $id = $account['Account']['account_name']; echo $id; ?>&nbsp;</td>
					<td><?php  echo $nepaliNumber->currency($account['Account']['current_balance']); ?>&nbsp;</td>
					<td class="actions">
						<?php //echo $this->Html->link(__('View', true), array('action' => 'getL2Exp', $account['Account']['account_id'])); ?>
						<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $account['Account']['account_id'])); ?>
						<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $account['Account']['account_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $account['Account']['account_id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
				</table>
				
			</div>
			<br /><br />
			<div class="accounts form">
			<h2><?php __(ADD . ' ' . BANK . ' ' . ACCOUNT); ?></h2>
					<?php echo $this->Form->create('Account', array('action' => 'addBankAccount'));?>
					<?php echo $form->hidden('level', array('value' => 2));?>
						<fieldset>
							<legend></legend>
							<div>
						<?php
							
							//echo $this->Form->label(ACCOUNT . ' ' . NAME);
							echo "खाताको नाम";
							echo "<br>";
							echo $this->Form->text('account_name', array('label' => 'Account Head'));
					
						?>
						</div>
						</fieldset>
					<?php echo $this->Form->end(__('Submit', true));?>
				</div>
			</td>
		</tr>
	</table>
</div>