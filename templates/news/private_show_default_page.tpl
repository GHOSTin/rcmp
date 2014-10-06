{% extends "public.tpl" %}
{% set news = response.news %}
{% block content %}
  <p><button class="btn btn-success" id="new-news"><i class="fa fa-plus"></i> Добавить тему для обсуждения</button></p>
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
