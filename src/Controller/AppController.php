<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'admin',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Blog',
                'action' => 'home'
            ]
        ]);
        $this->set('current_user', $this->Auth->user());
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //LOAD LAYOUT
        $this->layout = Configure::read('cakeblog_theme');
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        //ALLOW CONTROLLER ACTIONS
        $this->Auth->allow('load_pages', 'home', 'article_view', 'rss', 'categories', 'contact', 'captcha_image');

        $this->loadModel('Navigation');
        $this->set('main_navigation', $main_navigation = $this->Navigation->find('all', array('order' => 'position ASC')));

        $this->loadModel('Sidebar');
        $this->set('main_sidebar', $main_sidebar = $this->Sidebar->find('all', array('order' => 'position ASC')));

        $this->loadModel('Categories');
        $this->set('sidebar_categories', $sidebar_categories = $this->Categories->find('all', array('order' => 'title ASC')));
    }
}
