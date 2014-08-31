<li class="media">
  <div class="media-body">
    <h4 class="list-group-item-heading media-heading">{{ podcast.get_name() }}</h4>
    <p class="list-group-item-text">
      <iframe height="60" width="100%" src="http://www.youtube.com/embed/{{ podcast.get_url() }}" frameborder="0" allowfullscreen></iframe>
    </p>
    {% if item.get_user() == user %}
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