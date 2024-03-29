{% extends "default.tpl" %}

{% block content %}
<div class="row">
  <div class="col-md-3">
    <form method="post" action="/registration/" role="forms">
        <legend>Регистрация</legend>
        <div class="form-group">
          <label>Почта</label>
          <input type="text" class="form-control" name="email" placeholder="Введите вашу почту"{% if email %} value="{{ email }}"{% endif %}>
        </div>
        <div class="form-group">
          <label>Никнейм</label>
          <input type="text" class="form-control" name="nickname" placeholder="Введите ваш никнейм"{% if nickname %} value="{{ nickname }}"{% endif %}>
        </div>
        <div class="form-group">
          <label>Пароль</label>
          <input type="password" class="form-control" name="password" placeholder="Введите ваш пароль">
        </div>
        <button type="submit" class="btn btn-default">Зарегистрироваться</button>
    </form>
  </div>
  <div class="col-md-6">
    <p>Почта может состоять из <b>букв латинского алфавита, цифр, одинарного дефиса, собаки, точки</b> и иметь длину не более 128 знаков.</p>
    <p>Никнейм может состоять из <b>букв латинского и русского алфавитов, цифр, пробела</b> и иметь длину не более 16 знаков.</p>
    <p>Пароль может состоять из <b>букв латинского алфавита, цифр</b> и иметь длину от 8 до 16 символов.</p>
  </div>
</div>
{% endblock content %}