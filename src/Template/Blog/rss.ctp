<?php
$this->set('channelData', [
    'title' => __(Configure::read('site_title')),
    'link' => Configure::read('BASE_URL'),
    'description' => __(Configure::read('sub_title')),
    'language' => 'en-us'
]);

foreach ($articles as $article) {
    $postTime = strtotime($article['Article']['created_at']);

    $postLink = ''.Configure::read('BASE_URL').'/'.$article['Article']['id'].'/'.$article['Article']['slug'].'';

    // Remove & escape any HTML to make sure the feed content will validate.
    $bodyText = h(strip_tags($article['Article']['body']));
    $bodyText = $this->Text->truncate($bodyText, 400, [
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    ]);

    echo  $this->Rss->item([], [
        'title' => $article['Article']['title'],
        'link' => $postLink,
        'guid' => ['url' => $postLink, 'isPermaLink' => 'true'],
        'description' => $bodyText,
        'pubDate' => $article['Article']['created_at']
    ]);
}