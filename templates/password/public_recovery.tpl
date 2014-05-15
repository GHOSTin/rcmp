{% extends "public.tpl" %}
{% set user = component.user %}
{% set errors = {'no_user': 'Такого пользователя не существует.'} %}
{% block content %}
{% if component.error %}
  <div class="row">
    <div class="col-md-6">
      {{ errors[component.error] }}
      <a href="/">Вернуться на главную.</a>
    </div>
  </div>
{% else %}
  <div class="row">
    <div class="col-md-6">
      Вам выслано письмо с новым паролем на почту {{ user.get_email() }}.
    </div>
  </div>
{% endif %}
{% endblock content %}