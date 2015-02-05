<div class="box colorBlue">
	<h3><?php __("Users"); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('user_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
		<div id="main_head">
			Users
			<span class="fright">
			<?php //print $html->link($html->image('printer.png'), array('action' => 'index', $selectedYear, $selectedMonth, $selectedDay, 'book'), array('escape' => false, 'target' => '_blank')) ; ?>&nbsp;&nbsp;
			</span>
		</div>
        <div class="list_table">
		
		
		
		<p class="paging_count">
					<?php
					echo $paginator->counter(array(
					'format' => __('There are %current% users on this system. Page %page%/%pages%', true)
					));
					?></p>
					<?php echo $form->create('User', array('class'=>'filter'));?>
					<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th><?php echo $paginator->sort('id');?></th>
						<th><?php echo $paginator->sort('login');?></th>
					    <th><?php echo 'Group';?></th>
						<th><?php echo $paginator->sort(__('Disabled', true), 'disable');?></th>
						<th class="actions" style="text-align:center"><?php __('Actions');?></th>
					</tr>
					<tr class="table-filter">
					    <td width="5%"><?php echo $form->input('User.id', array('div'=>false, 'type'=>'text', 'label'=>false));?></td>
					    <td ><?php echo $form->input('User.login', array('div'=>false, 'type'=>'text', 'label'=>false));?></td>
					    <td width="30%">&nbsp;</td>
					    <td width="5%">&nbsp;</td>
					    <td width="5%"class="actions" colspan="3">
						<?php echo $form->submit(__('filter', true), array('div'=>false));?>
					    </td>
					</tr>
					<?php
					$i = 0;
					foreach ($users as $user):
						$class = '';
						if ($i++ % 2 == 0) {
							$class = 'altrow';
						}
					
					    // check if user account enables
					    $exp = $user['User']['expire_account'];
					
					    if ($user['User']['disable'] or ($exp != '0000-00-00' and $time->fromString($exp) < time()))
					        $class = " class=\"{$class} disabled\"";
					    else
					        $class = " class=\"{$class}\"";
					        
					?>
						<tr<?php echo $class;?>>
					        <td>
					            <?php echo $user['User']['id']; ?>
					        </td>
							<td>
								<?php echo $html->link($user['User']['login'], array('action'=>'view', $user['User']['id'])); ?>&nbsp;
							</td>
							<td>
					            <?php //pr($user['Group']);
					            $gr = (count($user['Group'])) ? array() : array(__('Guest', true));     // Specify Guest group if lonely group
					            $groupids = array();
					            foreach($user['Group'] as $k=>$group){
					                $gr[] = $html->link(__($group['name'], true), array('controller'=>'groups', 'action'=>'view', $group['id']));
					                $groupids[] = $group['id'];
					            }
					            echo implode('<br/>', $gr); ?>&nbsp;
					        </td>
							<td>
					    <?php
					        if ($user['User']['disable']) echo $htmlbis->image("/authake/img/icons/lock_delete.png", array('title' => __('Account disabled', true)));
					
					        $exp = $user['User']['expire_account'];
					        if ($exp != '0000-00-00' and $time->fromString($exp) < time()) echo $htmlbis->image("/authake/img/icons/clock_delete.png", array('title' => __('Account expired', true)));
					    ?>&nbsp;
					        </td>
							<td class="actions">
					            <?php echo $htmlbis->iconlink('information', __('View', true), array('action'=>'view', $user['User']['id'])); ?>
							</td>
							<td class="actions">
					            <?php if(array_intersect($currentgroups, $groupids)) {
					            	echo $htmlbis->iconlink('pencil', __('Edit', true), array('action'=>'edit', $user['User']['id']));
					            } else {
					            	print "&nbsp;";
					            }
					             ?>
							</td>
							<td class="actions">
								<?php echo $htmlbis->iconlink('cross', __('Delete', true), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete user \'%s\'?', true), $user['User']['login'])); ?>
							&nbsp;
							</td>
						</tr>
					<?php endforeach; ?>
					</table>
					<?php echo $form->end();?>
					<div class="paging">
						<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
					 | 	<?php echo $paginator->numbers();?>
						<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
					</div>
		
		</div>
		
		
	</div><!-- end contentList -->
</div><!-- end boxContent -->
