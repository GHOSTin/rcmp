<li class="media" data-id="{{ item.get_id() }}">
  <div class="pull-left news-rating">
    <p>
    {% if user %}
      {% if not item.isVoted(user) or user.isNewsAdmin() %}
        <a href="#up"><i class="fa fa-chevron-up"></i></a>
      {% endif %}
    {% endif %}
    </p>
    <p class="rating">{{ item.get_rating() }}</p>
    <p>
      {% if user %}
        {% if not item.isVoted(user) or user.isNewsAdmin() %}
          <a href="#down"><i class="fa fa-chevron-down"></i></a>
        {% endif %}
      {% endif %}
    </p>
  </div>
  <div class="media-body">
    <span class="date sr-only">{{ item.get_pubtime() }}</span>
    <h6>{{ item.get_user().get_nickname() }} предложил(а) тему:</h6>
    {% if user %}
      {% if item.get_user() == user or user.isNewsAdmin() %}
        <p>
          <div class="btn-group btn-group-xs tools">
            <button type="button" class="btn btn-default edit_news">
              <i class="fa fa-pencil-square-o"></i>
              <span> Редактировать</span>
            </button>
            <button type="button" class="btn btn-default delete_news">
              <i class="fa fa-trash"></i>
              <span> Удалить</span>
            </button>
          </div>
        </p>
      {% endif %}
    {% endif %}
    <h4 class="list-group-item-heading media-heading">{{ item.get_title() }}</h4>
    <p class="list-group-item-text">{{ item.get_description()|bbCode|nl2br }}</p>
  </div>
</li>