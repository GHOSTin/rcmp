{% extends "ajax.tpl" %}

{% block js %}
  $('.podcasts-feed').find('li[data-id={{ id }}]').remove();
{% endblock %}