<li class="media">
  <div class="media-body">
    <h4 class="list-group-item-heading media-heading">{{ podcast.get_name() }}</h4>
    <div class="list-group-item-text">
      <h5>Обсужденные темы:</h5>
      <ul class="list-unstyled col-xs-12" style="margin-bottom: 15px;">
        {% for news in podcast.get_news() %}
          <li>- {{ news.get_title() }}</li>
        {% endfor %}
      </ul>
      <iframe height="60" class="col-xs-12" src="http://www.youtube.com/embed/{{ podcast.get_url() }}" frameborder="0" allowfullscreen></iframe>
    </div>
    {% if user.isPodcastAdmin() %}
      <div class="btn-group btn-group-sm tools">
        <button type="button" class="btn btn-default edit_news">
          <i class="glyphicon glyphicon-pencil"></i>
          <span class="hidden-sm hidden-xs"> Редактировать</span>
        </button>
        <button type="button" class="btn btn-default delete_news">
          <i class="glyphicon glyphicon-trash"></i>
          <span class="hidden-sm hidden-xs"> Удалить</span>
        </button>
      </div>
    {% endif %}
  </div>
</li>