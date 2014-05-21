{% spaceless %}
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Подкаст Канадского Лося и Со.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Подкаст Канадского Лося и Со. - жизнь иммигрантов в Канаде.">
  <meta name="author" content="Торонто, Виндзор, Umputun, Podcast, Иммиграция в Канаду, Подкаст, RPOD, Жизнь в Канаде">
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/bootstrap.min.css?v=1">
  <link rel="stylesheet" href="/css/default.css">
  <link rel="shortcut icon" href="favicon.ico">
  {% block css %}{% endblock css %}
</head>
<body>
  <div id="wrap">
    <header>
      {% include 'menu.tpl' %}
    </header>
    <main class="container rcmp_main_block">
      <div class="row">
        <section class="col-md-12">{% block content %}{% endblock content %}</section>
      </div>
    </main>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    {% block js %}{% endblock js %}
    {% if host == 'rcmp.me' %}
    <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter22187086 = new Ya.Metrika({id:22187086, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/22187086" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
    {% endif %}
  </div>
</body>
</html>
{% endspaceless %}