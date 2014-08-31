{% extends "dialog.tpl" %}
{% block title %}
  Новый подкаст
{% endblock %}
{% block dialog %}
  <p>
    <label for="title">Заголовок *</label>
    <input id="title" class="form-control" required>
  </p>
  <p>
    <label for="alias">Alias *</label>
    <input id="alias" class="form-control" required>
  </p>
  <p>
    <label for="url">Youtube URL</label>
    <input id="url" class="form-control">
  </p>
{% endblock %}
{% block buttons %}
  <div class="btn btn-default send_podcast">Отправить</div>
{% endblock buttons %}
