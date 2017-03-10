<?php
if($articles->count() > 0) {
    foreach ($articles as $article):
        echo '<div class="post">';
        echo '<article>';
        if (!empty($article->featured)) {
            echo '<a href="'.BASE_URL.'/'.$article->slug.'"><img class="featured img-responsive" src="'.$article->featured.'" title="'.$article->title.'" alt="'.$article->title.'"></a>';
        }
        echo '<h2 class="page-header"><a href="'.BASE_URL.'/'.$article->slug.'">'.$article->title.'</a></h2>';

        echo '<div class="post-details">';
        echo '<div><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posted in ';
        $cat_count = 0;
        foreach($article->categories as $category) {
            $cat_count++;
            echo '<a href="'.BASE_URL.'/category/'.$category->slug.'">'.$category->title.'</a>';
            if ($cat_count < count($article->categories)) {
                echo ', ';
            }
        }
        echo '</div>';
        echo '<div><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ' . date_format($article->created_at, "F j, Y h:i:s A") . '</div>';
        echo '<div><span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span> Published by <a href="'.BASE_URL.'/author/'.$article->user->username.'" title="Posts by '.$article->user->full_name.'" rel="author">'.$article->user->full_name.'</a></div>';
        echo '<div><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <a href="' . BASE_URL.'/'.$article->slug . '#comments">Leave your thoughts</a></div>';
        echo '</div>';
        $body = substr($article->body, 0, 300);
        echo strip_tags($body, '<br>').'...';
        echo '<div class="readmore"><a href="'.BASE_URL.'/'.$article->slug.'">Read More</a></div>';
        echo '</article>';
        echo '</div>';
    endforeach;

    echo '<ul class="pagination">';
    echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
    echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo '</ul>';
} else {
    echo '<p>No articles to be shown.</p>';
}