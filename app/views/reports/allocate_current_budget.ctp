<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __(BUDGET_EXPENSE_ALLOCATE);?></h3></td>
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
					<?php if(isset($parent_account_name)) {?>
					<h4>Parent: <?php echo $parent_account_name;?></h4>
					<?php }?>
					<?php echo $this->Form->create('Account', array('action' => 'allocateBudget'));?>
					<?php echo $form->hidden('total_income', array('value' => $total_available_balance));?>
					<?php __(CURRENT . ' ' . BUDGET . ' ' . RELEASE)?> : <?php __($nepaliNumber->currency($total_release)); ?>
					<br>
					गत वर्षको अगाडि ल्याएको : <?php __($nepaliNumber->currency($carried_forward)); ?>
					<br>
					कूल बजेट : <?php __($nepaliNumber->currency($total_available_balance)); ?>
					<table cellpadding="0" cellspacing="0">
					<tr>
							<th><?php echo ACCOUNT;?></th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th><?php echo ALLOCATION ;?></th>
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
							if(isset($accounts["Account"]["current_budget_release"])) {
								$options['value'] = $nepaliNumber->toggleNumberLang($accounts["Account"]["current_budget_release"], 'nepali');
							}
							echo $this->Form->input('current_budget_release_' . $accountId, $options);
						?>
						</td>
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
