{% extends "public.tpl" %}
{% block content %}
<div class="row">
  <div class="col-md-4">
    <form action="/login/enter/" method="post" role="form">
      <div class="form-group">
        <label>Email:</label>
        <input type="text" class="form-control" name="login">
      </div>
      <div class="form-group">
        <label>Пароль:</label>
        <input type="password" class="form-control" name="password">
      </div>
      <input type="submit" value="Войти">
    </form>
  </div>
</div>
{% endblock content %}