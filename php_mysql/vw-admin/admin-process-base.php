<?php include("../connect.php");

$base = $mysql_db->query("SELECT count(*) FROM bases WHERE base_name='" . $_POST[base_name] . "'")->fetch_array(MYSQLI_ASSOC);

if ($base['count(*)'] > 0):
    $mysql_db->query("UPDATE bases SET base_name='" . $_POST[base_name] . "', base_aadd_num='" . $_POST[base_aadd_num] . "', base_sapr_num='" . $_POST[base_sapr_num] . "', base_cab_num='" . $_POST[base_cab_num] . "', base_afrc_num='" . $_POST[base_afrc_num] . "' WHERE base_name='" . $_POST[base_name] . "'");
else:
    $mysql_db->query("INSERT INTO bases (base_name, base_aadd_num, base_sapr_num, base_cab_num, base_afrc_num)
                    VALUES ('" . $_POST[base_name] . "','" . $_POST[base_aadd_num] . "','" . $_POST[base_sapr_num] . "','" . $_POST[base_cab_num] . "','" . $_POST[base_afrc_num] . "')");
endif;                    

echo json_encode(["success" => true, "error" => mysql_error()]);

?>