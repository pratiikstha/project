<html>
<?php echo $this->Html->charset(); ?>
<?php echo $this->Html->css(array('reset', 'style'), null, array('media' =>'all')); ?>

<body onload = "print(); window.close();">
	<div class="reportDiv">
	<table class="reportTable">
		<tr>
			<th colspan="3" class="center" >अनुसूची १०</th>
		</tr>
		<tr>
			<th colspan="3"><h1>गाउँ विकास समितिको कार्यालय</h1><h5><?php echo VDC_NAME; ?></h5></th>
		</tr>
		<tr>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<th colspan="3" ><h2>दैनिक आय शीर्षकगत कर संकलन खाता</h2></th>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">&nbsp;</td>
		    <td width="15%">&nbsp;</td>
		    <td width="15%">पाना नं.:&nbsp;</td>
		</tr>
	</table>
	<br />
	<table  class="reportTable reportTableBorder">
		<tr>
			<th class="border" style="width: 75px">मिति</th>
			<th class="border" style="width: 75px">रसिद नं</th>
			<th class="border" style="width:200px">आय वर्गीकरण</th>
			<th class="border" style="width:100px">छुट रकम रु</th>
			<th class="border" style="width:100px">खुद बिल रु.</th>
			<th class="border" style="width:100px">जरिवाना रु.</th>
			<th class="border" style="width:100px">कुल बिल रु.</th>
		</tr>
		<?php foreach ($dayBooks as $k => $dayBook) { ?>
		<tr>
			<td class="borderLeftRight center"><?php echo $nepaliNumber->toggleNumberLang($nepaliCalendar->convertToNepaliDate($dayBook['DayBook']['transaction_date']), 'Nepali'); ?></td>
			<td class="borderLeftRight center"><?php echo $nepaliNumber->toggleNumberLang($dayBook['DayBook']['receipt_number']); ?></td>
			<td class="borderLeftRight left"><?php echo $dayBook['DayBook']['account_name']; ?></td>
			<td class="borderLeftRight right"><?php echo $nepaliNumber->currency($dayBook['DayBook']['transaction_amount']);?></td>
			<td class="borderLeftRight right">
				<?php 
					if (!isset($dayBook['DayBook']['discount_amount']) || $dayBook['DayBook']['fine_amount'] == '') {
						$dayBook['DayBook']['discount_amount'] = 0;
					}
					echo $nepaliNumber->currency($dayBook['DayBook']['discount_amount']);
				?>
			</td>
			<td class="borderLeftRight right">
				<?php 
					if(!isset($dayBook['DayBook']['fine_amount']) || $dayBook['DayBook']['fine_amount'] == '') {
						$dayBook['DayBook']['fine_amount'] = 0;
					}
					echo $nepaliNumber->currency($dayBook['DayBook']['fine_amount']);
				?>
			</td>
			<td class="borderLeftRight right">
				<?php echo $nepaliNumber->currency($dayBook['DayBook']['net_amount']); ?>
			</td>
		</tr>
		<?php } ?>
		<tr class="borderTop">
			<td colspan="7"></td>
		</tr>
	</table>
</div>
</body>
</html>