<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class SidebarController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Sidebar');
        $this->loadModel('Pages');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Sidebar.id' => 'desc'
            ]
        ];
        $sidebars = $this->paginate($this->Sidebar);
        $this->set(compact('sidebars'));
    }

    public function add() {
        $this->set('title_for_layout', 'Sidebar : Add');
        $this->loadModel('Sidebar');
        $sidebar = $this->Sidebar->newEntity($this->request->data);
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
            if ($this->Sidebar->save($sidebar)) {
                $this->Flash->set('The sidebar has been saved.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to add sidebar.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
        $this->set(compact('sidebar'));
    }

    public function edit($id = NULL) {
        $this->loadModel('Sidebar');
        $sidebar = $this->Sidebar->get($id);
        $this->set('title_for_layout', 'Sidebar : '.$sidebar->title);
        if (empty($sidebar)) {
            throw new NotFoundException('Could not find that sidebar.');
        } else {
            $this->set(compact('sidebar'));
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
            $this->Sidebar->patchEntity($sidebar, $this->request->data);
            if ($this->Sidebar->save($sidebar)) {
                $this->Flash->set('The sidebar has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to update sidebar.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
    }

    public function delete($id = NULL) {
        $this->loadModel('Sidebar');
        $sidebar = $this->Sidebar->get($id);
        $this->Sidebar->delete($sidebar);
        $this->Flash->set('The sidebar '.$sidebar->title.' has been deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }
}
