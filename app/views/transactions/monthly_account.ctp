<?php echo $javascript->link('account');?>
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
<?php $yearNepali = $nepaliNumber->toggleNumberLang($year); ?>
<?php $monthNepali = $nepaliCalendar->getNepaliMonthName($month); ?>
<?php $prevMonth = sprintf("%02d", $prevMonth); ?>
<?php $nextMonth = sprintf("%02d", $nextMonth); ?>

<div class="box colorBlue">
	<h3>खर्चको फाँटवारी [<?php echo $this->NepaliNumber->toggleNumberLang($year, 'nepali'); ?> साल <?php echo $month; ?> महिना]</h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<br />
		<span class="fleft"><?php echo $html->link($nepaliCalendar->getNepaliMonthName($prevMonth), array('action' => 'getMonthlyAccount', $prevYear, $prevMonth))?></span>
		<span class="fright">
		<?php
			 
			echo $html->link($nepaliCalendar->getNepaliMonthName($nextMonth), array('action' => 'getMonthlyAccount', $nextYear, $nextMonth))
		?>
		</span>
		<br />
		<br />
		<div class="list_table_container">
			
			<div id="main_head" style="text-align:center">
				<?php echo $yearNepali . ' साल ' . $monthNepali; ?> महिनाको
				<?php if (!isset($data)) { ?>
					उपलब्ध छैन । 
				<?php } else { ?>
				<span class="fright">
				<?php print $html->link($html->image('printer.png'), array('action' => 'getBankCashBook', $year, $month, 'book'), array('escape' => false, 'class' =>'printLink')) ; ?>&nbsp;&nbsp;
				</span>
				<?php }?>
			</div>
	        <div class="list_table">
	        	<table border="0" width="1050px" cellspacing="0" cellpadding="0">
					<tr id="row">
						<th style="width:125px;"><?php echo $monthNepali; ?> महिनाको खर्च </th>
						<th style="width:125px;"><?php echo $monthNepali; ?> सम्मको निकासा</th>
						<th style="width: 75px;">बजेट रकम नं</th>
						<th style="width:325px;">बजेट खर्च शीर्षक</th>
						<th style="width:150px;">जम्मा बजेट बिनियोजन</th>
						<th style="width:125px;"><?php echo $monthNepali; ?> मसान्त सम्मको खर्च</th>
						<th style="width:125px;">बजेट बाँकी</th>
					</tr>
					<tr>
						<td class="right"></td>
						<td class="right">&nbsp;</td>
						<td class="right">&nbsp;</td>
						<td class="right">&nbsp;</td>
						<td class="right">&nbsp;</td>
						<td class="right">&nbsp;</td>
						<td class="right">&nbsp;</td>
					</tr>
					<?php foreach($monthly_account as $k => $v) { ?>
						<tr>
							<td class="right"><?php echo $nepaliNumber->currency($v['current_month_expense']); ?></td>
							<td class="right"><?php echo $nepaliNumber->currency($v['release_till_current_month']); ?></td>
							<td class="center"><?php echo $nepaliNumber->toggleNumberLang($v['budget_code']); ?></td>
							<td class=""><?php echo $v['budget_title']; ?></td>
							<td class="right"><?php echo $nepaliNumber->currency($v['total_allocation']); ?></td>
							<td class="right"><?php echo $nepaliNumber->currency($v['expense_till_current_month']); ?></td>
							<td class="right"><?php echo $nepaliNumber->currency($v['remaining_budget']); ?></td>
						</tr>
						<?php } ?>
						<tr>
							<td class="right">-</td>
							<td class="right"><?php echo $nepaliNumber->currency($totals['total_release_till_current_month']); ?></td>
							<td class="right">&nbsp;</td>
							<td class=""> जम्मा</td>
							<td class="right">-</td>
							<td class="right">-</td>
							<td class="right">-</td>
						</tr>
						<tr>
							<td class="right">-</td>
							<td class="right"><?php echo $nepaliNumber->currency($carried_forward); ?></td>
							<td class="right">&nbsp;</td>
							<td class="">चालुकोष बाँकी</td>
							<td class="right">-</td>
							<td class="right">-</td>
							<td class="right">-</td>
						</tr>
						<tr>
							<td style="text-align:right;"><?php echo $nepaliNumber->currency($totals['total_current_month_expense']); ?></td>
							<td style="text-align:right;"><?php echo $nepaliNumber->currency($total_release); ?></td>
							<td>&nbsp;</td>
							<td>जम्मा</td>
							<td style="text-align:right;"><?php echo $nepaliNumber->currency($totals['total_allocation']); ?></td>
							<td style="text-align:right;"><?php echo $nepaliNumber->currency($totals['total_expense_till_current_month']); ?></td>
							<td style="text-align:right;"><?php echo $nepaliNumber->currency($totals['total_remaining_budget']); ?></td>
						</tr>
				</table>
				<br />
				<table border="0" width="1050px" cellspacing="0" cellpadding="0">
					<tr>
						<th colspan="4" class="tbl-design center">कोषको अवस्था</th>
					</tr>
					<tr>
						<td class="right"><?php echo $nepaliNumber->convertToNepaliNum($end_of_month); ?> सम्ममा प्राप्त भएको जम्माजम्मी निकासा रु. </td>
						<td class="right"><?php echo $nepaliNumber->currency($total_release); ?></td>
						<th class="right">बैङ्क मौज्दात रु. </th>
						<td class="right"><?php echo $nepaliNumber->currency($bank_balance); ?></td>
					</tr>
					<tr>
						<td class="right"><?php echo $nepaliNumber->convertToNepaliNum($end_of_month); ?> सम्ममा भएको जम्माजम्मी खर्च रु. </td>
						<td class="right"><?php echo $nepaliNumber->currency($totals['total_expense_till_current_month']); ?></td>
						<td class="right">तहबिल मौज्दात रु. </td>
						<td class="right"><?php echo $nepaliNumber->currency($cash_balance); ?></td>
					</tr>
					<tr>
						<td class="right">&nbsp;</td>
						<td class="right"><?php echo $nepaliNumber->currency($release_expense_difference); ?></td>
						<td class="right">&nbsp;</td>
						<td class="right"><?php echo $nepaliNumber->currency($total_balance); ?></td>
					</tr>
				</table>
				
				<table border="0" width="1050px" cellspacing="0" cellpadding="0">
					<tr>
						<td class="right">फर्छ‌्‌यौट नभएको पेश्की रु. </td>
						<td><?php echo $nepaliNumber->currency($uncleared_advance); ?></td>
					</tr>
					<tr>
						<td class="right">खुद खर्च (पेश्की कटाई) रु. </td>
						<td><?php echo $nepaliNumber->currency($net_expense); ?></td>
					</tr>
				</table>
			</div>
    	</div>
	</div><!-- end contentList -->
</div><!-- end boxContent -->
