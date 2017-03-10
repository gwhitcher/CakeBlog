<?php
namespace App\Controller\Admin;

class UpdateController extends AppController {

    public function index() {
        ini_set('memory_limit','1024M');
        ini_set('max_execution_time', 300);
        if ($this->request->is('post')) {
            if(!empty($this->request->data('cakeblog_update'))) {
                $this->zip_download();
                $this->Flash->set('CakeBlog has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                $this->redirect(['action' => 'index']);
            }
            if(!empty($this->request->data('composer_update'))) {
                $this->composer_update();
                $this->Flash->set('Composer has been updated.',
                    ['element' => 'alert-box',
                        'params' => [
                            'class' => 'success'
                        ]]
                );
                $this->redirect(['action' => 'index']);
            }
        }
    }

    public function composer_update() {
        $base_dir = str_replace("webroot", "", getcwd());
        $composer_data = array(
            'url' => 'https://getcomposer.org/composer.phar',
            'dir' => $base_dir.'/.cakeblog/.composer',
            'bin' => $base_dir.'/.cakeblog/.composer/composer.phar',
        );
        if (!is_dir($composer_data['dir'])) {
            mkdir($composer_data['dir'],0777,true);
        }
        if(!file_exists($base_dir.'/composer.phar')) {
            copy($composer_data['url'],$composer_data['bin']);
        }

        require_once "phar://{$composer_data['bin']}/src/bootstrap.php";

        chdir($base_dir);

        putenv("COMPOSER_HOME={$base_dir}");
        putenv("OSTYPE=OS400"); //force to use php://output instead of php://stdout
        $app = new \Composer\Console\Application();

        $factory = new \Composer\Factory();
        $output = $factory->createOutput();

        $input = new \Symfony\Component\Console\Input\ArrayInput(array(
            'command' => 'update',
        ));
        $input->setInteractive(false);

        $app->doRun($input,$output); //run composer
        die();
    }

    public function zip_download() {
        $base_dir = str_replace("webroot", "", getcwd());
        $zip_url = 'https://github.com/gwhitcher/cakeblog/archive/'; //Url to zip
        $zip_name = 'master.zip'; //Zip filename
        $zip_folder = 'CakeBlog-master'; //Zip folder name
        $zip_dir = $base_dir.'/webroot/'.$zip_name;
        $src_dir = $base_dir.'/.cakeblog'; //Directory for update files

        //Move files so they are not overwritten
        copy($base_dir.'/composer.json', $base_dir.'/.cakeblog/.composer/composer.json');
        copy($base_dir.'/.htaccess', $base_dir.'/.cakeblog/.htaccess');

        //Make dir if it doesn't exist already
        if (!file_exists($src_dir)) {
            mkdir($src_dir, 0777, true);
        }

        //Download zip
        $hostfile = fopen($zip_url.$zip_name, 'r');
        $fh = fopen($zip_name, 'w');
        while (!feof($hostfile)) {
            $output = fread($hostfile, 8192);
            fwrite($fh, $output);
        }
        fclose($hostfile);
        fclose($fh);

        //Extract zip
        $zip = new \ZipArchive;
        $res = $zip->open($zip_dir);
        if ($res === TRUE) {
            $zip->extractTo($src_dir);
            $zip->close();
        }
        unlink($zip_dir); //Delete zip

        $this->recursive_copy($src_dir.'/'.$zip_folder.'/', $base_dir); //Copy files
        $this->recursive_delete($src_dir.'/'.$zip_folder); //Delete files

        //Move files back
        copy($base_dir.'/.cakeblog/.composer/composer.json', $base_dir.'/composer.json');
        copy($base_dir.'/.cakeblog/.htaccess', $base_dir.'/.htaccess');

    }

    public function recursive_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recursive_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function recursive_delete($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        $this->recursive_delete($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        }
    }
}