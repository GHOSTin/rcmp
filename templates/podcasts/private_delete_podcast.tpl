{% extends "ajax.tpl" %}
{% set id = response.delete_id %}
{% block js %}
  $('.podcasts-feed').find('li[data-id={{ id }}]').remove();
{% endblock %}