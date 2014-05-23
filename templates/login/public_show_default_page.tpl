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
      <button type="submit" class="btn btn-default">Войти</button>
    </form>
    <h3>Востановление пароля</h3>
    <p>Если вы забыли пароль и не можете его вспомить то вы можете его <a href="/password/">востановить</a>.</p>
    <p>Если вы не зарегистрированы. Вы можете пройти <a href="/registration/">регистрацию</a>.</p>
  </div>
</div>
{% endblock content %}