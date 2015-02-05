<?php
$titleBar = "गाउँ विकास समिति";
				
function printAccountTree($html, $tree, $level = 0, $pageType = '') {
	$ulAttr = '';
	if ($level == 0) {
		$ulAttr = ' id="tt1" class="easyui-tree" animate="true" dnd="true"';
	}
	print "<ul$ulAttr>";
	foreach($tree as $k => $v) {
		if ($level != 0) {
			$onclick = "onclick='setParentValue(\"" . $pageType . "\", \"" . $v['account_name'] . "\", \"" . $k . "\");'";
		} else {
			$onclick = '';
		}
		$closeLi = '';
		if(count($v['childs']) == 0 && $level != 0) {
			print "<li><span>&nbsp;&nbsp;<a href='#' $onclick style='text-decoration:none'>"  . $v['account_name'] . "</a> &nbsp;&nbsp;";
			print $html->link($html->image('add.png'), "add/$k/$pageType", array('class' => 'addLink', 'escape' => false, 'title' => 'थप्ने')) ."&nbsp;";
			print $html->link($html->image('delete.png'), "delete/$k/$pageType", array('class' => 'deleteLink', 'escape' => false, 'title' => 'हटाउने')) ."&nbsp;";
			//print $html->link($html->image('view.png'), "getLedger/$k/$pageType", array('class' => 'tree_img', 'escape' => false, 'title' => 'हेर्नुहोस्')) . "</span>";
			print "</li>";
		} else {
			$state = '';
			if ($level >= 1 ) {
				$state = 'state="closed"';
			}
			print "<li $state><span>&nbsp;&nbsp;" . $v['account_name'] . "	" . $html->link($html->image('add.png'), "add/$k/$pageType", array('class' => 'addLink','escape' => false, 'title' => 'थप्ने')) . " </span>" ;;
		}

		if (!empty($v['childs'])) {
			printAccountTree($html, $v['childs'], $level+1, $pageType);
		}
	}
	print "</ul>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $titleBar; ?></title>
<?php echo $this->Html->meta('icon'); ?>
<?php echo $this->Html->css(array('reset','tree', 'icon', 'faram', 'style'), null, array('media' =>'all')); ?>
<?php echo $javascript->link(array('jquery-1.6.1.min.js', 'jquery.easyui.min.js','account.js','jquery.cookie','jquery.treeview')); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#collapseAll').click(function(event) {
			$('#tt1').tree('collapseAll');
		});

		$('#expandAll').click(function(event) {
			$('#tt1').tree('expandAll');
		});

		$("a.addLink").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'titlePosition'		: 'inside',
			'overlayColor'		: '#FFFFFF',
			'overlayOpacity'	: 0.4
		});
	})
</script>

</head>


<body style="margin:15px">

				
<?php if(!isset($pageType)) { ?>
<div class="vouchers index">
<?php } ?>
<a href="#" id="expandAll">सबै खोल्नुहोस्</a> | <a href="#" id="collapseAll">सबै बन्द गर्नुहोस्</a>
<br /><br />
<?php 
	if(isset($pageType) && $pageType != '') {
		printAccountTree($this->Html, $accountTree, 0, $pageType);
	} else {
		printAccountTree($this->Html, $accountTree, 0);
	}	
?>
<?php if(!isset($pageType)) { ?>
</div>
<?php } ?>
</body>
</html>