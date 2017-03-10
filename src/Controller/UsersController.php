<?php
// src/Controller/UsersController.php

namespace App\Controller;

class UsersController extends AppController
{
    public function login() {
        $this->set('title_for_layout', 'Login');

        //Login security
        if(empty($_SESSION['login_count'])) {
            $_SESSION['login_count'] = 0;
        } elseif($_SESSION['login_count'] >= 3) {
            return $this->redirect('http://google.com');
        }

        if ($this->request->is('post')) {

            //Captcha
            if($this->request->data['captcha'] != 7) {
                $_SESSION['login_count']++;
                $this->Flash->set('Captcha incorrect!',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
                return $this->redirect(['action' => 'login']);
            }

            $user = $this->Auth->identify();
            if ($user) {
                unset($_SESSION['login_count']);
                $this->Auth->setUser($user);
                $this->Flash->set('Logged in!',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $_SESSION['login_count']++;

                $this->Flash->set('Invalid username or password, try again',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
            }
        }
        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('users.login');
    }

    public function logout() {
        $this->Flash->set('Successfully logged out.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect($this->Auth->logout());
    }

}