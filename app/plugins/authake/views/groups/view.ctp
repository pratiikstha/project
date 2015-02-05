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
					<?php if (!empty($actions)) { ?>
					
					<div class="monitor_rules index">
					<h3><?php __('Allowed & denied actions');?></h3>
					<?php
					    foreach($actions as $controller => $ruleslist) {
					        echo "<div style=\"float: left; padding: 0 0.7em; margin: 0.5em; border-left: 1px solid #CCC;\"><h4>{$controller}</h4>";
					        echo "<ul>";
					        foreach($ruleslist as $k => $rule) {
					            if ($rule['permission'] == "Allow")
					                echo '<li class="icon accept"><p style="color: green">'.$rule['action'];
					            else
					                echo '<li class="icon delete"><p style="color: red">'.$rule['action'];
					            echo '</p></li>';
					        
					        }
					        echo "</ul></div>";
					    }
					
					?>
					<p style="clear: both"></p>
					</div>
					    <div class="actions">
					        <ul>
					            <li class="icon accept"><?php echo $html->link(__('Hide this view', true), array('action'=>'view', $group['Group']['id'])); ?></li>
					        </ul>
					    </div>
					<?php } ?>
					
					<div class="related">
					    <h3><?php echo sprintf(__('Users in group %s', true), $group['Group']['name']);?></h3>
					    <?php if (!empty($group['User'])):?>
					    <table class="listing" cellpadding = "0" cellspacing = "0">
					    <tr>
					        <th><?php __('Login'); ?></th>
					        <th><?php __('Email'); ?></th>
					        <th class="actions"><?php __('Actions');?></th>
					    </tr>
					    <?php
					        $i = 0;
					        foreach ($group['User'] as $user):
					            $class = null;
					            if ($i++ % 2 == 0) {
					                $class = ' class="altrow"';
					            }
					        ?>
					        <tr<?php echo $class;?>>
					            <td><?php echo $html->link($user['login'], array('controller'=> 'users', 'action'=>'view', $user['id']));?></td>
					            <td><?php echo $user['email'];?></td>
					            <td class="actions">
					                <?php echo $htmlbis->iconlink('information', __('View', true), array('controller'=> 'users', 'action'=>'view', $user['id'])); ?>
					                <?php echo $htmlbis->iconlink('pencil', __('Edit', true), array('controller'=> 'users', 'action'=>'edit', $user['id'])); ?>
					            </td>
					        </tr>
					    <?php endforeach; ?>
					    </table>
					<?php endif; ?>
					
					</div>
			</td>
		</tr>
	</table>
</div>