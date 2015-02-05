<BR><BR>
<BR><BR>
<?php 
		echo "\$nepaliCalendar->getPreviousYearMonth(); =>";
		print_r($nepaliCalendar->getPreviousYearMonth());
		print "<br><br><HR><br><br>";
		echo "\$nepaliCalendar->getPreviousYearMonth(2067, 10); =>";
		print_r($nepaliCalendar->getPreviousYearMonth(2067, 10));
		print "<br><br><HR><br><br>";
		echo "\$nepaliCalendar->getPreviousYearMonth(2068, 1); =>";
		print_r($nepaliCalendar->getPreviousYearMonth(2068, 1));
		print "<br><br><HR><br><br>";
		echo "\$nepaliCalendar->getNextYearMonth(); =>";
		print_r($nepaliCalendar->getNextYearMonth());
		print "<br><br><HR><br><br>";
		echo "\$nepaliCalendar->getNextYearMonth(2067, 10); =>";
		print_r($nepaliCalendar->getNextYearMonth(2067, 10));
		print "<br><br><HR><br><br>";
		echo "\$nepaliCalendar->getNextYearMonth(2067, 12); =>";
		print_r($nepaliCalendar->getNextYearMonth(2068, 1));
		print "<br><br><HR>";
?> 