{% extends "dialog.tpl" %}
{% set podcast = response.podcast %}
{% block title %}
  Новый подкаст
{% endblock %}
{% block dialog %}
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
{% endblock %}
{% block buttons %}
  <div class="btn btn-default send_edit_podcast">Отправить</div>
{% endblock buttons %}
