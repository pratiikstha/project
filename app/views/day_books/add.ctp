<?php echo $javascript->link('citizeninfo', true);?>
<?php echo $javascript->link('daybook', true);?>

<div class="box colorBlue">
	<h3><?php __(ADD . ' ' . DAY_BOOK); ?></h3>
</div><!--end box-->


<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('revenue_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<h2><?php __(ADD . ' रसिद'); ?></h2>
		<?php echo $this->Form->create('DayBook', array('class'=> 'faram'));?>
		
		<table id="DayBook" >
			<tr>
				<th class="left w20">रसिद नं</th>
				<td><?php echo $this->Form->text('receipt_number', array('id'=>'receipt_number', 'label' => false, 'class' => 'input-text', 'placeholder' => 'रसिद नं', 'required' => 'required'));?></td> 
					</tr>
			<tr>
				<th class="left w20"><?php __(SSN_NO); ?></th>
				<td>
					<?php 
						$options['onkeyup'] = 'keyupAction(\'DayBook\', \'PersonName\')';
						if(isset($defaults['ssn_no'])) {
							$options['value'] = $defaults['ssn_no'];
						}
						$options['placeholder'] = '';
						$options['size'] = '45';
						$options['required'] = 'required';
						$options['label'] = 'नाम';
						$options['placeholder'] = SSN_NO;
						echo $this->Form->text('person_name', $options); ?>
						<?php 
						if(isset($defaults['contact_person_id'])) {
							echo $this->Form->hidden('person_name_id', array('value' => $defaults['contact_person_id'])); 
						} else {
							echo $this->Form->hidden('person_name_id');
						}
						?>
						<br />
					<div id="PersonName_List" class="citizenList"></div>
				</td>
			</tr>
			<tr>
				<th class="left w20"><?php echo INCOME_SOURCE_NAME; ?></th>
				<td>
					<?php echo $this->Form->text('account_name', array('onkeyup' => 'getAccounts()', 'value' => '', 'required' => 'required', 'placeholder' => 'खाता छान्नुहोस् ।', 'size' => '45', 'nicetext' => 'what is this')); ?>
					<span class="form_hint">खाता छान्नुहोस् ।</span>
					<!-- <span class="colorBlue" onclick="var child=window.open(' <?php echo "../accounts/printTree/1"; ?>', 'Select', 'height=700, width=600, scrollbars=yes');">....</span>  -->
					<?php echo $this->Form->hidden('account_id', array('value' => '')); ?>
					<br />
					<div id="accountList" class="accountList"></div>
				</td>
			</tr>
			<tr>
				<th class="left w20"><?php __(TRANSACTION_DATE)?></th>
				<td>
					<?php echo $this->Form->hidden('transaction_date', array('id' => 'transaction_date'));?>
					<?php echo $this->Form->text('transaction_date_display', array('id'=>'transaction_date_display', 'label' => false, 'class' => 'input-text', 'readonly' => 'readonly', 'placeholder' => TRANSACTION_DATE, 'required' => 'required')); ?>
					<?php $year = $this->NepaliCalendar->nepaliDate('Y'); ?>
					<?php $month = $this->NepaliCalendar->nepaliDate('m'); ?>
					<a href="javascript: void(0)" onclick="window.open('../date_pickers/index/<?php echo $year?>/<?php echo $month?>/transaction_date','windowname2','width=300, height=210, directories=no, location=no, menubar=no, resizable=no, scrollbars=1,status=no,toolbar=no');">DatePicker</a>
				</td>
			</tr>
			<tr>
				<th class="left w20"><?php __(TRANSACTION_AMOUNT)?></th>
				<td><?php echo $this->Form->text('transaction_amount', array('id'=>'transaction_amount', 'label' => false, 'class' => 'input-text', 'placeholder' => TRANSACTION_AMOUNT, 'required' => 'required'));?></td> 
			</tr>
			<tr>
				<th class="left w20"><?php __(FINE . ' ' . AMOUNT)?></th>
				<td><?php echo $this->Form->text('fine_amount', array('id'=>'fine_amount', 'label' => false, 'class' => 'input-text', 'placeholder' => FINE . ' ' . AMOUNT));?></td> 
			</tr>
			<tr>
				<th class="left w20"><?php __(DISCOUNT . ' ' . AMOUNT )?></th>
				<td><?php echo $this->Form->text('discount_amount', array('id'=>'discount_amount', 'label' => false, 'class' => 'input-text' , 'placeholder' => DISCOUNT . ' ' . AMOUNT));?></td> 
			</tr>
			
		</table>

		<?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?>
		<?php echo $this->Form->end(); ?>
	</div><!-- end contentList -->
</div><!-- end boxContent -->