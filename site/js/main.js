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