<?php
/* DROP DOWN NAV FUNCTIONS */
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
        $output .= ($child === false) ? '<ul>' : '<ul>' ;

        foreach ($menu_items as $nav_item) {
            if(!empty($nav_item['target'])) {
                $nav_target = 'target="'.$nav_item['target'].'"';
            } else {
                $nav_target = "";
            }
            if(strpos($nav_item['url'], "http://") !== false OR strpos($nav_item['url'], "https://") !== false) {
                $nav_url = $nav_item['url'];
            } else {
                $nav_url = "".Configure::read('BASE_URL')."".$nav_item['url']."";
            }
            $output .= '<li>';
            $output .= '<a href="'.$nav_url.'" '.$nav_target.'>'.$nav_item['title'].'</a>';

            //check if there are any children
            if (isset($nav_item['children']) && count($nav_item['children'])) {
                $output .= nav($nav_item['children'], true);
            }
            $output .= '</li>';
        }
        $output .= '</ul>';
    }
    return $output;
}