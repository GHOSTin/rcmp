<ul class="media-list news-feed">
  {% for item in news %}
    {% include '@news/news-history-item.tpl' with {'item': item} %}
  {% endfor %}
</ul>