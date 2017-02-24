$('input[type=submit]').click(function(){
    
    $('input[type=submit]').removeClass('password_error').removeClass('login_error');
    $('h2.password_error').removeClass('show');
    $('h2.login_error').removeClass('show');
    event.preventDefault();
    
    $('input').hide();
    
    login($('form').serialize(), function(){
        window.location.href = "/";
    });
    
});

$('form').submit(function(){
    
    $('input[type=submit]').removeClass('password_error').removeClass('login_error');
    $('h2.password_error').removeClass('show');
    $('h2.login_error').removeClass('show');
    event.preventDefault();
    
    $('input').hide();
    
    login($('form').serialize(), function(){
        window.location.href = "/";
    });
    
});


