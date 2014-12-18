var momentTime = function(){
    $('abbr[id|=time]').each(function(){
        $(this).text(moment.unix($(this).text()).local().locale('ru').calendar());
    });
};
$(document).ready(function(){
    var declension = function(number){
        var cases = [2, 0, 1, 1, 1, 2],
            forms = ['комментарий','комментария','комментариев'];
        return number +' ' +forms[ ( number%100>4 && number%100<20)? 2 : cases[Math.min(number%10, 5)] ];
    };
    momentTime();
    $(document).on('click', '.textarea-wrapper div', function(e){
        $(this).find('span.placeholder').hide();
        $(this).find('div.textarea').focus();
    }).on('blur', '.textarea-wrapper div', function(e){
        if($('div.textarea').text() == ''){
            $(this).siblings('span.placeholder').show();
        }
    }).on('click', 'form.reply .btn', function(e){
        e.preventDefault();
        var textarea = $(this).closest('form').find('div.textarea');
        $.post( window.location.pathname + 'comment/',
            {
                text: textarea.text(),
                parent_id: $(this).closest('li.post').attr('id') || null,
                sort: $('.sorting').find('.selected a').attr('data-sort') || 'desc'
            }).done(function(res){
                document.getElementsByClassName('post-list-container')[0].innerHTML = res.template;
                document.getElementsByClassName('comment-count')[0].innerText = declension(res.count);
                momentTime();
                textarea.text('');
                textarea.trigger('blur');
            });
        return false;
    }).on('click', 'li.reply a', function(){
        $(this).closest('.post-content').find('form.reply').toggleClass('hidden');
        var textarea = $(this).closest('.post-content').find('form.reply').find('div.textarea');
        textarea.text('');
        if(!textarea.hasClass('hidden'))
            textarea.trigger('click');
    }).on('click', 'li.delete a', function(){
        var comment_id = $(this).closest('li.post').attr('id').split('-')[1];
        $.ajax({
            url: window.location.pathname + 'comment/' + comment_id + '/delete/',
            type: 'PUT',
            data:{
                sort: $('.sorting').find('.selected a').attr('data-sort') || 'desc'
            }
        }).done(function(res){
            document.getElementsByClassName('post-list-container')[0].innerHTML = res.template;
            document.getElementsByClassName('comment-count')[0].innerText = declension(res.count);
            momentTime();
        });
    }).on('click', '.sorting .dropdown-menu > li', function(){
        $(this).siblings('li').removeClass('selected');
        $(this).addClass('selected');
        $('.sorting .dropdown-toggle').html($(this).find('a').text()+' вначале <span class="caret"></span>');
        $.get( window.location.pathname + 'comment/',
            {
                sort: $(this).find('a').attr('data-sort') || 'desc'
            }).done(function(res){
                document.getElementsByClassName('post-list-container')[0].innerHTML = res.template;
                document.getElementsByClassName('comment-count')[0].innerText = declension(res.count);
                momentTime();
            });
    })
});