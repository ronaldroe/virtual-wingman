function check_logged_in(){
    
    var is_logged_in = localStorage.getItem('logged_in');
    
    if(is_logged_in){
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}

function init_custom(){
    
    if(localStorage.getItem('custom_1_name') && localStorage.getItem('custom_1_num')){
        $('.custom.one').addClass('show').children('a').prop('href', 'tel:' + localStorage.getItem('custom_1_num')).html(localStorage.getItem('custom_1_name'));
        $('.aadd').addClass('half');
        $('input.custom_1_name').val(localStorage.getItem('custom_1_name'));
        $('input.custom_1_num').val(localStorage.getItem('custom_1_num'));
    }
    if(localStorage.getItem('custom_2_name') && localStorage.getItem('custom_2_num')){
        $('.custom.two').addClass('show').children('a').prop('href', 'tel:' + localStorage.getItem('custom_2_num')).html(localStorage.getItem('custom_2_name'));
        $('.cab').addClass('half');
        $('input.custom_2_name').val(localStorage.getItem('custom_2_name'));
        $('input.custom_2_num').val(localStorage.getItem('custom_2_num'));
    }
    
    size_blocks(get_viewport());
    
}

function save_custom(n){
    event.preventDefault();
    localStorage.setItem('custom_' + n + '_name', $('input.custom_' + n + '_name').val());
    localStorage.setItem('custom_' + n + '_num', $('input.custom_' + n + '_num').val());
    location.reload();
}

function del_custom(n){
    event.preventDefault();
    localStorage.removeItem('custom_' + n + '_name');
    localStorage.removeItem('custom_' + n + '_num');
    location.reload();
}

function set_up_unit_blocks(data){
    var shirt = data ? data.unit_shirt_num : localStorage.getItem('unit_shirt_num');
    var logo = data ? data.logo : localStorage.getItem('logo');
    var chaplain = data ? data.unit_chaplain_num : localStorage.getItem('unit_chaplain_num');
    $('.shirt a').prop('href', 'tel:' + shirt);
    $('.chaplain a').prop('href', 'tel:' + chaplain);
    $('img.logo').attr('src', 'images/' + logo);
    
    init_custom();
}

function set_up_base_blocks(data){
    
    var aadd = data ? data.base_aadd_num : localStorage.getItem('base_aadd_num');
    var sapr = data ? data.base_sapr_num : localStorage.getItem('base_sapr_num');
    var afrc = data ? data.base_afrc_num : localStorage.getItem('base_afrc_num');
    //var cab = data ? data.base_cab_num : localStorage.getItem('base_cab_num');
    
    $('.aadd a').prop('href', 'tel:' + aadd);
    $('.sapr a').prop('href', 'tel:' + sapr);
    $('.afrc a').prop('href', 'tel:' + afrc);
    //$('.cab a').prop('href', 'tel:' + cab);
}

function init_page(){

    if(check_logged_in()){
        
        login({unit: localStorage.getItem("unit_name"), pass: localStorage.getItem("unit_pass")});
        
    } else {
        
        window.location.href = "/login.php"
        
    }
    
}

function size_blocks(viewport){
    
    var block_full = {
        w: (viewport.w - 40),
        h: Math.floor(((viewport.h - 130) / 2) - 30)
    };
    var block_half = {
        w: Math.floor((block_full.w / 2) - 10),
        h: Math.floor((block_full.h / 2))
    };
    var block_small = {
        w: Math.floor((block_full.w / 3) - 13.33),
        h: Math.floor((block_full.w / 3) - 13.33)
    };
    
    $('.button:not(.half, .small)').css({
        'height': block_full.h + 'px',
        'width': block_full.w + 'px',
        'line-height': block_full.h + 'px',
        'left': '20px',
        'margin-top': '20px'
    });
    
    $('.half').css({
        'height': block_full.h + 'px',
        'width': block_half.w + 'px',
        'line-height': block_full.h + 'px',
        'margin-left': '20px',
        'margin-top': '20px'
    });
    
    $('.small').css({
        'height': block_small.h + 'px',
        'width': block_small.w + 'px',
        'line-height': block_small.h + 'px',
        'margin-left': '13.33%',
        'margin-bottom': '20px'
    });
    
    $('nav').css({'min-height': (viewport.h - 170) + 'px'})
    
    $('.button:not(.custom)').fitText(0.5);
    $('.button.custom').fitText();
    
}

function open_drawer(){
    
    var is_open = $('.drawer').hasClass('open');
    
    if(is_open){
        $('.drawer').removeClass('open');
        $('.opener').html("&#9650;")
    } else {
        $('.drawer').addClass('open');
        $('.opener').html("&#9660;")
    }
    
}

function get_viewport(){
    var viewport = {
        w: $(window).outerWidth(true),
        h: $(window).outerHeight(true)
    }
    
    return viewport;
}

function open_menu(){
    $('nav').toggleClass('open');
}

function login(data, callback){
    
    $.ajax({ url: 'processor.php', type: 'POST', data: data })
    .done(function(data){
        
        var data = JSON.parse(data);
        
        if(!data.password_error && !data.login_error){
            
            $('input[type=submit]').removeClass('password_error');
            $('input[type=submit]').removeClass('login_error');
            
            console.log(data);

            localStorage.setItem('unit_name', data.unit_name);
            localStorage.setItem('unit_base', data.unit_base);
            localStorage.setItem('unit_shirt_num', data.unit_shirt_num);
            localStorage.setItem('unit_chaplain_num', data.unit_chaplain_num);
            localStorage.setItem('unit_pass', data.unit_pass);
            localStorage.setItem('logo', data.logo);

            localStorage.setItem('base_aadd_num', data.base_aadd_num);
            localStorage.setItem('base_afrc_num', data.base_afrc_num);
            localStorage.setItem('base_sapr_num', data.base_sapr_num);
            localStorage.setItem('base_cab_num', data.base_cab_num);
            
            localStorage.setItem('logged_in', 'true');
            
            if(typeof callback == "function") callback();
            
            set_up_base_blocks(data);
            set_up_unit_blocks(data);
            
        } else if(data.password_error){
            
            $('input[type=submit]').addClass('password_error').val('Try Again');
            $('h2.password_error').addClass('show');
            $('input').show();
            
        } else if(data.login_error){
            
            $('input[type=submit]').addClass('login_error').val('Try Again');
            $('h2.login_error').addClass('show');
            $('input').show();
            
        }
    })
    .fail(function(err){
        
        $('input[type=submit]').addClass('login_error').val('Try Again');
        $('h2.login_error').addClass('show');
        $('input').show();
        
        console.log(err);
    });
    
}

function log_out(){
    localStorage.removeItem('base_aadd_num');
    localStorage.removeItem('base_afrc_num');
    localStorage.removeItem('base_cab_num');
    localStorage.removeItem('base_sapr_num');
    localStorage.removeItem('logged_in');
    localStorage.removeItem('logo');
    localStorage.removeItem('unit_base');
    localStorage.removeItem('unit_chaplain_num');
    localStorage.removeItem('unit_name');
    localStorage.removeItem('unit_pass');
    localStorage.removeItem('unit_shirt_num');
    
    window.location.href = "/login.php";
}

function get_position(){
    $.geolocation.get({
       win: get_cab_number,
       fail: no_location
    });
}

var map, service;

function get_cab_number(position){
    
    /*$('.cab').animate({
        width: (get_viewport().w - 40),
        height: Math.floor((get_viewport().h - 130) - 40),
        top: Math.floor(((get_viewport().h - 130) / 2) - 10) * (-1),
        position: 'absolute'
    }, 200);*/
    var location = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); /* global google */
    map = new google.maps.Map(document.querySelector('.map'), {
      center: location,
      zoom: 15
    });
    request = { /*global request*/
      location: location,
      radius: 50000,
      keyword: 'taxi service'
    };
    service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, add_cab_numbers);
}

function add_cab_numbers(results, status){
    
    var map = new google.maps.Map(document.querySelector('.map'), {
      center: request.location,
      zoom: 15
    });
    var place;
    var places_list = [];
    for(var i = 0; i<results.length; i++){
        var limo = results[i].name.search(new RegExp('limo', 'i'));
        place = results[i].place_id;
        if(limo < 0){
            place = results[i];
            break;
        }
    }
    
    console.log(place);
    
    service.getDetails(place.place_id, function(placeDeets, status){
        console.log('=> ' + placeDeets);
    });
}

function no_location(){
    var cab = localStorage.getItem('base_cab_num');
    $('.cab a').prop('href', 'tel:' + cab);
    window.location.href = $('.cab a').prop('href');
}

window.addEventListener('load', function(){
    
    $('.opener').click(function(){
        open_drawer();
    });
    
    $('.logout').click(function() {
        log_out();
    });
    
    $('.admin').click(function(){
        window.location.href = "vw-admin"
    })
    
    $('.menu_button').click(function(){
        open_menu();
    });
    
    $('.cab').on('click', function(){
        get_position();
    })
    
    $('header h1').fitText();
    
});