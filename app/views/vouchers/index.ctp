<script language="javascript">
	$(document).ready(function() {
		$("a.view").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'titlePosition'		: 'inside',
			'overlayColor'		: '#FFFFFF',
			'overlayOpacity'	: 0.4
		});
	});
</script>

<div class="box colorBlue">
	<h3><?php __(VOUCHER); ?></h3>
</div><!--end box-->


<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->
	
	<div class="rightContentList">
	<br />
		<!-- <h2><?php //__(SEARCH); ?></h2> -->	
		<?php echo $form->create('VoucherSearch', array('url'=>'index', 'type'=>'post', 'class' => 'faram')); ?>
		<table>
		<tr>
			<th class="left">कारोबार मिति</th>
			<td><?php
					//echo $selectedYear  . $selectedMonth . $selectedDay . "<BR>";
					echo $form->select('created_date.Y', $years, array('selected' => $selectedYear));
					echo " / ";
					echo $form->select('created_date.m', $months, array('selected' => $selectedMonth));
					echo " / ";
					echo $form->select('created_date.d', $days, array('selected' => $selectedDay));
				?>
			</td>
		</tr>
		<tr>
			<th class="left"><?php __(DESCRIPTION); ?></th>
			<td><?php echo $form->text('narration'); ?></td>
		</tr>
		<tr>
			<th class="left"><?php __(VOUCHER . ' ' .TYPE); ?></th>
			<td><?php echo $form->select('voucher_type_id', $voucherTypes); ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $form->button( SEARCH, array('class' => 'submit', 'div' => false)); ?></td>
		</tr>
	</table>
	<?php echo $form->end(); ?>
	<div class="list_table_container">
		<div id="main_head">भौचर सूची</div>
        <div class="list_table">
        	<table border="0" width="675"cellspacing="0" cellpadding="0">
				<tr id="row">
				    <th><?php __(VOUCHER . ' ' . TYPE)?> </th>
					<th><?php echo $this->Paginator->sort(DESCRIPTION, 'narration');?></th>
					<th><?php __(ACTIONS);?></th>
				</tr>
			<?php
				$i = 0;
				foreach ($vouchers as $voucher):
					$class = null;
					if ($i++ % 2 != 0) {
						$class = ' class="altrow"';
					}
					$voucherType = $voucher['Voucher']['voucher_type_id'];
				?>
				<tr<?php echo $class;?>>
					<td width="20%"><?php __($voucher['VoucherType']['voucher_type_name']); ?></td>
					<td><?php
					$narration = explode('~', $voucher['Voucher']['narration']);
					if(count($narration) == 2) {
						$voucher['Voucher']['narration'] = $narration[0] . " (" . $narration[1] . ")";
					}
					echo $this->Html->link(__($voucher['Voucher']['narration']), array('action' => 'view', $voucher['Voucher']['voucher_id'])); 
					
					?></td>
					<td width="13%" class="center">
						<?php //echo $this->Html->link(__(VIEW, true), array(), array('class' => 'view', 'href' => ));  ?>
					<?php print $html->link($html->image('view.png'), array('action' => 'view' , $voucher['Voucher']['voucher_id']), array('class' => 'view', 'escape' => false)); ?>
					<?php print $html->link($html->image('printer.png'), array('action' => 'view' , $voucher['Voucher']['voucher_id'],'print'), array('escape' => false, 'title' => 'प्रिन्ट', 'target' => '_blank')); ?>	
					<?php if($voucherType == 2) {
							if(isset($voucher['Voucher']['advance_expense_account']) && $voucher['Voucher']['advance_expense_account'] != '') {
								echo $this->Html->link($html->image('undo.png'), array('action' => 'clearAdvance', $voucher['Voucher']['voucher_id']), array('escape'=>false,'title' => 'फर्छ्यौट'));
							} else { ?>
							<!-- <span style="color:#CCC">फर्छ्यौट</span> -->
						<?php	} 
							//if(!isset($voucher['Voucher']['reverse_voucher_id'])) {
								//echo $this->Html->link(__("फर्छ्यौट भौचर", true), array('action' => 'view', $voucher['Voucher']['reverse_voucher_id']), array('target' => '_blank'));
							//}
							
						} else { ?>
							<!-- <span style="color:#CCC">फर्छ्यौट</span> -->
						<?php } ?>
						<?php //echo $html->link($html>image('print.png'), array( 'onclick' => "var child=window.open('vouchers/viewPdf/" . $voucher['Voucher']['voucher_id'] . "', 'Select', 'height=800, width=750, scrollbars=yes');", 'target' => '_blank'), array('escape' => false, 'title' => 'प्रिन्ट गर्नुहोस्'));?>
						
					</td>
				</tr>
			<?php endforeach; ?>
  		</table>
	</div>
	<div class="datagrid-pager pagination">
		<table cellspacing="0" cellpadding="0" border="0">
	    	<tr>
	        	<td><?php echo $this->Paginator->numbers(); ?></td>
	        </tr>	
		</table>
	</div>
    </div>
	</div><!-- end contentList -->
</div><!-- end boxContent -->