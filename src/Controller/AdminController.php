<?php
// src/Controller/AdminController.php

namespace App\Controller;

use Cake\Event\Event;

class AdminController extends AppController {

    public function beforeFilter(Event $event){
        //Deny if not logged in
        parent::beforeFilter($event);
        $this->Auth->deny();

        //Layout
        $this->viewBuilder()->layout('admin');
    }

    public function index() {
        $this->set('title_for_layout', 'Dashboard');
    }


}