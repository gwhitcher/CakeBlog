<h1>Administration</h1>
</br>
<?php if(!empty($articles)) { ?>
<h2>Articles</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/articles/add">Add Article</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th width="20%">ID</th>
			<th width="60%">Title</th>
			<th width="20%" class="actions">Actions</th>
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
		<td align="center"><?php echo $article->id; ?></td>
		<td align="center"><?php echo $article->title; ?>&nbsp;</td>
		<td align="center" class="actions">
            <a class="edit" href="<?php echo Configure::read('BASE_URL');?>/admin/articles/edit/<?php echo $article->id; ?>">Edit</a>
            <a class="delete" href="<?php echo Configure::read('BASE_URL');?>/admin/articles/delete/<?php echo $article->id; ?>">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</br>
<?php } ?>
<?php if(!empty($categories)) { ?>
<h2>Categories</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/categories/add">Add Category</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th width="20%">ID</th>
			<th width="60%">Title</th>
			<th width="20%" class="actions">Actions</th>
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
		<td align="center"><?php echo $category->id; ?></td>
		<td align="center"><?php echo $category->title; ?>&nbsp;</td>
		<td align="center" class="actions">
            <a class="edit" href="<?php echo Configure::read('BASE_URL');?>/admin/categories/edit/<?php echo $category->id; ?>">Edit</a>
            <a class="delete" href="<?php echo Configure::read('BASE_URL');?>/admin/categories/delete/<?php echo $category->id; ?>">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</br>
<?php } ?>
<?php if(!empty($pages)) { ?>
<h2>Pages</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/pages/add">Add Page</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th width="20%">ID</th>
			<th width="60%">Title</th>
			<th width="20%" class="actions">Actions</th>
	</tr>
	<?php
	$i = 0;
	foreach ($pages as $page):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td align="center"><?php echo $page->id; ?></td>
		<td align="center"><?php echo $page->title; ?>&nbsp;</td>
		<td align="center" class="actions">
            <a class="edit" href="<?php echo Configure::read('BASE_URL');?>/admin/pages/edit/<?php echo $page->id; ?>">Edit</a>
            <a class="delete" href="<?php echo Configure::read('BASE_URL');?>/admin/pages/delete/<?php echo $page->id; ?>">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</br>
<?php } ?>
<?php if(!empty($sidebars)) { ?>
<h2>Sidebars</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/sidebars/add">Add Page</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th width="20%">ID</th>
			<th width="60%">Title</th>
			<th width="20%" class="actions">Actions</th>
	</tr>
	<?php
	$i = 0;
	foreach ($sidebars as $sidebar):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td align="center"><?php echo $sidebar->id; ?></td>
		<td align="center"><?php echo $sidebar->title; ?>&nbsp;</td>
		<td align="center" class="actions">
            <a class="edit" href="<?php echo Configure::read('BASE_URL');?>/admin/sidebars/edit/<?php echo $sidebar->id; ?>">Edit</a>
            <a class="delete" href="<?php echo Configure::read('BASE_URL');?>/admin/sidebars/delete/<?php echo $sidebar->id; ?>">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</br>
<?php } ?>
<?php if(!empty($navigation)) { ?>
<h2>Navigation</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/navigation/add">Add Navigation</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th width="20%">ID</th>
			<th width="60%">Title</th>
			<th width="20%" class="actions">Actions</th>
	</tr>
	<?php
	$i = 0;
	foreach ($navigation as $navigation_item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td align="center"><?php echo $navigation_item->id; ?></td>
		<td align="center"><?php echo $navigation_item->title; ?>&nbsp;</td>
		<td align="center" class="actions">
            <a class="edit" href="<?php echo Configure::read('BASE_URL');?>/admin/navigation/edit/<?php echo $navigation_item->id; ?>">Edit</a>
            <a class="delete" href="<?php echo Configure::read('BASE_URL');?>/admin/navigation/delete/<?php echo $navigation_item->id; ?>">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</br>
<?php } ?>
<?php if(!empty($users)) { ?>
<h2>Users</h2>
<a class="floatright add_item" href="<?php echo Configure::read('BASE_URL');?>/admin/users/add">Add User</a>
	<table width="100%" cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th width="20%">ID</th>
			<th width="60%">Title</th>
			<th width="20%" class="actions">Actions</th>
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
		<td align="center"><?php echo $user->id; ?></td>
		<td align="center"><?php echo $user->username; ?>&nbsp;</td>
		<td align="center" class="actions">
            <a class="edit" href="<?php echo Configure::read('BASE_URL');?>/admin/users/edit/<?php echo $user->id; ?>">Edit</a>
            <a class="delete" href="<?php echo Configure::read('BASE_URL');?>/admin/users/delete/<?php echo $user->id; ?>">Delete</a>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php } ?>