<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
    	<li class="icon door_in"><?php echo $html->link(__('Logout', true), array('controller'=> 'user', 'action'=>'logout')); ?></li>
        <li class="icon user"><?php echo $html->link(__('Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
        <li class="icon group"><?php echo $html->link(__('Groups', true), array('controller'=> 'groups', 'action'=>'index')); ?> </li>
        <li class="icon lock"><?php //echo $html->link(__('Permissions', true), array('controller'=> 'permissions', 'action'=>'index')); ?> </li>
        <li class="icon add"><?php echo $html->link(__('New user', true), array('controller'=> 'users', 'action'=>'add')); ?></li>
        <li class="icon add"><?php echo $html->link(__('New group', true), array('controller'=> 'groups', 'action'=>'add')); ?></li>
	</ul>
</div>