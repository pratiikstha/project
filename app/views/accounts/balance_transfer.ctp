<?php echo $javascript->link('account');?>

<div class="box colorBlue">
	<h3><?php __("गत वर्षको अगाडि ल्याएको रकम");?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<?php echo $this->Form->create('Account', array('action' => 'balanceTranser', 'class'=> 'faram'));?>

		<table cellpadding="0" cellspacing="0">
			<tr>
				<th><?php echo ACCOUNT; ?></th>
				<th><?php echo OPENING_BALENCE; ?></th>
			</tr>
			<tr>
				<th colspan="2"><?php echo CASH; ?></th>
			</tr>
			<?php foreach ($cash as $id => $name) {?>
			<tr>
				<td><?php echo $name; ?></td>
				<td>
				<?php
					$options = array();
					$options['label'] = false;
					if(isset($balances[$id]['closing_balance'])) {
						$options['value'] = $nepaliNumber->toggleNumberLang($balances[$id]['closing_balance'], 'nepali');
						echo $this->Form->hidden('opening_balance_' . $id, $options);
						echo $this->Form->hidden('balance_id_' . $id, array('value' => ($balances[$id]['balance_id'])));
						echo $options['value'];
					} else {
						echo $this->Form->input('opening_balance_' . $id, $options);
					}
				?>
				</td>
			</tr>
			
				<?php } ?>
			
			<tr>
				<th colspan="2"><?php echo BANK . ' ' . ACCOUNT.MANY; ?></th>
			</tr>
			<?php foreach ($banks as $id => $name) {?>
			<tr>
				<td><?php echo $name; ?></td>
				<td>
				<?php
					$options = array();
					$options['label'] = false;
					if(isset($balances[$id]['closing_balance'])) {
						$options['value'] = $nepaliNumber->toggleNumberLang($balances[$id]['closing_balance'], 'nepali');
						echo $this->Form->hidden('opening_balance_' . $id, $options);
						echo $this->Form->hidden('balance_id_' . $id, array('value' => ($balances[$id]['balance_id'])));
						echo $options['value'];
					} else {
						echo $this->Form->input('opening_balance_' . $id, $options);
					}
				?>
				</td>
			</tr>
			
			<?php } ?>
			
			<tr>
				<th colspan="2"><?php echo ADVANCE . ' ' . ACCOUNT.MANY; ?></th>
			</tr>
			<?php foreach ($advances as $id => $name) {?>
			<tr>
				<td><?php echo $name; ?></td>
				<td>
				<?php
					$options = array();
					$options['label'] = false;
					if(isset($balances[$id]['closing_balance'])) {
						$options['value'] = $nepaliNumber->toggleNumberLang($balances[$id]['closing_balance'], 'nepali');
						echo $this->Form->hidden('opening_balance_' . $id, $options);
						echo $this->Form->hidden('balance_id_' . $id, array('value' => ($balances[$id]['balance_id'])));
						echo $options['value'];
					} else {
						echo $this->Form->input('opening_balance_' . $id, $options);
					}
				?>
				</td>
			</tr>
			
			<?php } ?>
			<tr>
				<td colspan="3"><?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?></td>
			</tr>
		</table>
		<?php echo $this->Form->end(); ?>
	</div><!-- end contentList -->
</div><!-- end boxContent -->

