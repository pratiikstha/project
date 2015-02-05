<?php 
	$onLoadEvent = '';
	if ($print == 'print') {
		$onLoadEvent = 'print(); window.close();';
	}
?>

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

<body onload = "<?php echo $onLoadEvent; ?>">
	<div class="reportDiv">
	<table class="reportTable">
		<tr>
			<th colspan="3" class="center" >अनुसूची १६</th>
		</tr>
		<tr>
			<th colspan="3"><h1>गाउँ विकास समितिको कार्यालय</h1><h5><?php echo VDC_NAME; ?></h5></th>
		</tr>
		<tr>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<th colspan="3" ><h2>गोश्वारा भौचर</h2></th>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">&nbsp;</td>
			<td width="15%">भौचर नम्बर:&nbsp;</td>
		    <td width="15%"><?php 
		    if(isset($voucher['Voucher']['voucher_number']) && $voucher['Voucher']['voucher_number'] != '') {
		    	echo $nepaliNumber->toggleNumberLang($voucher['Voucher']['voucher_number']);
		    } else {
		    	echo $nepaliNumber->toggleNumberLang($voucher['Voucher']['voucher_id']);
		    }
		    ?></td>
		</tr>
		<tr>
			<td width="70%">&nbsp;</td>
		    <td width="15%">मिति:&nbsp;</td>
		    <td width="15%"><?php echo $voucher['Voucher']['created_date']; ?></td>
		</tr>
	</table>
	<br />
	<table  class="reportTable reportTableBorder">
		<tr>
		    <th class="border" width="50%"><?php echo DESCRIPTION; ?></th>
		    <th class="border" width="7%">खा.पा.नं.</th>
		    <th class="border" width="13%">आम्दानी खर्च<br />संकेत नं.</th>
		    <th class="border" width="15%"><?php echo DEBIT; ?></th>
		    <th class="border" width="15%"><?php echo CREDIT; ?></th>
		</tr>
		<?php
			$drTotal = 0;
			$crTotal = 0;
			foreach ($voucher['Transaction'] as $transaction):
				if($transaction['drcr'] == 'Dr') {
					$drcr = 'डे.';
					$drTotal += $transaction['amount'];
				} else {
					$drcr = 'क्रे.';
					$crTotal += $transaction['amount'];
				}
		?>
		<tr>
			<td class="borderLeftRight"><?php echo $transaction['account_name'] . '&nbsp;&nbsp;&nbsp;' . $drcr;?></td>
			<td class="borderLeftRight">&nbsp;</td>
			<td class="center borderLeftRight"><?php echo $nepaliNumber->toggleNumberLang($transaction['budget_code']);?></td>
			<td class="right borderLeftRight"><?php if($transaction['drcr'] == 'Dr') { echo $nepaliNumber->currency($transaction['amount']); } else { echo ' ';}?></td>
			<td class="right borderLeftRight"><?php if($transaction['drcr'] == 'Cr') { echo $nepaliNumber->currency($transaction['amount']);} else { echo ' ';}?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td class="borderLeftRight"><p class="narration">( <?php echo $voucher['Voucher']['narration'];?> )</td>
			<td class="borderLeftRight">&nbsp;</td>
			<td class="borderLeftRight">&nbsp;</td>
			<td class="borderLeftRight">&nbsp;</td>
			<td class="borderLeftRight">&nbsp;</td>
		</tr>
		<tr>
			<td class="border right" colspan="3">जम्मा</td>
			<td class="border right"><?php echo $nepaliNumber->currency($drTotal); ?></td>
			<td class="border right"><?php echo $nepaliNumber->currency($crTotal); ?></td>
		</tr>
	</table>
	<br />
	<table class="reportTable">
		<tr>
			<td width="20%">रसिद नं.:-</td>
			<td width="30%">&nbsp;</td>
			<td width="20%">चेक नं.:-</td>
			<td width="30%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">प्राप्त रकम:-</td>
			<td width="30%">&nbsp;</td>
			<td width="20%">चेक रकम:-</td>
			<td width="30%">&nbsp;</td>
		</tr>
		<tr class="borderTop">
			<td width="20%">पेश गर्नेको दस्तखत:-</td>
			<td width="30%">
				&nbsp;
		    </td>
			<td width="20%">स्वीकृत गर्नेको दस्तखत:-</td>
			<td width="30%">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td width="20%">नाम, थर:-</td>
			<td width="30%">&nbsp;

			<?php 
		        	if(isset($voucher['Voucher']['posted_by_name'])) { 
		            		echo $voucher['Voucher']['posted_by_name']; 
					}
		    ?>
			</td>
			<td width="20%">नाम, थर:-</td>
			<td width="30%">&nbsp;
			<?php 
		        	if(isset($voucher['Voucher']['checked_by_name'])) { 
		            	echo $voucher['Voucher']['checked_by_name']; 
					} else { 
		            	echo $this->Html->link('Checked', array('controller' => 'vouchers', 'action' => 'check',  $voucher['Voucher']['voucher_id']), array('class' => 'checkLink'));
					}
			?>
			</td>
		</tr>
		<tr>
			<td width="20%">पद:-</td>
			<td width="30%">&nbsp;</td>
			<td width="20%">पद:-</td>
			<td width="30%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">मिति:-</td>
			<td width="30%">
				<?php 
					if(isset($voucher['Voucher']['posted_date'])) { 
						echo $nepaliCalendar->formatNepaliDate($nepaliCalendar->convertToNepaliDate($voucher['Voucher']['posted_date'])."-0"); 
					}
				?>
			</td>
			<td width="20%">मिति:-</td>
			<td width="30%">
				<?php 
					if(isset($voucher['Voucher']['checked_date'])) { 
							echo $nepaliCalendar->formatNepaliDate($nepaliCalendar->convertToNepaliDate($voucher['Voucher']['checked_date'])); 
					}
				?>
			</td>
		</tr>
		<tr class="borderTop">
			<td width="20%">बुझिलिनेको सही:-</td>
			<td width="30%" colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">नाम, थर:-</td>
			<td width="30%" colspan="3">&nbsp;</td>
		</tr>
	</table>
</div>
</body>
</html>