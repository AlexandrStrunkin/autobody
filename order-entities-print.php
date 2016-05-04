<?   
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//if ($USER->IsAdmin()) {
//$APPLICATION->SetTitle("Новая страница (1)");?> 
<style>
table {
    border-collapse:collapse;
}
.attention {
    border:1px solid black;
    width:950px;
    font-size:10pt;
}
.attention td {
    border:1px solid black;
    line-height:17px;
}
.table_info {
 position:absolute;
 bottom:0;
 left:0;
 font-size:9px;   
}
.attention tr:nth-child(2) td:first-child, .attention tr:last-child td:first-child {
    position:relative;
    height:50px;
    width:400px;
}
.bank_name, .IP_name {
    position:absolute;
    top:0;
    left:0;
    color:black;
}
.attention tr:nth-child(4) td:first-child {
    width:188px;
}
.attention tr:nth-child(3) td:first-child, .attention tr:nth-child(4) td:nth-child(3) {
    vertical-align:top;
}
.attention tr:nth-child(2) td:nth-child(2) {
    height:15px;
}
.attention tr:nth-child(3) td:nth-child(2), .attention tr:nth-child(4) td:last-child {
    vertical-align:top;
}
.check_info {
    font-size:14pt;
    font-weight:bold;
    color:black;
}
.provider_info {
    font-size:9pt;
    width:965px;
}
.provider_info tr td:first-child {
    text-align:left;
    width:88px;
    vertical-align:top;
}
.provider_info tr td:last-child {
    font-weight:bold;
}
.items_list {
    width:1000px;
    border:1px solid black;
}
.items_list td, .items_list th {
    border:1px solid black;
}
.items_list td {
    font-size:8pt;
    padding:3px;
}
.items_list th {
   text-align:center;
   font-size:10pt; 
}
.items_list th:first-child, .items_list th:nth-child(5) {
    width:40px;
}
.items_list th:last-child, .items_list th:nth-child(6) {
    width:80px;
}
.items_list tr td:first-child{
    text-align: center;
}
.items_list tr td:nth-child(4), .items_list tr td:nth-child(6), .items_list tr td:last-child{
    text-align: right;
}
.price_summ {
    width:1000px;
}
.price_summ td {
    font-size:10pt;
    font-weight:bold;
}
.price_summ tr td:first-child{
    width:915px;
    text-align:right;
    padding-right:10px;
}
.price_summ tr td:last-child {
    text-align:right;
}
.total_items {
    color:black;
    font-size:10pt;
}
.string_price {
    color:black;
    font-weight:bold;
    font-size:10pt;
    line-height:20px;
}
.line {
    border-bottom:1px solid black;
    width:935px;
    position:relative;
}
.chief {
    font-size:9pt;
    display:inline-block;
    color:black;
    font-weight:bold;                                                           
    margin-right:20px;
}
.chief_quote {
    display:inline-block;
    height:15px;
    margin-right:15px;
}
.chief_quote tr td {
    text-align:center;
    width:175px;
}  
.chief_quote tr:last-child td{
    font-size:8pt;
}
.chief_quote tr:first-child td{
    font-weight:bold;
    font-size:10pt;
    height:19px;
}
.chief_quote tr:first-child td {
    border-bottom:1px solid black;
}
.quote_2 tr td{
    width:200px;
}
.accountant {
    margin-right:122px;
}
#chief_sign img {
    position:absolute;
    z-index:-50;
    top:-60px;
    left:-95px;
}
#chief_sign {
    position:relative;
}
#chief_sign span, #accountant_sign span {
    opacity:0;
}
#stamp {
    height: 100px;
    width:105px;
    position:absolute;
    top:-102px;
    right:192px;
    z-index:-1;
}</style>  
<?
//arshow($_REQUEST);
$ID=htmlspecialcharsbx($_REQUEST['order_id']);
CModule::IncludeModule('iblock');
$list1=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, 'CODE' => 'WEIGHT'), false, false, array())->Fetch();
//arshow($list1['VALUE']);
if ($list1) {
$elem=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>105, 'PROPERTY_INN'=>$list1['VALUE']),false,false,array('PROPERTY_INN', 'NAME', 'PROPERTY_BANK', 'PROPERTY_BIK', 'PROPERTY_KOR_BILL', 'PROPERTY_BILL', 'PROPERTY_FIO_DIRECTOR', 'PROPERTY_ADDRESS', 'PROPERTY_PHONE', 'ID'));
while($elem1=$elem->Fetch()) {
  //  arshow($elem1);

?>
<table class="attention">
<tr> <td colspan='4'>
Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате 
 обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту
 прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.</td></tr>
 <tr><td colspan='2' rowspan='2'>  
 <span class="bank_name"> <?=$elem1['PROPERTY_BANK_VALUE'];?> </span><span class="table_info">Банк получателя</span></td>
 <td> БИК</td>
 <td><?=$elem1['PROPERTY_BIK_VALUE'];?></td>
 </tr>
 <tr><td>Сч. №</td><td><?=$elem1['PROPERTY_KOR_BILL_VALUE'];?></td></tr>
 <tr><td> ИНН <?=$elem1['PROPERTY_INN_VALUE'];?></td><td>КПП</td>
 <td rowspan='2'>Сч. №</td><td rowspan='2'><?=$elem1['PROPERTY_BILL_VALUE'];?></td></tr>
 <tr><td colspan='2'><span class="IP_name">Индивидуальный Предприниматель <?=$elem1['PROPERTY_FIO_DIRECTOR_VALUE'];?> </span><span class='table_info'>Получатель</span></td></tr>
</table>
<br>

<?  $num_ticket=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, 'CODE'=>'NUM_INVOICE'), false, false, array());
while($num_ticket1=$num_ticket->Fetch()) {
?>
<span class="check_info">Счет на оплату № <?=substr($num_ticket1['VALUE'],0,5);?> от 01 июля 2015 г.</span>
<?}?>
<br><br>   
<table class="provider_info">
<tr>
<td>Поставщик:</td>
<td>Индивидуальный Предприниматель <?=$elem1['PROPERTY_FIO_DIRECTOR_VALUE'];?>, ИНН <?=$elem1['PROPERTY_INN_VALUE'];?>, <?=$elem1['PROPERTY_ADDRESS_VALUE'];?>, <?=$elem1['PROPERTY_PHONE_VALUE'];?></td></tr>
</table>
<?$exploding=explode(" ",$elem1['PROPERTY_FIO_DIRECTOR_VALUE']);
$exploding_res=$exploding[0].' '.substr($exploding[1],0,1).'. '.substr($exploding[2],0,1).'.';?>
<?}}?>  
<br><br>
<table class="provider_info">
<tr>
<td>Покупатель:</td>
<? $order_info=CSaleOrder::GetByID($ID);
$user_info=CUser::GetByID($order_info['USER_ID'])->Fetch();
//arshow($user_info);?>
<?$ent_list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'NAME'=>htmlspecialcharsbx($_REQUEST['entname'])),false,false,array('NAME', 'ID', 'PROPERTY_ENTITY_ADDR', 'PROPERTY_ENTITY_INN', 'PROPERTY_ENTITY_BIK', 'PROPERTY_ENTITY_KOR_BILL', 'PROPERTY_ENTITY_KPP', 'PROPERTY_ENTITY_OKVED', 'PROPERTY_ENTITY_OKPO', 'PROPERTY_ENTITY_BILL', 'PROPERTY_ENTITY_PHONE'))->Fetch();
?>
<td><?=$ent_list['NAME']?>, ИНН <?=$ent_list['PROPERTY_ENTITY_INN_VALUE']?>, КПП <?=$ent_list['PROPERTY_ENTITY_KPP_VALUE']?>, <?=$ent_list['PROPERTY_ENTITY_ADDR_VALUE']?></td></tr>
</table>

<br><br>
<table class="items_list">
<tr>
<th>№</th>
<th>Артикул</th>
<th>Товары (работы, услуги)</th>
<th>Кол-во</th>
<th>Ед.</th>
<th>Цена</th>
<th>Сумма</th></tr>
<!--<tr>
<td>1</td>
<td>JAKOP00-FAK</td>
<td>JAKOPARTS '00- {Chevrolet Aveo, Daewoo} ФИЛЬТР ВОЗДУШНЫЙ</td>
<td>1</td>
<td>шт.</td>
<td>236,88</td>
<td>236,88</td></tr>
<tr>
<td>2</td>
<td>TYRV400-960-Z</td>
<td>RAV4 '00-05 РЫЧАГ ЗАДН ПОДВЕСКИ Л=П ВЕРХН</td>
<td>2</td>
<td>шт.</td>
<td>1397,22</td>
<td>2794,44</td></tr>
<tr>
<td>3</td>
<td>MBCAR99-810-L</td>
<td>CARISMA '99-03 {S40 96-00} РЫЧАГ ПЕРЕДН ПОДВЕСКИ ЛЕВ НИЖН В СБОРЕ</td>
<td>1</td>
<td>шт.</td>
<td>1545,60</td>
<td>1545,60</td></tr>
<tr>
<td>4</td>
<td>TYCAM11-740-L</td>
<td>CAMRY '11- ФОНАРЬ ЗАДН ВНЕШН ЛЕВ</td>
<td>1</td>
<td>шт.</td>
<td>2814,54</td>
<td>2814,54</td></tr>
<tr>
<td>5</td>
<td>TYRV496-042Y-L</td>
<td>RAV4 '96-97 УКАЗ.ПОВОРОТА НИЖН ЛЕВ В БАМПЕР (USA) ЖЕЛТ</td>
<td>1</td>
<td>шт.</td>
<td>574,96</td>
<td>574,96</td>
</tr> -->
<?$ORDER_LIST='';
$PRICE=0;
$i=1;

 $list=CSaleBasket::GetList(array(),array("ORDER_ID"=>$ID),false,false,array("PRODUCT_ID", 'DATE_INSERT', "QUANTITY", "PRICE", "USER_ID", "ID"));
 while($list1=$list->Fetch()) {
 $date_order=explode(' ',$list1['DATE_INSERT']);
 $date_order_new=explode('.',$date_order[0]);
 $elem=CIBlockElement::GetList(array(),array('ID'=>$list1['PRODUCT_ID']),false,false,array());
while($elem1=$elem->Fetch()) {
$ORDER_LIST.='<tr><td>'.$i.'</td><td>'.$elem1['CODE'].'</td><td>'.$elem1['NAME'].'</td><td>'.$list1['QUANTITY'].'</td><td>шт.</td><td>'.round(CCurrencyRates::ConvertCurrency($list1['PRICE'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2).'</td><td>'.round(CCurrencyRates::ConvertCurrency($list1['PRICE']*$list1['QUANTITY'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2).'</td></tr>';
$i++;
$PRICE+=round(CCurrencyRates::ConvertCurrency($list1['PRICE']*$list1['QUANTITY'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2);
 }}?>
 <?=$ORDER_LIST;?>
</table>
<br><br>
<table class="price_summ">
<tr>
<td>Итого:</td>
<td><?=$PRICE?></td></tr>
<tr>
<td>В том числе НДС:</td>
<td><?=round($PRICE*0.1525,2)?></td></tr>
<tr>
<td>Всего к оплате:</td>
<td><?=$PRICE?></td></tr></table>
<br><br>
<span class="total_items">Всего наименований <?=$i-1?>, на сумму <?=$PRICE?> руб.</span> <br>
<? $price_str='';


    /**
    * Склоняем словоформу
    * @ author runcore
    */
    ?>     
<span class="string_price"><?echo num2str($PRICE);?></span> <br><br>
<div class="line"><div id="stamp"></div></div> <br> <br>
<div class="chief">Руководитель</div>
<table class="chief_quote">
<tr><td>Руководитель</td></tr>
<tr><td>должность</td></tr></table>
<table class="chief_quote quote_2">
<tr><td><span id="chief_sign" style="color:white;">aaa</span></td></tr>
<tr><td>подпись</td></tr></table> 
<table class="chief_quote quote_2" style='position:relative;'>
<tr><td><?=$exploding_res?></td></tr>
<tr><td>расшифровка подписи</td></tr></table><br><br><br>
<div class="chief accountant">Главный (старший) бухгалтер</div>
<table class="chief_quote quote_2">
<tr><td><span id="accountant_sign" style="color:white;"><span>aaa</span></span></td></tr>
<tr><td>подпись</td></tr></table>
<table class="chief_quote quote_2">
<tr><td><span style="opacity:0;">aaa</span></td></tr>
<tr><td>расшифровка подписи</td></tr></table>   
<script>
$(document).ready(function(){
<?$list111=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, 'CODE' => 'WEIGHT'), false, false, array())->Fetch();
$elem=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>105, 'PROPERTY_INN'=>$list111['VALUE']),false,false,array('PROPERTY_INN', 'NAME', 'PROPERTY_BANK', 'PROPERTY_BIK', 'PROPERTY_KOR_BILL', 'PROPERTY_BILL', 'PROPERTY_FIO_DIRECTOR', 'PROPERTY_ADDRESS', 'PROPERTY_PHONE', 'ID'));
while($elem1=$elem->Fetch()) {?>
<? if ($elem1['ID']=='235821') {?>
document.getElementById("chief_sign").innerHTML='<span>aaa</span><img src="/images/nurmatov-sign.png" style="top:-60px;left:-35px;">';
$("#stamp").css("background", "url('/images/nurmatov-stamp.png') no-repeat");
<?}elseif($elem1['ID']=='235819'){?>
document.getElementById("chief_sign").innerHTML='<span>aaa</span><img src="/images/klochkov-sign.png" style="top:-60px;left:-95px;">';
$("#stamp").css("background", "url('/images/klochkov-stamp.png') no-repeat");
<?}elseif($elem1['ID']=='235822'){?>
document.getElementById("chief_sign").innerHTML='<span>aaa</span><img src="/images/pavlenko-sign.png" style="top:-60px;left:-35px;">';
$("#stamp").css("background", "url('/images/pavlenko-stamp.png') no-repeat");
<?}elseif($elem1['ID']=='235823'){?>
document.getElementById("chief_sign").innerHTML='<span>aaa</span><img src="/images/prudskih-sign.png" style="top:-60px;left:-35px;">';
$("#stamp").css("background", "url('/images/prudskih-stamp.png') no-repeat");
<?}elseif($elem1['ID']=='235820'){?>
document.getElementById("chief_sign").innerHTML='<span>aaa</span><img src="/images/minihanov-sign.png">';
$("#stamp").css("background", "url('/images/minihanov-stamp.png') no-repeat");
<?}else { ?>
 document.getElementById("chief_sign").innerHTML='<span>aaa</span><img src="">';   
<?}?>
<?}?>
});
</script>
           
<?/*}*/require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>