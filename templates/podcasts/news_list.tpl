<ul class="list-unstyled">
  {% for news in podcast.get_news() %}
    <li>{{ news.get_title() }} <a id="news_{{ news.get_id() }}" class="btn btn-link btn-sm">Открепить</a></li>
  {% endfor %}
</ul>