<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class ArticlesController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Articles');
        $this->loadModel('Articles');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Articles.id' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));
    }

    public function add() {
        $this->set('title_for_layout', 'Article : Add');
        //Post Types
        $this->loadModel('Post_Type');
        $post_type_ids = $this->Post_Type->find('list');
        $this->set(compact('post_type_ids'));

        //Categories
        $this->loadModel('Categories');
        $category_ids = $this->Categories->find('list');
        $this->set(compact('category_ids'));

        $this->loadModel('Articles');
        $article = $this->Articles->newEntity($this->request->data);
        if ($this->request->is('post')) {
            //Validation
            $validator = new Validator();
            $validator
                ->requirePresence('post_type_id')
                ->notEmpty('post_type_id', 'A post type is required.')
                ->requirePresence('title')
                ->notEmpty('title', 'A title is required.');
            $errors_array = $validator->errors($this->request->data);
            $error_msg = [];
            foreach($errors_array as $errors) {
                if(is_array($errors)) {
                    foreach($errors as $error) {
                        $error_msg[] = $error;
                    }
                } else {
                    $error_msg[] = $errors;
                }
            }
            if(!empty($error_msg)) {
                $this->Flash->set('Please fix the following error(s): '.implode('\n \r', $error_msg),
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
                $this->redirect(['action' => 'add']);
            }

            //Slug
            $article->slug = Text::slug(strtolower($this->request->data('title')));
            //User ID
            $current_user = $this->Auth->user();
            $article->user_id = $current_user['id'];
            //Date
            $article->updated_at = date('Y-m-d H:i:s');

            //Save
            if ($this->Articles->save($article)) {
                //Category array
                $cat_array = $this->request->data('category_id');
                foreach($cat_array as $cat) {
                    $article_id = $this->Articles->find('all')->order(['id' => 'DESC'])->first();
                    $this->loadModel('article_categories');
                    $query = $this->article_categories->query();
                    $query->insert(['article_id', 'category_id'])
                        ->values([
                            'article_id' => $article_id->id,
                            'category_id' => $cat
                        ])
                        ->execute();
                }

                $this->Flash->set('The article has been saved.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->set('Unable to add article.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
            }
        }
        $this->set(compact('article'));
    }

    public function edit($id = NULL) {
        //Post Types
        $this->loadModel('Post_Type');
        $post_type_ids = $this->Post_Type->find('list');
        $this->set(compact('post_type_ids'));

        //Article
        $this->loadModel('Articles');
        $article = $this->Articles->get($id);
        $this->set('title_for_layout', 'Article : '.$article->title);

        //Categories
        $this->loadModel('Categories');
        $category_ids = $this->Categories->find('list', array('conditions' => array('post_type_id' => $article->post_type_id), 'order' => 'id ASC'));
        $this->set('category_ids', $category_ids);

        if (empty($article)) {
            throw new NotFoundException('Could not find that article.');
        }
        else {
            $this->set(compact('article'));
            $this->loadModel('article_categories');
            $selected_categories_array = $this->article_categories->find('all')->where(['article_id' => $article->id]);
            foreach($selected_categories_array as $sel_cat) {
                $selected_categories[] = $sel_cat->category_id;
            }
            $this->set(compact('selected_categories'));
        }

        if ($this->request->is(['post', 'put'])) {
            //Validation
            $validator = new Validator();
            $validator
                ->requirePresence('post_type_id')
                ->notEmpty('post_type_id', 'A post type is required.')
                ->requirePresence('title')
                ->notEmpty('title', 'A title is required.');
            $errors_array = $validator->errors($this->request->data, false);
            $error_msg = [];
            foreach($errors_array as $errors) {
                if(is_array($errors)) {
                    foreach($errors as $error) {
                        $error_msg[] = $error;
                    }
                } else {
                    $error_msg[] = $errors;
                }
            }
            if(!empty($error_msg)) {
                $this->Flash->set('Please fix the following error(s): '.implode('\n \r', $error_msg),
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
                $this->redirect(['action' => 'edit', $id]);
            }

            //Slug
            $article->slug = Text::slug(strtolower($this->request->data('title')));
            //User ID
            $current_user = $this->Auth->user();
            $article->user_id = $current_user['id'];
            //Date
            $article->updated_at = date('Y-m-d H:i:s');
            //Category array
            $this->loadModel('article_categories');
            $cat_clean = $this->article_categories->find('all')->where(['article_id' => $article->id]);
            foreach($cat_clean as $cat_cleaned) {
                $this->article_categories->delete($cat_cleaned);
            }
            $cat_array = $this->request->data('category_id');
            foreach($cat_array as $cat) {
                $cat_check = $this->article_categories->find('all')->where(['category_id' => $cat, 'article_id' => $article->id])->first();
                if(empty($cat_check)) {
                    $query = $this->article_categories->query();
                    $query->insert(['article_id', 'category_id'])
                        ->values([
                            'article_id' => $article->id,
                            'category_id' => $cat
                        ])
                        ->execute();
                }
            }

            //Save
            $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->set('The article has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->set('Unable to update article.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
            }
        }
    }

    public function delete($id = NULL) {
        $this->loadModel('Articles');
        $article = $this->Articles->get($id);
        $this->Articles->delete($article);
        $this->Flash->set('The article '.$article->title.' has been deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }

    public function loadCategories() {
        $this->viewBuilder()->layout('ajax');
        $this->loadModel('Categories');
        $post_type_id = $_GET['post_type_id'];
        $category_ids = $this->Categories->find('list', array('conditions' => array('post_type_id' => $post_type_id), 'order' => 'id ASC'));
        $this->set(compact('category_ids'));
    }
}