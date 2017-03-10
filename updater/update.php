
<?php
ini_set('max_execution_time', 300); // EXTENDING EXECUTION TIME: 300 seconds = 5 minutes
include('config.php');
include('functions.php');

$update_lock = ''.$dest_dir.'updater/lock.txt';

if (file_exists($update_lock)) {
    echo "You are not authorized to view this page.";
} else {
    echo '<form method="post">';
    echo '<input name="submit" type="hidden" value="submit" />';
    echo '</form>';

if(!empty($_POST['submit'])) {
	$hostfile = fopen($zip_url . $zip_name, 'r');
	$fh = fopen($zip_name, 'w');

	while (!feof($hostfile)) {
   	 $output = fread($hostfile, 8192);
   	 fwrite($fh, $output);
	}

	fclose($hostfile);
	fclose($fh);

	require_once('pclzip.lib.php');
	$archive = new PclZip($zip_name);

	if (($v_result_list = $archive->extract()) == 0) {
   	 die("Error : ".$archive->errorInfo(true));
	}

	unlink($zip_name); //DELETE ZIP

	recursive_copy($src_dir,$dest_dir); //COPY FILES

	//system('/bin/rm -rf ' . escapeshellarg($src_dir)); //LINUX DELETE
	system('rd /Q /S "' . $src_dir . '"'); //WINDOWS DELETE

	include('mysql_update.php'); //UPDATE MYSQL
	
	echo "Updater finished!";  //FINAL
}

}