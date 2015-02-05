<?php $receiveBy = $dayBook['ReceivedBy']['first_name'] . ' ' . $dayBook['ReceivedBy']['last_name']; ?>
<?php $receiveFrom = $dayBook['ReceivedFrom']['first_name'] . ' ' . $dayBook['ReceivedFrom']['last_name']; ?>
<html>
<?php echo $this->Html->charset(); ?>
<?php echo $this->Html->css(array('reset', 'style'), null, array('media' =>'all')); ?>
<body><!--  onload="print();window.close();"-->
	<div class="reportDiv" style="margin:auto;width:700px;border:0px solid #000">
	<table class="reportTable" style="width:700px">
		<tr>
			<th colspan="3" class="center" >अनुसूची ९</th>
		</tr>
		<tr>
			<td colspan="3" class="right">रसिद नं. <?php echo $nepaliNumber->toggleNumberLang($dayBook['DayBook']['receipt_number']); ?></td>
		</tr>
		<tr>
			<th colspan="3"><h1>गाउँ विकास समितिको कार्यालय</h1><h5><?php echo VDC_NAME; ?></h5></th>
		</tr>
		<tr>
			<th colspan="3" ><br /><h2>आम्दानी रसिद</h2></th>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td class="right" >मिति:- <?php __($dayBook['DayBook']['transaction_date']); ?></td>
		</tr>
	</table>
	<br />
	<table  class="reportTable reportTableBorder" style="width:700px">
		<tr  id="row">
			<th class="border" colspan="2" style="width:225px;">विवरण</th>
			<th class="border" rowspan="2" style="width: 75px;">खा.पा.नं.</th>
			<th class="border" colspan="2" style="width:100px;">रकम</th>
		</tr>
		<tr  id="row">
			<th class="border" style="width: 150px;">वापत</th>
			<th class="border" style="width: 75px;">आम्दानी संकेत नं.</th>
			<th class="border" style="width: 75px;">रू</th>
			<th class="border" style="width: 25px;">पै</th>
		</tr>
		<tr>
			<?php 
				$net_rs = '';
				$net_ps = '';
				if(isset($dayBook['DayBook']['net_amount'])) {
					list($net_rs, $net_ps) = explode("/", $nepaliNumber->currency($dayBook['DayBook']['net_amount']));
				}
				
			?>
			<td class="borderLeftRight left"><?php echo $dayBook['Account']['account_name']; ?></td>
			<td class="borderLeftRight center"><?php echo $nepaliNumber->toggleNumberLang($dayBook['Account']['budget_code']); ?></td>
			<td class="borderLeftRight">&nbsp;</td>
			<td class="borderLeftRight right"><?php echo $net_rs; ?></td>
			<td class="borderLeftRight right"><?php echo $net_ps; ?></td>
		</tr>
		<tr class="borderTop">
			<td class="border" style="width: 150px;">जम्मा</td>
			<td class="border">&nbsp;</td>
			<td class="border">&nbsp;</td>
			<td class="border right" style="width: 75px;"><?php echo $net_rs; ?></td>
			<td class="border right" style="width: 25px;"><?php echo $net_ps; ?></td>
		</tr>
		<tr class="borderTop">
			<td class="border" colspan="5">अक्षरेपी: <?php echo $numberToWord->convert($number->precision($dayBook['DayBook']['net_amount'],2)); ?></td>
		</tr>
		<tr>
			<td class="left" colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td class="left" colspan="2">रकम बुझाउनेको सही<br /><?php echo $receiveFrom; ?></td>
			<td class="right" colspan="3">रकम बुझ्नेको सही<br /><?php echo $receiveBy; ?></td>
		</tr>
	</table>
<br />
<br />
<br />
<br />
<hr />
<br />
<br />
	<table class="reportTable" style="width:700px">
		<tr>
			<th colspan="3" class="center" >अनुसूची ९</th>
		</tr>
		<tr>
			<td colspan="3" class="right">रसिद नं. <?php echo $nepaliNumber->toggleNumberLang($dayBook['DayBook']['receipt_number']); ?></td>
		</tr>
		<tr>
			<th colspan="3"><h1>गाउँ विकास समितिको कार्यालय</h1><h5><?php echo VDC_NAME; ?></h5></th>
		</tr>
		<tr>
			<th colspan="3" ><br /><h2>आम्दानी रसिद</h2></th>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td class="right" >मिति:- <?php __($dayBook['DayBook']['transaction_date']); ?></td>
		</tr>
	</table>
	<br />
	<table  class="reportTable reportTableBorder" style="width:700px">
		<tr  id="row">
			<th class="border" colspan="2" style="width:225px;">विवरण</th>
			<th class="border" rowspan="2" style="width: 75px;">खा.पा.नं.</th>
			<th class="border" colspan="2" style="width:100px;">रकम</th>
		</tr>
		<tr  id="row">
			<th class="border" style="width: 150px;">वापत</th>
			<th class="border" style="width: 75px;">आम्दानी संकेत नं.</th>
			<th class="border" style="width: 75px;">रू</th>
			<th class="border" style="width: 25px;">पै</th>
		</tr>
		<tr>
			<?php 
				$net_rs = '';
				$net_ps = '';
				if(isset($dayBook['DayBook']['net_amount'])) {
					list($net_rs, $net_ps) = explode("/", $nepaliNumber->currency($dayBook['DayBook']['net_amount']));
				}
				
			?>
			<td class="borderLeftRight left"><?php echo $dayBook['Account']['account_name']; ?></td>
			<td class="borderLeftRight center"><?php echo $nepaliNumber->toggleNumberLang($dayBook['Account']['budget_code']); ?></td>
			<td class="borderLeftRight">&nbsp;</td>
			<td class="borderLeftRight right"><?php echo $net_rs; ?></td>
			<td class="borderLeftRight right"><?php echo $net_ps; ?></td>
		</tr>
		<tr class="borderTop">
			<td class="border" style="width: 150px;">जम्मा</td>
			<td class="border">&nbsp;</td>
			<td class="border">&nbsp;</td>
			<td class="border right" style="width: 75px;"><?php echo $net_rs; ?></td>
			<td class="border right" style="width: 25px;"><?php echo $net_ps; ?></td>
		</tr>
		<tr class="borderTop">
			<td class="border" colspan="5">अक्षरेपी: <?php echo $numberToWord->convert($number->precision($dayBook['DayBook']['net_amount'],2)); ?></td>
		</tr>
		<tr>
			<td class="left" colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td class="left" colspan="2">रकम बुझाउनेको सही<br /><?php echo $receiveFrom; ?></td>
			<td class="right" colspan="3">रकम बुझ्नेको सही<br /><?php echo $receiveBy; ?></td>
		</tr>
	</table>
</div>
</body>
</html>