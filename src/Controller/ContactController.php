<?php
namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Network\Session\DatabaseSession;
use Cake\Event\Event;
use Cake\Network\Email\Email;
use Cake\Utility\Inflector;

class ContactController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        /* AUTHENTICATION */
        $this->Auth->allow(['contact', 'captcha_image']);
    }

    public function contact() {
        $this->set('title_for_layout', 'Contact');
        if ($this->request->is('post')) {
            if($this->request->data['captcha']!=$_SESSION['captcha'])
            {
                $this->Flash->error(__('Please enter correct captcha code and try again.', true));
            }
            else {
                //SEND EMAIL
                $email = new Email();
                $email->transport('default');
                $email->from([$this->request->data['email'] => $this->request->data['name']])
                    ->to(Configure::read('cakeblog_contact_email'))
                    ->subject('Website Contact - '.$this->request->data['type'])
                    ->send($this->request->data['message']);

                    $this->Flash->success(__('Your message has been submitted'));
                return $this->redirect("".Configure::read('BASE_URL')."/contact");
            }
        }
        //RENDER THEME VIEW
        $this->render(''.Configure::read('cakeblog_theme').'.contact');
    }

    /* LOAD CAPTCHA IMAGE */
    public function captcha_image(){
        require_once('../plugins'.DS.'captcha'.DS.'captcha.php');
        show_captcha();
    }
	
}