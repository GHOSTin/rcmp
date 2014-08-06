{% extends "public.tpl" %}
{% set news = response.news %}
{% block content %}
  <div class="btn-group" data-toggle="buttons">
    <label class="btn btn-default active">
      <input type="radio" name="options" id="option1" checked>Активные темы
    </label>
    <label class="btn btn-default">
      <input type="radio" name="options" id="option2">Темы прошлых выпусков
    </label>
  </div>
  <ul class="media-list news-feed">
  {% for item in news %}
    {% include '@news/news-item.tpl' with {'item': item} %}
  {% endfor %}
  </ul>
{% endblock content %}
{% block css %}
  <link href="/css/news/default.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/summernote.css" rel="stylesheet">
{% endblock %}
