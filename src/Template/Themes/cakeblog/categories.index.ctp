<?php include('loop.carousel.php'); ?>
<h1 class="page-header"><?php echo $category->title; ?></h1>
<?php if(!empty($category->body)) { echo $category->body; } ?>
<div class="row">
    <div class="col-sm-8">
        <?php include('loop.php'); ?>
    </div>
    <div class="col-sm-4">
        <?php include('loop.sidebar.php'); ?>
    </div>
</div>