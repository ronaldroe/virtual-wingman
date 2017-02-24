var x = window.addEventListener('load', function(){
    var input = $('#select-template').html();
    var template = Hogan.compile(input);
    var output = template.render('{{data_opts}}');
    $('select').html(output);
});


$('input[type=submit]').click(function(){
    
    $(this).removeClass('password_error').removeClass('login_error');
    event.preventDefault();
    var base;
    
    $.ajax({ url: 'sendlogin', type: 'POST', data: $('form').serialize() })
    .done(function(data){
        
        if(!data.password_error && !data.login_error){
            
            $('input[type=submit]').removeClass('password_error');
            $('input[type=submit]').removeClass('login_error');
            
            console.log(data);
            base = data.unit_base;

            localStorage.setItem('unit_name', data.unit_name);
            localStorage.setItem('unit_base', data.unit_base);
            localStorage.setItem('unit_shirt_num', data.unit_shirt_num);
            localStorage.setItem('unit_chaplain_num', data.unit_chaplain_num);
            localStorage.setItem('unit_pass', data.unit_pass);
            localStorage.setItem('logo', data.logo);

            $.ajax({ url: 'sendbase', type: 'POST', data: {base: base} })
            .done(function(data){
                console.log(data);

                localStorage.setItem('base_aadd_num', data.base_aadd_num);
                localStorage.setItem('base_afrc_num', data.base_afrc_num);
                localStorage.setItem('base_sapr_num', data.base_sapr_num);
                localStorage.setItem('base_cab_num', data.base_cab_num);
                
                localStorage.setItem('logged_in', 'true');
                
                window.location.href = './';        
                
            });
            
                        
        } else if(data.password_error){
            
            $('input[type=submit]').addClass('password_error').val('Try Again');
            $('h2.password_error').addClass('show');
            
        } else if(data.login_error){
            
            $('input[type=submit]').addClass('login_error').val('Try Again');
            $('h2.login_error').addClass('show');
            
        }
    })
    .fail(function(err){
        
        $('input[type=submit]').addClass('login_error').val('Try Again');
        $('h2.login_error').addClass('show');
        console.log(err);
        
    });
});