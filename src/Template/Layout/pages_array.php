<?php
$pages_array = array
(
    array(
        "Dashboard",
        "".BASE_URL."/admin",
        array('x'),
        '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'
    ),
    array(
        "Posts",
        "".BASE_URL."/admin/articles",
        array('admin/articles', 'admin/articles/add', 'admin/articles/edit'),
        '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'
    ),
    array(
        "Categories",
        "".BASE_URL."/admin/categories",
        array('admin/categories', 'admin/categories/add', 'admin/categories/edit'),
        '<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>'
    ),
    array(
        "Post Types",
        "".BASE_URL."/admin/posttype",
        array('admin/posttype', 'admin/posttype/add', 'admin/posttype/edit'),
        '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'
    ),
    array(
        "Pages",
        "".BASE_URL."/admin/pages",
        array('admin/pages', 'admin/pages/add', 'admin/pages/edit'),
        '<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>'
    ),
    array(
        "Navigation",
        "".BASE_URL."/admin/navigation",
        array('admin/navigation', 'admin/navigation/add', 'admin/navigation/edit'),
        '<span class="glyphicon glyphicon-link" aria-hidden="true"></span>'
    ),
    array(
        "Sidebar",
        "".BASE_URL."/admin/sidebar",
        array('admin/sidebar', 'admin/sidebar/add', 'admin/sidebar/edit'),
        '<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>'
    ),
    array(
        "Uploads",
        "".BASE_URL."/admin/uploads",
        array('admin/uploads', 'admin/uploads/add', 'admin/uploads/folder'),
        '<span class="glyphicon glyphicon-file" aria-hidden="true"></span>'
    ),
    array(
        "Instagram",
        "".BASE_URL."/admin/instagram",
        array('admin/instagram', 'admin/instagram/dump', 'admin/instagram/edit'),
        '<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>'
    ),
    array(
        "Users",
        "".BASE_URL."/admin/users",
        array('admin/users', 'admin/users/add', 'admin/users/edit'),
        '<span class="glyphicon glyphicon-user" aria-hidden="true"></span>'
    ),
    array(
        "Update",
        "".BASE_URL."/admin/update",
        array('admin/update'),
        '<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>'
    )
);