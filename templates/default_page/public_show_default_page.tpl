{% extends "public.tpl" %}
{% block content %}
<div class="page-header"><h1>Подкаст Канадского Лося и Co<sup style="color: #A0A0A0;">18+</sup></h1></div>
{% include '@default_page/online.tpl' %}
<section class="row">
  <section class="col-md-6">
    {% include "@default_page/about.tpl" %}
    {% include "@default_page/headings.tpl" %}
  </section>
  <section class="col-md-6">
    <article class="well">
      <p>
        <b class="label label-danger">Важное примечание:</b>
        Если Вы не знакомы термины подкасты, подкастинг, rss фид, iTunes и т.д. рекомендуем Вам ознакомиться с статьей на
        <a href="http://lurkmore.to/%D0%9F%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82" arget="_blank">Лурке</a> или
        <a href="http://ru.wikipedia.org/wiki/%D0%9F%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82%D0%B8%D0%BD%D0%B3" target="_blank">Википедии</a>.
        Для тех кому лень читать: подкасты &mdash; это как радио только лучше&trade;
      </p>
    </article>
    {% include "@default_page/news.tpl" %}
  </section>
</section>
<section class="row">
  {% include "@default_page/masters.tpl" %}
</section>
<section class="row">
  {% include "@default_page/channels.tpl" %}
</section>
<footer>
  <div class="row">
    {% include "@default_page/footer.tpl" %}
  </div>
</footer>
{% include "@default_page/show_comments.tpl" %}
{% include "@default_page/donation.tpl" %}
{% endblock content %}
{% block js %}
  <script src="http://gdata.youtube.com/feeds/api/users/cndlos/uploads?v=2&alt=json-in-script&format=5&max-results=1&callback=getLastVideo"></script>
{% endblock %}