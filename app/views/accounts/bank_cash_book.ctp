<script language="javascript">
$(document).ready(function() {
	$("a.printLink").fancybox({
			'width'				: '100%',
			'height'			: '75%',
			'titlePosition'		: 'inside',
			'overlayColor'		: '#FFFFFF',
			'overlayOpacity'	: 0.4
	});
});
</script>

<?php list($prevYear, $prevMonth) = $nepaliCalendar->getPreviousYearMonth($year, $month); ?>
<?php list($nextYear, $nextMonth) = $nepaliCalendar->getNextYearMonth($year, $month); ?>
<?php $prevMonth = sprintf("%02d", $prevMonth); ?>
<?php $nextMonth = sprintf("%02d", $nextMonth); ?>

<div class="box colorBlue">
	<h3><?php echo ACCOUNTS_MENU; ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<br />
		<span class="fleft"><?php echo $html->link($nepaliCalendar->getNepaliMonthName($prevMonth), array('action' => 'getBankCashBook', $prevYear, $prevMonth))?></span>
		<span class="fright"><?php echo $html->link($nepaliCalendar->getNepaliMonthName($nextMonth), array('action' => 'getBankCashBook', $nextYear, $nextMonth))?></span>
		<br />
		<br />
		<div class="list_table_container">
			
			<div id="main_head" style="text-align:center">
				<?php echo $yearNepali . ' साल ' . $monthNepali; ?> महिनाको बैङ्क नगदी किताब 
				<?php if (!isset($data)) { ?>
					उपलब्ध छैन । 
				<?php } else { ?>
				<span class="fright">
				<?php print $html->link($html->image('printer.png'), array('action' => 'getBankCashBook', $year, $month, 'book'), array('escape' => false, 'target' => '_blank')) ; ?>&nbsp;&nbsp;
				</span>
				<?php }?>
			</div>
			<?php if (isset($data)) { ?>
	        <div class="list_table">
	        	<table border="0" width="1825px" cellspacing="0" cellpadding="0">
					<tr  id="row">
						<th rowspan="2" style="width: 75px;">मिति</th>
						<th rowspan="2" style="width: 75px;"><?php __(VOUCHER); ?></th>
						<th rowspan="2" style="width:300px;"><?php __(DESCRIPTION); ?></th>
						<th colspan="2" style="width:200px;">नगद मौज्दात</th>
						<th colspan="4" style="width:400px;">बैङ्क मौज्दात</th>
						<th colspan="2" style="width:200px;">बजेट खर्च</th>
						<th colspan="2" style="width:200px;">पेश्की</th>
						<th colspan="3" style="width:300px;">विविध खाता</th>
						<th rowspan="2" style="width: 75px;">कैफियत</th>
					</tr>
					<tr  id="row">
						<th style="width:100px;"><?php __(DEBIT); ?></th>
						<th style="width:100px;"><?php __(CREDIT); ?></th>
						<th style="width:100px;"><?php __(DEBIT); ?></th>
						<th style="width:100px;"><?php __(CREDIT); ?></th>
						<th style="width:100px;">चेक नं</th>
						<th style="width:100px;">बाँकी</th>
						<th style="width:100px;">खर्च शीर्षक नं.</th>
						<th style="width:100px;">रु.</th>
						<th style="width:100px;">पाएको</th>
						<th style="width:100px;">फर्छिएको</th>
						<th style="width:100px;">हिसाब नं</th>
						<th style="width:100px;"><?php __(DEBIT); ?></th>
						<th style="width:100px;"><?php __(CREDIT); ?></th>
					</tr>
				
				<?php foreach ($data as $k => $v) {?>
				<tr>
				<?php //$this->NepaliCalendar->convertEngNumberToNepaliNumber(number_format($vouchers['Transaction'][$k]['amount'], 2, '.', ','))?>
					<td class="center"><?php 
					if(isset($v['date'])) {
						echo  $v['date'];
					}
					?></td>
					<td class="center"><?php 
					if(isset($v['code'])) {
						echo $nepaliNumber->toggleNumberLang($v['code']);
					}
					?></td>
					<td class=""><?php if(isset($v['particulars'])) { __($v['particulars']);}?></td>
					<td class="right"><?php 
						if(isset($v['cash_dr'])) {
							 echo $nepaliNumber->currency($v['cash_dr']);
						}
					?></td>
					<td class="right"><?php 
						if(isset($v['cash_cr'])) { __($nepaliNumber->currency($v['cash_cr']));}
					?></td>
					<td class="right"><?php 
						if(isset($v['bank_dr'])) { __($nepaliNumber->currency($v['bank_dr']));}
					?></td>
					<td class="right"><?php 
						if(isset($v['bank_cr'])) { __($nepaliNumber->currency($v['bank_cr']));}
					?></td>
					<td class="center"><?php 
						if(isset($v['cheque_no'])) { __($v['cheque_no']);}
					?></td>
					<td class="right"><?php if(isset($v['balance'])) { __($nepaliNumber->currency($v['balance']));}?></td>
					<td class="center"><?php if(isset($v['budget_code'])) { __($nepaliNumber->toggleNumberLang($v['budget_code'])); }?></td>
					<td class="right">
						<?php if(isset($v['budget_amount'])) { __($nepaliNumber->currency($v['budget_amount']));}?>
						<?php if(isset($v['budget_advance'])) { __(" <br /> (" . $nepaliNumber->currency($v['budget_advance']) . ")");} ?>
					</td>
					<td class="right"><?php if(isset($v['advance_given'])) { __($nepaliNumber->currency($v['advance_given']));}?></td>
					<td class="right"><?php if(isset($v['advance_cleared'])) { __($nepaliNumber->currency($v['advance_cleared']));}?></td>
					<td class="center"><?php if(isset($v['account_id'])) { echo $nepaliNumber->toggleNumberLang($v['account_id']);}?></td>
					<td class="right"><?php if(isset($v['misc_dr'])) { __($nepaliNumber->currency($v['misc_dr']));}?></td>
					<td class="right"><?php if(isset($v['misc_cr'])) { __($nepaliNumber->currency($v['misc_cr']));}?></td>
					<td class=""><?php if(isset($v['remarks'])) { __($v['remarks']);}?></td>
				</tr>
				<?php }?>
				<tr class="borderTop">
					<td class="">&nbsp;</td>
					<td class="">&nbsp;</td>
					<td class="">&nbsp;</td>
					<td class="bold right"><?php __($nepaliNumber->currency($cash_debit)); ?></td>
					<td class="bold right"><?php __($nepaliNumber->currency($cash_credit)); ?></td>
					<td class="bold right"><?php __($nepaliNumber->currency($bank_debit)); ?></td>
					<td class="bold right"><?php __($nepaliNumber->currency($bank_credit)); ?></td>
					<td class="">&nbsp;</td>
					<td class="bold right"><?php __($nepaliNumber->currency($bank_balance)); ?></td>
					<td class="">&nbsp;</td>
					<td class="bold right"><?php __($nepaliNumber->currency($budget_expenditure)); ?></td>
					<td class="bold right"><?php __($nepaliNumber->currency($advance_given)); ?></td>
					<td class="bold right"><?php __($nepaliNumber->currency($advance_cleared)); ?></td>
					<td class="">&nbsp;</td>
					<td class="bold right"><?php __($nepaliNumber->currency($misc_debit)); ?></td>
					<td class="bold right"><?php __($nepaliNumber->currency($misc_credit)); ?></td>
					<td class="">&nbsp;</td>
				</tr>
			</table>
			</div>
		<?php } ?>
    	</div>
	</div><!-- end contentList -->
</div><!-- end boxContent -->