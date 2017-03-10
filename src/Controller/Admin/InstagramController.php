<?php
namespace App\Controller\Admin;

use Cake\Network\Exception\NotFoundException;
use Cake\Validation\Validator;

class InstagramController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Instagram');
        $this->loadModel('Instagram');
        $this->paginate = [
            'limit' => 10,
            'conditions' => [
                'Instagram.status' => 1
            ],
            'order' => [
                'Instagram.id' => 'desc'
            ]
        ];
        $instagram_images = $this->paginate($this->Instagram);
        $this->set(compact('instagram_images'));
    }

    public function dump() {
        $this->set('title_for_layout', 'Instagram : Dump');
        $this->loadModel('Instagram');
        $url = "https://api.instagram.com/v1/users/".INSTAGRAM_USER_ID."/media/recent?access_token=".INSTAGRAM_ACCESS_TOKEN;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $json = curl_exec($ch);
        curl_close($ch);
        $instaData = json_decode($json);
        $instaDataReversed = array_reverse($instaData->data);
        foreach ($instaDataReversed as $post) {
            $url = $post->images->standard_resolution->url;
            $url_fixed = strtok($url, '?');
            $url_basename = basename($url_fixed);
            $instagram_image = $this->Instagram->find('all')->where(['image' => $url_basename])->first();
            if(empty($instagram_image)) {
                $directory = WWW_ROOT.'/uploads/instagram';
                copy($post->images->standard_resolution->url, $directory.'/lg/'.$url_basename);
                copy($post->images->low_resolution->url, $directory.'/sm/'.$url_basename);
                $query = $this->Instagram->query();
                $query->insert(['title', 'image', 'link', 'created_time', 'status'])
                    ->values([
                        'title' => htmlentities($post->caption->text),
                        'image' => $url_basename,
                        'link' => $post->link,
                        'created_time' => htmlentities(date("F j, Y, g:i a", $post->caption->created_time)),
                        'status' => 1
                    ])
                    ->execute();
            }
        }
        $this->Flash->set('Instagram images updated.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = NULL) {
        $this->loadModel('Instagram');
        $instagram = $this->Instagram->get($id);
        $this->set('title_for_layout', 'Instagram : '.$instagram->title);
        if (empty($instagram)) {
            throw new NotFoundException('Could not find that image.');
        } else {
            $this->set(compact('instagram'));
        }

        if ($this->request->is(['post', 'put'])) {
            //Validation
            $validator = new Validator();
            $validator
                ->requirePresence('title')
                ->notEmpty('title', 'A title is required.')
                ->requirePresence('status')
                ->notEmpty('status', 'A status is required.');
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
            $this->Instagram->patchEntity($instagram, $this->request->data);
            if ($this->Instagram->save($instagram)) {
                $this->Flash->set('The image has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('Unable to update image.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
        }
    }

    public function delete($id = NULL) {
        $this->loadModel('Gallery');
        $gallery = $this->Gallery->get($id);
        $this->Gallery->delete($gallery);
        $this->Flash->set('The image '.$gallery->title.' has been deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }
}
