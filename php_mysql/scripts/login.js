$('input[type=submit]').click(function(){
    
    $(this).removeClass('password_error').removeClass('login_error');
    event.preventDefault();
    
    $('input').hide();
    
    login($('form').serialize(), function(){
        window.location.href = "/";
    });
    
});


