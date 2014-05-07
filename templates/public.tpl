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
  {% if host == 'rcmp.me' %}
  <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter22187086 = new Ya.Metrika({id:22187086, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/22187086" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
  {% endif %}
</body>
</html>
{% endspaceless %}