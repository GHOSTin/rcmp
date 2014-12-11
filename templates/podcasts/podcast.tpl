<li class="media" data-id="{{ podcast.get_id() }}">
  <div class="media-body">
    <h3 class="list-group-item-heading media-heading">
      <a href="/podcasts/{{ podcast.get_alias() }}">{{ podcast.get_name() }}</a>
      {% if podcast.isShowPodcast() %}<i class="fa fa-tags" style="color:#d9534f" title="Подкаст отображается на главной странице сайта"></i>{% endif %}
    </h3>
    {% if user and user.isPodcastAdmin() %}
      <div class="btn-group btn-group-xs tools">
        <button type="button" class="btn btn-default edit_podcast">
          <i class="fa fa-pencil-square-o"></i>
          <span class="hidden-sm hidden-xs"> Редактировать</span>
        </button>
        <button type="button" class="btn btn-default delete_podcast">
          <i class="fa fa-trash"></i>
          <span class="hidden-sm hidden-xs"> Удалить</span>
        </button>
        {% if not podcast.isShowPodcast() %}
        <button type="button" class="btn btn-default main_podcast">
          <i class="fa fa-tags"></i>
          <span class="hidden-sm hidden-xs"> Поместить на главную</span>
        </button>
        {% endif %}
      </div>
    {% endif %}
    <div class="list-group-item-text">
      <h5>Обсужденные темы:</h5>
      <ul class="list-unstyled col-xs-12" style="margin-bottom: 15px;">
        {% for news in podcast.get_news() %}
          <li>
            {{ news.get_title() }} (
            {% for link in news.get_urls() %}
              <a href="{{ link }}">{{ link|truncate(35) }}</a>
              {% if not loop.last %}, {% endif %}
            {% endfor %}
            )
          </li>
        {% endfor %}
      </ul>
      {% if podcast.get_url() is not empty %}
        <iframe height="60" class="col-xs-12" src="http://www.youtube.com/embed/{{ podcast.get_url() }}" frameborder="0" allowfullscreen></iframe>
      {% endif %}
    </div>
  </div>
</li>