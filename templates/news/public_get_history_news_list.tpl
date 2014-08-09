{% set news = response.news %}
{% include '@news/news-history-list.tpl' with {'news': news} %}