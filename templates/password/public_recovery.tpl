{% extends "public.tpl" %}
{% set user = response.user %}
{% block content %}
<div class="row">
	<div class="col-md-6">
    Вам выслано письмо с новым паролем на почту {{ user.get_email() }}.
	</div>
</div>
{% endblock content %}