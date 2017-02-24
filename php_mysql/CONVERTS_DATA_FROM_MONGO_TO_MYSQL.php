<?php 

include('connect.php');

echo "Mongo: ";
echo $db ? "success" : "fail";
echo ".<br />";

$receive = mysqli_connect('localhost', 'root', '', 'vw');

echo "MySQL: ";
echo $receive ? "success" : "fail";
echo ".<br />";

$units = $unit->find();
$units = iterator_to_array($units);
$bases = $base->find();
$bases = iterator_to_array($bases);

if ($receive && $db):
    
    foreach($units as $unit){
        $receive->query("INSERT INTO units (unit_name, unit_pass, unit_base, unit_shirt_num, unit_chaplain_num, logo)
        VALUES ('" . $unit[unit_name] . "', '" . $unit[unit_pass] . "', '" . $unit[unit_base] . "', '" . $unit[unit_shirt_num] . "', '" . $unit[unit_chaplain_num] . "', '" . $unit[logo] . "')");
        echo "Unit complete: ";
        echo $unit[unit_name];
        echo $receive->error;
        echo "<br />";
    }
    
    
    foreach($bases as $base){
        $receive->query("INSERT INTO bases (base_name, base_aadd_num, base_sapr_num, base_cab_num, base_afrc_num)
        VALUES ('" . $base[base_name] . "', '" . $base[base_aadd_num] . "', '" . $base[base_sapr_num] . "', '" . $base[base_cab_num] . "', '" . $base[base_afrc_num] . "')");
        echo "Base complete: ";
        echo $base[base_name];
        echo "<br />";
    }
    
endif;

echo "Done!";

?>