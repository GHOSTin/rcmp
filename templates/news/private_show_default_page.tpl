{% extends "public.tpl" %}
{% block content %}
  <p><button class="btn btn-success" id="new-news"><i class="glyphicon glyphicon-plus"></i> Добавить новость для обсуждения</button></p>
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
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/summernote.css" rel="stylesheet">
{% endblock %}
{% block js %}
  <script src="/js/default.js"></script>
  <script src="/js/news/default.js"></script>
  <script src="/js/news/jquery.confirm.min.js"></script>
  <script src="/js/summernote.min.js"></script>
  <script src="/js/summernote-ru-RU.js"></script>
{% endblock %}
