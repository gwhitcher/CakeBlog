<?php
#GENERAL SETTINGS
define('BASE_URL', 'http://localhost/cakeblog');
define('SITE_TITLE', 'CakeBlog');
define('SITE_DESCRIPTION', 'A blogging software written in CakePHP.');
define('SITE_KEYWORDS', 'cakeblog, cakephp, georgewhitcher');
define('SITE_AUTHOR', 'George Whitcher');
define('CAKEBLOG_THEME', 'cakeblog');
define('ADMIN_EMAIL', 'email@domain.com');

#ARTICLES
define('ARTICLES_PER_PAGE', 5);
define('SLIDER_ARTICLES_PER_PAGE', 3);

#INSTAGRAM(not required)
define('INSTAGRAM_ACCESS_TOKEN', '');
define('INSTAGRAM_USER_ID', '');

#COMMENTS - DISQUS: http://disqus.com Replace "EXAMPLE" with the ID given with the UNIVERSAL CODE.
define('CAKEBLOG_COMMENTS', '<div id="disqus_thread"></div>
<script>
    (function() {  // DON\'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement(\'script\');

        s.src = \'//EXAMPLE.disqus.com/embed.js\';

        s.setAttribute(\'data-timestamp\', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>');

include("cakeblog-functions.php");