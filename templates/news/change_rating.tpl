{% extends "ajax.tpl" %}

{% block html %}
  {% include 'news/news-item.tpl' with {'item': news} %}
{% endblock %}

{% block js %}
  $('.news-feed').find('li[data-id={{ news.get_id() }}]').replaceWith(get_hidden_content());
{% endblock %}