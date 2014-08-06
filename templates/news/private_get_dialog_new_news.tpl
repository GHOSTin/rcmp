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
    <label for="summernote">Описание</label>
    <textarea id="summernote" ></textarea>
  </p>
{% endblock %}
{% block buttons %}
  <div class="btn btn-default send_news">Отправить</div>
{% endblock buttons %}
{% block script %}
  $('.send_news').off('click');
  $(document).on('click', '.send_news', function(){
    $.get('/news/save_news/', {
      title: $('#title').val(),
      description: $('#summernote').code()
    }, function(r){
      $('.dialog').modal('hide');
      init_content(r);
    });
  });
{% endblock %}
