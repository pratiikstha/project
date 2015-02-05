<?php
	echo $javascript->link('account.js'); 
	echo $javascript->link('jquery.cookie'); 
	echo $javascript->link('jquery.treeview'); 
?>
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

		$("a.fancyboxLink").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'titlePosition'		: 'inside',
			'overlayColor'		: '#FFFFFF',
			'overlayOpacity'	: 0.4
		});
	})
</script>


<div class="box colorBlue">
	<h3><?php __(ACCOUNT); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<?php
				
				function printAccountTree($html, $tree, $level = 0, $pageType = '') {
					$ulAttr = '';
					if ($level == 0) {
						$ulAttr = ' id="tt1" class="easyui-tree" animate="true" dnd="true"';
					}
					print "<ul$ulAttr>";
					foreach($tree as $k => $v) {
						$closeLi = '';
						if(count($v['childs']) == 0 && $level != 0) {
							print "<li><span>&nbsp;&nbsp;"  . $v['account_name'] . "&nbsp;&nbsp;";
							print $html->link($html->image('add.png'), "add/$k/$pageType", array('class' => 'fancyboxLink', 'escape' => false)) ." &nbsp;&nbsp;";
							print $html->link($html->image('delete.png'), "delete/$k/$pageType", array('class' => 'fancyboxLink', 'escape' => false)) ." &nbsp;&nbsp;";
							print $html->link($html->image('view.png'), "getLedger/$k/book", array('class' => 'fancyboxLink', 'escape' => false)) . " &nbsp;&nbsp;";
							print $html->link($html->image('printer.png'), "getLedger/$k/book", array('target' => '_blank', 'escape' => false)) . "</span>";
							print "</li>";
						} else {
							$state = '';
							if ($level >= 1 ) {
								$state = 'state="closed"';
							}
							print "<li $state><span>&nbsp;&nbsp;" . $v['account_name'] . " " . $html->link($html->image('add.png'), "add/$k/$pageType", array('class' => 'fancyboxLink','escape' => false, 'title' => 'थप्ने')) . " </span>" ;;
						}
				
						if (!empty($v['childs'])) {
							printAccountTree($html, $v['childs'], $level+1, $pageType);
						}
						
					}
					print "</ul>";
				}?>
				
				<?php if(!isset($pageType)) { ?>
				<div class="vouchers index">
				<?php } ?>
				<br />
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
	</div><!-- end contentList -->
</div><!-- end boxContent -->


