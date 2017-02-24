function del_item(element){
    
    var data = $(element).parent('form').serializeArray();
    data.push({name: 'action', value: 'delete'});
    
    $.ajax({url: $(element).parent('form').attr('data-action'), type: 'POST', data: data})
    .done(function(data){
        console.log(data);
        
        data = JSON.parse(data);
        
        if(data.success){
            $(element).parent('form').hide(200, function(){
                alert("Deleted");
            });
        } else {
            alert('Delete failed');
        }
        
    });
    
}

function save_item(element){
    
    var data = $(element).parent('form').serializeArray();
    data.push({name: 'action', value: 'save'});
    
    $.ajax({url: $(element).parent('form').attr('data-action'), type: 'POST', data: data})
    .done(function(data){
        console.log(data);
        data = JSON.parse(data);
        
        if(data.success){
            
            alert("Saved");
            
        } else {
            
            alert('Save failed');
            
        }
        
    });
    
}

function copy_form(element){
    var form_to_copy = $(element).parent('section').children('form').clone();
    form_to_copy = form_to_copy[0];
    
    $(form_to_copy).children('p').children('input[type=text]').each(function(){
        $(this).removeAttr('value');
    });
    
    if(typeof form_to_copy == "undefined"){
        if($(element).hasClass('user')){
            form_to_copy = $('.hidden_form .unit_admins').clone();
        }
    }
    
    $(element).before(form_to_copy);
}

$(window).load(function(){
    $('header.admin h1').fitText(1.5, {maxFontSize: '40px'});
    $('section.admin h3').click(function(){
        $(this).parent('section').toggleClass('open');
    });
    $('section.admin').on('click', '.delete', function(event){
        event.preventDefault();
        del_item(this);
    });
    $('section.admin').on('click', '.save', function(event){
        event.preventDefault();
        save_item(this);
    });
    $('section.admin .add').click(function(){
        copy_form(this);
    });
    
});