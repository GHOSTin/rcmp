{% extends "public.tpl" %}
{% block content %}
  {% if user.isPodcastAdmin() %}
  <p><button class="btn btn-success" id="new-podcast"><i class="fa fa-plus"></i> Добавить подкаст</button></p>
  {% endif %}
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
