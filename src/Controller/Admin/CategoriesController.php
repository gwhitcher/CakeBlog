<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class CategoriesController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Categories');
        $this->loadModel('Categories');
        $this->paginate = [
            'contain' => ['post_type'],
            'limit' => 10,
            'order' => [
                'Categories.id' => 'desc'
            ]
        ];
        $categories = $this->paginate($this->Categories);
        $this->set(compact('categories'));
    }

    public function add() {
        $this->set('title_for_layout', 'Category : Add');

        //Post Types
        $this->loadModel('Post_Type');
        $post_type_ids = $this->Post_Type->find('list');
        $this->set(compact('post_type_ids'));

        $this->loadModel('Categories');
        $category = $this->Categories->newEntity($this->request->data);
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
            $category->slug = Text::slug(strtolower($this->request->data('title')));

            //Save
            if ($this->Categories->save($category)) {
                $this->Flash->set('The category has been saved.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->set('Unable to add category.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
            }
        }
        $this->set(compact('category'));
    }

    public function edit($id = NULL) {
        //Post Types
        $this->loadModel('Post_Type');
        $post_type_ids = $this->Post_Type->find('list');
        $this->set(compact('post_type_ids'));

        $this->loadModel('Categories');
        $category = $this->Categories->get($id);
        $this->set('title_for_layout', 'Category : '.$category->title);
        if (empty($category)) {
            throw new NotFoundException('Could not find that category.');
        } else {
            $this->set(compact('category'));
        }

        if ($this->request->is(['post', 'put'])) {
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
                $this->redirect(['action' => 'edit', $id]);
            }

            $category->slug = Text::slug(strtolower($this->request->data('title')));

            //Save
            $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->set('The category has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->set('Unable to update category.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
            }
        }
    }

    public function delete($id = NULL) {
        $this->loadModel('Categories');
        $category = $this->Categories->get($id);
        $this->Categories->delete($category);
        $this->Flash->set('The category '.$category->title.' has been deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }
}
