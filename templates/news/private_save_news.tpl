{% extends "ajax.tpl" %}
{% block html %}
  {% include '@news/news-item.tpl' with {'item': response.news} %}
{% endblock %}
{% block js %}
  $('.news-feed').append(get_hidden_content());
{% endblock %}