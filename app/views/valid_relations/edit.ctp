<div class="validRelations form">
<?php echo $this->Form->create('ValidRelation');?>
	<fieldset>
		<legend><?php __('Edit Valid Relation'); ?></legend>
	<?php
		echo $this->Form->input('relation_id');
		echo $this->Form->input(RELATION);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__(DELETE, true), array('action' => 'delete', $this->Form->value('ValidRelation.relation_id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ValidRelation.relation_id'))); ?></li>
		<li><?php echo $this->Html->link(__(RELATION.' '.LISTS, true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('controller' => 'citizen_relations', 'action' => 'index')); ?> </li>
	</ul>
</div>