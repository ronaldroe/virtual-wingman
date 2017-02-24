<form class="login" method>
    <h2 class="password_error">Incorrect Username or Password</h2>
    <h2 class="login_error">Something's Wrong. Try Again</h2>
    <input type="text" name="admin_user" placeholder="Username" />
    <input type="password" name="admin_pass" placeholder="Password" />
    <input type="submit" value="Send" />
</form>

<script type="text/javascript">
    
    $('form.login').submit(function(){
        event.preventDefault();
        $.ajax({url: 'admin-login.php', type: 'POST', data: $('form.login').serialize()})
        .done(function(data){
            
            data = JSON.parse(data);
            
            if(!data.password_error && !data.login_error){
                
                var date = new Date();
                date.setYear(date.getYear() + 1);
                date = date.toGMTString();
                
                $('input[type=submit]').removeClass('password_error');
                $('input[type=submit]').removeClass('login_error');
                console.log(data);
                document.cookie = 'admin_logged_in=true;path=/';
                document.cookie = 'user_name=' + data.user_name;
                document.cookie = 'user_pass=' + data.user_pass;
                document.cookie = 'user_level=' + data.user_level;
                document.cookie = 'user_base=' + data.user_base;
                document.cookie = 'user_unit=' + data.user_unit;
                console.log(document.cookie);
                
                window.location.href = window.location.href;
                
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
    });
    
</script>