{% extends "dialog.tpl" %}

{% block title %}Новый подкаст{% endblock %}

{% block dialog %}
  <p>
    <label for="time">Дата выпуска *</label>
    <div class="input-group date">
      <input type="text" class="form-control" id="time" readonly="true" tabindex="4" value="{{ "now"|date("d.m.Y") }}">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
  </p>
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
