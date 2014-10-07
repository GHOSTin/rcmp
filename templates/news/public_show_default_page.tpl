{% extends "public.tpl" %}
{% set news = response.news %}
{% block content %}
  <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    Для того чтобы оставить тему для обсуждения или проголосовать, <a href="/login/" class="alert-link">авторизуйтесь</a>.
  </div>
  {% include '@news/news-list.tpl' with {'news': news} %}
{% endblock content %}
{% block css %}
  <link href="/css/news/default.css" rel="stylesheet">
{% endblock %}
{% block js %}
  <script src="/js/news/default.js"></script>
  <script src="/js/news/isotope.min.js"></script>
{% endblock %}
