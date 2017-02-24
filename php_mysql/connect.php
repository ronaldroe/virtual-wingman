<?php include('settings.php');

    $mysql_db = mysqli_connect($SETTINGS['mysql_host'],
        $SETTINGS['mysql_user'],
        $SETTINGS['mysql_pass'],
        $SETTINGS['mysql_database']
    );
?>