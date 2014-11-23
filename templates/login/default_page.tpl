{% extends "default.tpl" %}

{% block content %}
<div class="row">
  <div class="col-md-4">
    <form action="/login/enter/" method="post" role="form">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" id="email" class="form-control" name="login" autofocus>
      </div>
      <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" class="form-control" name="password">
      </div>
      <button type="submit" class="btn btn-default">Войти</button>
    </form>
    <h3>Востановление пароля</h3>
    <p>Если вы забыли пароль и не можете его вспомить то вы можете его <a href="/password/">востановить</a>.</p>
    <p>Если вы не новый пользователь вы можете пройти <a href="/new_user/">регистрацию</a>.</p>
  </div>
</div>
{% endblock content %}