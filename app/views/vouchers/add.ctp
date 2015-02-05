<?php echo $javascript->link('account');?>
<script language="javascript">
	$(document).ready(function() {
		$("a.openLink").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'titlePosition'		: 'inside',
			'overlayColor'		: '#FFFFFF',
			'overlayOpacity'	: 0.4
		});
});
</script>

<div class="box colorBlue">
	<h3><?php __(ADD . ' ' . VOUCHER); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
	<?php 
			$voucherName = VOUCHER;
			?>
		<h2><?php echo $voucherName; ?></h2>
		<?php echo $this->Form->create('Voucher', array('controller' => 'voucher', 'action' => 'add', 'class'=> 'faram'));?>
		<?php 
			//$voucherName = VOUCHER;
			if ($voucherTypeId == '' ) {
				//echo $this->Form->input('voucher_type_id',  array('label' => VOUCHER. ' ' .  TYPE, 'value' => $voucherTypeId));
				$pathPre = "../"; 
			} else {
				echo $this->Form->hidden('voucher_type_id', array('value' => $voucherTypeId));
				$voucherName = $voucherTypes[$voucherTypeId];
				if(isset($error)) {
					$pathPre = "../";
				} else {
					$pathPre = "../../";
				}
			} 
		?>
		<?php echo $this->Form->hidden('trans_count', array('value' => $transactionCount)); ?>
		<?php
			if (isset($advance_clear) && $advance_clear != '') {
				echo $this->Form->hidden('clearance_voucher_id', array('value' => $advance_clear));
			}
		?>
		<?php echo $this->Form->hidden('path_pre', array('value' => $pathPre)); ?>
		
		<table id="TransactionsTable">
			<tr>
				<th class="right" colspan="2">भौचर नं</th>
				 
				<td>
					<?php echo $this->Form->text('voucher_number', array('size' => '14')); ?>
                	<span class="form_hint">भौचर नं</span>
				</td>
			</tr>
			 <tr>
				<th class="right" colspan="2">कारोबार मिति</th>
                <td>
                	<?php 
                		$todayNepali = $nepaliCalendar->nepaliDate('Y/m/d', null, 'nepali');
                		$todayEnglish = date('Y-m-d'); 
                		
                	?>
                	
               		<?php //echo $this->Form->hidden('created_date', array('value' => $todayEnglish)); ?>
                	<?php //echo $this->Form->text('created_date_nep', array('value' => $todayNepali, 'size' => '13', 'readonly' => 'readonly', 'required' => 'required'));	?>
                	<?php 
						echo $form->select('created_date.Y', $years, array('selected' => $selectedYear));
						echo " / ";
						echo $form->select('created_date.m', $months, array('selected' => $selectedMonth));
						echo " / ";
						echo $form->select('created_date.d', $days, array('selected' => $selectedDay));
                	?>
                   <!--  <span class="colorBlue" id="selectDate" onclick="alert('call jquery');">मिति</span> -->
					<span class="form_hint">भौचर मिति</span>
            	</td>
			</tr>
			<?php if ($voucherTypeId == 2 ) {?>
			<tr id="AdvanceVoucher">
				<th colspan="3" class="left">पेश्की दिईएको खर्च</th>
			</tr>
			<tr>
				<td colspan="3">
					<?php echo $this->Form->text('trans_account_a', array('onkeyup' => 'keyupAction("A")', 'value' => $defaults['adv']['trans_account_a'], 'placeholder' => 'advance account','size' => '45')); ?>
					<span class="colorBlue" onclick="var child=window.open(' <?php echo $pathPre . "accounts/printTree/A'" ?>, 'Select', 'height=700, width=600, scrollbars=yes');">....</span>
						<?php  echo $this->Form->hidden('trans_account_id_a', array('value' => $defaults['adv']['trans_account_id_a']));
					?>
					<br />
					<div id="accountListA" class="accountList"></div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="3">&nbsp;</td>
            </tr>
            <tr>
            	<th class="w60"><?php echo ACCOUNT; ?></th>
                <th class="w20"><?php echo DEBIT; ?>/<?php echo CREDIT; ?></th>
                <th class="w20"><?php echo AMOUNT;?></th>
			</tr>
			<?php for ($i = 1; $i <= $transactionCount; $i++){ ?>
			<tr id="TransactionRow<?php echo $i;?>">
				<td>
					<?php echo $this->Form->text('trans_account_' . $i, array('onkeyup' => 'keyupAction(' . $i . ')', 'value' => $defaults[$i]['trans_account'], 'required' => 'required', 'placeholder' => 'खाता छान्नुहोस् ।', 'size' => '45', 'nicetext' => 'what is this')); ?>
					<span class="form_hint">खाता छान्नुहोस् ।</span>
					<span class="colorBlue" onclick="var child=window.open(' <?php echo $pathPre . "accounts/printTree/" . $i . "'"; ?>, 'Select', 'height=700, width=600, scrollbars=yes');">....</span>
					<?php echo $this->Form->hidden('trans_account_id_' . $i, array('value' => $defaults[$i]['trans_account_id'])); ?>
					<br />
					<div id="accountList<?php echo $i?>" class="accountList"></div>
				</td>
				<td class="center">
					<?php 
						$options = array('Dr' => DEBIT, 'Cr' => CREDIT);
						$attr = array('legend' => false);
						if($defaults[$i]['trans_drcr'] != '') {
							$attr['value'] = $defaults[$i]['trans_drcr'];
						}
						echo $this->Form->radio('trans_drcr_' . $i, $options, $attr); 
					?>
				</td>
				<td class="center">
					<?php echo $this->Form->text('trans_amount_'. $i, array('class' => 'amount', 'value' => $defaults[$i]['trans_amount'], 'required' => 'required', 'placeholder' => 'रकम', 'size' => '10'))?>
					<span class="form_hint">रकम</span>
				</td>
			</tr>
			<?php } ?>
			</table>
			<table>
			<tr>
				<td colspan="3">
					<div id="addRemoveLink">
	                	<span class="colorBlue" id="addTransaction">[+] <?php echo ADD . ' ' . ACCOUNT;?></span>
                    </div>
				</td>
			</tr>
			<tr>
				<th colspan="3" class="left"><?php __(DESCRIPTION);?></th>
			</tr>
			<tr>
				<td colspan="3">
					<?php 
						if(isset($clear)) {
							$desc = $defaults[2]['trans_account'] . " को " .  $defaults[1]['trans_account'] . " वापतको पेश्की फर्छ्यौट गरियो । ";
						} else {
							if(isset($narration)) {
								$desc = $narration;
							} else {
								$desc = '';
							}
						}
					?>
					<?php echo $this->Form->input('narration', array('class'=>'textarea','label' => false, 'value' => $desc , 'cols' => '80'));?>
				</td>
			</tr>
			<tr>
				<th colspan="3" class="left">
                	<?php __(CHEQUE_NO);?>
                	</th>
              </tr>
              <tr>
              	<td colspan="3"><?php echo $this->Form->text('cheque_no', array('class' => 'size150px','label' => false, 'placeholder' => 'चेक नं'));?>
                	<span class="form_hint"> चेक नं </span>
 				</td>
			</tr>
			<tr>
				<td colspan="3"><?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?></td>
			</tr>
		</table>
		<?php echo $this->Form->end(); ?>
	</div><!-- end contentList -->
</div><!-- end boxContent -->