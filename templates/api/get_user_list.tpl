{% set users = response.users %}
{%- if users -%}
  [
  {% for user in users %}
    {
    "id":"{{ user.get_id() }}",
    "nickname":"{{ user.get_nickname() }}",
    "email":"{{ user.get_email() }}"
    }
    {% if not loop.last %}
      ,
    {% endif %}
  {% endfor %}
  ]
{% else %}
  {}
{%- endif -%}