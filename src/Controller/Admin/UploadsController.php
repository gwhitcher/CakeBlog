<?php
namespace App\Controller\Admin;

class UploadsController extends AppController {

    public function index() {
        $this->set('title_for_layout', 'Upload Manager');

        if(!empty($_GET['folder'])) { $folder = trim($_GET['folder'], "/"); } else { $folder = ''; };
        $dir = './uploads/'.$folder;
        $scan_dir = scandir($dir);
        $files = array_diff($scan_dir, array('.', '..', 'Thumbs.db'));
        $this->set('files', $files);
    }

    public function add() {
        $this->set('title_for_layout', 'Add Upload');

        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data['file']['name'])) {
                //Vars
                if(!empty($_GET['folder'])) { $folder = trim($_GET['folder'], "/"); } else { $folder = ''; };
                $dir = './uploads/'.$folder;
                $file = $this->request->data['file'];

                if (file_exists($dir.'/'.$file['name'])) {
                    $this->Flash->set('Image already exists.  Please choose a different filename or make sure the file you are uploading is not a duplicate!',
                        ['element' => 'alert-box',
                            'params' => [
                                'class' => 'danger'
                            ]]
                    );
                    $this->redirect(array('action' => 'index'));
                } else {
                    //Upload file
                    move_uploaded_file($file['tmp_name'], $dir.'/'.$file['name']);

                    $this->Flash->set('File uploaded successfully.',
                        ['element' => 'alert-box',
                            'params' => [
                                'class' => 'success'
                            ]]
                    );
                    $this->redirect(array('action' => 'index'));
                }

            }
        }
    }

    public function delete($file = NULL) {
        $dir = substr(dirname(__FILE__), 0, -14);
        if(!empty($_GET['file'])) {
            $file = $_GET['file'];
            $full_dir = $dir.'webroot/uploads/'.$_GET['file'];
        } else {
            $full_dir = $dir.'webroot/uploads/'.$file;
        }
        if(!unlink($full_dir)) {
            $this->Flash->set('Unable to delete '.$file.'.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->set('File: '.$file.' successfully deleted.',
            ['element' => 'alert-box',
                'params' => [
                    'class' => 'success'
                ]]
        );
        return $this->redirect(['action' => 'index']);
    }

    public function folder() {
        $this->set('title_for_layout', 'Add Folder');
        if ($this->request->is(['post', 'put'])) {
            if(!empty($_GET['folder'])) { $folder = trim($_GET['folder'], "/"); } else { $folder = ''; };
            $dir = './uploads/'.$folder.'/';
            $file = $this->request->data['folder'];

            mkdir($dir.$file, 0777);
            $this->Flash->set('Folder created successfully.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'success'
                    ]]
            );
            $this->redirect(array('action' => 'index'));
        }
    }

    public function deleteFolder() {
        if(!empty($_GET['folder'])) { $folder = trim($_GET['folder'], "/"); } else { $folder = ''; };
        $dir = './uploads/'.$folder.'/';

        $scan_dir = scandir($dir);
        $files = array_diff($scan_dir, array('.', '..', 'Thumbs.db'));
        $items_count = count($files);

        if(empty($folder) OR $folder == '/' OR strpos($folder, '/newsletters') == true) {
            $this->Flash->set('Cannot delete that folder!',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
            $this->redirect(array('action' => 'index'));
        } elseif ($items_count == 0) {
            rmdir($dir);
            $this->Flash->set('Folder removed successfully.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'success'
                    ]]
            );
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->set('Folder needs to be empty before it can be deleted.',
                ['element' => 'alert-box',
                    'params' => [
                        'class' => 'danger'
                    ]]
            );
            $this->redirect(array('action' => 'index'));
        }
    }
}