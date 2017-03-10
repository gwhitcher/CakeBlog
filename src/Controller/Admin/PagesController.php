<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class PagesController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Pages');
        $this->loadModel('Pages');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Pages.id' => 'desc'
            ]
        ];
        $pages = $this->paginate($this->Pages);
        $this->set(compact('pages'));
    }

    public function add() {
        $this->set('title_for_layout', 'Page : Add');
        $this->loadModel('Pages');
        $page = $this->Pages->newEntity($this->request->data);
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

            //Save
            if ($this->Pages->save($page)) {
                $this->Flash->set('The page has been saved.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to add page.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
        $this->set(compact('page'));
    }

    public function edit($id = NULL) {
        $this->loadModel('Pages');
        $page = $this->Pages->get($id);
        $this->set('title_for_layout', 'Page : '.$page->title);
        if (empty($page)) {
            throw new NotFoundException('Could not find that page.');
        } else {
            $this->set(compact('page'));
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

            //Save
            $this->Pages->patchEntity($page, $this->request->data);
            if ($this->Pages->save($page)) {
                $this->Flash->set('The page has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to update page.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
    }

    public function delete($id = NULL) {
        $this->loadModel('Pages');
        $page = $this->Pages->get($id);
        $this->Pages->delete($page);
        $this->Flash->set('The page '.$page->title.' has been deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }
}
