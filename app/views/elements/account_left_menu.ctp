<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__(ADD . " साधारण भौचर", true), array('controller' => 'vouchers', 'action' => 'add', 1)); ?></li>
		<li><?php echo $this->Html->link(__(NEW_ADVANCE_VOUCHER, true), array('controller' => 'vouchers', 'action' => 'add', 2)); ?></li>
		<li><?php echo $this->Html->link(__(ADD . " विविध भौचर", true), array('controller' => 'vouchers', 'action' => 'add', 3)); ?></li>
		<br>
		<li><?php echo $this->Html->link(__(VOUCHER . MANY, true), array('controller' => 'vouchers', 'action' => 'index')); ?> </li>
		<br>
		<li><?php echo $this->Html->link(__(ACCOUNT.MANY, true), array('controller' => 'accounts', 'action' => 'printTree')); ?> </li>
		<li><?php echo $this->Html->link(__(ADVANCE. ACCOUNT, true), array('controller' => 'accounts', 'action' => 'getAdvanceAccountList')); ?> </li>
		<li><?php echo $this->Html->link(__(BANK_CASH_BOOK, true), array('controller' => 'accounts', 'action' => 'getBankCashBook')); ?></li>
		<li><?php //echo $this->Html->link(__("मासिक खाता", true), array('controller' => 'accounts', 'action' => 'getMonthlyAccount')); ?></li>
		<br>
		<li><?php echo $this->Html->link(__("व्यक्तिगत खाता", true), array('controller' => 'personal_accounts')); ?></li>
		<br>
		<li><?php echo $this->Html->link(__("वार्षिक बजेट विनियोजन", true), array('controller' => 'accounts', 'action' => 'allocateAnnualBudget')); ?></li>
		<li><?php echo $this->Html->link(__("गत वर्षको अल्या", true), array('controller' => 'accounts', 'action' => 'getCarriedForward')); ?></li>
		<li><?php echo $this->Html->link(__("बैङ्क खाता", true), array('controller' => 'accounts', 'action' => 'showBankAccounts')); ?></li>
	</ul>
</div>