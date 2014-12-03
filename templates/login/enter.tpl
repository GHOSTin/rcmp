{% extends "default.tpl" %}

{% block content %}
<div class="row">
  <div class="col-md-4">
    <form action="/login/" method="post" role="form">
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
    <p>Если вы забыли пароль вы можете его <a href="/password/">востановить</a> зная email пользователя.</p>
    <h3>Регистрация</h3>
    <p>Если вы новый пользователь пройдите <a href="/new_user/">регистрацию</a> чтобы иметь возможность создавать темы для обсуждения и возможность писать в чате.</p>
  </div>
</div>
{% endblock content %}