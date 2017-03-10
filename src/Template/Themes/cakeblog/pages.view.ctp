<h1 class="page-header-top"><?php echo $page->title; ?></h1>
<?php
$functions = new \App\Controller\ArticlesController();
$body1 = $functions->gallery($page->body);
$body2 = $functions->instagram($body1);
$body3 = $functions->shortcode($body2);
echo $body3;