<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class PostTypeController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Post Types');
        $this->loadModel('Post_Type');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Post_Type.id' => 'desc'
            ]
        ];
        $post_types = $this->paginate($this->Post_Type);
        $this->set(compact('post_types'));
    }

    public function add() {
        $this->set('title_for_layout', 'Post Type : Add');
        $this->loadModel('Post_Type');
        $post_type = $this->Post_Type->newEntity($this->request->data);
        if ($this->request->is('post')) {
            //Validation
            $validator = new Validator();
            $validator
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
                return $this->redirect(['action' => 'add']);
            }

            //Slug
            $post_type->slug = Text::slug(strtolower($this->request->data('title')));

            //Save
            if ($this->Post_Type->save($post_type)) {
                $this->Flash->set('The post type has been saved.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to add post type.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
        $this->set(compact('post_type'));
    }

    public function edit($id = NULL) {
        $this->loadModel('Post_Type');
        $post_type = $this->Post_Type->get($id);
        $this->set('title_for_layout', 'Post Type : '.$post_type->title);
        if (empty($post_type)) {
            throw new NotFoundException('Could not find that post type.');
        } else {
            $this->set(compact('post_type'));
        }

        if ($this->request->is(['post', 'put'])) {
            //Validation
            $validator = new Validator();
            $validator
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
                return $this->redirect(['action' => 'edit', $id]);
            }

            //Slug
            $post_type->slug = Text::slug(strtolower($this->request->data('title')));

            //Save
            $this->Post_Type->patchEntity($post_type, $this->request->data);
            if ($this->Post_Type->save($post_type)) {
                $this->Flash->set('The post type has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to update post type.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
    }

    public function delete($id = NULL) {
        $this->loadModel('Post_Type');
        $post_type = $this->Post_Type->get($id);
        $this->Post_Type->delete($post_type);
        $this->Flash->set('The article '.$post_type->title.' has been deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }
}
