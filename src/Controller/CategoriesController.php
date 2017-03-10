<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Utility\Inflector;

class CategoriesController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //LOAD LAYOUT
        $this->layout = 'admin';
        //LOAD MODEL
        $this->loadModel('Category');
    }
   
    public function categories() {
        $this->set('title_for_layout', 'Categories');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Category.id' => 'desc'
            ]
        ];
        $categories = $this->paginate($this->Category);
        $this->set(compact('categories'));
    }

    public function category_add() {
        $this->set('title_for_layout', 'Add Category');
        $category = $this->Category->newEntity($this->request->data);
        if ($this->request->is('post')) {
            $category->slug = strtolower(Inflector::slug($category->title));
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/categories");
            }
            $this->Flash->error(__('Unable to add category.'));
        }
        $this->set('category', $category);
    }

    public function category_edit($id = null) {
		$category = $this->Category->get($id);
        $this->set('title_for_layout', $category->title);
        if (empty($category)) {
            throw new NotFoundException('Could not find that category.');
        }
        else {
            $this->set(compact('category'));
        }
        if ($this->request->is(['post', 'put'])) {
            $this->Category->patchEntity($category, $this->request->data);
            $category->slug = strtolower(Inflector::slug($category->title));
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been updated.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/categories");
            }
            $this->Flash->error(__('Unable to edit category.'));
        }
    }

    public function category_delete($id = null) {
        $this->set('title_for_layout', 'Delete Category');
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Category->get($id);
        if ($this->Category->delete($category)) {
            $this->Flash->success(__('The category with id: {0} has been deleted.', h($id)));
            return $this->redirect("".Configure::read('BASE_URL')."/admin/categories");
        }
    }
	
	
}