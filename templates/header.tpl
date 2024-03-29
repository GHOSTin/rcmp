<header>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header" id="main-menu-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/" ><i class="fa fa-home"></i></a>
      </div>
      <div class="collapse navbar-collapse" id="nav-collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Послушать <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="http://mi.rpod.ru" target="_blank">На Rpod.ru</a></li>
              <li><a href="https://www.youtube.com/user/cndlos" target="_blank">На YouTube.com</a></li>
              <li><a href="http://www.pinterest.com/cndlos/" target="_blank">На Pinterest.com</a></li>
              <li><a href="https://itunes.apple.com/us/podcast/kanadskij-los/id363311940?mt=2&ign-mpt=uo%3D4" target="_blank">На iTunes&trade;</a></li>
              <li><a href="http://pirate.rcmp.me/download.html" target="_blank">Пиратская версия</a></li>
              <li><a href="http://meir.podfm.ru/los/?all=1" target="_blank">На  PodFM.ru</a></li>
              <li><a href="/online/">Онлайн-трансляция</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Почитать <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="http://chat.rcmp.me/" target="_blank">Чат</a></li>
              <li><a href="http://twitter.com/cndlos" target="_blank">Официальный Twitter</a></li>
              <li><a href="http://wiki.rcmp.me/" target="_blank">Вики подкаста</a></li>
              <li><a href="http://meirz.net" target="_blank">Блог Канадского Лося</a></li>
            </ul>
          </li>
          <li><a href="/donation/">Инвестиции</a></li>
            <li><a href="/podcasts/">Список подкастов</a></li>
          <li><a style="color:#a94442;" href="/news/"><strong>[Обсудить]</strong></a></li>
          <li><a style="color:#a94442;" href="/rss/feed/" target="_blank"><i class="fa fa-rss-square"></i> RSS</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          {% if user is empty %}
          <li><a href="/enter/">Вход</a></li>
          {% else %}
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ user.get_nickname() }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/logout/">Выход</a></li>
            </ul>
          </li>
          {% endif %}
        </ul>
      </div>
      <div class="rcmp_online_player hide">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 25" class="svg-online-player" >
          <path d="M0,25C20.432,25,15.185,0,40.308,0h48.543C94.973,0,100,4.634,100,10.385V25"></path>
        </svg>
        <p class="label">Онлайн вещание</p>
        <div id="jquery_jplayer" class="jp-jplayer" style="width: 0px; height: 0px;"></div>
        <div id="jp_container_1" class="jp-audio-stream">
          <div class="jp-type-single">
            <div class="jp-gui jp-interface">
              <ul class="jp-controls">
                <li><a href="javascript:;" class="jp-play" tabindex="1" style="display: block;"><i class="fa fa-play"></i></a></li>
                <li><a href="javascript:;" class="jp-pause" tabindex="1" style="display: none;"><i class="fa fa-stop"></i></a></li>
              </ul>
              <div class="jp-volume-bar">
                <div class="jp-volume-bar-value" style="width: 80%;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>