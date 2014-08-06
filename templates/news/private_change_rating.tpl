{% extends "ajax.tpl" %}
{% set item = response.news %}
{% block html %}
  {% include '@news/news-item.tpl' with {'item': item} %}
{% endblock %}
{% block js %}
  $('.news-feed').find('li[data-id={{ item.get_id() }}]').replaceWith(get_hidden_content());
{% endblock %}
