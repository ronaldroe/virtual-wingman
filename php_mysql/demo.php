<?php include('head.php'); ?>

<script>
    $(window).load(function(){

        var unit = 'Demo';
        var pass = 'demounit';

        login({unit: unit, pass: pass}, function(){
            $('title').html(unit + " Virtual Wingman");
        });
        
        window.setTimeout(function(){
            localStorage.clear();
        }, 5000);

    });
</script>

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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>
<script src="scripts/main.js"></script>

<?php include('footer.php'); ?>