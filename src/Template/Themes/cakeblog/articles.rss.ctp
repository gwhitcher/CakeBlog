<?php
$this->set('channelData', [
    'title' => SITE_TITLE,
    'link' => SITE_TITLE,
    'description' => SITE_DESCRIPTION,
    'language' => 'en-us'
]);
foreach ($articles as $article) {
    $postTime = strtotime($article->created_at);
    $postLink = BASE_URL.'/'.$article->id.'/'.$article->slug.'';
    // Remove & escape any HTML to make sure the feed content will validate.
    $body = substr($article->body,0,300);
    $bodyText = strip_tags($body, '<br>').'...';
    echo  $this->Rss->item([], [
        'title' => $article->title,
        'link' => $postLink,
        'guid' => ['url' => $postLink, 'isPermaLink' => 'true'],
        'description' => $bodyText,
        'pubDate' => $article->created_at
    ]);
}