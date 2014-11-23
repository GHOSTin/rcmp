{% extends "default.tpl" %}

{% block content %}
<div class="row">
	<div class="col-md-4">
    <h3>Форма востановления пароля</h3>
    <p>Введите e-mail, который вы ввели при регистрации. На него будет выслан новый пароль</p>
    <form role="form" action="/password/recovery/" method="post">
      <div class="form-group">
        <label for="email">E-mail пользователя</label>
        <input type="email" class="form-control" id="email" name="login" autocomplete="off">
      </div>
      <button class="btn btn-default">Востановить</button>
    </form>
	</div>
</div>
{% endblock content %}