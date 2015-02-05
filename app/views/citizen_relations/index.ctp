<div class="citizenRelations index">
	<h2><?php __(CITIZEN.' '.RELATION);?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo RELATIONWITH;//$this->Paginator->sort('ssn_no');?></th>
		<th><?php echo RELATIVE;//$this->Paginator->sort('relative');?></th>
		<th><?php echo RELATION;//$this->Paginator->sort('relation_id');?></th>
		<th class="actions"><?php __(ACTIONS);?></th>
	</tr>
	<?php
	$i = 0;
	foreach($relationby as $key => $value):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		foreach ($value as $k => $val):
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($val['first_name'].' '.$val['last_name'], array('controller' => 'citizens', 'action' => 'view', $val['ssn_no'])); ?>
		</td>
		<td><?php echo $val['first_relation'].' ' .$val['last_relation']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($val['relation_name'], array('controller' => 'valid_relations', 'action' => 'view', $val['relation_id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__(VIEW, true), array('action' => 'view', $val['citizen_relation_id'])); ?>
			<?php echo $this->Html->link(__(EDIT, true), array('action' => 'edit', $val['citizen_relation_id'])); ?>
			<?php echo $this->Html->link(__(DELETE, true), array('action' => 'delete', $val['citizen_relation_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $val['citizen_relation_id'])); ?>
		</td>
	</tr>
<?php endforeach;
	endforeach; ?>
	</table>
	<p>
	<?php
	//echo $this->Paginator->counter(array(
	//s'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	//));
	?>	</p>

	<div class="paging">
		<?php //echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php //echo $this->Paginator->numbers();?>
 |
		<?php //echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__(ADD.' '.CITIZEN.' '.RELATION, true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.LISTS, true), array('controller' => 'citizens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(RELATION.' '.LISTS, true), array('controller' => 'valid_relations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__(ADD.' '.RELATION.' '.ADDS, true), array('controller' => 'valid_relations', 'action' => 'add')); ?> </li>
	</ul>
</div>