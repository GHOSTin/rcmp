{% set news = response.news %}
{% include '@news/news-list.tpl' with {'news': news} %}