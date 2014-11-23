{% extends "ajax.tpl" %}

{% block js %}
  $('.news-feed').find('li[data-id={{ id }}]').remove();
{% endblock %}