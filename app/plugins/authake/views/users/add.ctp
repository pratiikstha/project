<div class="box colorBlue">
	<h3><?php __(ADMIN); ?></h3>
</div><!--end box-->

<div class="boxContent clearfix">
	<div class="contentList">
		<div class="menu fleft">
			<?php echo $this->element('user_left_menu')?>
		</div><!-- end menu-->
	</div><!-- end contentList -->

	<div class="rightContentList">
	    <?php echo $form->create('User', array('class'=> 'faram'));?>
		    <fieldset>
			    <legend><?php __('Create a new user');?></legend>
		    <?php
			    echo $form->input('login', array('label'=>__('Login', true)));
			    echo $form->input('password', array('label'=>__('Password', true), 'size'=>'12'));
			    echo $form->input('email', array('label'=>__('Email', true), 'size'=>'40'));
			    echo $form->input('Group', array('label'=>__('In groups<br/>Press \'Control\' for multi-selection', true), 'style'=>'width: 15em;'));
			    echo $form->label(__('Disable account', true));
			    echo $form->checkbox('disable');
		    
		    ?>
		    </fieldset>
			<?php echo $form->end(__('Create', true));?>
	</div>

</div>