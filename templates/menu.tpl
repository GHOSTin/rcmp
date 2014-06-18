<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header" id="main-menu-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/" ><i class="glyphicon glyphicon-home"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="nav-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Послушать <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="http://mi.rpod.ru" target="_blank">На Rpod.ru</a></li>
            <li><a href="https://www.youtube.com/user/cndlos" target="_blank">На YouTube.com</a></li>
            <li><a href="https://itunes.apple.com/us/podcast/kanadskij-los/id363311940?mt=2&ign-mpt=uo%3D4" target="_blank">На iTunes&trade;</a></li>
            <li><a href="http://pirate.rcmp.me/download.html" target="_blank">Пиратская версия</a></li>
            <li><a href="http://meir.podfm.ru/los/?all=1" target="_blank">На  PodFM.ru</a></li>
            <li><a href="/online/">Онлайн-трансляция</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Почитать <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="" data-toggle="modal" data-target="#rcmp_show_comments">Комментарии к подкастам</a></li>
            <li><a href="http://wiki.rcmp.me/" target="_blank">Вики подкаста</a></li>
            <li><a href="http://meirz.net" target="_blank">Блог Канадского Лося</a></li>
            <li><a href="http://twitter.com/cndlos" target="_blank">Официальный Twitter</a></li>
          </ul>
        </li>
        <li><a href="" data-toggle="modal" data-target="#rcmp_donation">Помощь подкасту</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        {% if user is empty %}
        <li><a href="/login/">Вход</a></li>
        {% else %}
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ user.get_nickname() }} <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <!--<li class="divider"></li>-->
            <li><a href="/login/exit/">Выход</a></li>
          </ul>
        </li>
        {% endif %}
      </ul>
    </div>
  </div>
</nav>