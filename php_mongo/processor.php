<?php 

    $m = new MongoClient();
    $db = $m->drunk_button;
    $unit = $db->units;
    $base = $db->bases;
    
    if($_POST["unit"] && $_POST["pass"]){
        
        $unit = $unit->findOne(["unit_name" => $_POST["unit"]]);
        $base = $base->findOne(["base_name" => $unit["unit_base"]]);
        
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
