{% extends "default.tpl" %}

{% block content %}
<div class="row">
  <div class="col-md-12">
    Указанный вами email или никнейм уже используется другим пользователем.<br>
    Пожайлуйста выберите другие данные для регистрации. <a href="/new_user/?email={{ email }}&nickname={{ nickname }}">Вернутся</a>
  </div>
</div>
{% endblock content %}