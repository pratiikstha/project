<?php echo $javascript->link('account');?>

<div class="box colorBlue">
	<h3><?php __(DAY_BOOK); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('revenue_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<br />
		<?php echo $form->create('DayBookSearch', array('url'=>'index', 'type'=>'post', 'class' => 'faram')); ?>
		<table>
			<tr>
				<th class="left">मिति</th>
				<td><?php
						//echo $selectedYear  . $selectedMonth . $selectedDay . "<BR>";
						echo $form->select('created_date.Y', $years, array('selected' => $selectedYear));
						echo " / ";
						echo $form->select('created_date.m', $months, array('selected' => $selectedMonth));
						echo " / ";
						echo $form->select('created_date.d', $days, array('selected' => $selectedDay));
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $form->button( SEARCH, array('class' => 'submit', 'div' => false)); ?></td>
			</tr>
		</table>
		<?php echo $form->end(); ?>
		<br />
		<div class="list_table_container">
		<div id="main_head">
			दैनिक आय शीर्षकगत कर संकलन खाता
			<span class="fright">
			<?php print $html->link($html->image('printer.png'), array('action' => 'index', $selectedYear, $selectedMonth, $selectedDay, 'book'), array('escape' => false, 'target' => '_blank')) ; ?>&nbsp;&nbsp;
			</span>
		</div>
        <div class="list_table">
        	<table border="0" width="675"cellspacing="0" cellpadding="0">
				<tr id="row">
					<th>मिति</th>
					<th>रसिद नं</th>
					<th style="width:150px">आय वर्गीकरण</th>
					<th>छुट रकम रु</th>
					<th>खुद बिल रु.</th>
					<th>जरिवाना रु.</th>
					<th>कुल बिल रु.</th>
				</tr>
				<?php foreach ($dayBooks as $k => $dayBook) { ?>
				<tr>
					<td class="center"><?php echo $nepaliNumber->toggleNumberLang($nepaliCalendar->convertToNepaliDate($dayBook['DayBook']['transaction_date']), 'Nepali'); ?></td>
					<td class="center"><?php echo $nepaliNumber->toggleNumberLang($dayBook['DayBook']['receipt_number']); ?></td>
					<td class="left"><?php echo $dayBook['DayBook']['account_name']; ?></td>
					<td class="right"><?php echo $nepaliNumber->currency($dayBook['DayBook']['transaction_amount']);?></td>
					<td class="right">
						<?php 
							if (!isset($dayBook['DayBook']['discount_amount']) || $dayBook['DayBook']['fine_amount'] == '') {
								$dayBook['DayBook']['discount_amount'] = 0;
							}
							echo $nepaliNumber->currency($dayBook['DayBook']['discount_amount']);
						?>
					</td>
					<td class="right">
						<?php 
							if(!isset($dayBook['DayBook']['fine_amount']) || $dayBook['DayBook']['fine_amount'] == '') {
								$dayBook['DayBook']['fine_amount'] = 0;
							}
							echo $nepaliNumber->currency($dayBook['DayBook']['fine_amount']);
						?>
					</td>
					<td class="right">
						<?php 
							echo $nepaliNumber->currency($dayBook['DayBook']['net_amount']);
						?>
					</td>
				</tr>
				<?php } ?>
				<!-- 
				<tr>
					<td colspan='3'>Total</td>
					<td class="center"><?php //echo $nepaliNumber->currency($totals['transaction_amount']); ?></td>
					<td><?php //echo $nepaliNumber->currency($totals['discount_amount']); ?></td>
					<td><?php //echo $nepaliNumber->currency($totals['fine_amount']); ?></td>
					<td><?php //echo $nepaliNumber->currency($totals['net_amount']); ?></td>
				</tr>
				 -->
			</table>
			</div>
		</div>
	</div><!-- end contentList -->
</div><!-- end boxContent -->
