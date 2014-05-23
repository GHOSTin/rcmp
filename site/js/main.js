$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: 'http://pirate.rcmp.me/status/status.txt',
        beforeSend: function(xhr){
            xhr.withCredentials = true;
        },
        success: function(request){
            if(request == 'online'){
                $('#main-menu-header').append('<a class="navbar-brand" href="/stream" ><p class="label label-danger">Онлайн вещание</p></a>');
            }
        }
    });
});