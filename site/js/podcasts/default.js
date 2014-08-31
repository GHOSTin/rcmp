$(document).ready(function(){
    $('body').on('click', '#new-podcast', function(){
        $.get('get_dialog_new_podcast/',{
        },function(r){
            show_content(r);
        });
    }).on('click', '.send_podcast', function(){
        if(($('#title').val() != '' && $('#alias').val() != ''))
            $.get('/podcasts/save_podcast/', {
                title: $('#title').val(),
                alias: $('#alias').val(),
                url: $('#url').val()||null
            }, function(r){
                $('.dialog').modal('hide');
                $('.podcasts-feed').prepend(r);
            });
    });
});