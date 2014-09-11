{% extends "public.tpl" %}
{% block content %}
  <p>
  {% include '@podcasts/podcast-list.tpl' with {'podcasts': response.podcasts} %}
{% endblock content %}
{% block css %}
  <link href="/css/podcasts/default.css" rel="stylesheet">
{% endblock %}
{% block js %}
  <script src="/js/default.js"></script>
  <script src="/js/podcasts/default.js"></script>
{% endblock %}
