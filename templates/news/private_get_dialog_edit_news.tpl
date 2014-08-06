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
    <label for="summernote">Описание</label>
    <textarea id="summernote" >{{ item.get_description()|raw }}</textarea>
  </p>
{% endblock %}
{% block buttons %}
  <div class="btn btn-default send_news" id="news{{ item.get_id() }}">Отправить</div>
{% endblock buttons %}
{% block script %}
  $(document).on('click', '.send_news#news{{ item.get_id() }}', function(){
    $.post('/news/edit_news/', {
      id: {{ item.get_id() }},
      title: $('#title').val(),
      description: $('#summernote').code()
    }, function(r){
      $('.dialog').modal('hide');
      init_content(r);
    });
  });
{% endblock %}
