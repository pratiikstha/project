<script type="text/javascript">
	$(document).ready(function() {
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
		<br />
		<div class="list_table_container">
			<div id="main_head">पेश्की खाता सूची</div>
	        <div class="list_table">
	        	<table border="0" width="550"cellspacing="0" cellpadding="0">
					<tr id="row">
						<th><?php echo ACCOUNT . ' ' .  NAME;?></th>
						<th><?php echo BALANCE; ?></th>
						<th><?php __(ACTIONS);?></th>
					</tr>
					<?php foreach ($accounts as $account): ?>
					<tr>
						<td><?php echo $account['Account']['account_name']; ?>&nbsp;</td>
						<td class="right"><?php echo $this->NepaliNumber->currency($account["Account"]["current_balance"], true); ?></td>
						<td class="center">
							<?php echo $this->Html->link($html->image('view.png'), array('action' => 'viewAdvanceDetail', $account['Account']['account_id'], $year, $month), array('class' =>'fancyboxLink', 'escape' => false)); ?>
							&nbsp;
							<?php echo $this->Html->link($html->image('printer.png'), array('action' => 'viewAdvanceDetail', $account['Account']['account_id'], $year, $month), array('target' => '_blank', 'escape' => false)); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div><!-- end contentList -->
</div><!-- end boxContent -->