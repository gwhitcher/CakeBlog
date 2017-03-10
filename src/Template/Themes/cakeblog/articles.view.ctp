<?php
if (!empty($article->featured)) {
    echo '<img class="featured img-responsive" src="'.$article->featured.'" title="'.$article->title.'" alt="'.$article->title.'">';
}
echo '<h1 class="page-header-top">'.$article->title.'</h1>';

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
echo '<div><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <a href="'.BASE_URL.'/'.$article->slug.'#comments">Leave your thoughts</a></div>';
echo '</div>';

$functions = new \App\Controller\ArticlesController();
$body1 = $functions->gallery($article->body);
$body2 = $functions->instagram($body1);
$body3 = $functions->shortcode($body2);
echo $body3;

echo '<div class="row container">';
echo '<div class="author_block">';
echo '<div class="panel panel-default">';
echo '<div class="panel-heading"><h3 class="panel-title">Article written by: <a href="'.BASE_URL.'/author/'.$article->user->username.'" title="Posts by '.$article->user->full_name.'" rel="author">'.$article->user->full_name.'</a></h3></div>';
echo '<div class="panel-body">';
if(!empty($article->user->profile_image)) { echo '<img class="img-responsive img-thumbnail pull-right author_image" src="'.$article->user->profile_image.'"/>'; }
echo $article->user->body;
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<a name="comments" id="comments"></a>';
echo CAKEBLOG_COMMENTS;