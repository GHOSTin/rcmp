{% set pattern = '' %}
<li class="media" data-id="{{ podcast.get_time() }}">
  {% if user.isPodcastAdmin() %}
    <div class="pull-left" style="padding-top: 28px; width: 28px">
      <label>
        <input type="radio" name="mainPodcast" value="{{ podcast.get_time() }}"
            {% if podcast.isShowPodcast() %}
              checked
            {% endif %}
            >
        <span></span>
      </label>
    </div>
  {% endif %}
  <div class="media-body">
    <h4 class="list-group-item-heading media-heading">{{ podcast.get_name() }}</h4>
    <div class="list-group-item-text">
      <h5>Обсужденные темы:</h5>
      <ul class="list-unstyled col-xs-12" style="margin-bottom: 15px;">
        {% for news in podcast.get_news() %}
          <li>
            - {{ news.get_title() }} (
            {% for link in news.get_description()|preg_get_all('/\\[url=((?:ftp|https?):\\/\\/.*?)\\].*\\n?\\[\\/url\\]/', 1) %}
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
    {% if user.isPodcastAdmin() %}
      <div class="btn-group btn-group-sm tools">
        <button type="button" class="btn btn-default edit_podcast">
          <i class="fa fa-pencil-square-o"></i>
          <span class="hidden-sm hidden-xs"> Редактировать</span>
        </button>
        <button type="button" class="btn btn-default delete_podcast">
          <i class="fa fa-trash"></i>
          <span class="hidden-sm hidden-xs"> Удалить</span>
        </button>
      </div>
    {% endif %}
  </div>
</li>