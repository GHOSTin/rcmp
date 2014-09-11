{% extends "dialog.tpl" %}
{% set podcast = response.podcast %}
{% block title %}
  Новый подкаст
{% endblock %}
{% block dialog %}
  <p>
    <label for="time">Дата выпуска *</label>
  <div class="input-group date">
    <input type="text" class="form-control" id="time" readonly="true" tabindex="4" value="{{ podcast.get_time()|date("d.m.Y") }}">
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
  </div>
  </p>
  <p>
    <label for="title">Заголовок *</label>
    <input id="title" class="form-control" required value="{{ podcast.get_name() }}">
  </p>
  <p>
    <label for="alias">Alias *</label>
    <input id="alias" class="form-control" required value="{{ podcast.get_alias() }}">
  </p>
  <p>
    <label for="url">Youtube URL</label>
    <input id="url" class="form-control" value="{{ podcast.get_url() }}">
  </p>
  <span class="podcast_id sr-only">{{ podcast.get_time() }}</span>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#attachNews">
          Прикрепленные новости
        </a><span class="label label-success">{{ podcast.get_news()|length }}</span>
      </h4>
    </div>
    <div id="attachNews" class="panel-collapse collapse">
      <div class="panel-body">
        {% include '@podcasts/news_list.tpl' with {'podcast': podcast} %}
      </div>
    </div>
  </div>
{% endblock %}
{% block buttons %}
  <div class="btn btn-default send_edit_podcast">Отправить</div>
{% endblock buttons %}
{% block script %}
  $('.input-group.date').datepicker({
  format: "dd.mm.yyyy",
  weekStart: 1,
  todayBtn: "linked",
  language: "ru",
  autoclose: true,
  todayHighlight: true
  });
{% endblock %}
