<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products">गोश्वारा भौचर</h3></td>
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
					<h2><?php __(BUDGET_EXPENSE_ALLOCATE);?></h2>
					<?php if(isset($parent_account_name)) {?>
					<h4>Parent: <?php echo $parent_account_name;?></h4>
					<?php }?>
					<?php echo $this->Form->create('Account', array('action' => 'edit'));?>
					<?php echo $form->hidden('type', array('value' => 'expenses'));?>
					<?php echo $form->hidden('total_income', array('value' => $total_income));?>
					<table cellpadding="0" cellspacing="0">
					<tr>
							<th><?php echo BUDGET_CODE; ?></th>
							<th><?php echo ACCOUNT;?></th>
							<th><?php echo OPENING_BALENCE ;?></th>
							<th>&nbsp;</th>
							<th class="actions"><?php __('Actions');?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($headings as $parentCode => $parentName):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
					
					<tr<?php echo $class;?>>
						<td><?php echo $parentCode; ?>&nbsp;</td>
						<td colspan="3"><?php echo $parentName; ?>&nbsp;</td>
						<td class="actions">
							&nbsp;
						</td>
					</tr>
					<?php foreach ($subheadings[$parentCode] as $accounts) {?>
					<tr>
						<td>&nbsp;</td>
						<td><?php echo $accounts['Account']['budget_code']?></td>
						<td><?php echo $accounts['Account']['account_name']?></td>
						<td>
						<?php
							$accountId = $accounts['Account']['account_id'];
							$options['label'] = false;
							$options['value'] = $accounts["Account"]["opening_balance"];
							echo $this->Form->input('opening_balance_' . $accountId, $options);
						?>
						</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					
					<?php } ?>
				<?php endforeach; ?>
					<tr>
						<td colspan="6" align="center"><?php echo $this->Form->end(__(SAVE, true));?></td>
					</tr>
					</table>
					<p>
				</div>

			</td>
		</tr>
	</table>
</div>
