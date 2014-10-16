{% extends "public.tpl" %}
{% set news = response.news %}
{% block content %}
  <p><button class="btn btn-success" id="new-news"><i class="fa fa-plus"></i> Добавить тему</button></p>
  {% include '@news/news-list.tpl' with {'news': news} %}
{% endblock content %}
{% block css %}
  <link href="/css/news/default.css" rel="stylesheet">
  <link href="/public/components/jqjquery-wysibb/theme/default/wbbtheme.css" rel="stylesheet">
{% endblock %}
{% block js %}
  <script src="/public/components/jqjquery-wysibb/jquery.wysibb.min.js"></script>
  <script src="/public/components/jqjquery-wysibb/lang/ru.js"></script>
  <script src="/js/news/isotope.min.js"></script>
  <script src="/js/default.js"></script>
  <script src="/js/news/default.js"></script>
{% endblock %}
