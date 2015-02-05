<div class="box colorBlue clearfix">
	<h3>मेनु</h3>
</div><!--end box-->
<div class="boxContent clearfix">
	<div class="menu fleft" style="width:190px">
    	<span class="voucherIcon fleft"></span>
        <h4><?php __(ACTIONS)?></h4>
        <div class="menuContent">
        	<div class="contentList">
                <ul>
					<li><?php echo $this->Html->link(__(VOUCHER_ENTRY, true), array('controller' => 'vouchers', 'action' => 'add', 1)); ?></li>
					<li><?php echo $this->Html->link(__(NEW_ADVANCE_VOUCHER, true), array('controller' => 'vouchers', 'action' => 'add', 2)); ?></li>
					<li><?php echo $this->Html->link(__(ADD . " विविध भौचर", true), array('controller' => 'vouchers', 'action' => 'add', 3)); ?></li>
					<li><?php echo $this->Html->link(__("वार्षिक बजेट विनियोजन", true), array('controller' => 'accounts', 'action' => 'allocateAnnualBudget')); ?></li>
				</ul>
			</div><!-- end contentList-->
		</div><!-- end menuContent-->
	</div><!-- end menu-->
       
    <div class="menu fleft" style="width:190px">
		<span class="reportIcon fleft"></span>
        <h4><?php __(REPORT);?></h4>
        <div class="menuContent">
			<div class="contentList">
                <ul>
					<li><?php echo $this->Html->link(__(VOUCHER . MANY, true), array('controller' => 'vouchers', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__(BANK_CASH_BOOK, true), array('controller' => 'accounts', 'action' => 'getBankCashBook')); ?></li>
					<li><?php echo $this->Html->link(__(ADVANCE. ACCOUNT, true), array('controller' => 'accounts', 'action' => 'getAdvanceAccountList')); ?> </li>
				</ul>
			</div><!-- end contentList-->
		</div><!-- end menuContent-->
	</div><!-- end menu-->

	<div class="menu fleft" style="width:190px">
		<span class="reportIcon fleft"></span>
        <h4><?php __(OTHERS);?></h4>
        <div class="menuContent">
			<div class="contentList">
                <ul>
					<li><?php echo $this->Html->link(__(ACCOUNT.MANY, true), array('controller' => 'accounts', 'action' => 'printTree')); ?> </li>
					<li><?php echo $this->Html->link(__("व्यक्तिगत खाताहरु", true), array('controller' => 'personal_accounts', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__(BANK. ' ' . ACCOUNT.MANY, true), array('controller' => 'accounts', 'action' => 'showBankAccounts')); ?></li>
				</ul>
			</div><!-- end contentList-->
		</div><!-- end menuContent-->
	</div><!-- end menu-->
	
	<div class="menu fleft" style="width:190px">
		<span class="voucherIcon fleft"></span>
        <h4><?php __(OTHERS . ' ' . ACTIONS);?></h4>
        <div class="menuContent">
			<div class="contentList">
                <ul>
					<li><?php echo $this->Html->link(__(ADD . " व्यक्तिगत खाता", true), array('controller' => 'personal_accounts', 'action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link(__("पेश्की खातामा व्यक्ति वा संस्था थप", true), array('controller' => 'accounts', 'action' => 'addAdvanceAccount')); ?> </li>
				</ul>
			</div><!-- end contentList-->
		</div><!-- end menuContent-->
	</div><!-- end menu-->
</div><!-- end boxContent -->
       