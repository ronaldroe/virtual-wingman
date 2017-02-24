<?php 

// ************************************* MAIN PAGE INDEX *************************************

include('head.php');

    if($_GET["unit"] && $_GET["pass"]): ?>
    <script>
        $(window).load(function(){
            
            var unit = '<?php echo $_GET["unit"]; ?>';
            var pass = '<?php echo $_GET["pass"]; ?>';
            
            login({unit: unit, pass: pass}, function(){
                $('title').html(localStorage.getItem("unit_name") + " Virtual Wingman");
            });
            
        });
    </script>
    
<?php else: ?>
    
    <script>
        $(window).load(function(){
            if(check_logged_in()){
                
                var unit = localStorage.getItem("unit_name");
                var pass = localStorage.getItem("unit_pass");
                
                login({unit: unit, pass: pass}, function(){
                    $('title').html(localStorage.getItem("unit_name") + " Virtual Wingman");
                });
                
            } else {
                
                window.location.href = "/login.php";
                
            }
            
        });
    </script>
    
<?php endif; ?>

<header>
    <img class="logo">
    <h1>Virtual Wingman</h1>
    <div class="menu_button">&#9776;</div>
    <nav>
        <form>
            <h2>Custom Wingman #1</h2>
            <input type="text" name="custom_1_name" class="custom_1_name" data-num="1" placeholder="Name"/>
            <input type="text" name="custom_1_num" class="custom_1_num" data-num="1" placeholder="Number" />
            <button class="save" onclick="save_custom(1);">Save</button>
            <button class="del" onclick="del_custom(1);">Delete</button>
        </form>
        <form>
            <h2>Custom Wingman #2</h2>
            <input type="text" name="custom_2_name" class="custom_2_name" data-num="2" placeholder="Name"/>
            <input type="text" name="custom_2_num" class="custom_2_num" data-num="2" placeholder="Number" />
            <button class="save" onclick="save_custom(2);">Save</button>
            <button class="del" onclick="del_custom(2);">Delete</button>
        </form>
        <button class="logout">Log Out</button>
        <?php if($SETTINGS["is_admin"]): ?>
            <button class="admin">Admin</button>
        <?php endif; ?>
    </nav>
</header>

<section class="main">
    <div class="group">
        <div class="button aadd"><a>A2D2</a></div>
        <div class="button custom one half"><a></a></div>
    </div>
    <div class="group">
        <div class="button cab"><a>Taxi</a></div>
        <div class="button custom two half"><a></a></div>
    </div>
</section>

<section class="drawer">
    <div class="opener">&#9650;</div>
    <div class="button small shirt"><a>Shirt</a></div>
    <div class="button small chaplain"><a>Chaplain</a></div>
    <div class="button small sapr"><a>SARC</a></div>
    <div class="button small afrc"><a>AFRC</a></div>
</section>
<div class="map"></div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $key; ?>&libraries=places"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Geolocation/1.0.50/jquery.geolocation.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>
<script src="scripts/main.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4856851-6', 'auto');
  ga('send', 'pageview');

</script>

<?php include('footer.php'); ?>