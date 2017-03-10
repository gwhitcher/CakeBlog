<h2>Articles</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/articles/add">Add Article</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Category</th>
			<th class="actions">Actions</th>
	</tr>
	<?php
	$i = 0;
	foreach ($articles as $article):
        $class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $article->id; ?></td>
		<td><?php echo $article->title; ?>&nbsp;</td>
		<td><?php echo $article->category->title; ?>&nbsp;</td>
		<td align="center" class="actions">
		<?php echo $this->Html->link('Edit', array('action' => 'article_edit', $article->id), array('class' => 'edit')); ?>&nbsp;
		<?php echo $this->Form->postLink('Delete', array('class' => 'delete','action' => 'article_delete', $article->id), array('confirm'=>'Are you sure you want to delete that article?', 'class' => 'delete')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php
$this->Paginator->options([
    'url' => [
        'controller' => 'admin/articles/archive'
    ]
]);
echo '<div class="pagination">';
echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'off'));
echo $this->Paginator->numbers(array('tag' => 'div','separator' => ''));
echo $this->Paginator->next(__('next', true).' >>', array(), array(), array('class' => 'off'));
echo '</div>';
?>