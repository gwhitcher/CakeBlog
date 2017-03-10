<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Utility\Inflector;

class PagesController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        /* AUTHENTICATION */
        $this->Auth->allow(['load_pages']);
        //LOAD LAYOUT
        $this->layout = 'admin';
        //LOAD MODEL
        $this->loadModel('Page');
    }

	public function load_pages($slug = null) {
        $this->layout = Configure::read('cakeblog_theme');
        $pagetable = TableRegistry::get('Pages');
        $pages = $pagetable->find('all', array('conditions' => array('slug' => $slug)));
        $page = $pages->first();
        $this->set('title_for_layout', $page->title);
        if (empty($page)) {
            throw new NotFoundException('Could not find a page with that name.');
        }
        else {
            $this->set(compact('page'));
        }
		//RENDER THEME VIEW
		$this->render(''.Configure::read('cakeblog_theme').'.load_pages');
	}

	 public function pages() {
         $this->set('title_for_layout', 'Pages');
         $this->paginate = [
             'limit' => 10,
             'order' => [
                 'Page.id' => 'desc'
             ]
         ];
         $pages = $this->paginate($this->Page);
         $this->set(compact('pages'));
    }

    public function page_add() {
        $this->set('title_for_layout', 'Add Page');
        $page = $this->Page->newEntity($this->request->data);
        if ($this->request->is('post')) {
            $page->slug = strtolower(Inflector::slug($page->title));
            if ($this->Page->save($page)) {
                $this->Flash->success(__('The page has been saved.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/pages");
            }
            $this->Flash->error(__('Unable to add page.'));
        }
        $this->set('page', $page);
    }

    public function page_edit($id = null) {
        $page = $this->Page->get($id);
        $this->set('title_for_layout', $page->title);
        if (empty($page)) {
            throw new NotFoundException('Could not find that page.');
        }
        else {
            $this->set(compact('page'));
        }
        if ($this->request->is(['post', 'put'])) {
            $this->Page->patchEntity($page, $this->request->data);
            $page->slug = strtolower(Inflector::slug($page->title));
            if ($this->Page->save($page)) {
                $this->Flash->success(__('The page has been updated.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/pages");
            }
            $this->Flash->error(__('Unable to edit page.'));
        }
    }

    public function page_delete($id = null) {
        $this->set('title_for_layout', 'Delete Page');
        $this->request->allowMethod(['post', 'delete']);

        $page = $this->Page->get($id);
        if ($this->Page->delete($page)) {
            $this->Flash->success(__('The page with id: {0} has been deleted.', h($id)));
            return $this->redirect("".Configure::read('BASE_URL')."/admin/pages");
        }
    }
	
	
}
