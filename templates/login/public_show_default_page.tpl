{% extends "public.tpl" %}
{% block content %}
<form action="/login/enter/" method="post">
  <div>
    <label>email:</label> <input type="text" name="login">
  </div>
  <div>
    <label>Пароль:</label><input type="password" name="password">
  </div>
  <input type="submit" value="Войти">
</form>
{% endblock content %}