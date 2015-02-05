<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php echo $this->NepaliCalendar->nepaliDate('F', null, 'nepali')?> महिनाको बैङ्क नगदी किताब</h3></td>
					<td class="a-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table width="100%">
		<tr>
			<td width="10%">
				<?php echo $this->element('account_left_menu')?>
			</td>
			<td>
				<div class="accounts index">
					<?php echo $this->Form->button('Print', array('type' => 'button', 'onclick' => "var child=window.open('../accounts/getBankCashBook/" . $year . "/" . $month . "/book', 'Select', 'height=800, width=850, scrollbars=yes');", 'target' => '_blank'));?>
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
							<td>
								<?php if(isset($v['budget_amount'])) { __($nepaliNumber->currency($v['budget_amount']));}?>
								<?php if(isset($v['budget_advance'])) { __("<br>(" . $nepaliNumber->currency($v['budget_advance']) . ")");} ?>
								&nbsp;
							</td>
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
						
						<hr>
						<h2>ट्रायल ब्यालेन्स</h2>
						
						<?php echo $this->Form->button('Print', array('type' => 'button', 'onclick' => "var child=window.open('../accounts/getBankCashBook/" . $year . "/" . $month . "/trial', 'Select', 'height=800, width=850, scrollbars=yes');", 'target' => '_blank'));?>
						<table width="50%" border=1 cellpadding=0px cellspacing=0px>
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
							<td><?php __($nepaliNumber->currency($misc_debit)); ?></td>
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
				
				</div>

			</td>
		</tr>
	</table>
</div>