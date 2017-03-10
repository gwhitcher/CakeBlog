<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class NavigationController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Navigation');
        $this->loadModel('Navigation');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Navigation.position' => 'desc'
            ]
        ];
        $navigation = $this->paginate($this->Navigation);
        $this->set(compact('navigation'));
    }

    public function add() {
        $this->loadModel('Navigation');

        //Get all nav items
        $parent_ids = $this->Navigation->find('list');
        $this->set(compact('parent_ids'));

        $navigation = $this->Navigation->newEntity($this->request->data);
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
            if ($this->Navigation->save($navigation)) {
                $this->Flash->set('The navigation item has been saved.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to add navigation item.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
        $this->set(compact('navigation'));
    }

    public function edit($id = NULL) {
        $this->loadModel('Navigation');

        //Get all nav items
        $parent_ids = $this->Navigation->find('list');
        $this->set(compact('parent_ids'));

        $navigation = $this->Navigation->get($id);
        $this->set('title_for_layout', 'Navigation : '.$navigation->title);
        if (empty($navigation)) {
            throw new NotFoundException('Could not find that navigation item.');
        } else {
            $this->set(compact('navigation'));
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
            $this->Navigation->patchEntity($navigation, $this->request->data);
            if ($this->Navigation->save($navigation)) {
                $this->Flash->set('The navigation item has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to update navigation item.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
    }

    public function delete($id = NULL) {
        $this->loadModel('Navigation');
        $navigation = $this->Navigation->get($id);
        $this->Navigation->delete($navigation);
        $this->Flash->set('The navigation item '.$navigation->title.' has been deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }
}
