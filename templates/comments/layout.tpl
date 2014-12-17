{% macro declension(number, forms) %}
  {% set cases = [2, 0, 1, 1, 1, 2] %}
  {{ number }} {{ forms[ ( number%100>4 and number%100<20)? 2 : cases[min(number%10, 5)] ] }}
{% endmacro %}
<div id="layout" class="col-xs-12">
  <header id="main-nav" data-tracking-area="main-nav">
    <nav class="nav nav-primary">
      <ul class="list-unstyled">
        <li class="tab-conversation active">
          <a href="" class="publisher-nav-color" data-nav="conversation">
            {% if podcast.get_comments()|length > 0 %}
            <span class="comment-count">
              {{ _self.declension(podcast.get_comments()|length, ['комментарий','комментария','комментариев']) }}
            </span>
            {% else %}
            <span class="comment-count-placeholder">
            Комментарии
            </span>
            {% endif %}
          </a>
        </li>
      </ul>
    </nav>
  </header>
  <section id="conversation">
    <div class="nav nav-secondary">
      <ul class="list-unstyled">
        <li data-role="post-sort" class="dropdown sorting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Новые вначале
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li class="selected">
              <a data-sort="desc">Новые<i aria-hidden="true" class="icon-checkmark"></i></a>
            </li>
            <li>
              <a data-sort="asc">Старые<i aria-hidden="true" class="icon-checkmark"></i></a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div id="posts">
      <div id="form">
        {% include 'comments/commentForm.tpl' %}
      </div>
      <div class="post-list-container">
      {% if podcast.get_comments()|length > 0 %}
        {% include 'comments/commentsList.tpl' with {'comments': comments} %}
      {% else %}
        <div id="no-posts">Прокомментируйте первым.</div>
      {% endif %}
      </div>
    </div>
  </section>
</div>