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