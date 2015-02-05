<div class="accounts">
<?php echo $this->Form->create('Account');?>
	<fieldset>
		<legend><?php __(ACCOUNT . ' ' . DELETE); ?></legend>
	<?php
		echo $this->Form->hidden('account_id', array('value' => $accounts['account_id']));
		echo $this->Form->hidden('page', array('value' => ($pageType)));
		
		echo "<font color='#000'>" . getMessage(ACCOUNT_DELETE_MSG, array($accounts['account_name'])) . "</font>";
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
</div>