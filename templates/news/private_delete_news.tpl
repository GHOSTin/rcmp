{% extends "ajax.tpl" %}
{% set id = response.delete_id %}
{% block js %}
  $('.news-feed').find('li[data-id={{ id }}]').remove();
{% endblock %}