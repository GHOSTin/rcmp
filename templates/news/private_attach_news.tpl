{% extends "ajax.tpl" %}
{% set ids = response.attach_ids %}
{% block js %}
  {% for id in ids %}
    $('.news-feed').find('li[data-id={{ id }}]').remove();
  {% endfor %}
{% endblock %}