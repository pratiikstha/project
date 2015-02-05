<div class="citizenRelations view">
<h2><?php  __(CITIZEN.' '.RELATION);?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(RELATIONWITH); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($relationby[0][0]['first_name'].' '.$relationby[0][0]['last_name'], array('controller' => 'citizens', 'action' => 'view', $citizenRelation['CitizenRelation']['ssn_no'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(RELATIVE); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $relative[0][0]['first_name'].' '.$relative[0][0]['last_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __(RELATION); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($citizenRelation['Relation']['relation_name'], array('controller' => 'valid_relations', 'action' => 'view', $citizenRelation['CitizenRelation']['relation_id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__(EDIT, true), array('action' => 'edit', $citizenRelation['CitizenRelation']['ssn_no'])); ?> </li>
		<li><?php echo $this->Html->link(__(DELETE, true), array('action' => 'delete', $citizenRelation['CitizenRelation']['ssn_no']), null, sprintf(__('Are you sure you want to delete # %s?', true), $citizenRelation['CitizenRelation']['ssn_no'])); ?> </li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(ADD.' '.CITIZEN.' '.RELATION, true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION, true), array('controller' => 'citizens', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Ssn No', true), array('controller' => 'citizens', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__(RELATION.' '.LISTS, true), array('controller' => 'valid_relations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(ADD.' '.RELATION.' '.ADDS, true), array('controller' => 'valid_relations', 'action' => 'add')); ?> </li>
	</ul>
</div>
