{% extends "public.tpl" %}
{% set news = response.news %}
{% block content %}
  <p><button class="btn btn-success" id="new-news"><i class="fa fa-plus"></i> Добавить новость для обсуждения</button></p>
  {% if user.isNewsAdmin() %}
  <p>
    <div class="input-group col-md-5">
      <span class="input-group-btn">
        <button class="btn btn-success attach" type="button"><i class="fa fa-paperclip"></i> Привязать к</button>
      </span>
      <select type="text" class="form-control" id="attach_podcast">
        <option></option>
        {% for podcast in response.podcasts %}
          <option value="{{ podcast.get_time() }}">{{ podcast.get_name() }}</option>
        {% endfor %}
      </select>
    </div>
  </p>
  {% endif %}
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
  {% include '@news/news-list.tpl' with {'news': news} %}
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
