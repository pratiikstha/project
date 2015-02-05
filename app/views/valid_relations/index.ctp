<div class="validRelations index">
	<h2><?php __(RELATION);?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort(RELATION,'relation_name');?></th>
			<th class="actions"><?php __(ACTIONS);?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($validRelations as $validRelation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $validRelation['ValidRelation']['relation_name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(VIEW, true), array('action' => 'view', $validRelation['ValidRelation']['relation_id'])); ?>
			<?php echo $this->Html->link(__(EDIT, true), array('action' => 'edit', $validRelation['ValidRelation']['relation_id'])); ?>
			<?php echo $this->Html->link(__(DELETE, true), array('action' => 'delete', $validRelation['ValidRelation']['relation_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $validRelation['ValidRelation']['relation_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	/*echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));*/
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __(PREVIOUS, true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__(NEXT, true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__(ADD.' '.RELATION, true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__(CITIZEN.' '.RELATION.' '.LISTS, true), array('controller' => 'citizen_relations', 'action' => 'index')); ?> </li>
	</ul>
</div>