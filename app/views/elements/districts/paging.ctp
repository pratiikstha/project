
		<table class="actions" cellspacing="0">
			<tbody>
			<tr>
				<td class="pager">
					Page
					<?php if ($this->Paginator->hasPrev()) {?>
					<?php echo $this->Paginator->prev($html->image('pager_arrow_left.gif', array('class' => 'arrow')), array('escape' => false), null, null); ?>
					<?php } else { ?>
					<?php echo $html->image('pager_arrow_left_off.gif', array('class' => 'arrow', 'alt' => 'Go to Previous Page'));?>
					<?php }?>
					
					<?php echo $this->Form->text('page', array('class' => 'input-text page', 'value' => $this->Paginator->counter( array('format' => '%page%')))); ?>
					
					<?php if ($this->Paginator->hasNext()) {?>
					<?php echo $this->Paginator->next($html->image('pager_arrow_right.gif', array('class' => 'arrow')), array('escape' => false), null, array('class'=>'disabled')); ?>
					<?php } else { ?>
					<?php echo $html->image('pager_arrow_right_off.gif', array('class' => 'arrow', 'alt' => 'Go to Next Page'));?>
					<?php }?>
					of <?php echo $this->Paginator->counter( array('format' => '%pages%')); ?> pages
					<span class="separator">|</span>
					<?php echo $this->Paginator->counter(
						array('format' => __('Showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
					?>

				</td>
				<td class="filter-actions a-right">
					<?php //TODO ?>
					<button id="id_7bdc6cf40816218c96af248392cbaf8b" type="button" class="scalable " onclick="productGridJsObject.resetFilter()" style=""><span>Reset Filter</span></button>
					<button id="id_4a72bc528fb8660c4588838bc7b254f9" type="button" class="scalable task" onclick="productGridJsObject.doFilter()" style=""><span>Search</span></button>        
				</td>
			</tr>
			</tbody>
		</table>
	
		<table class="tablesorter" id="districtsGrid_table" cellspacing="0" style="width: 50%">
					<thead>
						<tr class="headings">
							<th><a class="not-sort" title="asc" name="name" href="#">SN</a></th>
							<th><a class="not-sort" title="asc" name="name" href="#">Zone</a></th>
							<th><a class="not-sort" title="asc" name="name" href="#">District Name</a></th>
							<th class="header">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i = 0;
						foreach ($districts as $district):
						$class = "even";
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
					?>
						<tr>
							<td class="a-center"><?php echo $district['District']['district_id']; ?></td>
							<td ><?php echo $this->Html->link($district['Zone']['zone_name'], array('controller' => 'zones', 'action' => 'view', $district['Zone']['zone_id'])); ?></td>
							<td ><?php echo $district['District']['district_name']; ?></td>
							<td >
								<?php echo $this->Html->link(__('View', true), array('action' => 'view', $district['District']['district_id'])); ?>
								<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $district['District']['district_id'])); ?>
								<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $district['District']['district_id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $district['District']['district_id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

		<script language="javascript">
		
			$(document).ready(function() { 
							    $("#districtsGrid_table").tablesorter({ 
		        // pass the headers argument and assing a object 
		        headers: { 
		            // assign the secound column (we start counting zero) 
		            3: {
		                // disable it by setting the property sorter to false 
		                sorter: false 
		            } 
		        } 
		    }); 
		});
		
</script>