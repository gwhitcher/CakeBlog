<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

class UpdaterController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //LOAD LAYOUT
        $this->layout = 'admin';
        //LOAD MODEL
        $this->loadModel('Updater');
    }
	
	public function updater() {
		$this->set('title_for_layout', 'Updater');
	}
	

	
}