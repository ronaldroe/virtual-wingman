<?php include("../connect.php");

// $unit->update(["unit_name" => $_POST["unit_name"]], ["unit_name" => $_POST["unit_name"], "unit_pass" => $_POST["unit_pass"], "unit_base" => $_POST["unit_base"], "unit_shirt_num" => $_POST["unit_shirt_num"], "unit_chaplain_num" => $_POST["unit_chaplain_num"], "logo" => $_POST["logo"]], ["upsert" => true]);

$unit = $mysql_db->query("SELECT count(*) FROM units WHERE unit_name='" . $_POST[unit_name] . "'")->fetch_array(MYSQLI_ASSOC);

if ($unit['count(*)'] > 0):
    $mysql_db->query("UPDATE units SET unit_name='" . $_POST[unit_name] . "', unit_pass='" . $_POST[unit_pass] . "', unit_shirt_num='" . $_POST[unit_shirt_num] . "', unit_chaplain_num='" . $_POST[unit_chaplain_num] . "', logo='" . $_POST[logo] . "', unit_base='" . $_POST[unit_base] . "' WHERE unit_name='" . $_POST[unit_name] . "'");
else:
    $mysql_db->query("INSERT INTO units (unit_name, unit_pass, unit_shirt_num, unit_chaplain_num, logo, unit_base) 
                    VALUES ('" . $_POST[unit_pass] . "', " . $_POST[unit_shirt_num] . "', " . $_POST[unit_chaplain_num] . "', " . $_POST[logo] . "', " . $_POST[unit_base] . "')");
endif;

echo json_encode(["success" => true]);

?>