

<div class="citizens form">
<?php echo $this->Form->create('Citizen');?>
	<fieldset>
		<legend><?php __('Add Citizen'); ?></legend>
	<?php
		echo CITIZENSHIP_NO;
		echo $this->Form->input('citizenship_no', array('label'=>false));
	?>
	<table>
	<tr>
	<td>
	<fieldset>
		<legend><?php __(PERMANENT_ADDRESS);?></legend>
	<?php	
		/*echo STATE;
		echo $this->Form->input('state', array('label'=>false));*/
		echo REGION;
		echo $this->Form->input('region', array('label'=>false));
		echo ZONE;
		echo $this->Form->input('zone', array('label'=>false));
		echo DISTRICT;
		echo $this->Form->input('district', array('label'=>false));
		echo VMS_OPTION;
		echo "<br>";
		echo $this->Form->select('vms_option', array('VDC'=>VDC, 'Metropolitan City'=>METROPOLITAN,'Sub-metropolitan City'=>SUBMETROPOLITAN), array('label'=>false));
		echo "<br>";
		echo VMS_NAME;
		echo $this->Form->select('vms_name', $vmses, array('label'=>false));
		echo WARD_NO;
		echo $this->Form->input('ward_no', array('label'=>false));
	?>
	</fieldset>
	</td>
	<td>
	<fieldset>
		<legend><?php __(BIRTH_PLACE);?></legend>
	<?php	
		/*echo STATE;
		echo $this->Form->input('birth_state', array('label'=>false));*/
		echo REGION;
		echo $this->Form->input('birthregion', array('label'=>false));
		echo ZONE;
		echo $this->Form->input('birthzone', array('label'=>false));
		echo DISTRICT;
		echo $this->Form->input('birthdistrict', array('label'=>false));
		echo VMS_OPTION;
		echo "<br>";
		echo $this->Form->select('birth_vms_option', array('VDC'=>VDC, 'Metropolitan City'=>METROPOLITAN,'Sub-metropolitan City'=>SUBMETROPOLITAN), array('label'=>false));
		echo "<br>";
		echo VMS_NAME;
		echo $this->Form->select('birth_vms_name', $birthvmses, array('label'=>false));
		echo WARD_NO;
		echo $this->Form->input('birth_ward_no', array('label'=>false));
	?>
	</fieldset>
	</td>
	</tr>
	</table>
	<?php
		echo BIRTH_DATE;
		echo "</br></br>";
		echo $this->Form->month('birth_date').'-';
		echo $this->Form->day('birth_date').'-';
		echo $this->Form->year('birth_date',1900);
		echo '</br></br>';
		echo FIRST_NAME;
		echo $this->Form->input('first_name', array('label'=>false));
		echo LAST_NAME;
		echo $this->Form->input('last_name', array('label'=>false));
		echo PREPARED_BY;
		echo $this->Form->input('prepared_by', array('label'=>false));
		echo VERIFIED_BY;
		echo $this->Form->input('verified_by', array('label'=>false));
		echo ISSUED_BY;
		echo $this->Form->input('issued_by', array('label'=>false));
		echo ISSUED_DATE;
		echo $this->Form->input('issued_date', array('label'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.LISTS, true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('controller' => 'citizen_relations', 'action' => 'index')); ?> </li>
	</ul>
</div>