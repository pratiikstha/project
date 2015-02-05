<?php 
$titleBar = "गाउँ विकास समिति";
$pageHeader = "नेपाल सरकार<br>स्थानीय विकास मन्त्रालय<br>गाउँ विकास समितिको कार्यालय<br>________ गा.वि.स.,________";
$footerText = "सर्वाधिकार : गाउँ विकास समितिको कार्यालयमा सुरक्षित ।"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $titleBar; ?> | <?php echo $title_for_layout; ?></title>
<?php
echo $this->Html->meta('icon');
echo $this->Html->css(array('boxes','reset','menu','tablesorter'), null, array('media' =>'all'));
?>
<!--[if IE]>      <?php echo $this->Html->css('iestyles', null, array('media' => 'all'));  ?>  <![endif]-->
<!--[if lt IE 7]> <?php echo $this->Html->css('below_ie7', null, array('media' => 'all')); ?>  <![endif]-->
<!--[if IE 7]>    <?php echo $this->Html->css('ie7.css', null, array('media' => 'all'));   ?>  <![endif]-->
<?php echo $javascript->link(array('jquery-1.6.1.min.js','jquery.tablesorter.min.js')); ?>
</head>
<body id="html-body" >

<!-- TODO -->
<div class="wrapper">
	<p class="demo-notice">
			तपाईले <b><?php echo $this->Authake->getLogin(); ?></b> को रुपमा लगइन गर्नुभएको छ <span class="separator">|</span>
				<?php echo $nepaliCalendar->nepaliDate('Y/m/d', null, 'nepali');?><span class="separator">|</span>
				<?php echo $this->Html->link('लग आउट गर्नुहोस', '/logout'); ?></p>
	<div class="header">
		<div class="header-top">
			<?php echo $html->image('logo.png', array('class' => 'logo')); ?>
			<div class="header-right">
				<p class="super"><?php echo VDC_NAME ; ?></p>
			</div>
		<br /><br />
	</div>

	<div class="clear"></div>
	<?php echo $this->element('menu');?>
	<div id="content">
	<div class="msg" style="text-align:center">
				<?php echo $this->Session->flash(); ?>
			</div>
	<?php echo $content_for_layout; ?>
	</div>
	<div class="footer">
		<p class="legality">
			<?php echo getMessage(COPYRIGHT, array(HEADER_3)); ?>
		</p>
	</div>
<!-- ENDS -->
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
