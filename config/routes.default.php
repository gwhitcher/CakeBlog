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
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

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
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'home']);

    $routes->connect('/*', ['controller' => 'Articles', 'action' => 'view']);

    $routes->connect('/blog/*', ['controller' => 'Articles', 'action' => 'index']);

    $routes->connect('/rss', ['controller' => 'Articles', 'action' => 'rss']);

    $routes->connect('/author/*', ['controller' => 'Author', 'action' => 'index']);

    $routes->connect('/category/*', ['controller' => 'Categories', 'action' => 'index']);

    $routes->connect('/search', ['controller' => 'Search', 'action' => 'index']);

    $routes->connect('/users/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/users/logout', ['controller' => 'Users', 'action' => 'logout']);

    $routes->connect('/admin', ['controller' => 'Admin', 'action' => 'index']);

    $routes->connect('/install', ['controller' => 'Install', 'action' => 'index']);

    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('admin', function ($routes) {
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added
    $routes->redirect('/users/login', BASE_URL.'/users/login', ['status' => 302]);
    $routes->redirect('/users/logout', BASE_URL.'/users/logout', ['status' => 302]);

    //Post type fallback for older PHP versions
    $routes->connect('/posttype', ['controller' => 'PostType', 'action' => 'index']);
    $routes->connect('/posttype/add', ['controller' => 'PostType', 'action' => 'add']);
    $routes->connect('/posttype/edit/*', ['controller' => 'PostType', 'action' => 'edit']);
    $routes->connect('/posttype/delete/*', ['controller' => 'PostType', 'action' => 'delete']);

    $routes->fallbacks(DashedRoute::class);
});

Plugin::routes();
