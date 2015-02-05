<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __('नयाँ समूह'); ?></h3></td>
					<td class="a-right">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table width="100%">
		<tr>
			<td width="20%">
				<div class="actions">
				<ul>
				    <li class="icon info"><?php echo $html->link(__('View user', true), array('action'=>'view', $form->value('User.id')));?></li>
				    <li class="icon cross"><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('User.login'))); ?></li>
				</ul>
			    </div>
			</td>
			<td>
				<div class="groups <?php if (!$tableonly) { echo 'index';} ?>">
					<?php if (!$tableonly) { ?>
					
					<h2><?php __('Groups');?></h2>
					<div class="actions">
					</div>
					<?php } ?>
					<p class="paging_count">
					<?php
					echo $paginator->counter(array(
					'format' => __('There are %current% groups on this system.', true)
					));
					?></p>
					<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th><?php echo $paginator->sort('name');?></th>
						<th class="actions"><?php __('Actions');?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($groups as $group):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
						<tr<?php echo $class;?>>
					    <?php if ($group['Group']['id'] != 0) { ?>
							<td>
								<?php echo $html->link($group['Group']['name'], array('action'=>'view', $group['Group']['id'])); ?>
							</td>
							<td class="actions">
								<?php echo $htmlbis->iconlink('information', __('View', true), array('action'=>'view', $group['Group']['id'])); ?>
								<?php echo $htmlbis->iconlink('pencil', __('Edit', true), array('action'=>'edit', $group['Group']['id'])); ?>
								<?php echo $htmlbis->iconlink('cross', __('Delete', true), array('action'=>'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete the group \'%s\'?', true), $group['Group']['name'])); ?>
					        </td>
					    <?php } else { ?>
						</tr>
					    <?php } ?>
					<?php endforeach; ?>
					<?php
					    $class = null;
					    if ($i++ % 2 == 0) {
					        $class = ' class="altrow"';
					    }
					    echo "<tr{$class}>";
					    ?>
					        <td>
					            <?php echo __('Everybody (all users, logged or not, are in this group)', true); ?>
					        </td>
					        <td class="actions">&nbsp;
					        </td>
					    </tr>
					</table>
					<div class="paging">
						<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
					 | 	<?php echo $paginator->numbers();?>
						<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
					</div>
					</div>
								
				
				</td>
		</tr>
	</table>
</div>
