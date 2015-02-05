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
		<?php echo $this->Form->create('PersonalAccount', array('class'=> 'faram', 'action' => 'addUsername/'. $id));?>
		<?php echo $this->Form->hidden('ssn_no', array('value' => $ssn_no)); ?>
				<br><br>
				<?php 
					echo 'प्रयोगकर्ता नाम<br>';
					echo $this->Form->text('username', array('label' => 'पद'));
				?>
				<br><br>
				<?php 
					echo 'पासवर्ड<br>';
					echo $this->Form->text('password', array('label' => 'पद'));
				?>
		
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