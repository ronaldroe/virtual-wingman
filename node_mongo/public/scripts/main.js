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
    var cab = data ? data.base_cab_num : localStorage.getItem('base_cab_num');
    
    $('.aadd a').prop('href', 'tel:' + aadd);
    $('.sapr a').prop('href', 'tel:' + sapr);
    $('.afrc a').prop('href', 'tel:' + afrc);
    $('.cab a').prop('href', 'tel:' + cab);
}

function init_page(){

    $.ajax({ url: 'sendlogin', type: 'POST', data: { unit: localStorage.getItem('unit_name'), pass: localStorage.getItem('unit_pass') } })
    .done(function(data){
            console.log(data);
        if(!data.password_error && !data.login_error){
            
            var base = data.unit_base;

            // Function to set up data
            set_up_unit_blocks(data);

            $.ajax({ url: 'sendbase', type: 'POST', data: {base: base} })
            .done(function(data){
                console.log(data);
                //Function to set up data
                set_up_base_blocks(data);
                
                $('.button:not(.custom)').fitText(0.5);
                $('.button.custom').fitText();
                
            });

        } else {

            window.location.href = './login';

        }

    })
    .fail(function(){
        console.log('fail')
        set_up_unit_blocks(null);
        set_up_base_blocks(null);
    });
    
    
    
}

function qr_login(unit_info, base_info){
    
    set_up_unit_blocks(unit_info);
    set_up_base_blocks(base_info);
    
    $('.button:not(.custom)').fitText(0.5);
    $('.button.custom').fitText();
    
    localStorage.setItem('logged_in', 'true');
    localStorage.setItem('unit_name', unit_info.unit_name);
    localStorage.setItem('unit_base', unit_info.unit_base);
    localStorage.setItem('unit_shirt_num', unit_info.unit_shirt_num);
    localStorage.setItem('unit_chaplain_num', unit_info.unit_chaplain_num);
    localStorage.setItem('unit_pass', unit_info.unit_pass);
    localStorage.setItem('logo', unit_info.logo);
    
    localStorage.setItem('base_aadd_num', base_info.base_aadd_num);
    localStorage.setItem('base_afrc_num', base_info.base_afrc_num);
    localStorage.setItem('base_sapr_num', base_info.base_sapr_num);
    localStorage.setItem('base_cab_num', base_info.base_cab_num);
    
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
    
    console.log(viewport.h);
    return viewport;
}

function open_menu(){
    $('nav').toggleClass('open');
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
    
    window.location.href = "./login";
}

window.addEventListener('load', function(){
    if(typeof unit_info !== 'undefined' && typeof base_info !== 'undefined'){
        qr_login(unit_info, base_info);
    } else if(check_logged_in()){
        init_page();
    } else {
        window.location.href = "/login";
    }
    
    $('.opener').click(function(){
        open_drawer();
    });
    
    $('.logout').click(function() {
        log_out();
    });
    
    $('.menu_button').click(function(){
        open_menu();
    });
    
    $('header h1').fitText();
    
});