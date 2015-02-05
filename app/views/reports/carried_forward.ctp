<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __("गत वर्षको अगाडि ल्याएको रकम");?></h3></td>
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
					<?php echo $this->Form->create('Account', array('action' => 'getCarriedForward'));?>

					<table cellpadding="0" cellspacing="0">
					<tr>
							<th><?php echo ACCOUNT; ?></th>
							<th><?php echo OPENING_BALENCE; ?></th>
					</tr>
					<tr>
						<th colspan="2"><?php echo CASH; ?></th>
					</tr>
					<?php foreach ($cash as $id => $name) {?>
					<tr>
						<td><?php echo $name; ?></td>
						<td>
						<?php
							$options = array();
							$options['label'] = false;
							if(isset($balances[$id]['closing_balance'])) {
								$options['value'] = $nepaliNumber->toggleNumberLang($balances[$id]['closing_balance'], 'nepali');
								echo $this->Form->hidden('opening_balance_' . $id, $options);
								echo $this->Form->hidden('balance_id_' . $id, array('value' => ($balances[$id]['balance_id'])));
								echo $options['value'];
							} else {
								echo $this->Form->input('opening_balance_' . $id, $options);
							}
						?>
						</td>
					</tr>
					
					<?php } ?>
					
					<tr>
						<th colspan="2"><?php echo BANK . ' ' . ACCOUNT.MANY; ?></th>
					</tr>
					<?php foreach ($banks as $id => $name) {?>
					<tr>
						<td><?php echo $name; ?></td>
						<td>
						<?php
							$options = array();
							$options['label'] = false;
							if(isset($balances[$id]['closing_balance'])) {
								$options['value'] = $nepaliNumber->toggleNumberLang($balances[$id]['closing_balance'], 'nepali');
								echo $this->Form->hidden('opening_balance_' . $id, $options);
								echo $this->Form->hidden('balance_id_' . $id, array('value' => ($balances[$id]['balance_id'])));
								echo $options['value'];
							} else {
								echo $this->Form->input('opening_balance_' . $id, $options);
							}
						?>
						</td>
					</tr>
					
					<?php } ?>
					
					<tr>
						<th colspan="2"><?php echo ADVANCE . ' ' . ACCOUNT.MANY; ?></th>
					</tr>
					<?php foreach ($advances as $id => $name) {?>
					<tr>
						<td><?php echo $name; ?></td>
						<td>
						<?php
							$options = array();
							$options['label'] = false;
							if(isset($balances[$id]['closing_balance'])) {
								$options['value'] = $nepaliNumber->toggleNumberLang($balances[$id]['closing_balance'], 'nepali');
								echo $this->Form->hidden('opening_balance_' . $id, $options);
								echo $this->Form->hidden('balance_id_' . $id, array('value' => ($balances[$id]['balance_id'])));
								echo $options['value'];
							} else {
								echo $this->Form->input('opening_balance_' . $id, $options);
							}
						?>
						</td>
					</tr>
					
					<?php } ?>
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
