<h2>Navigation</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/navigation/add">Add Navigation Item</a>
<ul id="my-list">
<li>
<div id="column_head">ID</div>
<div id="column_head">NAME</div>
<div id="column_head">URL</div>
<div id="column_head">ACTIONS</div>
</li>
<?php 
$i = 0;
foreach ($navigation as $navigation_item):
$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		} else {
			$class = ' class="row"';
		}?>
<li id="item_<?php echo $navigation_item->id; ?>"<?php echo $class;?>>
<div id="column">
<?php echo $navigation_item->id; ?>
</div>
<div id="column">
<?php echo $navigation_item->title; ?>
</div>
<div id="column">
<?php echo $navigation_item->url; ?>
</div>
<div id="column" class="center actions">
<?php echo $this->Html->link('Edit', array('action' => 'navigation_edit', $navigation_item->id), array('class' => 'edit')); ?>&nbsp;
<?php echo $this->Form->postLink('Delete', array('action' => 'navigation_delete', $navigation_item->id), array('confirm'=>'Are you sure you want to delete that navigation item?', 'class' => 'delete')); ?>
</div>
</li>
<?php endforeach; ?>
</ul>
<script type="text/javascript">
    $('#my-list').sortable({
        axis: 'y',
        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            var success = alert("Order Saved");

            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'POST',
                success: success,
                url: '<?php echo Configure::read('BASE_URL');?>/admin/navigation/reorder'
            });

        }
    });
</script>