<?php 
if(!empty($article->metadescription)) {
	$this->assign('metadescription', $article->metadescription);
}
if(!empty($article->metakeywords)) {
	$this->assign('metakeywords', $article->metakeywords);
}
?>
<article>
<?php 
if(!empty($article->featured)) {
	echo '<a href="'.Configure::read('BASE_URL').'/'.$article->id.'/'.$article->slug.'"><img class="featured" src="'.Configure::read('BASE_URL').'/img/articles/featured/'.$article->featured.'" title="'.$article->title.'" alt="'.$article->title.'"></a>';
}
?>
<h2><?php echo $article->title; ?></h2>
<?php echo $article->body; ?>
</article>