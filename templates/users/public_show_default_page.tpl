{% extends "public.tpl" %}
{% set users = response.users %}
{% block content %}
  <ul class="unstyled">
  {% for user in users %}
    <li>{{ user.get_nickname() }}</li>
  {% endfor %}
  </ul>
{% endblock content %}