<?php 
$titleBar = "गाउँ विकास समिति";
//$pageHeader = "नेपाल सरकार<br>स्थानीय विकास मन्त्रालय<br>गाउँ विकास समितिको कार्यालय<br>________ गा.वि.स.,________";
//$footerText = "सर्वाधिकार : गाउँ विकास समितिको कार्यालयमा सुरक्षित ।"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $titleBar; ?> | <?php echo $title_for_layout; ?></title>
<?php echo $this->Html->meta('icon'); ?>
<?php echo $this->Html->css(array('reset','fancybox/jquery.fancybox-1.3.4','tree', 'pagination', 'icon', 'faram', 'style', 'tabs'), null, array('media' =>'all')); ?>
<?php echo $javascript->link(array('jquery-1.6.1.min.js', 'jquery.easyui.min.js', 'fancybox/jquery.fancybox-1.3.4.pack.js')); ?>
</head>


<body>
	<div class="mainwrapper boxShadow clearfix">
		<div class="header">
    		<div class="logo fleft">
        		<?php echo $html->image('logo.gif', array('height' => '90', 'width' => '100', 'alt' => HEADER_1)); ?>
        	</div><!--end logo-->
        
        	<div class="companyName fleft">
        		<?php echo $html->image('company_name.gif', array('height' => '73', 'width' => '274', 'alt' => HEADER_3)); ?>
        	</div><!-- end company_name-->

        	<div class="adminSection fright">
	        	<h6><?php echo $this->Authake->getSsnNo(); ?>  |  <?php echo $this->Html->link('लग आउट गर्नुहोस', '/logout'); ?></h6>
    	        <h6><?php echo $nepaliCalendar->nepaliDate('Y/m/d', null, 'nepali');?></h6>
        	    <h6><?php echo VDC_NAME ; ?></h6>
        	</div><!--end admin section-->
    	</div><!-- end header-->
    	
    	<div class="menuNav clrboth colorBlue">
			<?php echo $this->element('menu')?>
    	</div><!-- end menuNav-->

    <div class="msg" style="text-align:center">
    	<?php echo $this->Session->flash(); ?>
	</div>
	<?php echo $content_for_layout; ?>
	
	<div class="footer clrboth">
		<?php echo getMessage(COPYRIGHT, array(HEADER_3)); ?>
	</div>
	
	</div><!-- end mainwrapper -->
	<div style="font-size:12px; line-height:150%">
	<?php echo $this->element('sql_dump'); ?>
	</div>
</body>
</html>