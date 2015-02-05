<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __($account_name . ' ' . ADVANCE . ' ' . ACCOUNT );?></h3></td>
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
					<br />
					<table cellpadding="5" cellspacing="3" style="border:1px dotted" width="100%">
					<tr>
							<th>मिति</th>
							<th>विवरण</th>
							<th>भौचर नं.</th>
							<th>डेबिट (रु।)</th>
							<th>क्रेडिट (रु)</th>
							<th>मौज्दात</th>
							<th>स्वीकृत गर्ने</th>
					</tr>
					<?php
					$i = 0;
					foreach ($advances as $account):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
				
					<tr<?php echo $class;?>>
						<td><?php if(isset($account['date'])) {echo $account['date']; } ?></td>
						<td><?php if(isset($account['particulars'])) {echo $account['particulars']; } ?></td>
						<td><?php if(isset($account['voucher_id'])) {echo $nepaliNumber->toggleNumberLang($account['voucher_id']); } ?></td>
						<td><?php if(isset($account['amount_dr'])) { echo $nepaliNumber->currency($account['amount_dr']); } else { echo "-"; } ?></td>
						<td><?php if(isset($account['amount_cr'])) { echo $nepaliNumber->currency($account['amount_cr']); } else { echo "-"; } ?></td>
						<td><?php if(isset($account['balance'])) { echo $nepaliNumber->currency($account['balance']); } ?></td>
						<td>&nbsp;</td>
					</tr>
				<?php endforeach; ?>
					<tr>
						<td colspan="7" align="center"></td>
					</tr>
					</table>
				
				</div>

			</td>
		</tr>
	</table>
</div>
