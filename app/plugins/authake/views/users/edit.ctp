<div class="middle" id="anchor-content">
	<div id="page:main-container">
    	<div id="messages"></div>
		<div class="content-header">
			<table cellspacing="0">
				<tbody>
				<tr>
					<td style="width: 50%;"><h3 class="icon-head head-products"><?php __('नयाँ यूजर'); ?></h3></td>
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
				 <div class="users form">
			    <?php echo $form->create('User');?>
				    <fieldset>
					    <legend><?php __('Modify user'); echo " ".$this->data['User']['login']; ?></legend>
				    <?php
					    echo $form->input('id');
					    echo $form->input('Group', array('label'=>__('In groups<br/>Press \'Control\' for multi-selection', true), 'style'=>'width: 15em;'));
					    echo $form->input('email', array('label'=>__('Email', true), 'size'=>'40'));
					    echo $form->input('emailcheckcode', array('label'=>__('Email check code', true)));
					    echo $form->input('passwordchangecode', array('label'=>__('Password change code', true)));
					    echo $form->input('password', array('label'=>__('New password (visible!)', true), 'type'=>'text', 'value' => '', 'size'=>'12'));
			    
					    echo $form->label(__('Disable account', true));
					    echo $form->checkbox('disable');
			     
					    echo $form->input('expire_account', array('label'=>__('Account expiry date', true)));
				    ?>
				    </fieldset>
			    <?php echo $form->end(__('Modify', true));?>
			    </div>
			</td>
		</tr>
	</table>
</div>