<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

class CategoriesController extends AppController {
    
    public function index($slug = NULL) {
        $category = $this->Categories->find('all')->where(['Categories.slug' => $slug])->first();
        $this->set('title_for_layout', $category->title);
        $this->set('description_for_layout', $category->metadescription);
        $this->set('keywords_for_layout', $category->metakeywords);
        $this->set(compact('category'));
        if (empty($category)) {
            throw new NotFoundException('Could not find that category.');
        }
        $this->loadModel('article_categories');
        $article_categories = $this->article_categories->find('all')->where(['category_id' => $category->id]);
        $article_ids = array();
        foreach($article_categories as $article_category) {
            $article_ids[] = $article_category->article_id;
        }
        $this->loadModel('Articles');
        $this->paginate = [
            'conditions' => [
                'Articles.id IN' => $article_ids,
                'Articles.status' => 1
            ],
            'contain' => ['users', 'categories'],
            'limit' => ARTICLES_PER_PAGE,
            'order' => [
                'Articles.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));

        $slider_articles = $this->Articles->find('all')->where(['status' => 1, 'slider' => 1, 'Articles.id IN' => $article_ids])->order(['id' => 'DESC'])->limit(SLIDER_ARTICLES_PER_PAGE);
        $this->set(compact('slider_articles'));

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('categories.index');
    }

    public function count_posts_in_category($category_id = NULL) {
        $this->loadModel('article_categories');
        $article_categories = $this->article_categories->find('all')->where(['category_id' => $category_id]);
        $articles_count = $article_categories->count();
        return $articles_count;
    }
}
