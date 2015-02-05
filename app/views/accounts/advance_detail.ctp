<html>
<?php echo $this->Html->charset(); ?>
<?php echo $this->Html->css(array('reset', 'style'), null, array('media' =>'all')); ?>
<body onload="print();window.close();">
	<div class="reportDiv">
	<table class="reportTable" style="width:850px">
		<tr>
			<th colspan="3" class="center" >अनुसूची २०</th>
		</tr>
		<tr>
			<th colspan="3"><h1>गाउँ विकास समितिको कार्यालय</h1><h5><?php echo VDC_NAME; ?></h5></th>
		</tr>
		<tr>
			<th colspan="3" ><br /><h2>पेश्की खाता</h2></th>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td>पेश्की लिनेको नाम:- <?php __($account_name);?></td>
			<td>&nbsp;</td>
			<td class="right" >पाना नं. <?php __($nepaliNumber->toggleNumberLang($id)); ?></td>
		</tr>
	</table>
	<br />
	<table  class="reportTable reportTableBorder" style="width:850px">
		<tr  id="row">
			<th class="border" colspan="2" style="width: 75px;">मिति</th>
			<th class="border" rowspan="2" style="width:300px;">विवरण</th>
			<th class="border" rowspan="2" style="width: 75px;"><?php __(VOUCHER); ?></th>
			<th class="border" colspan="2" style="width:100px;"><?php __(DEBIT); ?></th>
			<th class="border" colspan="2" style="width:100px;"><?php __(CREDIT); ?></th>
			<th class="border" colspan="2" style="width:100px;">बाँकी</th>
			<th class="border" rowspan="2" style="width:100px;">प्रमाणित गर्ने</th>
		</tr>
		<tr  id="row">
			<th class="border" style="width: 50px;">महिना</th>
			<th class="border" style="width: 25px;">गते</th>
			<th class="border" style="width: 75px;">रू</th>
			<th class="border" style="width: 25px;">पै</th>
			<th class="border" style="width: 75px;">रू</th>
			<th class="border" style="width: 25px;">पै</th>
			<th class="border" style="width: 75px;">रू</th>
			<th class="border" style="width: 25px;">पै</th>
		</tr>
		<?php foreach ($advances as $account): ?>
		<tr>
			<?php 
				list($month, $date) = explode("/", $account['date']);
				$amount_dr_rs = '';
				$amount_dr_ps = '';
				if(isset($account['amount_dr'])) {
					list($amount_dr_rs, $amount_dr_ps) = explode("/", $nepaliNumber->currency($account['amount_dr']));
				}
				$amount_cr_rs = '';
				$amount_cr_ps = '';
				if(isset($account['amount_cr'])) {
					list($amount_cr_rs, $amount_cr_ps) = explode("/", $nepaliNumber->currency($account['amount_cr']));
				}
				$balance_rs = '';
				$balance_ps = '';
				if(isset($account['balance'])) {
					list($balance_rs, $balance_ps) = explode("/", $nepaliNumber->currency($account['balance']));
				}
				
			?>
			<td class="borderLeftRight center"><?php echo $nepaliCalendar->getNepaliMonthName($month); ?></td>
			<td class="borderLeftRight center"><?php echo $nepaliNumber->toggleNumberLang($date); ?></td>
			<td class="borderLeftRight"><?php if(isset($account['particulars'])) {echo $account['particulars']; } ?></td>
			<td class="borderLeftRight center""><?php if(isset($account['voucher_id'])) {echo $nepaliNumber->toggleNumberLang($account['voucher_id']); } ?></td>
			<td class="borderLeftRight right"><?php echo $amount_dr_rs; ?></td>
			<td class="borderLeftRight right"><?php echo $amount_dr_ps; ?></td>
			<td class="borderLeftRight right"><?php echo $amount_cr_rs; ?></td>
			<td class="borderLeftRight right"><?php echo $amount_cr_ps; ?></td>
			<td class="borderLeftRight right"><?php echo $balance_rs; ?></td>
			<td class="borderLeftRight right"><?php echo $balance_ps; ?></td>
			<td class="borderLeftRight">&nbsp;</td>
		</tr>
	<?php endforeach; ?>
		<tr class="borderTop">
			<td colspan="7">&nbsp;</td>
		</tr>
	</table>
</div>
</body>
</html>