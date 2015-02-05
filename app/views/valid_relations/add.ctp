<div class="validRelations form">
<?php echo $this->Form->create('ValidRelation');?>
	<fieldset>
		<legend><?php __(ADD.' '.RELATION); ?></legend>
	<?php
		echo RELATION;
		echo $this->Form->input('relation_name', array('label'=>false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__(RELATION.' '.LISTS, true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('controller' => 'citizen_relations', 'action' => 'index')); ?> </li>
	</ul>
</div>