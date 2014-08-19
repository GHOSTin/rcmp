<li class="media" data-id="{{ item.get_id() }}">
  <div class="pull-left news-rating">
    <p>{% if not item.isVoted() and user is not null %}
        <a href="#up"><i class="glyphicon glyphicon-chevron-up"></i></a>
      {% endif %}
    </p>
    <p class="rating">{{ item.get_rating() }}</p>
    <p>{% if not item.isVoted() and user is not null %}
        <a href="#down"><i class="glyphicon glyphicon-chevron-down"></i></a>
      {% endif %}
    </p>
  </div>
  <div class="media-body">
    <span class="date sr-only">{{ item.get_pubtime() }}</span>
    <h6>Опубликовано: {{ item.get_user().get_nickname() }} {{ item.get_pubtime()|date('d.m.Y H:i') }}</h6>
    <h4 class="list-group-item-heading media-heading">{{ item.get_title() }}</h4>
    <p class="list-group-item-text">{{ item.get_description()|bbCode|nl2br }}</p>
    {% if item.get_user().get_id() == user.get_id() %}
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