<?php 

    include("connect.php");
    
    if($_POST["unit"] && $_POST["pass"]){
        
        $unit = $mysql_db->query("SELECT * FROM units WHERE unit_name='" . $_POST[unit] . "'");
        $unit = $unit->fetch_array(MYSQLI_ASSOC);
        $base = $mysql_db->query("SELECT * FROM bases WHERE base_name='" . $unit[unit_base] . "'");
        $base = $base->fetch_array(MYSQLI_ASSOC);
        
        $out = array_merge($unit, $base);
        
        if($_POST["pass"] == $unit["unit_pass"]){
        
            echo json_encode($out);
        
        } else {
            
            echo json_encode(["password_error" => true]);
            
        }
        
    } else {
        
        echo json_encode(["login_error" => true]);
    }
    
?>
