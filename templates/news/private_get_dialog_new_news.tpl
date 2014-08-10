{% extends "dialog.tpl" %}
{% block title %}
  Новая тема для обуждения
{% endblock %}
{% block dialog %}
  <p>
    <label for="title">Заголовок</label>
    <input id="title" class="form-control">
  </p>
  <p>
    <label for="editor">Описание</label>
    <textarea id="editor" ></textarea>
  </p>
{% endblock %}
{% block buttons %}
  <div class="btn btn-default send_news">Отправить</div>
{% endblock buttons %}
