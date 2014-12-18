{% spaceless %}
<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Подкаст Канадского Лося и Со.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Подкаст Канадского Лося и Со. - жизнь иммигрантов в Канаде.">
  <meta name="author" content="Торонто, Виндзор, Umputun, Podcast, Иммиграция в Канаду, Подкаст, RPOD, Жизнь в Канаде">
  <link rel="stylesheet" href="/public/components/bootstrap/dist/css/bootstrap.min.css?v=1">
  <link href="/public/components/Font-Awesome/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/default.css">
  <link rel="shortcut icon" href="favicon.ico">
  {% block css %}{% endblock css %}
</head>
<body>
  <div id="wrap">
    {% include 'header.tpl' %}
    <main class="container rcmp_main_block">
      <div class="row">
        <section class="col-md-12">{% block content %}{% endblock content %}</section>
      </div>
    </main>
    {% include 'footer.tpl' %}
    </div>
    <script src="/public/components/jquery/dist/jquery.min.js"></script>
    <script src="/public/components/jplayer/jquery.jplayer/jquery.jplayer.js"></script>
    <script src="/public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/public/components/localforage/dist/localforage.min.js"></script>
    <script src="/public/components/lazyloadxt/dist/jquery.lazyloadxt.extra.min.js"></script>
    <script src="/js/main.js"></script>
    {% block js %}{% endblock js %}
    {% if constant('app\\conf::status')|trim  == 'production' %}
      <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter22187086 = new Ya.Metrika({id:22187086, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/22187086" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
      <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function()
      { (i[r].q=i[r].q||[]).push(arguments)}
      ,i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-51709054-1', 'auto');
      ga('send', 'pageview');
      </script>
    {% endif %}
</body>
</html>
{% endspaceless %}