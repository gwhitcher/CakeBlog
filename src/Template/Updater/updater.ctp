<h2>Updater</h2>
<form method="post">
<input name="submit" type="submit" value="Update" />
</form>
<?php
use Cake\Core\Configure;

//LOCK
$filename = '../updater/lock.txt';

if(!empty($_POST['submit'])) {
    //REMOVE LOCK
    if (file_exists(''.getcwd().'/'.$filename.'')) {
        unlink(''.getcwd().'/'.$filename.'');
    }

    $post_data = array();

    //create array of data to be posted
    $post_data['submit'] = 1;

    $url = ''.Configure::read('BASE_URL').'/updater/update.php';
    $data = http_build_query($post_data);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, count($post_data));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;

    //CREATE LOCK
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    $txt = "Updating is locked.\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}
?>