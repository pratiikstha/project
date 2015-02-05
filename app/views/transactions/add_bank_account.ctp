<?php echo $javascript->link('account');?>

<div class="box colorBlue">
	<h3><?php __(ADD . ' ' . BANK . ' ' . ACCOUNT); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<?php echo $this->Form->create('Account', array('action' => 'addBankAccount', 'class' => 'faram'));?>
		<?php echo $form->hidden('level', array('value' => 2));?>
			<fieldset>
				<legend></legend>
			<div>
		<?php
			
			//echo $this->Form->label(ACCOUNT . ' ' . NAME);
				echo "खाताको नाम";
				echo "<br>";
				echo $this->Form->text('account_name', array('label' => 'Account Head'));
		
			?>
			</div>
			</fieldset>
		<?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?>
		<?php echo $this->Form->end(); ?>
	</div><!-- end contentList -->
</div><!-- end boxContent -->














<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __(ADD . ' ' . BANK . ' ' . ACCOUNT); ?></h3></td>
					<td class="a-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table width="100%">
		<tr>
			<td width="20%">
				<?php echo $this->element('account_left_menu')?>
			</td>
			<td>
				<div class="accounts form">
					<?php echo $this->Form->create('Account', array('action' => 'addBankAccount'));?>
					<?php echo $form->hidden('level', array('value' => 2));?>
						<fieldset>
							<legend></legend>
						<div>
						<?php
							
							//echo $this->Form->label(ACCOUNT . ' ' . NAME);
							echo "खाताको नाम";
							echo "<br>";
							echo $this->Form->text('account_name', array('label' => 'Account Head'));
					
						?>
						</div>
						</fieldset>
					<?php echo $this->Form->end(__('Submit', true));?>
					</div>
			</td>
		</tr>
	</table>
</div>