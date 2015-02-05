<html>
<?php echo $this->Html->charset(); ?>
<?php echo $this->Html->css(array('reset', 'style'), null, array('media' =>'all')); ?>
<script language="javascript">
	$(document).ready(function() {
		$("a.checkLink").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'titlePosition'		: 'inside',
			'overlayColor'		: '#FFFFFF',
			'overlayOpacity'	: 0.4
		});
});
</script>
<body>
	<div class="reportDiv" style="width:1550px">
	<table class="reportTable" style="width:1550px">
		<tr>
			<th colspan="3" class="center" >अनुसूची १७</th>
		</tr>
		<tr>
			<th colspan="3"><h1>गाउँ विकास समितिको कार्यालय</h1><h5><?php echo VDC_NAME; ?></h5></th>
		</tr>
		<tr>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<th colspan="3" ><h2>बैङ्क नगदी किताब</h2></th>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
	<br />
	<table  class="reportTable reportTableBorder" style="width:1550px">
		<tr>
			<th class="border" rowspan="2" style="width: 50px;">मिति</th>
			<th class="border" rowspan="2" style="width: 50px;"><?php __(VOUCHER); ?></th>
			<th class="border" rowspan="2" style="width:200px;"><?php __(DESCRIPTION); ?></th>
			<th class="border" colspan="2" style="width:200px;">नगद मौज्दात</th>
			<th class="border" colspan="4" style="width:350px;">बैङ्क मौज्दात</th>
			<th class="border" colspan="2" style="width:150px;">बजेट खर्च</th>
			<th class="border" colspan="2" style="width:200px;">पेश्की</th>
			<th class="border" colspan="3" style="width:300px;">विविध खाता</th>
			<th class="border" rowspan="2" style="width: 50px;">कैफियत</th>
		</tr>
		<tr>
			<th class="border" style="width:100px;"><?php __(DEBIT); ?></th>
			<th class="border" style="width:100px;"><?php __(CREDIT); ?></th>
			<th class="border" style="width:100px;"><?php __(DEBIT); ?></th>
			<th class="border" style="width:100px;"><?php __(CREDIT); ?></th>
			<th class="border" style="width: 50px;">चेक नं</th>
			<th class="border" style="width:100px;">बाँकी</th>
			<th class="border" style="width: 50px;">खर्च शीर्षक नं.</th>
			<th class="border" style="width:100px;">रु.</th>
			<th class="border" style="width:100px;">पाएको</th>
			<th class="border" style="width:100px;">फर्छिएको</th>
			<th class="border" style="width: 50px;">हिसाब नं</th>
			<th class="border" style="width:100px;"><?php __(DEBIT); ?></th>
			<th class="border" style="width:100px;"><?php __(CREDIT); ?></th>
		</tr>
	
	<?php foreach ($data as $k => $v) {?>
	<tr>
	<?php //$this->NepaliCalendar->convertEngNumberToNepaliNumber(number_format($vouchers['Transaction'][$k]['amount'], 2, '.', ','))?>
		<td class="borderLeftRight center"><?php 
		if(isset($v['date'])) {
			echo  $v['date'];
		}
		?></td>
		<td class="borderLeftRight center"><?php 
		if(isset($v['code'])) {
			echo $nepaliNumber->toggleNumberLang($v['code']);
		}
		?></td>
		<td class="borderLeftRight"><?php if(isset($v['particulars'])) { __($v['particulars']);}?></td>
		<td class="borderLeftRight right"><?php 
			if(isset($v['cash_dr'])) {
				 echo $nepaliNumber->currency($v['cash_dr']);
			}
		?></td>
		<td class="borderLeftRight right"><?php 
			if(isset($v['cash_cr'])) { __($nepaliNumber->currency($v['cash_cr']));}
		?></td>
		<td class="borderLeftRight right"><?php 
			if(isset($v['bank_dr'])) { __($nepaliNumber->currency($v['bank_dr']));}
		?></td>
		<td class="borderLeftRight right"><?php 
			if(isset($v['bank_cr'])) { __($nepaliNumber->currency($v['bank_cr']));}
		?></td>
		<td class="borderLeftRight center"><?php 
			if(isset($v['cheque_no'])) { __($v['cheque_no']);}
		?></td>
		<td class="borderLeftRight right"><?php if(isset($v['balance'])) { __($nepaliNumber->currency($v['balance']));}?></td>
		<td class="borderLeftRight center"><?php if(isset($v['budget_code'])) { __($nepaliNumber->toggleNumberLang($v['budget_code'])); }?></td>
		<td class="borderLeftRight right">
			<?php if(isset($v['budget_amount'])) { __($nepaliNumber->currency($v['budget_amount']));}?>
			<?php if(isset($v['budget_advance'])) { __(" <br /> (" . $nepaliNumber->currency($v['budget_advance']) . ")");} ?>
		</td>
		<td class="borderLeftRight right"><?php if(isset($v['advance_given'])) { __($nepaliNumber->currency($v['advance_given']));}?></td>
		<td class="borderLeftRight right"><?php if(isset($v['advance_cleared'])) { __($nepaliNumber->currency($v['advance_cleared']));}?></td>
		<td class="borderLeftRight center"><?php if(isset($v['account_id'])) { echo $nepaliNumber->toggleNumberLang($v['account_id']);}?></td>
		<td class="right"><?php if(isset($v['misc_dr'])) { __($nepaliNumber->currency($v['misc_dr']));}?></td>
		<td class="borderLeftRight right"><?php if(isset($v['misc_cr'])) { __($nepaliNumber->currency($v['misc_cr']));}?></td>
		<td class="borderLeftRight"><?php if(isset($v['remarks'])) { __($v['remarks']);}?></td>
	</tr>
	<?php }?>
	<tr class="borderTop">
		<td class="border">&nbsp;</td>
		<td class="border">&nbsp;</td>
		<td class="border">&nbsp;</td>
		<td class="border bold right"><?php __($nepaliNumber->currency($cash_debit)); ?></td>
		<td class="border bold right"><?php __($nepaliNumber->currency($cash_credit)); ?></td>
		<td class="border bold right"><?php __($nepaliNumber->currency($bank_debit)); ?></td>
		<td class="border bold right"><?php __($nepaliNumber->currency($bank_credit)); ?></td>
		<td class="border ">&nbsp;</td>
		<td class="border bold right"><?php __($nepaliNumber->currency($bank_balance)); ?></td>
		<td class="border ">&nbsp;</td>
		<td class="border bold right"><?php __($nepaliNumber->currency($budget_expenditure)); ?></td>
		<td class="border bold right"><?php __($nepaliNumber->currency($advance_given)); ?></td>
		<td class="border bold right"><?php __($nepaliNumber->currency($advance_cleared)); ?></td>
		<td class="border ">&nbsp;</td>
		<td class="border bold right"><?php __($nepaliNumber->currency($misc_debit)); ?></td>
		<td class="border bold right"><?php __($nepaliNumber->currency($misc_credit)); ?></td>
		<td class="border ">&nbsp;</td>
	</tr>
	</table>
</div>
</body>
</html>