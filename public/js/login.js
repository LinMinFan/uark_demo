function showPassword() {
    
    let password_attr = $('#password').attr('type');
    
    if(password_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#password').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#password').attr('type', 'password');
        
    }
    
}