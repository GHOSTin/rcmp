{% extends "default.tpl" %}

{% block content %}
<div class="row">
  <div class="col-md-12">
    Пароль не соответствует правилам<br>
    Пожайлуйста выберите другой пароль. <a href="/new_user/?email={{ email }}&nickname={{ nickname }}">Вернутся</a>
  </div>
</div>
{% endblock content %}