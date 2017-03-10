<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

class NavigationController extends AppController {

    public $helpers = ['Text'];

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
        $this->loadModel('Navigation');
    }
   
    /* ADMINISTRATION */
	public function navigation() {
        $this->set('title_for_layout', 'Navigation');
        $this->set('navigation', $this->Navigation->find('all',array('order' => 'position ASC')));
    }

    public function navigation_add() {
        $this->set('title_for_layout', 'Add Navigation Item');
		//LOAD EXISTING NAV ITEMS FOR SUBMENU
		$existing_navigation = $this->Navigation->find('list');
		$this->set(compact('existing_navigation'));
        $navigation = $this->Navigation->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Navigation->save($navigation)) {
                $this->Flash->success(__('The navigation item has been saved.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/navigation");
            }
            $this->Flash->error(__('Unable to add navigation item.'));
        }
        $this->set('navigation', $navigation);
    }

    public function navigation_edit($id = null) {
		//LOAD EXISTING NAV ITEMS FOR SUBMENU
		$existing_navigation = $this->Navigation->find('list');
		$this->set(compact('existing_navigation'));

        $navigation = $this->Navigation->get($id);
        $this->set('title_for_layout', $navigation->title);
        if (empty($navigation)) {
            throw new NotFoundException('Could not find that navigation item.');
        }
        else {
            $this->set(compact('navigation'));
        }
        if ($this->request->is(['post', 'put'])) {
            $this->Navigation->patchEntity($navigation, $this->request->data);
            if ($this->Navigation->save($navigation)) {
                $this->Flash->success(__('The navigation item has been updated.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/navigation");
            }
            $this->Flash->error(__('Unable to edit navigation item.'));
        }
    }

    public function navigation_delete($id = null) {
        $this->set('title_for_layout', 'Delete Navigation Item');
        $this->request->allowMethod(['post', 'delete']);

        $navigation = $this->Navigation->get($id);
        if ($this->Navigation->delete($navigation)) {
            $this->Flash->success(__('The navigation item with id: {0} has been deleted.', h($id)));
            return $this->redirect("".Configure::read('BASE_URL')."/admin/navigation");
        }
    }
	
	public function navigation_reorder() {
        foreach ($_POST['item'] as $key => $value) {
            $navigation_items = TableRegistry::get('Navigation');
            $navigation_item = $navigation_items->find('all')->where(['id' => $value])->first();
            $navigation_item->position = $key + 1;
            $navigation_items->save($navigation_item);
        }
        exit();
	}
	
}