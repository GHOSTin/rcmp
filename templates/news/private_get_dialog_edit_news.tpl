{% extends "dialog.tpl" %}
{% set item = response.news %}
{% block title %}
  Редактирование темы для обуждения
{% endblock %}
{% block dialog %}
  <p>
    <label for="title">Заголовок</label>
    <input id="title" class="form-control" value="{{ item.get_title() }}">
  </p>
  <p>
    <label for="editor">Описание</label>
    <textarea id="editor" >{{ item.get_description() }}</textarea>
  </p>
  <span class="news_id sr-only">{{ item.get_id() }}</span>
{% endblock %}
{% block buttons %}
  <div class="btn btn-default send_edit_news">Отправить</div>
{% endblock buttons %}
