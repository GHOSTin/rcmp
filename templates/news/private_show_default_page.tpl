{% extends "public.tpl" %}
{% block content %}
  <p><button class="btn btn-success" id="new-news"><i class="glyphicon glyphicon-plus"></i> Добавить новость для обсуждения</button></p>
  <p>
    <div class="btn-group news-status" data-toggle="buttons">
      <label class="btn btn-default active">
        <input type="radio" name="status" id="active" checked>Активные темы
      </label>
      <label class="btn btn-default">
        <input type="radio" name="status" id="history">Темы прошлых выпусков
      </label>
    </div>
  </p>
  <p>
  <div id="sorts" class="btn-group btn-group-xs" data-toggle="buttons">
    <label class="btn btn-default active">
      <input type="radio" name="sort" data-sort-value="date, number" checked>По дате добавления
    </label>
    <label class="btn btn-default">
      <input type="radio" name="sort" data-sort-value="rating, date">По рейтингу
    </label>
  </div>
  </p>
  <ul class="media-list isotope">
  </ul>
{% endblock content %}
{% block css %}
  <link href="/css/news/default.css" rel="stylesheet">
  <link href="/css/wbbtheme.css" rel="stylesheet">
{% endblock %}
{% block js %}
  <script src="/js/jquery.wysibb.min.js"></script>
  <script src="/js/jquery.wysibb-ru-RU.js"></script>
  <script src="/js/news/isotope.min.js"></script>
  <script src="/js/default.js"></script>
  <script src="/js/news/default.js"></script>
{% endblock %}
