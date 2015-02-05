<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __(ACCOUNT.MANY)?></h3></td>
					<td class="a-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table width="100%">
		<tr>
			<?php if(!isset($pageType)) { ?>
			<td width="20%">
				<?php echo $this->element('account_left_menu')?>
			</td>
			<?php } ?>
			<td>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<meta http-equiv="Cache-Control" content="no-cache">
					<?php echo $this->Html->charset('UTF-8'); ?>
					<title>
						Tree
					</title>
				
				<?php 	
					echo $javascript->link('jquery-1.6.1.min.js'); echo "\r\n";
					echo $javascript->link('account.js'); echo "\r\n";
					echo $javascript->link('jquery.cookie'); echo "\r\n";
					echo $javascript->link('jquery.treeview'); echo "\r\n";
					echo $javascript->link('fancybox/jquery.mousewheel-3.0.4.pack');echo "\r\n";
					echo $javascript->link('fancybox/jquery.fancybox-1.3.4.pack'); echo "\r\n";
					
					echo $this->Html->css('fancybox/jquery.fancybox-1.3.4.css');echo "\r\n";
					echo $this->Html->css('jquery.treeview.css');echo "\r\n";
				?>
				
				<script type="text/javascript">
					$(document).ready(function() {
						$("#tree").treeview({
							collapsed: true,
							animated: "fast",
							control:"#sidetreecontrol",
							prerendered: true,
							persist: "location"
						});
				
						$("a#example").fancybox({
								'titlePosition'		: 'outside',
								'overlayColor'		: '#000',
								'overlayOpacity'	: 0.9
							});
					})
				</script>
				</head>
				<body>
				
				<?php
				
				function printAccountTree($html, $tree, $level = 0, $pageType = '') {
					$ulAttr = '';
					$tab = "";
					
					for($i = 0; $i < $level; $i++) {
						$tab .= "\t";
					}
					if ($level == 0) {
						$ulAttr = ' class="filetree treeview-famfamfam" id="tree"';
					} else {
						$ulAttr = ' style="display: block;"';
					}
					print "$tab<ul$ulAttr>\r\n";
					foreach($tree as $k => $v) {
						$spanClass = 'file';
						$liStyle = '';
						$div ='</li>';
						$onclick = "onclick='setParentValue(\"" . $pageType . "\", \"" . $v['account_name'] . "\", \"" . $k . "\");'";
						$closeLi = '';
						if (!empty($v['childs']) || $level == 0) {
							$spanClass = 'folder';
							$liStyle = ' class="expandable"';
							$div = '<div class="hitarea expandable-hitarea"></div>';
							$closeLi = '';
							$onclick = '';
						} else {
							
						}
						//$addLink = sprintf("%s", );
						
						if(count($v['childs']) == 0) {
							print "$tab\t\t<li$liStyle>$div<span class='$spanClass pointer'><a href='#' $onclick class='addlinks'>" . $v['account_name'] . "</a> &nbsp;&nbsp;";
							print $html->link("थप्ने", "add/$k/$pageType", array('id' => 'example')) ." &nbsp;|&nbsp; ";
							print $html->link("हटाउने", "delete/$k/$pageType", array('id' => 'example')) ." &nbsp;|&nbsp; ";
							print $html->link("खाता हेर्ने", "getLedger/$k/$pageType", array('id' => 'example')) . "</span>  $closeLi \r\n";
						} else {
							print "$tab\t<li$liStyle>$div<span class='$spanClass pointer'><a href='#' $onclick class='addlinks'>" . $v['account_name'] . "</a> &nbsp;&nbsp;". $html->link("थप्ने", "add/$k/$pageType", array('id' => 'example')) ."</span>  $closeLi \r\n";
						}
				
						if (!empty($v['childs'])) {
							printAccountTree($html, $v['childs'], $level+1, $pageType);
						}
						
					}
					print "$tab</ul>\r\n";
				}?>
				
				<?php if(!isset($pageType)) { ?>
				<div class="vouchers index">
				<?php } ?>
				<div id="sidetree"> 
				<div class="treeheader">&nbsp;</div> 
				<div id="sidetreecontrol"> <a href="?#">Expand All</a> | <a href="?#">Collapse All</a> </div> 
				<?php 
					if(isset($pageType) && $pageType != '') {
						printAccountTree($this->Html, $accountTree, 0, $pageType);
					} else {
						printAccountTree($this->Html, $accountTree, 0);
					}	
				?>
				</div>
				<?php if(!isset($pageType)) { ?>
				</div>
				<?php } ?>
				</body>
				</html>
			</td>
		</tr>
	</table>
</div>


