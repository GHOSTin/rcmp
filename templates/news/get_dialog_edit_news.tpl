{% extends "dialog.tpl" %}

{% block title %}
  Редактирование темы для обуждения
{% endblock %}

{% block dialog %}
  <p>
    <label for="title">Заголовок</label>
    <input id="title" class="form-control" value="{{ news.get_title() }}" autofocus>
  </p>
  <p>
    <label for="editor">Описание</label>
    <textarea id="editor" >{{ news.get_description() }}</textarea>
  </p>
  <span class="news_id sr-only">{{ news.get_id() }}</span>
{% endblock %}

{% block buttons %}
  <div class="btn btn-default send_edit_news">Отправить</div>
{% endblock buttons %}
