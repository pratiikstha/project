<div class="actions menuheader">
    <ul>
    	<li class="icon door_in"><?php echo $html->link(__('Logout', true), array('controller'=> 'user', 'action'=>'logout')); ?></li>
        <li class="icon house"><?php echo $html->link(__('Admin', true), array('controller'=> 'authake', 'action'=>'index')); ?></li>
        <li class="icon user"><?php echo $html->link(__('Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
        <li class="icon group"><?php echo $html->link(__('Groups', true), array('controller'=> 'groups', 'action'=>'index')); ?> </li>
        <li class="icon lock"><?php echo $html->link(__('Permission', true), array('controller'=> 'permissions', 'action'=>'index')); ?> </li>
    </ul>
</div>
