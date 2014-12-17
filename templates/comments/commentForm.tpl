{% if classes is defined %}
  {% set class = classes|join(' ') %}
{% else %}
  {% set class = '' %}
{% endif %}
<form class="reply {{ class }}">
  <div class="postbox">
    <div role="alert"></div>
    <div class="avatar">
      <span class="user">
        <img data-role="user-avatar" src="/images/avatar92.jpg" alt="Аватар">
      </span>
    </div>
    <div class="textarea-wrapper" data-role="textarea" dir="auto">
      <div>
        <span class="placeholder">Присоединиться к обсуждению...</span>
        <div class="textarea" tabindex="0" role="textbox" aria-multiline="true"
             contenteditable="true" data-role="editable" aria-label="Присоединиться к обсуждению..."
             style="overflow: auto; max-height: 350px;">
        </div>
      </div>
      <div class="post-actions">
        <div class="logged-in">
          <section>
            <div class="temp-post" style="text-align: right">
              <button class="btn">
                Опубликовать
              </button>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</form>