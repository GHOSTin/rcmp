{% extends "public.tpl" %}
{% block content %}
<div class="row-fluid">
  <div class="span3">
    <form method="post" action="/registration/do/">
      <fieldset>
        <legend>Регистрация</legend>
        <label>Почта</label>
        <input type="text" name="email" placeholder="Введите вашу почту">
        <label>Никнейм</label>
        <input type="text" name="nickname" placeholder="Введите ваш никнейм">
        <label>Пароль</label>
        <input type="text" name="password" placeholder="Введите ваш пароль">
        <input type="submit" value="Зарегистрироватся">
      </fieldset>
    </form>
  </div>
  <div class="span6" style="padding:40px 0px 0px 0px">
    <p>Почта может состоять из <b>букв латинского алфавита, цифр, одинарного дефиса, собаки, точки</b> и иметь длину не более 128 знаков.</p>
    <p>Никнейм может состоять из <b>букв латинского и русского алфавитов, цифр, пробела</b> и иметь длину не более 16 знаков.</p>
    <p>Пароль может состоять из <b>букв латинского алфавита, цифр</b> и иметь длину от 8 до 16 символов.</p>
  </div>
</div>
{% endblock content %}