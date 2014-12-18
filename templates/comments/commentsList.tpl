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
        {% if not user == null %}
        <footer>
          <menu>
            <li class="bullet" aria-hidden="true">•</li>
            <li class="reply" data-role="reply-link">
              <a data-action="reply">
                <i class="icon icon-mobile icon-reply"></i><span class="text">Ответить</span></a>
            </li>
          </menu>
        </footer>
        {% endif %}
      </div>
      <div class="reply-form-container">
        {% include 'comments/commentForm.tpl' with {'classes': ['hidden']} %}
      </div>
    </div>
    {% if comment.get_children()|length > 0 %}
      {% include 'comments/commentsList.tpl' with {'comments': comment.get_children()} %}
    {% endif %}
  </li>
{% endfor %}
</ul>