<script type="text/javascript">
<!--
var actions = new Array();
<?php foreach($actions as $c => $actionArr) { ?>
	var controlActionList = new Array();
	<?php
	$i = 0; 
	foreach($actionArr as $k => $v) { 
	?>
	controlActionList['<?php echo $v; ?>'] = '<?php echo $v; ?>';
	<?php
		$i++; 
	}
	?>
	actions['<?php echo $c; ?>'] = controlActionList;
<?php } ?>

function getAction(obj){
	//var val = obj.value;
	var tempArr = actions[obj];
	var actSelect = document.getElementById('act');
	var str = '<select name="data[Permission][action]" id="PermissionAction">';
	
	for  (var acts in tempArr) {
		str += '<option value="' + acts + '">' + acts + '</option>'
	}
	str += '</select>';
	actSelect.innerHTML = str;
}

//-->
</script>
<div class="authakePermissions form">
<?php echo $this->Form->create('Permission');?>
	<fieldset>
		<legend><?php __('Add Authake Permission'); ?></legend>
		<div>
		<label for="PermissionController">Controller</label>
		<?php
			echo $this->Form->select('controller', $controllers, '', array('onchange' => "getAction(this.value);", 'label' => 'Controller'));
		?>
		</div>
		<div id="act" name="act">
			<label for="PermissionAction">Action</label>
			<?php echo $this->Form->select('action', array());?>
		</div>
		<?php 
			echo $this->Form->input('groups');
			echo $this->Form->input('allow_persons');
			echo $this->Form->input('deny_persons');
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Permissions', true), array('action' => 'index'));?></li>
	</ul>
</div>