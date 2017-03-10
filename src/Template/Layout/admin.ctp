<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title>Administration: <?php echo Configure::read('site_title');?> - <?php echo $title_for_layout; ?></title>
<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('admin');
	echo $this->Html->script('jquery');
    echo $this->Html->script('jquery-ui');
	echo $this->Html->script('sorttable');
	echo $this->Html->script('tinymce/tinymce.min.js');
	echo $this->Html->script('default');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
</head>
<body>
	<div id="container">
    <div id="container_padding">
		<header id="header">
			<h1><?php echo Configure::read('site_title');?></h1>
            <h2><?php echo Configure::read('sub_title');?></h2>
		</header>
        <nav id="nav">
        <ul>
        	<li><a href="<?php echo Configure::read('BASE_URL');?>/">Home</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin">Administration Home</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/articles">Articles</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/categories">Categories</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/pages">Pages</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/sidebars">Sidebar</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/navigation">Navigation</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/users">Users</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/updater">Update</a></li>
            <li><a href="<?php echo Configure::read('BASE_URL');?>/admin/logout">Logout</a></li>
        </ul>
        </nav>
		<section id="content">
        <div id="container_padding">
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->fetch('content'); ?>
		</div>
        </section>
		<footer id="footer">
		<p>CakeBlog: <?php echo Configure::read('cakeblog_version');?> <a href="http://cakephp.org" target="_blank">CakePHP</a>: <?php echo Configure::version(); ?></p>
		</footer>
	</div></div>
</body>
</html>
