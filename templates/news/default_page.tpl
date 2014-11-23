{% extends "default.tpl" %}

{% block content %}
  {% if user %}
  <p><button class="btn btn-success" id="new-news"><i class="fa fa-plus"></i> Добавить тему</button></p>
  {% else %}
  <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    Для того чтобы оставить тему для обсуждения или проголосовать, <a href="/login/" class="alert-link">авторизуйтесь</a>.
  </div>
  {% endif %}
  {% include 'news/news-list.tpl' with {'news': news} %}
{% endblock %}

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
