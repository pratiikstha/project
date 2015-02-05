<?php echo $javascript->link('ddaccordion.js', true);?>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "budgetCodeParent", //Shared CSS class name of headers group that are expandable
	contentclass: "budgetCodeChild", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 1000, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "slow", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<div class="box colorBlue">
	<h3><?php __(BUDGET_EXPENSE_ALLOCATE); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->
	
	<div class="rightContentList" >
		<h2><?php __(BUDGET_EXPENSE_ALLOCATE); ?></h2>
		<!-- ASK REKHA : STARTS -->
		<?php if(isset($parent_account_name)) {?>
			<h4>Parent: <?php echo $parent_account_name;?></h4>
		<?php } ?>
		<!-- ASK REKHA : ENDS -->
	
		<?php echo $this->Form->create('Account', array('action' => 'allocateBudget', 'class' => 'faram'));?>

		<div class="easyui-tabs" style="width:740px">
			<div title="आय" style="padding:10px;">
				<!-- accordian start -->
				<?php echo $this->Form->create('Account', array('action' => 'allocateBudget', 'class' => 'faram'));?>
				<?php foreach ($headingsIncome as $parentCode => $parentName): ?>
				<h3 class="budgetCodeParent"><?php echo $parentName; ?></h3>
				<table class="budgetCodeChild">	
				<?php foreach ($subheadingsIncome[$parentCode] as $accounts) {?>
					<?php $accountId = $accounts['Account']['account_id']; ?>
					<?php $label = $nepaliNumber->toggleNumberLang($accounts['Account']['budget_code']) . "&nbsp;&nbsp;" . $accounts['Account']['account_name']; ?>
					<?php $value =  $nepaliNumber->precision($accounts["Account"]["opening_balance"], '2'); ?>
					<tr>
						<td class="w400"><?php echo $label; ?></td>
						<td>
							<?php echo $this->Form->text('opening_balance_' . $accountId, array('value' => $value)); ?>
							<span class="form_hint_green"><?php echo $label; ?></span>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="2"><?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?></td>
				</tr>
				</table>
				<?php endforeach; ?>
				<?php echo $this->Form->end(); ?>
				<!-- accordian ends -->
			</div>
			<div title="व्यय"  style="padding:10px;">
				<!-- accordian start -->
				<?php echo $this->Form->create('Account', array('action' => 'allocateBudget', 'class' => 'faram'));?>
				<?php foreach ($headings as $parentCode => $parentName): ?>
				<h3 class="budgetCodeParent"><?php echo $parentName; ?></h3>
				<table class="budgetCodeChild">	
				<?php foreach ($subheadings[$parentCode] as $accounts) {?>
					<?php $accountId = $accounts['Account']['account_id']; ?>
					<?php $label = $accounts['Account']['budget_code']. "&nbsp;&nbsp;" . $accounts['Account']['account_name']; ?>
					<?php $value =  $nepaliNumber->precision($accounts["Account"]["opening_balance"], '2'); ?>
					<tr>
						<td class="w400"><?php echo $label; ?></td>
						<td>
							<?php echo $this->Form->text('opening_balance_' . $accountId, array('value' => $value)); ?>
							<span class="form_hint_green"><?php echo $label; ?></span>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="2"><?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?></td>
				</tr>
				</table>
				<?php endforeach; ?>
				<?php echo $this->Form->end(); ?>
				<!-- accordian ends -->
			</div>
		</div>
		
		<br />
	</div><!--  end contentList -->
</div><!-- end boxContent -->