<?php include('../settings.php');

$connect = mysqli_connect($SETTINGS['mysql_host'], $SETTINGS['mysql_user'], $SETTINGS['mysql_pass'], $SETTINGS['mysql_database']);

if($connect) echo "success!! <br />";

$admins = $connect->query('SELECT * FROM admin');

foreach($admins as $admin){
    echo $admin['user_name'] . "<br />";
}


?>