<?php include('loop.carousel.php'); ?>
<h1 class="page-header"><?php echo $post_type->title; ?></h1>
<?php if(!empty($post_type->body)) { echo $post_type->body; } ?>
<div class="row">
    <div class="col-sm-8">
        <?php include('loop.php'); ?>
    </div>
    <div class="col-sm-4">
        <?php include('loop.sidebar.php'); ?>
    </div>
</div>