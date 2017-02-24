<?php 

    $SETTINGS = [
        "key" => "AIzaSyCbqhkRrjlZPNrm86W5KhTEA4Eg8FoTmcE", /* Google API Key */
        "is_admin" => $_COOKIE["admin_logged_in"], /* Checks for admin login status */
        
        /* MySQL Login Info */
        "mysql_host" => "localhost",
        "mysql_user" => "root",
        "mysql_pass" => "",
        "mysql_database" => "vw",
        
        /* General Settings */
        "current_page" => $_SERVER[REQUEST_URI],
        
    ];

?>