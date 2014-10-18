{% extends "public.tpl" %}
{% block content %}
  {% if user.isPodcastAdmin() %}
  <p><button class="btn btn-success" id="new-podcast"><i class="fa fa-plus"></i> Добавить подкаст</button></p>
  {% endif %}
  <p>
  {% include '@podcasts/podcast-list.tpl' with {'podcasts': response.podcasts} %}
{% endblock content %}
{% block css %}
  <link href="/public/components/bootstrap-3-datepicker/css/datepicker3.css" rel="stylesheet">
  <link href="/public/components/multiselect/css/multi-select.css" rel="stylesheet">
  <link href="/css/podcasts/default.css" rel="stylesheet">
{% endblock %}
{% block js %}
  <script src="/js/default.js"></script>
  <script src="/js/podcasts/default.js"></script>
  <script src="/public/components/bootstrap-3-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="/public/components/bootstrap-3-datepicker/js/locales/bootstrap-datepicker.ru.js"></script>
  <script src="/public/components/multiselect/js/jquery.multi-select.js"></script>
{% endblock %}
