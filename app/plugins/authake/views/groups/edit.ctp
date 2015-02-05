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
			<div class="groups form">
			<?php echo $form->create('Group');?>
				<fieldset>
			 		<legend><?php __('Modify group'); echo " ".$this->data['Group']['name']; ?></legend>
				<?php
			        echo $form->input('id');   
					echo $form->input('name', array('label'=>__('Name', true)));
					echo $form->input('User', array('label'=>__('Users in this group<br/>Press \'Control\' for multi-selection', true), 'style'=>'width: 15em;'));
				?>
				</fieldset>
			<?php echo $form->end(__('Modify', true));?>
			</div>
			</td>
		</tr>
	</table>
</div>