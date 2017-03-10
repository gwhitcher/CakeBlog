<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class SidebarController extends AppController {

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
        $this->loadModel('Sidebar');
    }

	public function sidebars() {
        $this->set('title_for_layout', 'Sidebars');
        $this->set('sidebars', $this->Sidebar->find('all',array('order' => 'position ASC')));
    }

    public function sidebar_add() {
        $this->set('title_for_layout', 'Add Sidebar');
        $sidebar = $this->Sidebar->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Sidebar->save($sidebar)) {
                $this->Flash->success(__('The sidebar item has been saved.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/sidebars");
            }
            $this->Flash->error(__('Unable to add sidebar item.'));
        }
        $this->set('sidebar', $sidebar);
    }

    public function sidebar_edit($id = null) {
        $sidebar = $this->Sidebar->get($id);
        $this->set('title_for_layout', $sidebar->title);
        if (empty($sidebar)) {
            throw new NotFoundException('Could not find that sidebar item.');
        }
        else {
            $this->set(compact('sidebar'));
        }
        if ($this->request->is(['post', 'put'])) {
            $this->Sidebar->patchEntity($sidebar, $this->request->data);
            if ($this->Sidebar->save($sidebar)) {
                $this->Flash->success(__('The sidebar item has been updated.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/sidebars");
            }
            $this->Flash->error(__('Unable to edit sidebar item.'));
        }
    }

    public function sidebar_delete($id = null) {
        $this->set('title_for_layout', 'Delete Sidebar Item');
        $this->request->allowMethod(['post', 'delete']);

        $sidebar = $this->Sidebar->get($id);
        if ($this->Sidebar->delete($sidebar)) {
            $this->Flash->success(__('The sidebar with id: {0} has been deleted.', h($id)));
            return $this->redirect("".Configure::read('BASE_URL')."/admin/sidebars");
        }
    }
	
	public function sidebar_reorder() {
        foreach ($_POST['item'] as $key => $value) {
            $sidebar_items = TableRegistry::get('Sidebar');
            $sidebar_item = $sidebar_items->find('all')->where(['id' => $value])->first();
            $sidebar_item->position = $key + 1;
            $sidebar_items->save($sidebar_item);
        }
        exit();
	}
	
}