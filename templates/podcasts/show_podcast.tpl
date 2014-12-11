{% extends "default.tpl" %}
{% block content %}
  <div class="media-body">
    <h3 class="list-group-item-heading media-heading">
      {{ podcast.get_name() }}
      {% if podcast.get_file_url() %}
        <a href="{{ podcast.get_file_url() }}">
          <span class="badge"><i class="fa fa-download" title="Скачать"></i> скачать</span>
        </a>
      {% endif %}
    </h3>
    <div class="list-group-item-text">
      {% if podcast.get_url() is not empty %}
        <p class="embed-responsive embed-responsive-16by9 col-xs-12">
          <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/{{ podcast.get_url() }}" frameborder="0" allowfullscreen></iframe>
        </p>
      {% endif %}
      {{ podcast.get_shownotes()|nl2br }}
      <p style="padding-top: 1em;">Обсужденные темы:</p>
      <ul class="list-unstyled col-xs-12" style="margin-bottom: 15px;">
        {% for news in podcast.get_news() %}
          <li>
            {{ news.get_title() }} (
            {% for link in news.get_urls() %}
              <a href="{{ link }}">{{ link|truncate(35) }}</a>
              {% if not loop.last %}, {% endif %}
            {% endfor %}
            )
          </li>
        {% endfor %}
      </ul>
    </div>
  </div>
{% endblock %}