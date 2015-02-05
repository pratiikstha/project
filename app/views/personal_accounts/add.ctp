<?php echo $javascript->link('citizeninfo', true);?>

<div class="box colorBlue">
	<h3><?php __("व्यक्तिगत खाता");?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('account_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<?php echo $this->Form->create('PersonalAccount', array('action' => 'add', 'class'=> 'faram'));?>

		<?php
			echo $this->Form->select('type', $accountTypeArray);
		?>
			
			<div id="personal">
			<?php 
				$options['onkeyup'] = 'keyupAction(\'PersonalAccount\', \'PersonName\')';
				if(isset($defaults['ssn_no'])) {
					$options['value'] = $defaults['ssn_no'];
				}
				$options['placeholder'] = '';
				$options['size'] = '45';
				$options['nicetext'] = '';
				$options['label'] = 'नाम';
				echo 'नाम<br>';
				echo $this->Form->text('person_name', $options); ?>
				<?php 
				if(isset($defaults['contact_person_id'])) {
					echo $this->Form->hidden('person_name_id', array('value' => $defaults['contact_person_id'])); 
				} else {
					echo $this->Form->hidden('person_name_id');
				}
				?>
				<br />
				<div id="PersonName_List""></div>
				<br><br>
				<?php __("नागरिकता नं"); ?> <br>
				<?php echo $this->Form->text('citizenship_no', array('placeholder' => CITIZENSHIP_NO ));?>
				<br><br>
				<?php 
					echo 'पद<br>';
					echo $this->Form->text('designation', array('label' => 'पद'));
				?>
			
			</div>
			<div id="organization">
			<?php
				echo '<br>ठेकेदार वा संस्थाको नाम<br>';
				echo $this->Form->text('name');
			?>
			<?php 
				$options['onkeyup'] = 'keyupAction(\'PersonalAccount\', \'ContactPerson\')';
				if(isset($defaults['ssn_no'])) {
					$options['value'] = $defaults['ssn_no'];
				}
				$options['placeholder'] = '';
				$options['size'] = '45';
				$options['nicetext'] = '';
				$options['label'] = 'नाम';
				echo '<br>आधिकारिक व्यक्ति<br>';
				echo $this->Form->text('contact_person', $options); ?>
				
				<?php 
				if(isset($defaults['contact_person_id'])) {
					echo $this->Form->hidden('contact_person_id', array('value' => $defaults['contact_person_id'])); 
				} else {
					echo $this->Form->hidden('contact_person_id');
				}
			?>
				<br />
				<div id="ContactPerson_List" class="ContactPerson_List"></div>
			<?php 
				echo '<br>संस्था दर्ता मिति<br>';
				echo $form->select('registered_date.Y', $years, array('selected' => $selectedYear));
				echo " / ";
				echo $form->select('registered_date.m', $months, array('selected' => $selectedMonth));
				echo " / ";
				echo $form->select('registered_date.d', $days, array('selected' => $selectedDay));
				
				echo '<br>प्यान नं<br>';
				echo $this->Form->text('pan_no');
				echo '<br>भ्याट नं<br>';
				echo $this->Form->text('vat_no');
				echo '<br>खाता रहेको बैङ्क तथा शाखा - १<br>';
				echo $this->Form->text('bank_account_name_1');
				echo '<br>बैङ्क खाता नं ‍- १<br>';
				echo $this->Form->text('bank_account_id_1');
				echo '<br>खाता रहेको बैङ्क तथा शाखा - २<br>';
				echo $this->Form->text('bank_account_name_2');
				echo '<br>बैङ्क खाता नं ‍- २<br>';
				echo $this->Form->text('bank_account_id_2');
			?>
			</div>
			</fieldset>
			<hr>
			<?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?>
			<?php echo $this->Form->end();?>

	</div><!-- end contentList -->
</div><!-- end boxContent -->

<script language="javascript">
$(document).ready(function() {
	//$('#PersonalAccountType').load(function(event) {
	var type = $('#PersonalAccountType').val();
	if(type == '') {
		$('#organization').hide('slow');
		$('#personal').hide('slow');
	}else if ( type == 0 || type == 1 || type == 4) {
		$('#organization').hide('slow');
		$('#personal').show('slow');
	} else if(type == 2 || type == 3 || type == 5) {
		$('#organization').show('slow');
		$('#personal').hide('slow');
	}
	//});
	$('#PersonalAccountType').change(function(event) {
		var type = $('#PersonalAccountType').val();
		if(type == '') {
			$('#organization').hide('slow');
			$('#personal').hide('slow');
		}else if ( type == 0 || type == 1 || type == 4) {
			$('#organization').hide('slow');
			$('#personal').show('slow');
		} else if(type == 2 || type == 3 || type == 5) {
			$('#organization').show('slow');
			$('#personal').hide('slow');
		}
	});
 });
</script>