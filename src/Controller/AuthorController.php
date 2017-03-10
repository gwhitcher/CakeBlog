<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

class AuthorController extends AppController {

    public function index($username = NULL) {
        $this->loadModel('Users');
        $user = $this->Users->find('all')->where(['Users.username' => $username])->first();
        $this->set('title_for_layout', $user->full_name);
        $this->loadModel('Articles');
        $this->paginate = [
            'conditions' => [
                'Articles.user_id' => $user->id
            ],
            'contain' => ['users', 'categories'],
            'limit' => ARTICLES_PER_PAGE,
            'order' => [
                'Articles.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));

        $this->loadModel('Categories');
        $categories = $this->Categories->find('all');
        $this->set(compact('categories'));

        $slider_articles = $this->Articles->find('all')->where(['user_id' => $user->id, 'status' => 1, 'slider' => 1])->order(['id' => 'DESC'])->limit(SLIDER_ARTICLES_PER_PAGE);
        $this->set(compact('slider_articles'));

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('author.index');
    }
}
