<ul class="post-list list-unstyled">
{% for comment in comments %}
  <li class="post" id="post-{{ comment.get_id() }}">
    <div class="post-content">
      <div class="avatar">
        <span class="user">
          <img data-role="user-avatar" src="/images/avatar92.jpg" alt="Аватар">
        </span>
      </div>
      <div class="post-body">
        {% if comment.get_status() == 'delete' %}
          <div class="delete-post-message" data-role="message" dir="auto">
            (Комментарий удален)
          </div>
        {% else %}
        <header>
          <span class="post-byline">
            <span class="author">
              {{ comment.get_user().get_nickname() }}
            </span>
          </span>
          <span class="post-meta">
            <span class="bullet time-ago-bullet" aria-hidden="true">•</span>
            <abbr id="time-{{ comment.get_time() }}" data-role="relative-time"
                  class="time-ago" title="{{ comment.get_time()|date('d.m.Y H:i') }}">
              {{ comment.get_time() }}
            </abbr>
          </span>
        </header>
        <div class="post-body-inner">
          <div class="post-message-container">
            <div class="publisher-anchor-color">
              <div class="post-message " data-role="message" dir="auto">
                  {{ comment.get_text()|nl2br|linkify }}
              </div>
            </div>
          </div>
        </div>
        {% endif %}
        {% if not user == null %}
        <footer>
          <menu>
            <li class="bullet" aria-hidden="true">•</li>
            <li class="reply" data-role="reply-link">
              <a data-action="reply">
                <span class="text">Ответить</span>
              </a>
            </li>
            {% if comment.get_user() == user %}
              <li class="bullet" aria-hidden="true">•</li>
              {% if comment.get_status() == 'active' %}
              <li class="delete" data-role="delete-link">
                <a data-action="delete">
                  <span class="text">Удалить</span>
                </a>
              </li>
              {% else %}
                <li class="recovery" data-role="recovery-link">
                  <a data-action="recovery">
                    <span class="text">Восстановить</span>
                  </a>
                </li>
              {% endif %}
            {% endif %}
          </menu>
        </footer>
        {% endif %}
      </div>
      {% if not user == null %}
      <div class="reply-form-container">
        {% include 'comments/commentForm.tpl' with {'classes': ['hidden']} %}
      </div>
      {% endif %}
    </div>
    {% if comment.get_children()|length > 0 %}
      {% include 'comments/commentsList.tpl' with {'comments': comment.get_children()} %}
    {% endif %}
  </li>
{% endfor %}
</ul>