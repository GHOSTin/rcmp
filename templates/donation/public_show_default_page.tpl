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
  <div class="col-md-6">
    <p class="donate">Если ты хочешь поддерживать нас постоянно оформи подписку</p>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="5YQDFQ9LCLKTU">
      <table>
        <tbody><tr><td><input type="hidden" name="on0" value=""></td></tr><tr><td><select name="os0">
          <option value="$25/month"> &gt;&gt;&gt; $25 per Month</option>
          <option value="$10/month"> &gt;&gt; $10 per Month</option>
          <option value="$5/month"> &gt; $5 per Month</option>
        </select></td></tr>
        </tbody></table>
      <input type="hidden" name="currency_code" value="USD">
      <input class="paypalInput" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif"
             border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
    <p class="donate">или поддержи нас разовым платежом</p>
    <form class="paypalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="42ZQXUB44Q4LG">
      <input class="paypalInput" type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Paypal">
      <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
  </div>
  <div class="col-md-6">
  <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=410011225397189&quickpay=donate&payment-type-choice=on&default-sum=99&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C+%D0%BF%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82%D1%83&target-visibility=on&project-name=RCMP.me&project-site=rcmp.me&button-text=05" width="507" height="133"></iframe>
  <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=410011225397189&quickpay=donate&payment-type-choice=on&default-sum=199&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C+%D0%BF%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82%D1%83&target-visibility=on&project-name=RCMP.me&project-site=rcmp.me&button-text=05" width="507" height="133"></iframe>
  <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=410011225397189&quickpay=donate&payment-type-choice=on&default-sum=299&targets=%D0%9F%D0%BE%D0%BC%D0%BE%D1%89%D1%8C+%D0%BF%D0%BE%D0%B4%D0%BA%D0%B0%D1%81%D1%82%D1%83&target-visibility=on&project-name=RCMP.me&project-site=rcmp.me&button-text=05" width="507" height="133"></iframe>
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
{% endblock content %}