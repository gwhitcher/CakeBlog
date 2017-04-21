<?php include('pages_array.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="George Whitcher">
    <link rel="icon" href="<?php echo BASE_URL; ?>/favicon.ico">

    <title>Administration<?php if(!empty($title_for_layout)) { echo ' : '.$title_for_layout; } ?></title>

    <!-- Bootstrap -->
    <?= $this->Html->css('/resources/bootstrap/css/bootstrap.min.css'); ?>

    <!-- Custom -->
    <?= $this->Html->css('/css/admin.css'); ?>

    <!-- Jquery -->
    <?= $this->Html->script('/resources/jquery/jquery.js'); ?>

    <!--Jquery-UI-->
    <?= $this->Html->script('/resources/jquery-ui/jquery-ui.min.js'); ?>
    <?= $this->Html->css('/resources/jquery-ui/jquery-ui.css'); ?>

    <!--TinyMCE-->
    <?= $this->Html->script('/resources/tinymce/tinymce.min.js'); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?= $this->Flash->render() ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>/admin"><?php echo SITE_TITLE; ?> Administration</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach($pages_array as $page) { ?>
                            <li<?php nav_active_array($page[2]); ?>><a href="<?php echo $page[1]; ?>"><?php echo $page[3];?> <?php echo $page[0]; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="<?php echo BASE_URL; ?>" target="_blank">Visit Site</a></li>
                <li><a class="logout" href="<?php echo BASE_URL; ?>/users/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <?php foreach($pages_array as $page) { ?>
                    <li<?php nav_active_array($page[2]); ?>><a href="<?php echo $page[1]; ?>"><?php echo $page[3];?> <?php echo $page[0]; ?></a></li>
                <?php } ?>
            </ul>
            <footer>
                <p class="text-center">
                    &copy; Copyright 2016 - <?php echo date("Y"); ?>.
                    <br />
                    <?php echo SITE_TITLE; ?> is powered by <a href="//georgewhitcher.com/projects/cakeblog" target="_blank">CakeBlog</a>
                </p>
            </footer>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
<div class="advertisement">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Responsive -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-1862231357641748"
         data-ad-slot="1935611714"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<!-- Bootstrap -->
<?= $this->Html->script('/resources/bootstrap/js/bootstrap.min.js'); ?>
<!-- JS -->
<?= $this->Html->script('/js/admin.js'); ?>
</body>
</html>