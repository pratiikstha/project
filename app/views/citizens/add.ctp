<?php //echo $javascript->link('account');?>
<?php 
	$vmsOptions = array(
					'VDC' => VDC, 
					'Municipality' => MUNICIPALITY, 
					'Sub-metropolitan City' => SUBMETROPOLITAN, 
					'Metropolitan City' => METROPOLITAN
				  ); 
?>
<div class="box colorBlue">
	<h3><?php __(ADD . ' ' . CITIZEN); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('citizen_left_menu'); ?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<h2><?php __(ADD . ' ' . CITIZEN); ?></h2>
		<?php echo $this->Form->create('Citizen', array('controller' => 'citizen', 'action' => 'add', 'class'=> 'faram'));?>
		
		<table id="CitizensTable" >
			<tr>
				<th class="left w20"><?php echo CITIZENSHIP_NO; ?></th>
				<td><?php echo $this->Form->text('citizenship_no', array('placeholder' => CITIZENSHIP_NO ));?></td>
			</tr>
			<tr>
				<th class="left w20"><?php echo NAME; ?></th>
				<td>
					<?php echo $this->Form->text('first_name', array('required' => 'required', 'placeholder' => FIRST_NAME))?>
					<?php echo $this->Form->text('last_name', array('required' => 'required', 'placeholder' => LAST_NAME))?>
				</td>
			</tr>
		</table>

		<?php echo $this->Form->button(SAVE, array('class' => 'submit', 'div' => false));?>
		<?php echo $this->Form->end(); ?>
	</div><!-- end contentList -->
</div><!-- end boxContent -->