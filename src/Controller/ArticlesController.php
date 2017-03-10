<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Utility\Inflector;

class ArticlesController extends AppController {

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
        $this->loadModel('Article');
    }

    public $helpers = ['Text'];

	public function articles() {
        $this->set('title_for_layout', 'Articles');
        $this->paginate = [
            'limit' => 10,
            'contain' => array('Category'),
            'order' => [
                'Article.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Article);
        $this->set(compact('articles'));
    }

    public function article_add() {
		//LOAD CATEGORIES
		$this->loadModel('Categories');
		$categories = $this->Categories->find('list');
		$this->set(compact('categories'));

        $this->set('title_for_layout', 'Add Article');
        $article = $this->Article->newEntity($this->request->data);
        if ($this->request->is('post')) {
            $article->slug = strtolower(Inflector::slug($article->title));
            if(!empty($this->request->data['featured']['name']))
            {
                $file = $this->request->data['featured'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/articles/featured/' . $file['name']);
                $article->featured = $file['name'];
            }
            if ($this->Article->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/articles");
            }
            $this->Flash->error(__('Unable to add article.'));
        }
        $this->set('article', $article);
    }

    public function article_edit($id = null) {
		//LOAD CATEGORIES
		$this->loadModel('Categories');
		$categories = $this->Categories->find('list');
		$this->set(compact('categories'));

        $article = $this->Article->get($id);
        $this->set('title_for_layout', $article->title);
        $featured_image = $article->featured;
        if (empty($article)) {
            throw new NotFoundException('Could not find that article.');
        }
        else {
            $this->set(compact('article'));
        }
        if ($this->request->is(['post', 'put'])) {
            $this->Article->patchEntity($article, $this->request->data);
            $article->slug = strtolower(Inflector::slug($article->title));
            if(!empty($this->request->data['featured']['name']))
            {
                $file = $this->request->data['featured'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/articles/featured/' . $file['name']);
                $article->featured = $file['name'];
            } else {
                $article->featured = $featured_image;
            }
            if ($this->Article->save($article)) {
                $this->Flash->success(__('The article has been updated.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/articles");
            }
            $this->Flash->error(__('Unable to edit article.'));
        }
    }

    public function article_delete($id = null) {
        $this->set('title_for_layout', 'Delete Article');
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Article->get($id);
        if ($this->Article->delete($article)) {
            $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
            return $this->redirect("".Configure::read('BASE_URL')."/admin/articles");
        }
    }

}