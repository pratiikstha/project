<div id="authake"> 
<?php 
if (!$tableonly) { 
	echo $this->element('gotoadminpage');
?>
<?php  
} 
?>
<div class="permissions <?php if (!$tableonly) { echo 'index';} ?>">
	<h2><?php __('Permissions');?></h2>
	<div class="actions">
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('controller');?></th>
			<th><?php echo $this->Paginator->sort('action');?></th>
			<th><?php echo $this->Paginator->sort('groups');?></th>
			<th><?php echo $this->Paginator->sort('allow_persons');?></th>
			<th><?php echo $this->Paginator->sort('deny_persons');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($authakePermissions as $authakePermission):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $authakePermission['Permission']['id']; ?>&nbsp;</td>
		<td><?php echo $authakePermission['Permission']['controller']; ?>&nbsp;</td>
		<td><?php echo $authakePermission['Permission']['action']; ?>&nbsp;</td>
		<td><?php echo $authakePermission['Permission']['groups']; ?>&nbsp;</td>
		<td><?php echo $authakePermission['Permission']['allow_persons']; ?>&nbsp;</td>
		<td><?php echo $authakePermission['Permission']['deny_persons']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $authakePermission['Permission']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $authakePermission['Permission']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $authakePermission['Permission']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Permission', true), array('action' => 'add')); ?></li>
	</ul>
</div>
</div>