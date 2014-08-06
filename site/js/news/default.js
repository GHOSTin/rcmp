$(document).ready(function(){
    $('body').on('click', '#new-news', function(){
        $.get('get_dialog_new_news/',{
        },function(r){
            show_content(r);
        }).done(function(){$('#summernote').summernote({
            lang: 'ru-RU',
            height: "300px",
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol']],
                ['insert', ['link', 'picture', 'video']],
            ]
            });
        });
    }).on('click', '.news-rating a', function(){
        $.get('/news/change_rating/', {
            news_id: $(this).closest('li').attr('data-id'),
            number: $(this).attr('href').replace('#', '')
        }, function(r){
            show_content(r);
        });
    }).on('click', '.edit_news', function(){
        $.get('/news/get_dialog_edit_news/', {
            news_id: $(this).closest('li').attr('data-id')
        }, function(r){
            show_content(r);
        }).done(function(){$('#summernote').summernote({
            lang: 'ru-RU',
            height: "300px",
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol']],
                ['insert', ['link', 'picture', 'video']],
            ]
            });
        });
    }).on('click', '.delete_news', function(){
        if(confirm("Вы подтверждаете удаление?")){
            $.get('/news/delete_news/',{
                news_id: $(this).closest('li').attr('data-id')
            }, function(r){
                show_content(r);
            });
        }
    });

});