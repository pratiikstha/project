<body  onLoad="print();window.close();">
<h2 align="center" ><?php __(HEADER_3);?><br><span style="font-size:90%"><?php __(HEADER_3_E); ?></span></h2>
<h2 align="center"><?php echo VDC_NAME; ?><br><?php __(VDC_NAME_E)?></h2></td>
<center><h3>ट्रायल ब्यालेन्स</h3>
<?php echo $this->NepaliCalendar->nepaliDate('Y-F', null, 'nepali'); ?>
</center>

<hr>
<h2>ट्रायल ब्यालेन्स</h2>
<?php echo $this->Form->button('Print Trial Balance', array('type' => 'button', 'onclick' => "var child=window.open('../accounts/getBankCashBook/trial', 'Select', 'height=800, width=850, scrollbars=yes');", 'target' => '_blank'));?>
<table>
<tr>
	<th>क्रम नं</th>
	<th>विवरण</th>
	<th>डेबिट (रु.)</th>
	<th>क्रेडिट (रु.)</th>
</tr>
<tr>
	<td>१</td>
	<td>नगद</td>
	<td><?php __($nepaliNumber->currency($cash_debit)); ?></td>
	<td><?php __($nepaliNumber->currency($cash_credit));?></td>
</tr>
<tr>
	<td>२</td>
	<td>बैङ्क</td>
	<td><?php __($nepaliNumber->currency($bank_debit)); ?></td>
	<td><?php __($nepaliNumber->currency($bank_credit)); ?></td>
</tr>
<tr>
	<td>३</td>
	<td>बजेट खर्च</td>
	<td><?php __($nepaliNumber->currency($budget_expenditure)); ?></td>
	<td>-</td>
</tr>

<tr>
	<td>४</td>
	<td>पेश्की</td>
	<td><?php __($nepaliNumber->currency($advance_given)); ?></td>
	<td><?php __($nepaliNumber->currency($advance_cleared)); ?></td>
</tr>
<tr>
	<td>५</td>
	<td>विविध</td>
	<td>-</td>
	<td><?php __($nepaliNumber->currency($misc_credit)); ?></td>
</tr>
<tr>
	<td colspan="2">जम्मा:</td>
	<td><?php __($nepaliNumber->currency($trial_debit_total)); ?></td>
	<td><?php __($nepaliNumber->currency($trial_credit)); ?></td>
</tr>
<tr>
	<td colspan="2">फर्छ्‌यौट नभएको पेश्की:</td>
	<td>-</td>
	<td><?php __($nepaliNumber->currency($uncleared_advance)); ?></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
	<td><?php __($nepaliNumber->currency($trial_debit_total))?></td>
	<td><?php __($nepaliNumber->currency($trial_credit_total)); ?></td>
</tr>
</table>
</body>