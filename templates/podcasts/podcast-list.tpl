<ul class="media-list podcasts-feed">
  {% for podcast in podcasts %}
    {% include '@podcasts/podcast.tpl' with {'podcast': podcast} %}
  {% endfor %}
</ul>