{% set user = component.user %}
{%- if user -%}
  {
    error: false,
    user:{
      'id':{{ user.get_id() }},
      'nickname':{{ user.get_nickname() }}
    }
  }
{% else %}
  { error: true }
{%- endif -%}