<h2>Categories</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/categories/add">Add Category</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th>ID</th>
			<th>Title</th>
			<th class="actions">Actions</th>
	</tr>
	<?php
	$i = 0;
	foreach ($categories as $category):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $category->id; ?></td>
		<td><?php echo $category->title; ?>&nbsp;</td>
		<td align="center" class="actions">
		<?php echo $this->Html->link('Edit', array('action' => 'category_edit', $category->id), array('class' => 'edit')); ?>&nbsp;
		<?php echo $this->Form->postLink('Delete', array('action' => 'category_delete', $category->id), array('confirm'=>'Are you sure you want to delete that category?', 'class' => 'delete')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php
$this->Paginator->options([
    'url' => [
        'controller' => 'admin/categories/archive'
    ]
]);
echo '<div class="pagination">';
echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'off'));
echo $this->Paginator->numbers(array('tag' => 'div','separator' => ''));
echo $this->Paginator->next(__('next', true).' >>', array(), array(), array('class' => 'off'));
echo '</div>';
?>