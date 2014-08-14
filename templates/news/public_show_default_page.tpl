{% extends "public.tpl" %}
{% set news = response.news %}
{% block content %}
  <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    Для того чтобы оставить новость для обсуждения или проголосовать, <a href="/login/" class="alert-link">авторизуйтесь</a>.
  </div>
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
        <input type="radio" name="sort" data-sort-value="date, id" checked>По дате добавления
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
{% endblock %}
{% block js %}
  <script src="/js/news/default.js"></script>
  <script src="/js/news/isotope.min.js"></script>
{% endblock %}
