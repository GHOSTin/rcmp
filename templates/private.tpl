{% spaceless %}
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Подкаст Канадского Лося и Со.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Подкаст Канадского Лося и Со. - жизнь иммигрантов в Канаде.">
  <meta name="author" content="Торонто, Виндзор, Umputun, Podcast, Иммиграция в Канаду, Подкаст, RPOD, Жизнь в Канаде">
  <meta charset="utf-8">
  <link rel="stylesheet" href="/public/components/bootstrap/dist/css/bootstrap.min.css?v=1">
  <link href="/public/components/Font-Awesome/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/default.css">
  <link rel="shortcut icon" href="favicon.ico">
  {% block css %}{% endblock css %}
</head>
<body>
  <div id="wrap">
    <header>
      {% include 'menu.tpl' with {'user': user} %}
    </header>
    <main class="container rcmp_main_block">
      <div class="row">
        <section class="col-md-12">{% block content %}{% endblock content %}</section>
      </div>
    </main>
  </div>
  <footer class="rcmp_footer">
    <div class="container">
      <div class="row">
        {% include 'footer.tpl' %}
      </div>
    </div>
  </footer>
  <script src="/public/components/jquery/dist/jquery.min.js"></script>
  <script src="/public/components/jplayer/jquery.jplayer/jquery.jplayer.js"></script>
  <script src="/public/components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/public/components/localforage/dist/localforage.min.js"></script>
  <script src="/js/default.js"></script>
  <script src="/js/main.js"></script>
  {% block js %}{% endblock js %}
</body>
</html>
{% endspaceless %}