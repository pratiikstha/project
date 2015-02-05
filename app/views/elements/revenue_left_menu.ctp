<div class="actions" >
	<h3><?php __(ACTIONS); ?></h3>
	<ul style="line-height: 150%">
		<li><?php echo $this->Html->link(__("आम्दानी रसिद", true), array('controller' => 'day_books','action' => 'add'));?></li>
		
		<li><?php echo $this->Html->link(__("दैनिक कर सङ्कलन खाता", true), array('controller' => 'day_books','action' => 'index')); ?></li>
	</ul>
</div>