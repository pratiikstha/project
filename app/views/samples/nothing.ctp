<table>
<tr><td>FORMAT: YYYY/MM/DD</td><td><?php echo $nepaliCalendar->convertToNepaliDate('1985-07-20'); ?> [English to Nepali Date Conversion]</td></tr>
<tr><td>FORMAT: MM/DD</td><td><?php echo $nepaliCalendar->convertToNepaliDate('1985-07-20', 'm/d'); ?> [English to Nepali Date Conversion]</td></tr>
<tr><td>FORMAT: MM/DD</td><td><?php echo $nepaliCalendar->convertToEnglishDate('2042-04-05'); ?> [Nepali to English Date Conversion]</td></tr>
<tr><td>PRECISION (2)</td><td><?php echo $nepaliNumber->precision('123123213', 0); ?></td></tr>
<tr><td>PRECISION (0)</td><td><?php echo $nepaliNumber->precision('10000.25379', 2); ?></td></tr>
<tr><td>CURRENCY (2)</td><td><?php echo $nepaliNumber->currency('1234567890', 2); ?></td></tr>
<tr><td>CURRENCY (0)</td><td><?php echo $nepaliNumber->currency('1234567890', 0); ?></td></tr>
<tr><td>ENG TO NEP</td><td><?php echo $nepaliNumber->toggleNumberLang('1234567890', 'nepali'); ?></td></tr>
<tr><td>NEP TO ENG</td><td><?php echo $nepaliNumber->toggleNumberLang('१२३४५६७८९०', 'english'); ?></td></tr>
<tr><td>NEP TO NEP</td><td><?php echo $nepaliNumber->toggleNumberLang('१२३४५६७८९०', 'nepali'); ?></td></tr>
<tr><td>ENG TO ENG</td><td><?php echo $nepaliNumber->toggleNumberLang('1234567890', 'english'); ?></td></tr>

</table>
<table>
	<tr>
		<th colspan='2'>FirstDay</th>
		<th colspan='2'>LastDay</th>
	</tr>
	<tr>
	<tr>
		<th>NepaliDate</th>
		<th>EnglishDate</th>
		<th>NepaliDate</th>
		<th>EnglishDate</th>
	</tr>
	<?php for ($i = 1; $i <= 12; $i++) { ?>
	<?php $month = sprintf('%02d', $i); ?>
	<tr>
		<td align='center'><?php echo $nepaliCalendar->convertToNepaliDate($nepaliCalendar->getFirstDayOfNepaliMonthInEnglish('2068', $month)) ;?></td>
		<td align='center'><?php echo $nepaliCalendar->getFirstDayOfNepaliMonthInEnglish('2068', $month) ;?></td>
		<td align='center'><?php echo $nepaliCalendar->convertToNepaliDate($nepaliCalendar->getLastDayOfNepaliMonthInEnglish('2068', $month)) ;?></td>
		<td align='center'><?php echo $nepaliCalendar->getLastDayOfNepaliMonthInEnglish('2068', $month) ;?></td>
	</tr>
	<?php }?>
</table>
