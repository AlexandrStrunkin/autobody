<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Р—Р°РєР°Р·");
?>
<?//CEvent::Send("ORDER_IN_PROGRESS","s1",array(),"N",86); ?>
<style>
@font-face {
    font-family: 'helveticaneuecyrroman';
    src: url('/fonts/helveticaneuecyr-roman-webfont.eot');
    src: url('/fonts/helveticaneuecyr-roman-webfont.eot?#iefix') format('embedded-opentype'),
         url('/fonts/helveticaneuecyr-roman-webfont.woff2') format('woff2'),
         url('/fonts/helveticaneuecyr-roman-webfont.woff') format('woff'),
         url('/fonts/helveticaneuecyr-roman-webfont.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;

}
@font-face {
    font-family: 'rouble';
    src: url('/fonts/rouble.eot');
    src: url('/fonts/rouble.eot?#iefix') format('embedded-opentype'),
         url('/fonts/rouble.woff2') format('woff2'),
         url('/fonts/rouble.woff') format('woff'),
         url('/fonts/rouble.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;

}
.letter {
    width:800px;
    height:1900px;
    font-family: 'helveticaneuecyrroman';
}
.mail-logo {
    height:180px;
    float:left;
    clear:both;
    margin-left:50px;
}
.mail-logo img {
    position:relative;
    top:40%;
}
.mail-info {
    height:61px;
    width:395px;
    float:right;
    margin-right:45px;
    font-size:15px;
    padding-left:50px;
    border-left:1px solid #dddddd;
    position:relative;
    top:3.7%;
    line-height:30px;
}
.mail-info span {
    color:#585858;
}
.dear {
    float:left;
    width:100%;
    font-size:20px;
    height:140px;
    margin-left:50px;
}
.dear-blue {
     color:#14628a;
     position:relative;
     top:30%;
}
.dear-order {
    color:#e5262d !important;
    text-decoration:underline;
}
.mail-price {
    float:left;
    width:100%;
    font-size:20px;
    height:100px;
    margin-left:50px;
}
.order-price {
       color:black;
       position:relative;
       top:36%;
}
.mail-data {
    float:left;
    width:100%;
    font-size:15px;
    height:430px;
    padding-top:30px;
    margin-left:50px;
}
.field {
    margin-right:50px;
    height:55px;
    border-bottom:1px solid grey;
}
.field span {
    position:relative;
    top:50%;
}
.field_name {
    float:left;
    clear:both;
}
.field_value {
    float:right;
}
.you_ordered {
    float:left;
    width:100%;
    font-size:20px;
    padding-top:48px;
    padding-bottom:30px;
    margin-left:50px;
}
.you_ordered table {
    font-size:12px;
    width:100%;
    margin-top:15px;
    padding-right:50px;
}
.you_ordered table th {
    text-align:center;
    color:#585858;
    border-bottom:2px solid black;
    
}
.you_ordered table th:first-child {
    text-align:left;
}
.ordered_item {
    color:#0094c8;
    line-height:25px;
    border-bottom:1px solid #0094c8;
    padding-bottom:2px;
}
.item_descr {
    font-size:11px;
    color:#808080;
    line-height:25px;
}
.you_ordered tr {
    height:88px;
    text-align:center;
}
.you_ordered tr:first-child {
    height:60px;
}
.you_ordered table tr td:first-child {
    text-align:left;
}
.order_checking {
    float:left;
    width:100%;
    height:180px;
    margin-left:50px;
}
.check_button {
    padding:20px 30px;
    background:#e02e2e;
    font-size:18px;
    position:relative;
    top:44%;
}
.check_button a {
    color:white;
}
.checking_info {
    font-size:14px;
    width:406px;
    float:right;
    margin-right:70px;
    position:relative;
    top:35%;
}
.more_info {
    float:left;
    width:100%;
    font-size:14px;
    height:180px;
    margin-left:50px;
}
.more_info span {
    position:relative;
    top:25%;
}
.letter_footer {
    background:#055883;
    float:left;
    width:750px;
    padding-left:50px;
    padding-top:50px;
}
.letter_footer span {
    color:white;
}
.letter_footer img {
    float:left;
    padding-top:30px;
}
.footer_info {
    font-size:24px;
    margin-top:55px;
    float:left;
}
.footer_contacts {
    float:left;
    clear:both;
    font-size:15px;
    line-height:22px;
    margin-top:30px;
    padding-bottom:47px;
}
.footer_contacts span {
    border-bottom:1px solid #578fac;
}
</style>
<div class="letter">
    <div class="mail-logo">
<img src="/images/logo-image.png">
</div>
<div class="mail-info">
<span>Информационное сообщение сайта "ФОРВАРД"<br>Оптовые склады автозапчастей</span>
    </div>
<div class="dear">
<span class="dear-blue">Уважаемый Александр,<br>Ваш заказ номер <span class="dear-order">444921 от 2015-04-07 12-08-02</span> поступил в обработку</span>
</div>
<div class="mail-price">
<span class="order-price">Стоимость заказа: 25 078.98 <img src="/images/rub-002.png"></span>
</div>
<div class="mail-data">
<div class="field">
<span class="field_name">Склад</span>
<span class="field_value">Москва-Дмитровка</span>
</div>
<div class="field">
<span class="field_name">Номер резерва</span>
<span class="field_value">342342343242343247755</span>
</div>
<div class="field">
<span class="field_name">Зарезервировано до</span>
<span class="field_value">22.05.25</span>
</div>
<div class="field">
<span class="field_name">Номер накладной</span>
<span class="field_value">232325928371</span>
</div>
<div class="field">
<span class="field_name">Доставка</span>
<span class="field_value">Экспресс доставка заказа курьером В ЮВАО, ВАО, ЮАО</span>
</div>
<div class="field">
<span class="field_name">Стоимость доставки</span>
<span class="field_value">0 Р</span>
</div> 
<div class="field">
<span class="field_name">Оплата</span>
<span class="field_value">Наличными</span>
</div>
</div>
<div class="you_ordered">
Вы заказали
<table>
<tr>
    <th>Наименование (артикул, ОЕМ, год)</th>
    <th>Резерв</th> 
    <th>Отг-но</th>
    <th>Снято</th>
    <th>Отказ</th>
    <th>Кол-во, шт.</th>
    <th>Цена, Р</th>
    <th>Сумма, Р</th>         
</tr>
<tr>
    <td><span class="ordered_item">AUDI 80 СТЕКЛО ФАРЫ ПРАВ</span><br>
    <span class="item_descr">(AF15592-000-R, 0301085302/301085302, 92-96)</span></td>
    <td>43</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>43</td>
    <td>12 452</td>
    <td><b>52 452</b></td>
</tr>
<tr>
    <td><span class="ordered_item">AUDI 80 СТЕКЛО{AI100 (83-93)(250/150W 280mm)}</span><br>
    <span class="item_descr">(AF15592-000-R, 0301085302/301085302, 92-96)</span></td>
    <td>45</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>45</td>
    <td>55 452</td>
    <td><b>92 452</b></td>
</tr>
</table>
</div>
<div class="order_checking">
<span class="check_button"><a href="#">Отслеживать заказ</a></span>
<span class="checking_info">Для входа в этот раздел вам необходимо будет ввести логин и пароль пользователя сайта "ФОРВАРД" Оптовые склады автозапчастей.</span>
</div>
<div class="more_info">
<span>Для того, чтобы аннулировать заказ, сообщите об этом нашим менеджерам.<br><br><br>
Пожалуйста, при обращении к администрации сайта "ФОРВАРД" Оптовые склады автозапчастей обязательно указывайте номер Вашего заказа - 444921.</span>
</div>
<div class="letter_footer">
<img src="/images/thanks-for-buying.png">
<span class="footer_info">Вы можете связаться с нами: <b>8 800 707 78 13</b> (бесплатно)</span><br>
<span class="footer_contacts"><span>forward@autobody.ru</span><span style="margin-left:20px;">www.autobody.ru</span></span>
</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>