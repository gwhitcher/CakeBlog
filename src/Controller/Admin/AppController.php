<?php
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller {

    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth');
        $this->set('current_user', $this->Auth->user());

        //Layout
        $this->viewBuilder()->layout('admin');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //Deny all admin pages if not logged in
        $this->Auth->deny();
    }
}
