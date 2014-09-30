{% set podcast = response.podcast %}
{%- if podcast -%}
  {
    "error": false,
    "podcast":{
      "id":"{{ podcast.get_time() }}",
      "title":"{{ podcast.get_name() }}",
      "news": [
        {% for news in podcast.get_news() %}
          {
            "title":"{{ news.get_title() }}",
            "urls":[
              {% for link in news.get_description()|preg_get_all('/\\[url=((?:ftp|https?):\\/\\/.*?)\\].*\\n?\\[\\/url\\]/', 1) %}
                {
                  "url":"{{ link }}",
                  "title":"{{ link|truncate(35) }}"
                }
                {% if not loop.last %}, {% endif %}
              {% endfor %}
            ]
          }
          {% if not loop.last %}, {% endif %}
        {% endfor %}
      ],
      "youtube_url":"{{ podcast.get_url() }}"
    }
  }
{% else %}
  { "error": true }
{%- endif -%}