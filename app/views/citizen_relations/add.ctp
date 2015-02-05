<div class="citizenRelations form">
<?php echo $this->Form->create('CitizenRelation');?>
	<fieldset>
		<legend><?php __(ADD.' '.CITIZEN.' '.RELATION); ?></legend>
	<?php
		echo $this->Form->input('citizen_relation_id');
		echo RELATIONWITH;
		echo $this->Form->input('ssn_no', array('label'=>false));
		echo RELATIVE;
		echo $this->Form->input('relative', array('label'=>false));
		echo RELATION;
		echo $this->Form->input('relation_id', array('label'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.LISTS, true), array('controller' => 'citizens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(ADD.' '.RELATION , true), array('controller' => 'valid_relations', 'action' => 'add')); ?> </li>
	</ul>
</div>