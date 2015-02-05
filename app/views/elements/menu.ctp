<?php
	$home = '';
	$accounts = '';
	$citizens = '';
	$admin = '';

	if ($this->params['controller'] == 'pages') {
		$home = 'current';
	} else if ($this->params['controller'] == 'accounts') {
		$accounts = 'current';
	} else if ($this->params['controller'] == 'citizens') {
		$citizens = 'current';
	} else if ($this->params['plugin'] == 'authake') {
		$admin = 'current';
	}
?> 

<ul>
	<li><?php echo $this->Html->link(HOME_PAGE, '/', array('class' => $home))?></li>
	<li><?php echo $this->Html->link(ACCOUNTS_MENU, '/accounts' ,array('class' => $accounts))?></li>
	<li><?php echo $this->Html->link(CITIZEN, '/citizens', array('class' => $citizens))?></li>
	<li><?php //echo $this->Html->link("प्रशासनिक", '/authake', array('class' => $admin))?></li>
</ul>
