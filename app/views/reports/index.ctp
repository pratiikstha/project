<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products">एकाउन्ट</h3></td>
					<td class="a-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="homeDivBg" >
		<h3><?php __(ACTIONS)?></h3>
		<ul>
			<li><?php echo $this->Html->link(__(VOUCHER_ENTRY, true), array('controller' => 'vouchers', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__(NEW_ADVANCE_VOUCHER, true), array('controller' => 'vouchers', 'action' => 'add', 2)); ?></li>
			<li><?php echo $this->Html->link(__(ADD . " विविध भौचर", true), array('controller' => 'vouchers', 'action' => 'add', 3)); ?></li>
			<li><?php echo $this->Html->link(__(ADD . " गत वर्षको भौचर", true), array('controller' => 'vouchers', 'action' => 'add', 4)); ?></li>
			<li><?php echo $this->Html->link(__("वार्षिक बजेट विनियोजन", true), array('controller' => 'accounts', 'action' => 'allocateAnnualBudget')); ?></li>
			<li><?php echo $this->Html->link(__("हाल सम्मको बजेट विनियोजन", true), array('controller' => 'accounts', 'action' => 'allocateCurrentBudget')); ?></li>
		</ul>
	</div>
	<div class="homeDivBg" >
		<h3><?php __(REPORT);?></h3>
		<ul>
			<li><?php echo $this->Html->link(__(TODAY_VOUCHER, true), array('controller' => 'vouchers', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__(BANK_CASH_BOOK, true), array('controller' => 'accounts', 'action' => 'getBankCashBook')); ?></li>
			<li><?php echo $this->Html->link(__(ADVANCE. ACCOUNT, true), array('controller' => 'accounts', 'action' => 'getAdvanceAccountList')); ?> </li>
		</ul>
	</div>
	<div class="homeDivBg" >
		<h3><?php __(OTHERS);?></h3>
		<ul>
			<li><?php echo $this->Html->link(__(ACCOUNT.MANY, true), array('controller' => 'accounts', 'action' => 'printTree')); ?> </li>
			<li><?php echo $this->Html->link(__(BANK. ' ' . ACCOUNT.MANY, true), array('controller' => 'accounts', 'action' => 'getBankAccounts')); ?></li>
			<li><?php echo $this->Html->link(__("गत वर्षको अल्या", true), array('controller' => 'accounts', 'action' => 'getCarriedForward')); ?></li>
		<li><?php echo $this->Html->link(__("बैङ्क खाता", true), array('controller' => 'accounts', 'action' => 'addBankAccount')); ?></li>
		</ul>
	</div>
</div>