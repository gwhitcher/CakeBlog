<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->layout = 'admin';
    }

    public function dashboard() {
        $this->set('title_for_layout', 'Dashboard');
        $this->layout = 'admin';

        $this->loadModel('Article');
        $articles = $this->Article->find('all', array('limit' => 5, 'order' => 'id DESC'));
        $this->set('articles', $articles);

        $this->loadModel('Categories');
        $categories = $this->Categories->find('all', array('limit' => 5, 'order' => 'id DESC'));
        $this->set('categories', $categories);

        $this->loadModel('Page');
        $pages = $this->Page->find('all', array('limit' => 5, 'order' => 'id DESC'));
        $this->set('pages', $pages);

        $this->loadModel('Sidebar');
        $sidebar = $this->Sidebar->find('all', array('limit' => 5, 'order' => 'id DESC'));
        $this->set('sidebars', $sidebar);

        $this->loadModel('Navigation');
        $navigation = $this->Navigation->find('all', array('limit' => 5, 'order' => 'id DESC'));
        $this->set('navigation', $navigation);

        $this->loadModel('User');
        $users = $this->User->find('all', array('limit' => 5, 'order' => 'id DESC'));
        $this->set('users', $users);
    }

    public function login()
    {
        $this->layout = Configure::read('cakeblog_theme');
        $this->set('title_for_layout', 'Login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        //RENDER THEME VIEW
        $this->render(''.Configure::read('cakeblog_theme').'.login');
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function user_view($id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function user_add()
    {
        $user = $this->Users->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/users");
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

    public function user_edit($id = null) {
        $user = $this->Users->get($id);
        $this->set('title_for_layout', $user->name);
        if (empty($user)) {
            throw new NotFoundException('Could not find that user.');
        }
        else {
            $this->set(compact('user'));
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been updated.'));
                return $this->redirect("".Configure::read('BASE_URL')."/admin/users");
            }
            $this->Flash->error(__('Unable to update the user.'));
        }
    }

    public function user_delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
            return $this->redirect("".Configure::read('BASE_URL')."/admin/users");
        }
    }

    public function users() {
        $this->set('title_for_layout', 'Users');
        $this->loadModel('User');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'User.id' => 'desc'
            ]
        ];
        $users = $this->paginate($this->User);
        $this->set(compact('users'));
    }

}