<?php
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$files = array_diff(scandir($mysql_dir, $mysql_order), array(".", ".."));
foreach ($files as $file) {
    $contents = file_get_contents(''.$mysql_dir.'/'.$file.'');
    $sql = $contents;
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
}
mysqli_close($conn);