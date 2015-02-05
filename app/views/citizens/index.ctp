<div class="box colorBlue">
	<h3><?php __(CITIZEN); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('citizen_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<div class="list_table_container">
		<div id="main_head">
			नागरिक रेकर्डहरू
			<span class="fright">
			<?php //print $html->link($html->image('printer.png'), array('action' => 'index', $selectedYear, $selectedMonth, $selectedDay, 'book'), array('escape' => false, 'target' => '_blank')) ; ?>&nbsp;&nbsp;
			</span>
		</div>
        <div class="list_table">
        	<table border="0" width="675"cellspacing="0" cellpadding="0">
				<tr id="row">
					<th width="20%">नागरिकता नं</th>
					<th>नाम</th>
				</tr>
				<?php
					$i = 0;
					foreach ( $citizens as $citizen):
					
				?>
				<tr>
					<td><?php echo $nepaliNumber->toggleNumberLang($citizen['citizenship_no'], 'Nepali'); ?>&nbsp;</td>
					<td><?php 
					echo $citizen['first_name'] . ' ' . $citizen['last_name'];  
					?>&nbsp;</td>

				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		</div>
	</div><!-- end contentList -->
</div><!-- end boxContent -->