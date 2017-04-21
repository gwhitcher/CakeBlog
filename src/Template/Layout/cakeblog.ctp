<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if(!empty($title_for_layout)) {
            echo $title_for_layout.' : '.SITE_TITLE;
        } else {
            echo SITE_TITLE.' : '.SITE_DESCRIPTION;
        }
        ?>
    </title>
    <?php
    if(!empty($description_for_layout)) {
        echo '<meta name="description" content="'.$description_for_layout.'">';
    } else {
        echo '<meta name="description" content="'.SITE_DESCRIPTION.'">';
    }
    ?>
    <?php
    if(!empty($keywords_for_layout)) {
        echo '<meta name="keywords" content="'.$keywords_for_layout.'">';
    } else {
        echo '<meta name="keywords" content="'.SITE_KEYWORDS.'">';
    }
    ?>
    <?php
    if(!empty($author_for_layout)) {
        echo '<meta name="author" content="'.$author_for_layout.'">';
    } else {
        echo '<meta name="author" content="'.SITE_AUTHOR.'">';
    }
    ?>
    <link rel="icon" href="<?php echo BASE_URL; ?>/favicon.ico">

    <!-- Bootstrap -->
    <?= $this->Html->css('/resources/bootstrap/css/bootstrap.min.css'); ?>

    <!-- Custom -->
    <?= $this->Html->css('/css/cakeblog.css'); ?>

    <!-- Jquery -->
    <?= $this->Html->script('/resources/jquery/jquery.js'); ?>

    <!--Jquery-UI-->
    <?= $this->Html->script('/resources/jquery-ui/jquery-ui.min.js'); ?>
    <?= $this->Html->css('/resources/jquery-ui/jquery-ui.css'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link rel="alternate" type="application/rss+xml" title="RSS Feed for <?php echo SITE_TITLE; ?>" href="<?php echo BASE_URL; ?>/rss" />
</head>
<body>

<div class="container main-container">
    <header class="header">
        <div class="row">
            <div class="col-sm-6">
                <h1><a href="<?php echo BASE_URL; ?>"><?php echo SITE_TITLE; ?></a></h1>
            </div>
            <div class="col-sm-6">
                <h2><?php echo SITE_DESCRIPTION; ?></h2>
            </div>
        </div>
    </header>

    <!-- navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            <?php
            $nav_array = array();
            if(isset($main_navigation) && !is_null($main_navigation)) {
                foreach ($main_navigation as $nav_item) {
                    $nav_array[] = array('id' => $nav_item->id, 'parent_id' => $nav_item->parent_id, 'url' => $nav_item->url, 'target' => $nav_item->target, 'title' => $nav_item->title, 'position' => $nav_item->position);
                }
                $tree = prepareList($nav_array);
                echo nav($tree);
            } else {
                echo '<ul class="nav navbar-nav">';
                echo '<li class="active"><a href="'.BASE_URL.'/install">Install</a></li>';
                echo '</ul>';
            }
            ?>
            </div>
        </div>
    </nav>

    <section class="content <?php echo $this->request->params['controller']; echo ' '; echo $this->request->params['action']; ?>">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </section>

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

    <footer>
        <p class="text-center">
            &copy; Copyright 2016 - <?php echo date("Y"); ?>.
            <br />
            <?php echo SITE_TITLE; ?> is powered by <a href="//georgewhitcher.com/projects/cakeblog" target="_blank">CakeBlog</a>
        </p>
    </footer>

</div>
<!-- Bootstrap -->
<?= $this->Html->script('/resources/bootstrap/js/bootstrap.min.js'); ?>
<!-- JS -->
<?= $this->Html->script('/js/cakeblog.js'); ?>
</body>
</html>
