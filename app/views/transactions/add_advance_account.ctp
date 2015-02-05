<?php echo $javascript->link('account');?>

<div class="box colorBlue">
	<h3><?php __("व्यक्तिगत खातालाई पेश्की खातामा उपलब्ध गराउने");?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<?php echo $this->Form->create('Account', array('class'=> 'faram'));?>
			<fieldset>
				<legend><h2><?php __(ADD . ' ' . ACCOUNT); ?> > [ <?php __(ADVANCE); ?> ]</h2></legend>
			<?php 
				if(count($personalAccounts) == 0) {
			?>
			सबै व्यक्तिगत खाताहरु पेश्की खाताको रुपमा उपलब्ध छन् ।
			<?php 
				} else {
			?>
			<?php
				echo $this->Form->hidden('page', array('value' => ($pageType)));
				echo $this->Form->select('personal_account_id', $personalAccounts);
				
				echo "<br>";
		
				?>
			</fieldset>
			<?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?>
		<?php echo $this->Form->end(); ?>
			<?php } ?>
		
		
	</div><!-- end contentList -->
</div><!-- end boxContent -->
