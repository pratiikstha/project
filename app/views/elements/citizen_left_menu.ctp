<div class="actions">
	<h3><?php __(ACTIONS); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__("नागरिक सूची", true), array('controller' => 'citizens', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__(ADD . " नागरिक", true), array('controller' => 'citizens', 'action' => 'add')); ?></li>
		<br>
		<li><?php echo $this->Html->link(__(ADD . " कर्मचारी", true), array('controller' => 'citizens', 'action' => 'add')); ?></li>
	</ul>
</div>