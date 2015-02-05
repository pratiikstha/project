<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __(ADVANCE . ' ' . ACCOUNT . ' ' . LISTS);?></h3></td>
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
					<?php echo $this->Form->create('Account', array('action' => 'editIncome'));?>
					<table cellpadding="0" cellspacing="0" width=50%>
					<tr>
							<th><?php echo ACCOUNT . ' ' .  NAME;?></th>
							<th><?php echo BALANCE; ?></th>
							<th class="actions" style="text-align:center"><?php __(ACTIONS);?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($accounts as $account):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
				
					<tr<?php echo $class;?>>
						<td><?php echo $account['Account']['account_name']; ?>&nbsp;</td>
						<td>
						<?php
							echo $this->NepaliNumber->currency($account["Account"]["current_balance"], true);;
						?>&nbsp;
						</td>
						<td class="actions">
							<?php echo $this->Html->link(__(VIEW, true), array('action' => 'viewAdvanceDetail', $account['Account']['account_id'], $year, $month)); ?>
							<?php //echo $this->Html->link(__(EDIT, true), array('action' => 'edit', $account['Account']['account_id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
					<tr>
						<td colspan="3" align="center"></td>
					</tr>
					</table>
				
				</div>
			</td>
		</tr>
	</table>
</div>






