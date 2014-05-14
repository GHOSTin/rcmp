{% extends "public.tpl" %}
{% block content %}
<div class="row">
	<div class="col-md-6">
    <h3>Форма востановления пароля</h3>
    <p>Введите e-mail, который вы ввели при регистрации.</p>
    <form role="form" action="/password/recovery/">
      <div class="form-group">
        <label for="login">E-mail пользователя</label>
        <input type="email" class="form-control" id="login" name="login"
               autocomplete="off" placeholder="Введите e-mail пользователя">
      </div>
      <button class="btn btn-default">Востановить</button>
    </form>
	</div>
</div>
{% endblock content %}