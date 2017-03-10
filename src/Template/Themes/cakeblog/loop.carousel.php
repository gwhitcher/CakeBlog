<?php
if($slider_articles->count() > 0) {
    echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
    echo '<ol class="carousel-indicators">';
    $i = 0;
    foreach($slider_articles as $slider_article) {
        if($i == 0) {
            echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
        } else {
            echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
        }
        $i++;
    }
    echo '</ol>';

    echo '<div class="carousel-inner" role="listbox">';
    $i = 1;
    foreach ($slider_articles as $slider_article):
        $item_class = ($i == 1) ? 'item active' : 'item';
        echo '<div class="'.$item_class.'" style="background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('.$slider_article->featured.'); background-repeat: no-repeat; background-size: 100%; background-position: 50%;">';
        echo '<a href="'.BASE_URL.'/'.$slider_article->slug.'">';
        echo '<img class="img-responsive center-block" src="'.$slider_article->featured.'" />';
        echo '<div class="container">';
        echo '<div class="carousel-caption">';
        echo '<h1>'.$slider_article->title.'</h1>';
        $body = substr($slider_article->body,0,50);
        echo strip_tags($body, '<br>').'...';
        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
        $i++;
    endforeach;
    echo '</div>';

    echo '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>';
    echo '<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>';
    echo '</div>';
}