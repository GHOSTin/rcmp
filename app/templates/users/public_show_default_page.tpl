{% extends "public.tpl" %}
{% set users = component.users %}
{% block content %}
  <ul class="unstyled">
  {% for user in users %}
    <li>{{ user.get_nickname() }}</li>
  {% endfor %}
  </ul>
{% endblock content %}