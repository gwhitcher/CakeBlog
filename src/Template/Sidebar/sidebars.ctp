<h2>Sidebars</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/sidebars/add">Add Sidebar</a>
<ul id="my-list">
<li>
<div id="column_head">ID</div>
<div id="column_head">NAME</div>
<div id="column_head">&nbsp;</div>
<div id="column_head">ACTIONS</div>
</li>
<?php 
$i = 0;
foreach ($sidebars as $sidebar):
$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		} else {
			$class = ' class="row"';
		}?>
<li id="item_<?php echo $sidebar->id; ?>"<?php echo $class;?>>
<div id="column">
<?php echo $sidebar->id; ?>
</div>
<div id="column">
<?php echo $sidebar->title; ?>
</div>
<div id="column">
&nbsp;
</div>
<div id="column" class="center actions">
<?php echo $this->Html->link('Edit', array('action' => 'sidebar_edit', $sidebar->id), array('class' => 'edit')); ?>&nbsp;
<?php echo $this->Form->postLink('Delete', array('action' => 'sidebar_delete', $sidebar->id), array('confirm'=>'Are you sure you want to delete that sidebar?', 'class' => 'delete')); ?>
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
                url: '<?php echo Configure::read('BASE_URL');?>/admin/sidebars/reorder'
            });

        }
    });
</script>