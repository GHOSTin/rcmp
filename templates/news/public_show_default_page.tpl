{% extends "public.tpl" %}
{% set news = response.news %}
{% block content %}
  <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    Для того чтобы оставить новость для обсуждения или проголосовать, <a href="/login/" class="alert-link">авторизуйтесь</a>.
  </div>
  <div class="btn-group news-status" data-toggle="buttons">
    <label class="btn btn-default active">
      <input type="radio" name="options" id="active" checked>Активные темы
    </label>
    <label class="btn btn-default">
      <input type="radio" name="options" id="history">Темы прошлых выпусков
    </label>
  </div>
  <ul class="media-list">
  </ul>
{% endblock content %}
{% block css %}
  <link href="/css/news/default.css" rel="stylesheet">
{% endblock %}
{% block js %}
  <script src="/js/news/default.js"></script>
{% endblock %}
