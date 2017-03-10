<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {


    /* BLOG */
    $routes->connect('/', array('controller' => 'Blog', 'action' => 'home'));
    $routes->connect('/archive/*', array('controller' => 'Blog', 'action' => 'home'));
    $routes->connect('/:id/*', array('controller' => 'Blog', 'action' => 'article_view'), array('pass' => array('id', 'slug'), 'id' => '[0-9]+'));
    $routes->connect('/category/:id/*', array('controller' => 'Blog', 'action' => 'categories'), array('pass' => array('id', 'slug'), 'id' => '[0-9]+'));
    $routes->connect('/category/archive/:id/*', array('controller' => 'Blog', 'action' => 'categories'), array('pass' => array('id', 'slug'), 'id' => '[0-9]+'));
    $routes->connect('/rss', array('controller' => 'Blog', 'action' => 'rss'));
    $routes->connect('/rss.rss', array('controller' => 'Blog', 'action' => 'rss'));

    /** CONTACT **/
    $routes->connect('/contact', array('controller' => 'Contact', 'action' => 'contact'));
    $routes->connect('/contact/captcha_image', array('controller' => 'Contact', 'action' => 'captcha_image'));

    /** ADMIN MAIN & USER **/
    $routes->connect('/admin', array('controller' => 'Users', 'action' => 'dashboard'));
    $routes->connect('/users/login', array('controller' => 'Users', 'action' => 'login'));
    $routes->connect('/admin/logout', array('controller' => 'Users', 'action' => 'logout'));
    $routes->connect('/admin/users', array('controller' => 'Users', 'action' => 'users'));
    $routes->connect('/admin/users/archive/*', array('controller' => 'Users', 'action' => 'users'));
    $routes->connect('/admin/users/add', array('controller' => 'Users', 'action' => 'user_add'));
    $routes->connect('/admin/users/edit/*', array('controller' => 'Users', 'action' => 'user_edit'));
    $routes->connect('/admin/users/delete/*', array('controller' => 'Users', 'action' => 'user_delete'));
    $routes->connect('/admin/users/view/*', array('controller' => 'Users', 'action' => 'user_view'));

    /* ARTICLES */
    $routes->connect('/admin/articles', array('controller' => 'Articles', 'action' => 'articles'));
    $routes->connect('/admin/articles/archive/*', array('controller' => 'Articles', 'action' => 'articles'));
    $routes->connect('/admin/articles/add', array('controller' => 'Articles', 'action' => 'article_add'));
    $routes->connect('/admin/articles/edit/*', array('controller' => 'Articles', 'action' => 'article_edit'));
    $routes->connect('/admin/articles/delete/*', array('controller' => 'Articles', 'action' => 'article_delete'));

    /* CATEGORIES */
    $routes->connect('/admin/categories', array('controller' => 'Categories', 'action' => 'categories'));
    $routes->connect('/admin/categories/archive/*', array('controller' => 'Categories', 'action' => 'categories'));
    $routes->connect('/admin/categories/add', array('controller' => 'Categories', 'action' => 'category_add'));
    $routes->connect('/admin/categories/edit/*', array('controller' => 'Categories', 'action' => 'category_edit'));
    $routes->connect('/admin/categories/delete/*', array('controller' => 'Categories', 'action' => 'category_delete'));

    /* PAGES */
    $routes->connect('/admin/pages', array('controller' => 'Pages', 'action' => 'pages'));
    $routes->connect('/admin/pages/archive/*', array('controller' => 'Pages', 'action' => 'pages'));
    $routes->connect('/admin/pages/add', array('controller' => 'Pages', 'action' => 'page_add'));
    $routes->connect('/admin/pages/edit/*', array('controller' => 'Pages', 'action' => 'page_edit'));
    $routes->connect('/admin/pages/delete/*', array('controller' => 'Pages', 'action' => 'page_delete'));

    /* SIDEBARS */
    $routes->connect('/admin/sidebars', array('controller' => 'Sidebar', 'action' => 'sidebars'));
    $routes->connect('/admin/sidebars/archive/*', array('controller' => 'Sidebar', 'action' => 'sidebars'));
    $routes->connect('/admin/sidebars/add', array('controller' => 'Sidebar', 'action' => 'sidebar_add'));
    $routes->connect('/admin/sidebars/edit/*', array('controller' => 'Sidebar', 'action' => 'sidebar_edit'));
    $routes->connect('/admin/sidebars/delete/*', array('controller' => 'Sidebar', 'action' => 'sidebar_delete'));
    $routes->connect('/admin/sidebars/reorder/*', array('controller' => 'Sidebar', 'action' => 'sidebar_reorder'));

    /* NAVIGATION */
    $routes->connect('/admin/navigation', array('controller' => 'Navigation', 'action' => 'navigation'));
    $routes->connect('/admin/navigation/archive/*', array('controller' => 'Navigation', 'action' => 'navigation'));
    $routes->connect('/admin/navigation/add', array('controller' => 'Navigation', 'action' => 'navigation_add'));
    $routes->connect('/admin/navigation/edit/*', array('controller' => 'Navigation', 'action' => 'navigation_edit'));
    $routes->connect('/admin/navigation/delete/*', array('controller' => 'Navigation', 'action' => 'navigation_delete'));
    $routes->connect('/admin/navigation/reorder/*', array('controller' => 'Navigation', 'action' => 'navigation_reorder'));

    /* UPDATER */
    $routes->connect('/admin/updater', array('controller' => 'Updater', 'action' => 'updater'));

    /* AUTOLOAD PAGES */
    $routes->connect('/*', array('controller' => 'Pages', 'action' => 'load_pages'));

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `InflectedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('InflectedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();

/* EXTENSIONS */
Router::extensions('rss');