<?php 
$titleBar = "गाउँ विकास समिति";
$pageHeader = "नेपाल सरकार<br>स्थानीय विकास मन्त्रालय<br>गाउँ विकास समितिको कार्यालय<br>________ गा.वि.स.,________";
$footerText = "सर्वाधिकार : गाउँ विकास समितिको कार्यालयमा सुरक्षित ।"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $titleBar; ?></title>
<?php echo $this->Html->meta('icon'); ?>

<style>
<!--
body  { font-size:80%; }
.red  { color: red; }
.blue { color: blue; }
td    { width: 30px; text-align: center; }
a     { text-decoration: none; }
a:hover { text-decoration: underline; }
--> 
</style>
<script language='javascript'>
function setDatetoParentWindow(engDt, nepDt, eleName) {
	opener.document.getElementById(eleName).value = engDt;
	var dispElement = eleName + "_display";
	opener.document.getElementById(dispElement).value = nepDt;
	self.close();
}
</script>

</head>
<body>


<table width="100%">
<thead>
	<tr>
		<th colspan="2" align="left"><?php echo $this->Html->link($this->NepaliCalendar->getNepaliMonthName($prevMonth), "index/$prevYear/$prevMonth/$eleName"); ?>&nbsp;</th>
		<th colspan="3" style="font-size: 130%;"><?php echo $year?>&nbsp; <?php echo $month;?></th>
		<th colspan="2" align="right"><?php echo $this->Html->link($this->NepaliCalendar->getNepaliMonthName($nextMonth), "index/$nextYear/$nextMonth/$eleName"); ?>&nbsp;</th>
	</tr>
</thead>
	<tr>
		<th class="blue">आइत</th>
		<th class="blue">सोम</th>
		<th class="blue">मंगल</th>
		<th class="blue">बुध</th>
		<th class="blue">बिही</th>
		<th class="blue">शुक्र</th>
		<th class="red">शनि</th>
	</tr>

<?php foreach($calendar as $row => $col) :?>
	<tr>
	<?php $i = 0;?>
	<?php foreach($col as $key => $val) :?>
		<?php 
			if ( $i == 6 ) {
				$class = 'red';
			} else {
				$class = 'blue';
			}
		?>
		<td class="<?php echo $class; ?>">
			<?php if ($val['nepali_date'] != '') { ?>
					<?php $englishDate = $val['english_date']; ?>
					<?php $nepaliDate  = $year . "-" .  $monthInNumber . "-" . $nepaliNumber->toggleNumberLang(sprintf("%02d", $val['nepali_date']), 'nepali'); ?>
					<a href="#" onclick="setDatetoParentWindow('<?php echo $englishDate; ?>', '<?php echo $nepaliDate; ?>', '<?php echo $eleName?>');" class="<?php echo $class;?>"><?php echo $nepaliNumber->precision($val['nepali_date'], 0);?></a>
			<?php } else { ?>
					&nbsp;
			<?php } ?>
			<?php $i++; ?>
		</td>
	<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
</body>
</html>