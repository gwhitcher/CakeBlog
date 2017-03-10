<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

class BlogController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        /* AUTHENTICATION */
        $this->Auth->allow([
            'home', 'article_view', 'categories', 'rss']);
    }

    public $helpers = ['Text'];
	
	public function home() {
		$this->set('title_for_layout', Configure::read('sub_title'));
		$this->loadModel('Article');
        $this->paginate = [
            'limit' => 3,
            'order' => [
                'Article.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Article);
        $this->set(compact('articles'));
		
		//SLIDER IMAGES
		$this->set('slider_articles', $this->Article->find('all', array('conditions' => array('slider' => 1, 'status' => 0), 'limit' => 3, 'order'=>'id DESC')));

		//RENDER THEME VIEW
		$this->render(''.Configure::read('cakeblog_theme').'.home');
	}
	
	public function article_view($id = null) {
        $this->loadModel('Article');
        $article = $this->Article->get($id);
        $this->set('title_for_layout', $article->title);
        if (empty($article)) {
            throw new NotFoundException('Could not find that article');
        }
        else {
            $this->set(compact('article'));
        }
		//RENDER THEME VIEW
		$this->render(''.Configure::read('cakeblog_theme').'.article_view');
	}
	
	public function categories($id = null) {
        $this->loadModel('Categories');
        $category = $this->Categories->get($id);
        $this->set('title_for_layout', $category->title);
        if (empty($category)) {
            throw new NotFoundException('Could not find that category');
        }
        else {
            $this->set(compact('category'));
        }

        $this->loadModel('Article');
        $this->paginate = [
            'conditions' => array('Article.category_id' => $id, 'Article.status' => 0),
            'limit' => 3,
            'order' => [
                'Article.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Article);
        $this->set(compact('articles'));

		//RENDER THEME VIEW
		$this->render(''.Configure::read('cakeblog_theme').'.categories');
	}

    public function rss() {
        $this->layout = 'rss/default';
        $this->loadModel('Article');
        $articles = $this->Article->find(
            'all',
            ['conditions' => array('Article.status' => 0), 'limit' => 20, 'order' => 'Article.id DESC']
        );
        $this->set(compact('articles'));
    }
	
}