{% extends "public.tpl" %}
{% block content %}
<div class="row">
  <div class="col-md-12">
    <p>
      Мы записываем подкаст с октября <b>2005</b> года уже более <b>8 лет</b> и записали более <b>400 выпусков</b>.
      Этого не могло бы состоятся без наших преданных слушателей, которые поддерживали нас пожертвованиями.</p>
  </div>
</div>
<div class="row">
  <div class="col-xs-2 col-sm-1"> <!-- required for floating -->
    <!-- Nav tabs -->
    <ul class="nav nav-tabs tabs-left vertical-text">
      <li class="active"><a href="#yandex" data-toggle="tab">Yandex</a></li>
      <li><a href="#paypal" data-toggle="tab">PayPal</a></li>
    </ul>
  </div>
  <div class="col-xs-9">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane" id="paypal">
        <p class="donate">Если ты хочешь поддерживать нас постоянно оформи подписку</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" class="widget-donate" method="post" target="_top">
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="hosted_button_id" value="5YQDFQ9LCLKTU">
          <p>Ежемесячная помощь подкасту</p>
          <div class="row">
            <div class="col-xs-5">
              <select name="os0" class="form-control">
                <option value="$25/month">$25 per Month</option>
                <option value="$10/month">$10 per Month</option>
                <option value="$5/month">$5 per Month</option>
              </select>
            </div>
            <div class="col-xs-2 widget_card"></div>
            <div class="col-xs-4">
              <span class="b-button b-button_orange" data-block="b-button">
                <span class="b-button__inner">Поддержать</span>
                <input class="paypalInput b-button__input" type="image" name="submit" alt="PayPal - The safer, easier way to pay online!">
              </span>
            </div>
          </div>
          <input type="hidden" name="on0" value="">
          <input type="hidden" name="currency_code" value="USD">
          <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
        <p class="donate">или поддержи нас разовым платежом</p>
        <form class="paypalForm widget-donate" action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <p>Помощь подкасту</p>
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="hosted_button_id" value="42ZQXUB44Q4LG">
          <div class="row">
            <div class="col-xs-2 widget_card"></div>
            <div class="col-xs-4">
              <span class="b-button b-button_orange" data-block="b-button">
                <span class="b-button__inner">Поддержать</span>
                <input class="paypalInput b-button__input" type="image" name="submit" alt="PayPal">
              </span>
            </div>
          </div>
          <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
      </div>
      <div class="tab-pane active" id="yandex">
        <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=410011225397189&quickpay=donate&payment-type-choice=on&default-sum=99&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C+%D0%BF%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82%D1%83&target-visibility=on&project-name=RCMP.me&project-site=rcmp.me&button-text=05" width="507" height="133"></iframe>
        <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=410011225397189&quickpay=donate&payment-type-choice=on&default-sum=199&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C+%D0%BF%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82%D1%83&target-visibility=on&project-name=RCMP.me&project-site=rcmp.me&button-text=05" width="507" height="133"></iframe>
        <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=410011225397189&quickpay=donate&payment-type-choice=on&default-sum=299&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C+%D0%BF%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82%D1%83&target-visibility=on&project-name=RCMP.me&project-site=rcmp.me&button-text=05" width="507" height="133"></iframe>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <p class="donate">
      Все пожертвования мы используем для развития подкаста: покупаем записывающую аппаратуру,
      проводим конкурсы, оплачиваем хостинг и разработку для аудитории слушателей.
      Мы рады взаимному сотрудничеству и будем рады если с твоей помощью нас услышит большее количество людей.
    </p>
  </div>
</div>
{% include "show_comments.tpl" %}
{% endblock content %}
{% block css %}
  <link href="/css/bootstrap.vertical-tabs.css" rel="stylesheet">
  <link href="/css/donation/default.css" rel="stylesheet">
{% endblock %}