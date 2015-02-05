<html>
<?php echo $this->Html->charset(); ?>
<?php echo $this->Html->css(array('reset', 'style'), null, array('media' =>'all')); ?>

<body>
<div class="states form">
<?php echo $this->Form->create('Installation');?>
	<fieldset>
		<legend><?php __('कार्यालयको प्रकार'); ?></legend>
	<?php
		$officeType[0] = VDC;
		$officeType[1] = MUNICIPALITY;
		$officeType[2] = DDC;
		
		echo $this->Form->select('office_type', $officeType);
	?>
	</fieldset>
	<fieldset>
		<legend><?php __(''); ?></legend>
	<?php
		echo $this->Form->input('office_name_nepali', array('label' => 'कार्यालयको नाम (नेपालीमा)'));
		echo $this->Form->input('office_name_english', array('label' => 'कार्यालयको नाम (अँग्रेजीमा)'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
</body>
</html>
