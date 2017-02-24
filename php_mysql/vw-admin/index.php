<?php 

// ********************************* ADMIN INDEX PAGE *********************************

include("../head.php"); 

if($_COOKIE["admin_logged_in"]): 

    include("../connect.php");
    
    /*********************************
        User Levels:
        
            100 = Unit Admin (Update unit info/create unit admins)
            200 = Base Admin (Update base info/add & edit units/add & edit base & unit admins)
            Over 9000 = MSgt Roe
            
    *********************************/
    
    // User Info
    $user_level = intval($_COOKIE["user_level"]);
    
    $user_unit_info = $mysql_db->query("SELECT * FROM units WHERE unit_name='" . $_COOKIE[user_unit] . "'");
    $user_unit_info ? $user_unit_info = $user_unit_info->fetch_array(MYSQLI_ASSOC) : null;
    
    $user_base_info = $mysql_db->query("SELECT * FROM bases WHERE unit_name='" . $_COOKIE[user_base] . "'");
    $user_base_info ? $user_base_info = $user_base_info->fetch_array(MYSQLI_ASSOC) : null;
    
    $user_admin_info = $mysql_db->query("SELECT * FROM admin WHERE user_name='" . $_COOKIE[user_name] . "'");
    
    // Units & Bases
    $units = $mysql_db->query("SELECT * FROM units WHERE unit_base='" . $_COOKIE[user_base] . "' AND NOT (unit_name='Demo')");
    
    $bases = $mysql_db->query("SELECT * FROM bases WHERE base_name='" . $_COOKIE[user_base] . "'");
    
    $unit_admins = $mysql_db->query("SELECT * FROM admin WHERE user_unit='" . $_COOKIE[user_unit] . "' AND user_level<='" . $user_level . "' ORDER BY user_name");
    
    $user_base_units = ($user_level > 100) ? $mysql_db->query("SELECT * FROM units WHERE unit_base='" . $_COOKIE[user_base] . "' AND NOT (unit_name='Demo') ORDER BY unit_name") : null;
    
?>

    <header class="admin">
        <h1>Virtual Wingman Admin</h1>
    </header>
    
    <section class="admin main unit info">
        <h3>Unit Details for: <?php echo $user_unit_info["unit_name"]; ?></h3>
        <form class="unit_info" method="post" data-action="admin-process-unit.php">
            <p><label for="unit_name">Unit Name:</label><input type="text" name="unit_name" value="<?php echo $user_unit_info["unit_name"]; ?>" /></p>
            <p><label for="unit_pass">Unit Password:</label><input type="text" name="unit_pass" value="<?php echo $user_unit_info["unit_pass"]; ?>" /></p>
            <p><label for="unit_base">Unit Base:</label><input type="text" name="unit_base" value="<?php echo $user_unit_info["unit_base"]; ?>" /></p>
            <p><label for="unit_shirt_num">Unit Shirt Number:</label><input type="text" name="unit_shirt_num" value="<?php echo $user_unit_info["unit_shirt_num"]; ?>" /></p>
            <p><label for="unit_chaplain_num">Unit Chaplain Number:</label><input type="text" name="unit_chaplain_num" value="<?php echo $user_unit_info["unit_chaplain_num"]; ?>" /></p>
            <p><label for="logo">Unit Logo File Name:</label><input type="text" name="logo" value="<?php echo $user_unit_info["logo"]; ?>" /></p>
            <button type="button" class="save">Save</button>
        </form>
    </section>
    
    <section class="admin main unit users">
        <h3>Unit Users for: <?php echo $user_unit_info["unit_name"]; ?></h3>
        <?php foreach($unit_admins as $admin): ?>
            <form class="unit_admins" method="post" data-action="admin-process-user.php">
                <p><label for="user_name">User Name:</label><input type="text" name="user_name" value="<?php echo $admin['user_name'] ?>" /></p>
                <p><label for="user_pass">User Password:</label><input type="text" name="user_pass" value="<?php echo $admin['user_pass'] ?>" /></p>
                <?php if($user_level > 100): ?>
                    <p><label for="user_unit">Unit:</label>
                        <select name="user_unit">
                            <option>Select Unit</option>
                            <?php foreach($units as $unit_name): ?>
                                <option <?php if($unit_name["unit_name"] == $admin["user_unit"]) echo "selected"; ?> value="<?php echo $unit_name["unit_name"]; ?>"><?php echo $unit_name["unit_name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <p><label for="user_base">Base:</label>
                        <select name="user_base">
                            <option>Select Base</option>
                            <?php foreach($bases as $base_name): ?>
                                <option <?php if($base_name["base_name"] == $admin["user_base"]) echo "selected"; ?> value="<?php echo $base_name["base_name"]; ?>"><?php echo $base_name["base_name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                <?php else: ?>
                    <input type="hidden" name="user_unit" value="<?php echo $admin['user_unit'] ?>" />
                    <input type="hidden" name="user_base" value="<?php echo $admin['user_base'] ?>" />
                <?php endif; ?>
                <input type="hidden" name="user_level" value="100" />
                <button type="button" class="save">Save</button>
                <button type="button" class="delete">Delete</button>
            </form>
        <?php endforeach; ?>
        <button class="add user">Add User</button>
    </section>
    
    <?php if($user_level > 100):
    
       include("admin-base.php");
    
    endif; ?>

<?php else: 

    include("admin-form.php"); ?>

<?php endif; ?>
<div class="hidden_form">
    <!-- Unit Users Form -->
    <form class="unit_admins" method="post" data-action="admin-process-user.php">
        <p><label for="user_name">User Name:</label><input type="text" name="user_name" /></p>
        <p><label for="user_pass">User Password:</label><input type="text" name="user_pass" /></p>
        <p><label for="user_unit">Unit:</label>
            <select name="user_unit">
                <option>Select Unit</option>
                <?php foreach($units as $unit_name): ?>
                    <option <?php if($unit_name["unit_name"] == $admin["user_unit"]) echo "selected"; ?> value="<?php echo $unit_name["unit_name"]; ?>"><?php echo $unit_name["unit_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p><label for="user_base">Base:</label>
            <select name="user_base">
                <option>Select Base</option>
                <?php foreach($bases as $base_name): ?>
                    <option <?php if($base_name["base_name"] == $admin["user_base"]) echo "selected"; ?> value="<?php echo $base_name["base_name"]; ?>"><?php echo $base_name["base_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <input type="hidden" name="user_level" value="100" />
        <button type="button" class="save">Save</button>
        <button type="button" class="delete">Delete</button>
    </form>
    <!-- Base Users Form -->
    <form class="base_admins" method="post" data-action="admin-process-user.php">
        <p><label for="user_name">User Name:</label><input type="text" name="user_name" value="<?php echo $admin['user_name'] ?>" /></p>
        <p><label for="user_pass">User Password:</label><input type="text" name="user_pass" value="<?php echo $admin['user_pass'] ?>" /></p>
        <p><label for="user_unit">Unit:</label>
            <select name="user_unit">
                <option>Select Unit</option>
                <?php foreach($units as $unit_name): ?>
                    <option <?php if($unit_name["unit_name"] == $admin["user_unit"]) echo "selected"; ?> value="<?php echo $unit_name["unit_name"]; ?>"><?php echo $unit_name["unit_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p><label for="user_base">Base:</label>
            <select name="user_base">
                <option>Select Base</option>
                <?php foreach($bases as $base_name): ?>
                    <option <?php if($base_name["base_name"] == $admin["user_base"]) echo "selected"; ?> value="<?php echo $base_name["base_name"]; ?>"><?php echo $base_name["base_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <input type="hidden" name="user_level" value="200" />
        <button type="button" class="save">Save</button>
        <button type="button" class="delete">Delete</button>
    </form>
    <!-- Base Form -->
    <section class="admin main base info">
        <form class="base_info" method="post" data-action="admin-process-base.php">
            <p><label for="">Base Name: </label><input type="text" name="base_name" /></p>
            <p><label for="">Base AADD/A2D2 Number: </label><input type="text" name="base_aadd_num" /></p>
            <p><label for="">Base SARC Number: </label><input type="text" name="base_sapr_num" /></p>
            <p><label for="">Base Cab Fallback Number: </label><input type="text" name="base_cab_num" /></p>
            <p><label for="">Base AFRC/MFLC Number: </label><input type="text" name="base_afrc_num" /></p>
            <button type="button" class="save">Save</button>
        </form>
    </section>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>
<script type="text/javascript" src="../scripts/admin.js"></script>
<?php include("../footer.php"); ?>