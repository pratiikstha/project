<div class="accounts">
<?php echo $this->Form->create('Account');?>
	<fieldset>
		<legend><?php __(ADD . ' ' . ACCOUNT); ?> > [ <?php if(isset($accounts['account_name'])) { echo $accounts['account_name']; } ?> ]</legend>
	<?php
		echo $this->Form->hidden('parent_id', array('value' => $accounts['account_id']));
		echo $this->Form->hidden('level', array('value' => ($accounts['level']+1)));
		echo $this->Form->hidden('page', array('value' => ($pageType)));
		
		echo "<font color=#000>" . ACCOUNT . ' ' . NAME . "</font>";
		echo "<br>";
		echo $this->Form->text('account_name');
		echo "<br>";

		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
</div>