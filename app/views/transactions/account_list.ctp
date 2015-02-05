<?php echo $javascript->link('account');?>

<div class="box colorBlue">
	<h3><?php __(BANK . ACCOUNT . MANY)?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
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
				
			
			<br /><br />
			<div class="accounts form">
			<h2><?php __(ADD . ' ' . BANK . ' ' . ACCOUNT); ?></h2>
			<?php echo $this->Form->create('Account', array('action' => 'addBankAccount', 'class' => 'faram'));?>
			<?php echo $form->hidden('level', array('value' => 2));?>
				<fieldset>
					<legend></legend>
					<div>
				<?php
					
					//echo $this->Form->label(ACCOUNT . ' ' . NAME);
					echo "खाताको नाम";
					echo "<br><br>";
					echo $this->Form->text('account_name', array('label' => 'Account Head'));
					echo "<br><br><br>";
				?>
					</div>
				</fieldset>
				<?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?>
			</div>
		<?php echo $this->Form->end(); ?>
	</div><!-- end contentList -->
</div><!-- end boxContent -->
