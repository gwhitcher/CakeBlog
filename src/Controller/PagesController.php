<?php
namespace App\Controller;

use Cake\Core\Configure;

class PagesController extends AppController {

    public function home() {
        $this->loadModel('Articles');
        $this->paginate = [
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

        $slider_articles = $this->Articles->find('all')->where(['status' => 1, 'slider' => 1])->order(['id' => 'DESC'])->limit(SLIDER_ARTICLES_PER_PAGE);
        $this->set(compact('slider_articles'));

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('pages.home');
    }
}
