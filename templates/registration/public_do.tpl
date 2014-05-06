{% extends "public.tpl" %}
{% block content %}
{% if component == false %}
<div class="row">
  <div class="col-md-6">
    Возможно вы неверно данные. Вернитесь на <a href="/registration/">страницу регистрации</a>.
  </div>
</div>
{% endif %}
{% endblock content %}