<?php 

    $units_json = file_get_contents('units.json');
    $units_json = json_decode($units_json, true);
    
    $bases_json = file_get_contents('bases.json');
    $bases_json = json_decode($bases_json, true);
    
    $unit_in = $_POST[unit];
    $pass_in = $_POST[pass];
    
    $unit_current = [];
    $base_current = []; 

    foreach($units_json as $unit_json):
    
        if($unit_json[unit_name] == $unit_in && $unit_json[unit_pass] == $pass_in):
        
            
    
?>
