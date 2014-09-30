(function($){
    $.urlify = function(text){
        var urlRegex = /(https?:\/\/[^\s]+)/g;
        return text.replace(urlRegex, function(url) {
            return '<a href="' + url + '" target="_blank">' + url + '</a>';
        });
    };
})(jQuery);
function getLastVideo(data){
    var $container = $('#LastVideo');
    if(!data.error) {
        var entry = JSON.parse(data).podcast;
        $container.find('.panel-title span').html(entry.title);
        $container.find('.panel-body #video').html('<iframe height="360" width="100%" src="http://www.youtube.com/embed/'+entry.youtube_url+'" frameborder="0" allowfullscreen></iframe>');
        $container.find('.panel-body #description').html('<h4>Обсужденные темы:</h4>');
        if(entry.news){
            $container.find('.panel-body #description').append('<ul class="list-unstyled"></ul>');
            for(var id in entry.news){
                var news = '';
                news += '<li>-'+entry.news[id].title;
                if(entry.news[id].urls){
                    news += ' (';
                    news += entry.news[id].urls.map(function(elem){
                        return '<a href="'+elem.url+'">'+elem.title+'</a>';
                    }).join(", ");
                    news += ') ';
                }
                news += '</li>';
                $container.find('.panel-body #description ul').append(news);
            }
        }
    }
}
$(document).ready(function(){

    var stream = {
            title: "RCMP Stream",
            mp3: "http://rcmp.me/stream"
        },
        ready = false;

    $.ajax({
        type: 'GET',
        url: 'http://pirate.rcmp.me/status/status.txt',
        beforeSend: function(xhr){
            xhr.withCredentials = true;
        },
        success: function(request){
            if($.trim(request) == 'online'){
                $('.rcmp_online_player').removeClass('hide');
                $("#jquery_jplayer").jPlayer({
                    ready: function (event) {
                        ready = true;
                        $(this).jPlayer("setMedia", stream);
                    },
                    pause: function() {
                        $(this).jPlayer("clearMedia");
                        localforage.setItem('playerStatus', 'stop');
                    },
                    play: function() {
                        localforage.setItem('playerStatus', 'play');
                    },
                    error: function(event) {
                        if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
                            $(this).jPlayer("setMedia", stream).jPlayer("play");
                            localforage.setItem('playerStatus', 'play');
                        }
                    },
                    swfPath: "../js",
                    supplied: "mp3",
                    preload: "none",
                    wmode: "window",
                    keyEnabled: true
                });
                $('.page-header').prepend('<img src="/images/online.png" class="img-responsive img-online">');
                $('body').addClass('online');
            }
            localforage.getItem('playerStatus')
                .then(function(res){
                    if(res){
                        $("#jquery_jplayer").jPlayer(res.toString());
                    }
                });
        }
    });
});