<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Users');
        $this->loadModel('Users');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Users.id' => 'desc'
            ]
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    public function add() {
        $this->set('title_for_layout', 'User : Add');
        $user = $this->Users->newEntity($this->request->data);
        if ($this->request->is('post')) {
            //Password hash
            $password_hash = new DefaultPasswordHasher;
            $this->request->data['password'] = $password_hash->hash($this->request->data['password']);

            if ($this->Users->save($user)) {
                $this->Flash->set('The user has been saved.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'users']);
            }
            $this->Flash->set('Unable to add user.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
        $this->set(compact('user'));
    }

    public function edit($id = null) {
        $user = $this->Users->get($id);
        $this->set('title_for_layout', 'User : '.$user->name);
        if (empty($user)) {
            throw new NotFoundException('Could not find that user.');
        } else {
            $this->set(compact('user'));
        }

        if ($this->request->is(['post', 'put'])) {
            //Password hash
            $password_hash = new DefaultPasswordHasher;
            $this->request->data['password'] = $password_hash->hash($this->request->data['password']);

            //Save
            $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->set('The user has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to update the user.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
    }

    public function delete($id = null) {
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->set('The user ID:'.$id.' has been deleted.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'success'
                    ]]
            );
            return $this->redirect(['action' => 'users']);
        }
    }
}