<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Validation\Validator;

class ContactController extends AppController {
    
    public function index() {
        $this->set('title_for_layout', 'Contact');

        if ($this->request->is(['post'])) {
            //Captcha
            $captcha = $this->request->data(['captcha']);
            if($captcha != 7) {
                $this->Flash->set('Captcha not entered correctly.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'danger'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }

            //Validation
            $validator = new Validator();
            $validator
                ->requirePresence('full_name')
                ->notEmpty('full_name', 'A full name is required.')
                ->requirePresence('email_address')
                ->notEmpty('email_address', 'An email address is required.')
                ->requirePresence('message')
                ->notEmpty('message', 'A message is required.');
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
                return $this->redirect(['action' => 'index']);
            }

            $fullname = $this->request->data['full_name'];
            $replyto = $this->request->data['email_address'];
            $attachment = $this->request->data['file'];
            $message = $this->request->data['message'];
            $email_addresses = ADMIN_EMAIL;
            $todays_date = date("m-d-Y");

            if(!empty($attachment['name'])) {
                $img_directory = WWW_ROOT.'img/contact';
                move_uploaded_file($attachment['tmp_name'], $img_directory.'/'.$attachment['name']);
                $attachment_url = $img_directory.'/'.$attachment['name'];
                $email = new Email('default');
                $email->from([ADMIN_EMAIL => SITE_TITLE])
                    ->emailFormat('html')
                    ->to($email_addresses)
                    ->replyTo([$replyto => $fullname])
                    ->subject('Contact: '.$fullname.' '.$todays_date)
                    ->attachments($attachment_url)
                    ->send($message);
            } else {
                $email = new Email('default');
                $email->from([ADMIN_EMAIL => 'Administrator'])
                    ->emailFormat('html')
                    ->to($email_addresses)
                    ->replyTo([$replyto => $fullname])
                    ->subject('Contact: '.$fullname.' '.$todays_date)
                    ->send($message);
            }

            $this->Flash->set('The mail has been sent.  Someone will contact you as soon as possible.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'success'
                    ]]
            );
            return $this->redirect(['action' => 'index']);
        }

        //Load theme
        $this->viewBuilder()->templatePath('Themes/'.CAKEBLOG_THEME);
        $this->render('contact.index');
    }
}
