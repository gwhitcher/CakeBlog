<?php
foreach($sidebars as $sidebar) {
    echo '<h2>'.$sidebar->title.'</h2>';
    echo eval('?>'.$sidebar->body);
}