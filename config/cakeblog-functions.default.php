<?php
//Nav active
function nav_active_array($requestUri=array())
{
    $routing_uri = $_SERVER['REQUEST_URI'];
    foreach($requestUri as $ruri) {
        if (strpos($routing_uri, $ruri) !== FALSE)
            echo ' class="active"';
    }
}
function nav_active($page = NULL) {
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if($page == $url) {
        $class = ' class="active"';
    } else {
        $class = '';
    }
    return $class;
}

/* Drop down navigation */
function prepareList(array $items, $pid = 0) {
    $output = array();
    foreach ($items as $item) {
        if ((int) $item['parent_id'] == $pid) {
            if ($children = prepareList($items, $item['id'])) {
                $item['children'] = $children;
            }
            $output[] = $item;
        }
    }
    return $output;
}
function nav($menu_items, $child = false){
    $output = '';
    if (count($menu_items)>0) {
        $output .= ($child === false) ? '<ul class="nav navbar-nav">' : '<ul class="dropdown-menu">' ;
        foreach ($menu_items as $nav_item) {
            if(!empty($nav_item['target'])) {
                $nav_target = 'target="'.$nav_item['target'].'"';
            } else {
                $nav_target = "";
            }
            if(strpos($nav_item['url'], "http://") !== false OR strpos($nav_item['url'], "https://") !== false) {
                $nav_url = $nav_item['url'];
            } else {
                $nav_url = "".BASE_URL."".$nav_item['url']."";
            }

            //check if there are any children
            if (isset($nav_item['children']) && count($nav_item['children'])) {
                $children = 1;
            } else {
                $children = 0;
            }

            if($children == 1) {
                $output .= '<li class="dropdown">';
                $output .= '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="'.$nav_url.'" '.$nav_target.'>'.$nav_item['title'].' <span class="caret"></span></a>';
            } else {
                $output .= '<li'.nav_active($nav_url).'>';
                $output .= '<a href="'.$nav_url.'" '.$nav_target.'>'.$nav_item['title'].'</a>';
            }

            //loop
            if ($children == 1) {
                $output .= nav($nav_item['children'], true);
            }

            $output .= '</li>';

        }
        $output .= '</ul>';
    }
    return $output;
}

//Increase PHP session duration
ini_set('session.gc_maxlifetime', 86400); //86400 = 24hrs