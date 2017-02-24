<?php 

    if($_POST["admin_user"] && $_POST["admin_pass"]):
        
        include("../connect.php");
        
        $admin_user = $mysql_db->query("SELECT * FROM admin WHERE user_name='" . $_POST['admin_user'] . "'");
        $admin_user ? $admin_user = $admin_user->fetch_array(MYSQLI_ASSOC) : null;
        
        if($admin_user["user_pass"] == $_POST["admin_pass"] && $admin_user["user_name"] == $_POST["admin_user"]):
            
            echo json_encode($admin_user);
            
        else:
            
            echo json_encode(["password_error" => true]);
            
        endif;
        
    else:
        
        echo json_encode(["login_error" => true]);
        
    endif;

?>