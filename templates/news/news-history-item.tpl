<li class="media" data-id="{{ item.get_id() }}">
  <div class="pull-left news-rating">
    <p></p>
    <p class="rating">{{ item.get_rating() }}</p>
    <p></p>
  </div>
  <div class="media-body">
    <span class="date sr-only">{{ item.get_pubtime() }}</span>
    <h6>Опубликовано: {{ item.get_user().get_nickname() }} {{ item.get_pubtime()|date('d.m.Y H:i') }}</h6>
    <h4 class="list-group-item-heading media-heading">{{ item.get_title() }}</h4>
    <p class="list-group-item-text">{{ item.get_description()|bbCode|nl2br }}</p>
  </div>
</li>