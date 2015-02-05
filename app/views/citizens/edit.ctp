<div class="citizens form">
<?php echo $this->Form->create('Citizen');?>
	<fieldset>
		<legend><?php __(CITIZEN.' '.EDIT); ?></legend>
	<?php
		echo $this->Form->input('ssn_no');
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
		echo $this->Form->input('state', array( 'selected'=> $value, 'label'=>false));*/
		echo REGION;
		echo $this->Form->input('region', array( 'selected'=> $address['Address']['region_id'], 'label'=>false));
		echo ZONE;
		echo $this->Form->input('zone', array( 'selected'=> $address['Address']['zone_id'], 'label'=>false));
		echo DISTRICT;
		echo $this->Form->input('district', array( 'selected'=> $address['Address']['district_id'], 'label'=>false));
		echo VMS_OPTION;
		echo "<br>";
		echo $this->Form->select('vms_option', array('VDC'=>VDC, 'Metropolitan City'=>METROPOLITAN,'Sub-metropolitan City'=>SUBMETROPOLITAN), array( 'selected'=> $address['Address']['vms_options'], 'label'=>false));
		echo "<br><br>";
		echo VMS_NAME;
		echo "<br>";
		echo $this->Form->select('vms_name', $vmses, array( 'value'=> $address['Address']['vms_id'], 'label'=>false));
		echo "<br><br>";
		echo WARD_NO;
		echo $this->Form->input('ward_no', array( 'value'=> $address['Address']['ward_no'], 'label'=>false));
	?>
	</fieldset>
	</td>
	<td>
	<fieldset>
		<legend><?php __(BIRTH_PLACE);?></legend>
	<?php
		/*echo STATE;
		echo $this->Form->input('birth_state', array( 'selected'=> $value, 'label'=>false));*/
		echo REGION;
		echo $this->Form->input('birthregion', array( 'selected'=> $birthaddress['Address']['region_id'], 'label'=>false));
		echo ZONE;
		echo $this->Form->input('birthzone', array( 'selected'=> $birthaddress['Address']['zone_id'], 'label'=>false));
		echo DISTRICT;
		echo $this->Form->input('birthdistrict', array( 'selected'=> $birthaddress['Address']['district_id'], 'label'=>false));
		echo VMS_OPTION;
		echo "<br>";
		echo $this->Form->select('birth_vms_option', array('VDC'=>VDC, 'Metropolitan City'=>METROPOLITAN,'Sub-metropolitan City'=>SUBMETROPOLITAN), array( 'selected'=> $birthaddress['Address']['vms_options'], 'label'=>false));
		echo "<br><br>";
		echo VMS_NAME;
		echo "<br>";
		echo $this->Form->select('birth_vms_name', $birthvmses, array( 'value'=> $birthaddress['Address']['vms_id'], 'label'=>false));
		echo "<br><br>";
		echo WARD_NO;
		echo $this->Form->input('birth_ward_no', array( 'value'=> $birthaddress['Address']['ward_no'], 'label'=>false));
	?>
	</fieldset>
	</td>
	</tr>
	</table>
	<?php
		echo BIRTH_DATE;
		echo "</br>";
		echo "</br>";
		echo $this->Form->month('birth_date').'-';
		echo $this->Form->day('birth_date').'-';
		echo $this->Form->year('birth_date',1900);
		echo '</br>';
		echo "</br>";
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

		echo $this->Form->hidden('permanent_address', array('value'=>$this->data['Citizen']['permanent_address']));
		echo $this->Form->hidden('birth_place', array('value'=>$this->data['Citizen']['birth_place']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__(DELETE, true), array('action' => 'delete', $this->Form->value('Citizen.ssn_no')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Citizen.ssn_no'))); ?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.LISTS, true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('controller' => 'citizen_relations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(ADD.' '.RELATION.' '.ADDS, true), array('controller' => 'citizen_relations', 'action' => 'add')); ?> </li>
	</ul>
</div>