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
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        //Users
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Admin',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
        $current_user = $this->Auth->user();
        $this->set(compact('current_user'));

        //Layout
        $this->viewBuilder()->layout(CAKEBLOG_THEME);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        if ($this->request->params['controller'] != 'Install') {
            $this->loadNavigation();
            $this->loadSidebars();
        }
    }

    public function loadNavigation() {
        //Load navigation items
        $this->loadModel('Navigation');
        $this->set('main_navigation', $main_navigation = $this->Navigation->find('all', array('order' => 'position ASC')));
    }

    public function loadSidebars() {
        //Load sidebars
        $this->loadModel('Sidebar');
        $this->set('sidebars', $sidebars = $this->Sidebar->find('all', array('order' => 'position ASC')));
        //Load categories for sidebar into array that also counts posts
        $this->loadModel('Categories');
        $sidebar_categories = $this->Categories->find('all', array('order' => 'id DESC'));
        $cat_array = array();
        foreach ($sidebar_categories as $sidebar_category) {
            $cat_controller = new CategoriesController();
            $post_count = $cat_controller->count_posts_in_category($sidebar_category->id);

            $cat_array[] = array('id' => $sidebar_category->id, 'post_type_id' => $sidebar_category->post_type_id, 'title' => $sidebar_category->title, 'slug' => $sidebar_category->slug, 'count' => $post_count);
        }
        $this->set(compact('cat_array'));
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        /* AUTHENTICATION */
        $this->Auth->allow();
    }
}
