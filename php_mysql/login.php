<?php include("head.php") ?>

<form action="sendlogin" class="login" method="post">
    <h2 class="password_error">Incorrect Password</h2>
    <h2 class="login_error">Something's Wrong. Try Again</h2>
    <select name="unit">
        <option>Select Unit</option>
    <?php 
    
        include("connect.php");
        
        // MYSQL QUERIES
        
        $opts = $mysql_db->query("SELECT * FROM units WHERE NOT (unit_name='Demo') ORDER BY unit_name");
        
        foreach ($mysql_units as $mysql_unit){
            
            echo $mysql_unit[unit_name];
            
        }
        
        // MONGO QUERIES
        /*$opts = $unit->find(["unit_name" => ['$ne' => 'Demo']]);
        
        $opts->sort(["unit_name" => 1]);*/
        
        foreach ($opts as $option){ ?>
            
            <option value="<?php echo $option['unit_name'] ?>"><?php echo $option['unit_name'] ?></option>
            
    <?php } ?>
    
</select>
    <input type="password" name="pass" placeholder="password" />
    <input type="submit" value="Log In" />
</form>

<script src="scripts/main.js"></script>
<script type="text/javascript" src="scripts/login.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>

<?php include("footer.php"); ?>