$(document).ready(function(){
    $('body').on('click', '#new-podcast', function(){
        $.get('/podcasts/get_dialog_new_podcast/',{
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
    }).on('click', '.edit_podcast', function(){
        $.get('/podcasts/get_dialog_edit_podcast/',{
            podcast_id: $(this).closest('li').attr('data-id')
        }, function(r){
            show_content(r);
        });
    }).on('click', '.send_edit_podcast', function(){
        var id = $('.podcast_id').text();
        if(($('#title').val() != '' && $('#alias').val() != ''))
            $.post('/podcasts/edit_podcast/', {
                id: id,
                title: $('#title').val(),
                alias: $('#alias').val(),
                url: $('#url').val()||null
            }, function(r){
                $('.dialog').modal('hide');
                $('.podcasts-feed').find('li[data-id='+id+']').replaceWith(r);
            });
    }).on('click', '.delete_podcast', function(){
        if(confirm("Вы подтверждаете удаление?")){
            $.get('/podcasts/delete_podcast/',{
                podcast_id: $(this).closest('li').attr('data-id')
            }, function(r){
                show_content(r);
            });
        }
    });
});