<html>
<?php echo $this->Html->charset(); ?>
<?php echo $this->Html->css(array('reset', 'style'), null, array('media' =>'all')); ?>
<script language="javascript">
	$(document).ready(function() {
		$("a.checkLink").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'titlePosition'		: 'inside',
			'overlayColor'		: '#FFFFFF',
			'overlayOpacity'	: 0.4
		});
});
</script>
<body onload="print();window.close();" >
	<div class="reportDiv">
	<table class="reportTable" style="width:850px">
		<tr>
			<th colspan="3" class="center" >अनुसूची १९</th>
		</tr>
		<tr>
			<th colspan="3"><h1>गाउँ विकास समितिको कार्यालय</h1><h5><?php echo VDC_NAME; ?></h5></th>
		</tr>
		<tr>
			<td colspan="3" class="right">खाता पाना नं. <?php __($nepaliNumber->toggleNumberLang($id)); ?></td>
		</tr>
		<tr>
			<th colspan="3" ><h2><?php __($account_name);?> <br />लेजर खाता</h2></th>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
	<br />
	<table  class="reportTable reportTableBorder" style="width:850px">
		<tr  id="row">
			<th class="border" style="width: 75px;">मिति</th>
			<th class="border" style="width:300px;">विवरण</th>
			<th class="border" style="width: 75px;"><?php __(VOUCHER); ?></th>
			<th class="border" style="width:100px;"><?php __(DEBIT); ?></th>
			<th class="border" style="width:100px;"><?php __(CREDIT); ?></th>
			<th class="border" style="width:100px;">डे <br />क्रे</th>
			<th class="border" style="width:100px;">मौज्दात</th>
		</tr>
		<?php foreach ($advances as $account): ?>
		<tr>
			<td class="borderLeftRight center"><?php if(isset($account['date'])) {echo $account['date']; } ?></td>
			<td class="borderLeftRight"><?php if(isset($account['particulars'])) {echo $account['particulars']; } ?></td>
			<td class="borderLeftRight center"">
				<?php if(isset($account['voucher_id'])) { echo $nepaliNumber->toggleNumberLang($account['voucher_id']); } ?>
			</td>
			<td class="borderLeftRight right"><?php if(isset($account['amount_dr'])) { echo $nepaliNumber->currency($account['amount_dr']); } else { echo "-"; } ?></td>
			<td class="borderLeftRight right"><?php if(isset($account['amount_cr'])) { echo $nepaliNumber->currency($account['amount_cr']); } else { echo "-"; } ?></td>
			<td class="borderLeftRight">&nbsp;</td>
			<td class="borderLeftRight right"><?php if(isset($account['balance'])) { echo $nepaliNumber->currency($account['balance']); } ?></td>
		</tr>
	<?php endforeach; ?>
		<tr class="borderTop">
			<td colspan="7">&nbsp;</td>
		</tr>
	</table>
</div>
</body>
</html>