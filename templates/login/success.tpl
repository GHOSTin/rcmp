{% extends "default.tpl" %}

{% block content %}
<div class="row">
  <div class="col-md-12">
  Вы успешно зарегестрировались используя почту: {{ email }}.<br>
  Пожалуйста <a href="/enter/">пройдите авторизацию</a>, используя выбранную почту и пароль.
  </div>
</div>
{% endblock content %}