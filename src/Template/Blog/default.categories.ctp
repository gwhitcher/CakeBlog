<?php 
if(!empty($category->metadescription)) {
	$this->assign('metadescription', $category->metadescription);
}
if(!empty($category->metakeywords)) {
	$this->assign('metakeywords',$category->metakeywords);
}
?>
<?php 
	foreach($articles as $article):
		echo '<article>';
		if(!empty($article->featured)) {
			echo '<a href="'.Configure::read('BASE_URL').'/'.$article->id.'/'.$article->slug.'"><img class="featured" src="'.Configure::read('BASE_URL').'/img/articles/featured/'.$article->featured.'" title="'.$article->title.'" alt="'.$article->title.'"></a>';
		}
		echo '<h2><a href="'.Configure::read('BASE_URL').'/'.$article->id.'/'.$article->slug.'">'.$article->title.'</a></h2>';
		$body = substr($article->body,0,300);
		echo ''.strip_tags($body, '<br>').'...';
		echo '<div class="readmore"><a href="'.Configure::read('BASE_URL').'/'.$article->id.'/'.$article->slug.'">Read More</a></div>';
		echo '</article>';
	endforeach;
?>
<?php
$this->Paginator->options([
    'url' => [
        'controller' => 'category/archive/'.$category->id.'/'.$category->slug.''
    ]
]);
echo '<div class="pagination">';
echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'off'));
echo $this->Paginator->numbers(array('tag' => 'div','separator' => ''));
echo $this->Paginator->next(__('next', true).' >>', array(), array(), array('class' => 'off'));
echo '</div>';
?>