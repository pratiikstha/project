<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __(DAY_BOOK); ?></h3></td>
					<td class="a-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table width="100%">
		<tr>
			<td width="20%">
				<?php echo $this->element('revenue_left_menu')?>
			</td>
			<td>
				<div class="incomeSources form">
				<?php echo $this->Form->create('DayBook');?>
				<?php echo $this->Form->input('day_book_id');?>
				<table class="form-list" cellspacing="0">
					<tr>
						<td class="label"><?php __(SSN_NO)?></td>
						<td class="value"><?php echo $this->Form->input('ssn_no', array('label' => false)); ?></td> 
					</tr>
					<tr>
						<td class="label"><?php __(INCOME_SOURCE_NAME)?></td>
						<td class="value"><?php echo $this->Form->input('income_source_id',  array('label' => false)); ?></td> 
					</tr>
					<tr>
						<td class="label"><?php __(TRANSACTION_DATE)?></td>
						<td class="value">
							<?php echo $this->Form->hidden('transaction_date', array('id' => 'transaction_date'));?>
							<?php echo $this->Form->text('transaction_date_display', array('id'=>'transaction_date_display', 'label' => false, 'class' => 'input-text', 'readonly' => 'readonly')); ?>
							<?php $year = $this->NepaliCalendar->nepaliDate('Y'); ?>
							<?php $month = $this->NepaliCalendar->nepaliDate('m'); ?>
							<a href="javascript: void(0)" onclick="window.open('../../date_pickers/index/<?php echo $year?>/<?php echo $month?>/transaction_date','windowname2','width=250, height=210, directories=no, location=no, menubar=no, resizable=no, scrollbars=1,status=no,toolbar=no');">DatePicker</a>
						</td> 
					</tr>
					<tr>
						<td class="label"><?php __(TRANSACTION_AMOUNT)?></td>
						<td class="value"><?php echo $this->Form->input('transaction_amount', array('id'=>'transaction_amount', 'label' => false, 'class' => 'input-text'));?></td> 
					</tr>
					<tr>
					<td colspan="2"><?php echo $this->Form->button('<span>'.SAVE.'</span>', array('id' => 'add_day_book' , 'type' => 'submit', 'class' => 'scalable save', 'label' => 'Submit')); ?></td>
					</tr>
				</table>
				<?php echo $this->Form->end();?>
				</div>
			</td>
		</tr>
	</table>
</div>