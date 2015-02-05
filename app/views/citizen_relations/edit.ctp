<div class="citizenRelations form">
<?php echo $this->Form->create('CitizenRelation');?>
	<fieldset>
		<legend><?php __(EDIT); ?></legend>
	<?php
		echo $this->Form->input('citizen_relation_id');
		echo RELATIONWITH;
		echo '</br>';
		echo $this->Form->select(RELATIONWITH, $ssnNo, array('select'=>$CitizenRelation['CitizenRelation']['ssn_no']));
		echo '</br></br>';
		echo RELATIVE;
		echo '</br>';
		echo $this->Form->select(RELATIVE, $relative, array('select'=>$CitizenRelation['CitizenRelation']['relative']));
		echo '</br></br>';
		echo RELATION;
		echo '</br>';
		echo $this->Form->select(RELATION, $relation_id, array('select'=>$CitizenRelation['CitizenRelation']['relation_id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__(DELETE, true), array('action' => 'delete', $this->Form->value('CitizenRelation.ssn_no')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CitizenRelation.ssn_no'))); ?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.LISTS.' '.RELATION, true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.LISTS, true), array('controller' => 'citizens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(ADD.' '.RELATION.' '.ADDS, true), array('controller' => 'valid_relations', 'action' => 'add')); ?> </li>
	</ul>
</div>