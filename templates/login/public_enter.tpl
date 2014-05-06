{% extends "public.tpl" %}
{% block content %}
{% if component == false %}
<div class="row">
  <div class="col-md-4">
    Возможно вы неверно ввели email или пароль. Вернитесь на <a href="/login/">страницу аутентификации</a>.
  </div>
</div>
{% endif %}
{% endblock content %}