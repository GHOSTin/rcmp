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
    var entry = data.feed.entry[0];
    $container.find('.panel-title span').html(entry.title.$t);
    $container.find('.panel-body #video').html('<iframe height="360" width="100%" src="'+entry.content.src+'" frameborder="0" allowfullscreen></iframe>');
    $.ajax({url:'//gdata.youtube.com/feeds/api/videos/'+entry.media$group.yt$videoid.$t+'?v=2&alt=jsonc',dataType:'json',cache:true})
        .done(function(msg){$container.find('.panel-body #description').html($.urlify(msg.data.description).replace(/\n/g,"<br>"));});
}
$(document).ready(function(){

    var stream = {
            title: "ABC Jazz",
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
                        $(this).jPlayer("setMedia", stream).jPlayer("play");
                    },
                    pause: function() {
                        $(this).jPlayer("clearMedia");
                    },
                    error: function(event) {
                        if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
                            $(this).jPlayer("setMedia", stream).jPlayer("play");
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
        }
    });
});