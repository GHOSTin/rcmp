$(document).ready(function(){
    var $container;
    $('body').on('click', '#new-news', function(){
        $.get('get_dialog_new_news/',{
        },function(r){
            show_content(r);
        }).done(function(){$('#editor').wysibb({
                lang: 'ru',
                buttons: "bold,italic,underline,|,video,link",
                minheight: 200
            });
        });
    }).on('click', '.news-rating a', function(){
        $.get('/news/change_rating/', {
            news_id: $(this).closest('li').attr('data-id'),
            number: $(this).attr('href').replace('#', '')
        }, function(r){
            show_content(r);
            $('.isotope').isotope('reloadItems');
            $('#sorts').trigger('change');
        });
    }).on('click', '.edit_news', function(){
        $.get('/news/get_dialog_edit_news/', {
            news_id: $(this).closest('li').attr('data-id')
        }).done(function(r){
            show_content(r);
            $('#editor').wysibb({
                lang: 'ru',
                buttons: "bold,italic,underline,|,video,link",
                minheight: 200
            });
        });
    }).on('click', '.delete_news', function(){
        if(confirm("Вы подтверждаете удаление?")){
            $.get('/news/delete_news/',{
                news_id: $(this).closest('li').attr('data-id')
            }, function(r){
                show_content(r);
                $('.isotope').isotope('reloadItems');
                $('#sorts').trigger('change');
            });
        }
    }).on('click', '.send_news', function(){
        if(($('#title').val() != '' && $('#editor').bbcode() != ''))
            $.get('/news/save_news/', {
                title: $('#title').val(),
                description: $('#editor').bbcode()
            }, function(r){
                $('.dialog').modal('hide');
                $('.news-feed').append(r);
                $('.isotope').isotope('reloadItems');
                $('#sorts').trigger('change');
            });
    }).on('click', '.send_edit_news', function(){
            var id = $('.news_id').text();
            if(($('#title').val() != '' && $('#editor').bbcode() != ''))
                $.post('/news/edit_news/', {
                    id: id,
                    title: $('#title').val(),
                    description: $('#editor').bbcode()
                }, function(r){
                    $('.dialog').modal('hide');
                    $('.news-feed').find('li[data-id='+id+']').replaceWith(r);
                    $('.isotope').isotope('reloadItems');
                    $('#sorts').trigger('change');
                });
    }).on('click', '.attach', function(){
        if($('#attach_podcast').val()){
            var myCheckboxes = new Array();
            $(".news-feed input:checked").each(function() {
                myCheckboxes.push($(this).closest('li').attr('data-id'));
            });
            $.post('/news/attach_news/', {
                podcast: $('#attach_podcast').val(),
                news: myCheckboxes
            }, function(r){
                show_content(r);
                $('.isotope').isotope('reloadItems');
                $('#sorts').trigger('change');
            });
        }
    });

    // bind sort button click
    $('#sorts').on( 'change', function() {
        // init Isotope
        $container = $('.isotope').isotope({
            layoutMode: 'vertical',
            getSortData: {
                number: '[data-id] parseInt',
                date: '.date parseInt',
                rating: '.rating parseInt'
            },
            sortAscending: {
                number: false,
                date: false,
                rating: false
            }
        });
        var sortValue = $(this).find('input[name=sort]:checked').attr('data-sort-value');
        sortValue = sortValue.split(',');
        $container.isotope({ sortBy: sortValue });
    }).trigger('change');

});