<?php echo $javascript->link('account');?>

<div class="box colorBlue">
	<h3><?php __("व्यक्तिगत खाताहरु"); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<div class="list_table_container">
		<div id="main_head">
			व्यक्तिहरु
			<span class="fright">
			<?php //print $html->link($html->image('printer.png'), array('action' => 'index', $selectedYear, $selectedMonth, $selectedDay, 'book'), array('escape' => false, 'target' => '_blank')) ; ?>&nbsp;&nbsp;
			</span>
		</div>
        <div class="list_table">
        	<table border="0" width="675"cellspacing="0" cellpadding="0">
				<tr id="row">
					<th>&nbsp;</th>
					<th>नाम</th>
					<th style="width:150px">पद</th>
					<th>&nbsp;</th>
				</tr>
				<?php
					$i = 0;
					foreach ($personalAccounts as $personalAccount):
					$accountType = $personalAccount['PersonalAccount']['type'];
					if( $accountType == 2 || $accountType == 3 || $accountType == 5) {
						continue;
					}
				?>
				<tr>
					<td><?php echo $accountTypeArray[$personalAccount['PersonalAccount']['type']]; ?>&nbsp;</td>
					<td><?php 
					echo $personalAccount['Person']['first_name'] . ' ' . $personalAccount['Person']['last_name'];  
					?>&nbsp;</td>
					<td><?php echo $personalAccount['PersonalAccount']['designation']; ?>&nbsp;</td>
					<td class="actions">
						<?php 
							if($this->AppFunction->checkAdminOrSelf($personalAccount['PersonalAccount']['ssn_no'])) {
								echo $this->Html->link(__("प्रयोगकर्ता", true), array('action' => 'addUsername', $personalAccount['PersonalAccount']['personal_account_id']));
							} 
						?>
						<?php //echo $this->Html->link(__('View', true), array('action' => 'view', $personalAccount['PersonalAccount']['personal_account_id'])); ?>
						<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $personalAccount['PersonalAccount']['personal_account_id'])); ?>
						<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $personalAccount['PersonalAccount']['personal_account_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $personalAccount['PersonalAccount']['personal_account_id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<br><br>
		<div id="main_head">
			संस्थाहरु
			<span class="fright">
			<?php //print $html->link($html->image('printer.png'), array('action' => 'index', $selectedYear, $selectedMonth, $selectedDay, 'book'), array('escape' => false, 'target' => '_blank')) ; ?>&nbsp;&nbsp;
			</span>
		</div>
        <div class="list_table">
        	<table border="0" width="675"cellspacing="0" cellpadding="0">
				<tr id="row">
					<th>&nbsp;</th>
					<th>नाम</th>
					<th style="width:150px">आधिकारिक व्यक्ति</th>
					<th style="width:150px">दर्ता मिति</th>
					<th>&nbsp;</th>
				</tr>
				<?php
					$i = 0;
					foreach ($personalAccounts as $personalAccount):
					$accountType = $personalAccount['PersonalAccount']['type'];
					if( $accountType == 0 || $accountType == 1 || $accountType == 4) {
						continue;
					}
				?>
				
				<tr>
					<td><?php echo $accountTypeArray[$personalAccount['PersonalAccount']['type']]; ?>&nbsp;</td>
					<td><?php echo $personalAccount['PersonalAccount']['name']; ?>&nbsp;</td>
					<td><?php 
					echo $personalAccount['ContactPerson']['first_name'] . ' ' . $personalAccount['ContactPerson']['last_name']; 
					?>&nbsp;</td>
					<td><?php echo $personalAccount['PersonalAccount']['registered_date']; ?>&nbsp;</td>
					<td class="actions">
						<?php //echo $this->Html->link(__('View', true), array('action' => 'view', $personalAccount['PersonalAccount']['personal_account_id'])); ?>
						<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $personalAccount['PersonalAccount']['personal_account_id'])); ?>
						<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $personalAccount['PersonalAccount']['personal_account_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $personalAccount['PersonalAccount']['personal_account_id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			</div>
		</div>
		<?php echo $this->Html->link(__("नयाँ खाता", true), array('action' => 'add')) ?>
	</div><!-- end contentList -->
</div><!-- end boxContent -->
