{% extends "default.tpl" %}

{% block content %}
<div class="row">
  <div class="col-md-7">
    <h1>Подкаст Канадского Лося и Co<sup style="color: #A0A0A0;">18+</sup></h1>
  </div>
  <div class="col-md-5">
    <h1 class="pull-right"><iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/small.xml?account=410011225397189&quickpay=small&yamoney-payment-type=on&button-text=06&button-size=m&button-color=orange&targets=%D0%BF%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82&default-sum=99&successURL=" width="212" height="42"></iframe></h1>
  </div>
</div>
<div class="well">
  <p>Своим слушателям мы даем возможность поучаствовать в записи подкаста.
  Специально для этого во время записи подкаста мы проводим <a href="/online/">онлайн-трансляцию</a> и сделали <a href="http://chat.rcmp.me/" target="_blank">чат</a> для общения с ведущими.
  Часто в официальный подкаст не попадает инсайд, который можно услышать во время онлайн-трансляции и он оказывается безвозвратно утерян, если конечно <a href="http://sniper.rpod.ru/" target="_blank">Снайпер</a> не записал <a href="http://pirate.rcmp.me/download.html" target="_blank">пиратку</a> и не выложил все  на свои сервера в NSA.</a> В том случае если вы услышали пикантные подробности в прямом эфире и хотели бы поделится своими наблюдениями со всеми слушателями вы можете воспользоваться нашей <a href="http://wiki.rcmp.me" target="_blank">wiki</a>.</p>
</div>
{% if podcast %}
<div class="row">
  <div class="col-md-6">
    <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/{{ podcast.get_url() }}" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
  <div class="col-md-6">
    <h4>Свежий выпуск:
      <a href="/podcasts/{{ podcast.get_alias() }}/">{{ podcast.get_name() }}</a>
    {% if podcast.get_file_url() %}
      <a href="{{ podcast.get_file_url() }}" target="_blank">
        <span class="badge"><i class="fa fa-download" title="Скачать"></i> скачать</span>
      </a>
    {% endif %}
    </h4>
    <ul class="list-unstyled">
    {%- for news in podcast.get_news -%}
    <li>{{ news.get_title() }}
      {% for link in news.get_urls %}
      <a href="{{ link }}">{{ link|truncate(35) }}</a>
        {% if not loop.last %}, {% endif %}
      {% endfor %}
    </li>
    {%- endfor -%}
    </ul>
  </div>
</div>
{% endif %}
<section class="row">
  <div class="col-md-12 text-center">
    <h2 style="padding: 15px 0;">Ведущие подкаста</h2>
    <div class="row">
      <div class="col-sm-4">
        <a href="http://wiki.rcmp.me/index.php?title=%D0%96%D0%B5%D0%BD%D1%8F" target="_blank" >
          <img src="./images/host_los.jpg" class="img-circle img-responsive rcmp_master" alt="Женя" title="Женя">
        </a>
        <a href="http://wiki.rcmp.me/index.php?title=%D0%96%D0%B5%D0%BD%D1%8F" target="_blank" class="btn btn-lg btn-inverse">Женя</a>
      </div>
      <div class="col-sm-4">
        <a href="http://wiki.rcmp.me/index.php?title=%D0%92%D0%B0%D0%BD%D1%8F" target="_blank">
          <img src="./images/host_vanya.jpg" class="img-circle img-responsive rcmp_master" alt="Ваня" title="Ваня" >
        </a>
        <a href="http://wiki.rcmp.me/index.php?title=%D0%92%D0%B0%D0%BD%D1%8F" target="_blank" class="btn btn-lg btn-inverse">Ваня</a>
      </div>
      <div class="col-sm-4">
        <a href="http://wiki.rcmp.me/index.php?title=%D0%92%D0%B8%D0%BA%D1%82%D0%BE%D1%80" target="_blank" >
          <img src="./images/host_viktor.jpg" alt="Виктор" title="Виктор" class="img-circle img-responsive rcmp_master">
        </a>
        <a href="http://wiki.rcmp.me/index.php?title=%D0%92%D0%B8%D0%BA%D1%82%D0%BE%D1%80" target="_blank" class="btn btn-lg btn-inverse">Виктор</a>
      </div>
    </div>
  </div>
</section>
{% endblock %}