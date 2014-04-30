{% spaceless %}
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>RCMP - Подкаст Канадского лося и компании</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, maximum-scale = 1, minimum-scale = 1">
  <link rel="stylesheet" href="/css/bootstrap.min.css" >
  {% block css %}{% endblock css %}
</head>
<body>
  <div class="container-fluid">
    {% include 'header.tpl' %}
  </div>
  <div class="container-fluid">
    <div class="row">
      {% include 'menu.tpl' %}
      <section class="col-md-10">{% block content %}{% endblock content %}</section>
    </div>
  </div>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  {% block js %}{% endblock js %}
</body>
</html>
{% endspaceless %}