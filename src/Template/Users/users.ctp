<h2>Users</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/users/add">Add User</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th>ID</th>
			<th>Username</th>
			<th class="actions">Actions</th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user->id; ?></td>
		<td><?php echo $user->username; ?></td>
		<td align="center" class="actions">
		<?php echo $this->Html->link('Edit', array('action' => 'user_edit', $user->id), array('class' => 'edit')); ?>&nbsp;
		<?php echo $this->Form->postLink('Delete', array('action' => 'user_delete', $user->id), array('confirm'=>'Are you sure you want to delete that article?', 'class' => 'delete')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php
$this->Paginator->options(array(
  'url' => array(
    'controller' => '',
	'action' => 'admin/users/archive'
  )
));
echo '<div class="pagination">';
echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'off'));
echo $this->Paginator->numbers(array('tag' => 'div','separator' => ''));
echo $this->Paginator->next(__('next', true).' >>', array(), array(), array('class' => 'off'));
echo '</div>';
?>