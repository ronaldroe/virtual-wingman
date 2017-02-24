
<?php 

include("../connect.php");
    
foreach($bases as $base): ?>
    <section class="admin main base info">
        <h3>Base Details for: <?php echo $base["base_name"]; ?></h3>
        <form class="base_info" method="post" data-action="admin-process-base.php">
            <input type="hidden" name="base_name" value="<?php echo $base["base_name"]; ?>" />
            <p><label for="">Base AADD/A2D2 Number: </label><input type="text" name="base_aadd_num" value="<?php echo $base["base_aadd_num"]; ?>" /></p>
            <p><label for="">Base SARC Number: </label><input type="text" name="base_sapr_num" value="<?php echo $base["base_sapr_num"]; ?>" /></p>
            <p><label for="">Base Cab Fallback Number: </label><input type="text" name="base_cab_num" value="<?php echo $base["base_cab_num"]; ?>" /></p>
            <p><label for="">Base AFRC/MFLC Number: </label><input type="text" name="base_afrc_num" value="<?php echo $base["base_afrc_num"]; ?>" /></p>
            <button type="button" class="save">Save</button>
        </form>
    </section>
<?php endforeach; ?>

<?php foreach($bases as $base): 
    $base_admins = $admin->find(["user_level" => ['$gte' => 200], "user_base" => $base["base_name"]]);
    $base_admins->sort(["user_name" => 1]); ?>
    <section class="admin main base users">
        <h3>Base-level Users for: <?php echo $base["base_name"]; ?></h3>
        <?php foreach($base_admins as $admin): ?>
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
                <?php if($admin["user_name"] == "rroe"): ?>
                <input type="hidden" name="user_level" value="9001" />
                <?php else: ?>
                <input type="hidden" name="user_level" value="200" />
                <?php endif; ?>
                <button type="button" class="save">Save</button>
                <button type="button" class="delete">Delete</button>
            </form>
        <?php endforeach; ?>
        <button class="add admin">Add User</button>
    </section>
<?php endforeach; ?>

<section class="admin main base units">
    <h3>Units on: <?php echo $user_base_info["base_name"]; ?></h3>
</section>