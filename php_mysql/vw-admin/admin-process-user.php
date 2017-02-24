<?php include("../connect.php");

if($_POST["action"] == "save"){ 

$has_user = $mysql_db->query("SELECT count(*) FROM admin WHERE user_name='" . $_POST[user_name] . "'")->fetch_array(MYSQLI_ASSOC);
    
    // $user_level = intval($_POST["user_level"]);
    
    // $admin->update(["user_name" => $_POST["user_name"]], ["user_name" => $_POST["user_name"], "user_pass" => $_POST["user_pass"], "user_level" => $user_level, "user_base" => $_POST["user_base"], "user_unit" => $_POST["user_unit"]], ['upsert' => true]);
if ($has_user['count(*)'] > 0){
    $mysql_db->query("UPDATE admin SET user_name='" . $_POST[user_name] . "', user_pass='" . $_POST[user_pass] . "', user_level='" . intval($_POST[user_level]) . "', user_base='" . $_POST[user_base] . "', user_unit='" . $_POST[user_unit] . "' WHERE user_name='" . $_POST[user_name] . "'");
} else {
    $mysql_db->query("INSERT INTO admin (user_name, user_pass, user_level, user_base, user_unit) 
                VALUES ('" . $_POST[user_name] . "', '" . $_POST[user_pass] . "', '" . intval($_POST[user_level]) . "', '" . $_POST[user_base] . "', '" . $_POST[user_unit] . "')");
}
    echo json_encode(["success" => true, "error" => $mysql_db->error]);
    
} else {
    
    $mysql_db->query("DELETE FROM admin WHERE user_name='" . $_POST[user_name] . "'");
    
    // $user_to_delete = $_POST["user_name"];
        
    // $admin->remove(["user_name" => $user_to_delete]);
    echo json_encode(["success" => true]);
    
}



?>