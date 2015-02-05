<body  onLoad="print();window.close();">
<h2 align="center" ><?php __(HEADER_3);?><br><span style="font-size:90%"><?php __(HEADER_3_E); ?></span></h2>
<h2 align="center"><?php echo VDC_NAME; ?><br><?php __(VDC_NAME_E)?></h2></td>
<center><h3>बैङ्क नगदी किताब</h3>
<?php echo $this->NepaliCalendar->nepaliDate('Y-F', null, 'nepali'); ?>
</center>
<table width="100%" border=1 cellpadding=0px cellspacing=0px>
						<tr>
							<th>मिति</th>
							<th>कोड नं</th>
							<th width="20%" style="text-align:center;">विवरण</th>
							<th colspan="2" style="text-align:center;">नगद मौज्दात</th>
							<th colspan="4" style="text-align:center;">बैङ्क मौज्दात</th>
							<th colspan="2" style="text-align:center;">बजेट खर्च</th>
							<th colspan="2" style="text-align:center;">पेश्की</th>
							<th colspan="3" style="text-align:center;">विविध खाता</th>
							<th style="text-align:center;">कैफियत</th>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>डे.<br>(रु.)</td>
							<td>क्रे.<br>(रु.)</td>
							<td>डे.<br>(रु.)</td>
							<td>क्रे.<br>(रु.)</td>
							<td>चेक नं</td>
							<td>मौज्दात<br>(रु.)</td>
							<td>बजेट कोड</td>
							<td>रकम<br>(रु.)</td>
							<td>दिएको<br>(रु.)</td>
							<td>फर्छ्‌यौट<br>(रु.)</td>
							<td>खाता नं</td>
							<td>डे.<br>(रु.)</td>
							<td>क्रे.<br>(रु.)</td>
							<td>&nbsp;</td>
						</tr>
						<?php foreach ($data as $k => $v) {?>
						<tr>
						<?php //$this->NepaliCalendar->convertEngNumberToNepaliNumber(number_format($vouchers['Transaction'][$k]['amount'], 2, '.', ','))?>
							<td><?php 
							if(isset($v['date'])) {
								echo $v['date'];
							}
							?>&nbsp;</td>
							<td><?php 
							if(isset($v['code'])) {
								echo $nepaliNumber->toggleNumberLang($v['code']);
							}
							?>&nbsp;</td>
							<td><?php if(isset($v['particulars'])) { __($v['particulars']);}?>&nbsp;</td>
							<td><?php 
								if(isset($v['cash_dr'])) {
									 echo $nepaliNumber->currency($v['cash_dr']);
								}
							?>&nbsp;</td>
							<td><?php 
								if(isset($v['cash_cr'])) { __($nepaliNumber->currency($v['cash_cr']));}
							?>&nbsp;</td>
							<td><?php 
								if(isset($v['bank_dr'])) { __($nepaliNumber->currency($v['bank_dr']));}
							?>&nbsp;</td>
							<td><?php 
								if(isset($v['bank_cr'])) { __($nepaliNumber->currency($v['bank_cr']));}
							?>&nbsp;</td>
							<td><?php 
								if(isset($v['cheque_no'])) { __($v['cheque_no']);}
							?>&nbsp;</td>
							<td><?php if(isset($v['balance'])) { __($nepaliNumber->currency($v['balance']));}?>&nbsp;</td>
							<td><?php if(isset($v['budget_code'])) { __($v['budget_code']);}?>&nbsp;</td>
							<td><?php if(isset($v['budget_amount'])) { __($nepaliNumber->currency($v['budget_amount']));}?>&nbsp;</td>
							<td><?php if(isset($v['advance_given'])) { __($nepaliNumber->currency($v['advance_given']));}?>&nbsp;</td>
							<td><?php if(isset($v['advance_cleared'])) { __($nepaliNumber->currency($v['advance_cleared']));}?>&nbsp;</td>
							<td><?php if(isset($v['account_id'])) { echo $nepaliNumber->toggleNumberLang($v['account_id']);}?>&nbsp;</td>
							<td><?php if(isset($v['misc_dr'])) { __($nepaliNumber->currency($v['misc_dr']));}?>&nbsp;</td>
							<td><?php if(isset($v['misc_cr'])) { __($nepaliNumber->currency($v['misc_cr']));}?>&nbsp;</td>
							<td><?php if(isset($v['remarks'])) { __($v['remarks']);}?>&nbsp;</td>
						</tr>
						<?php }?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php __($nepaliNumber->currency($cash_debit)); ?></td>
							<td><?php __($nepaliNumber->currency($cash_credit)); ?></td>
							<td><?php __($nepaliNumber->currency($bank_debit)); ?></td>
							<td><?php __($nepaliNumber->currency($bank_credit)); ?></td>
							<td>&nbsp;</td>
							<td><?php __($nepaliNumber->currency($bank_balance)); ?></td>
							<td>&nbsp;</td>
							<td><?php __($nepaliNumber->currency($budget_expenditure)); ?></td>
							<td><?php __($nepaliNumber->currency($advance_given)); ?></td>
							<td><?php __($nepaliNumber->currency($advance_cleared)); ?></td>
							<td>&nbsp;</td>
							<td><?php __($nepaliNumber->currency($misc_debit)); ?></td>
							<td><?php __($nepaliNumber->currency($misc_credit)); ?></td>
							<td>&nbsp;</td>
						</tr>
						</table>
</body>