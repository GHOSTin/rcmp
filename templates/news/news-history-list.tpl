<ul class="media-list news-history-feed isotope">
  {% for item in news %}
    {% include '@news/news-history-item.tpl' with {'item': item} %}
  {% endfor %}
</ul>