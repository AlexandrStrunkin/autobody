<?   require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

    $ID=htmlspecialcharsbx($_REQUEST['order_id']);
    $ent__name=$_REQUEST['entname'];
    $list1=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, 'CODE' => 'WEIGHT'), false, false, array())->Fetch();
    if ($list1) {
        $inn_value=$list1['VALUE'];
        $elem=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>105, 'PROPERTY_INN'=>$inn_value),false,false,array('PROPERTY_INN', 'NAME', 'PROPERTY_BANK', 'PROPERTY_BIK', 'PROPERTY_KOR_BILL', 'PROPERTY_BILL', 'PROPERTY_FIO_DIRECTOR', 'PROPERTY_ADDRESS', 'PROPERTY_PHONE', 'ID'));
        if($elem1=$elem->Fetch()){
            $elem_bank_value=$elem1['PROPERTY_BANK_VALUE'];
            $elem_bik_value=$elem1['PROPERTY_BIK_VALUE'];
            $elem_kor_bill_value=$elem1['PROPERTY_KOR_BILL_VALUE'];
            $elem_inn_value=$elem1['PROPERTY_INN_VALUE'];
            $elem_bill_value=$elem1['PROPERTY_BILL_VALUE'];
            $elem_director_value=$elem1['PROPERTY_FIO_DIRECTOR_VALUE'];
            $elem_addr_value=$elem1['PROPERTY_ADDRESS_VALUE'];
            $elem_phone_value=$elem1['PROPERTY_PHONE_VALUE'];
            $exploding=explode(" ",$elem1['PROPERTY_FIO_DIRECTOR_VALUE']);
            $exploding_res=$exploding[0].' '.substr($exploding[1],0,1).'. '.substr($exploding[2],0,1).'.';
            $num_ticket=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, 'CODE'=>'NUM_INVOICE'), false, false, array());
            while($num_ticket1=$num_ticket->Fetch()) {
                $check_id=substr($num_ticket1['VALUE'],0,5);
            } 
            switch ($elem1['ID']) {
                case 235821:
                    $sign_path="/images/nurmatov-sign-stamp.png";
                    //$stamp_path="/images/nurmatov-stamp.png"; 
                    break;
                case 235819:
                    $sign_path="/images/klochkov-sign-stamp.png";
                   // $stamp_path="/images/klochkov-stamp.png"; 
                    break;
                case 235822:
                    $sign_path="/images/pavlenko-sign-stamp.png";
                   // $stamp_path="/images/pavlenko-stamp.png"; 
                    break; 
                case 235823:
                    $sign_path="/images/prudskih-sign-stamp.png";
                   // $stamp_path="/images/prudskih-stamp.png"; 
                    break; 
                case 235820:
                    $sign_path="/images/minihanov-sign-stamp.png";
                  //  $stamp_path="/images/minihanov-stamp.png"; 
                    break;   
            }
         }   
    };
    $order_info=CSaleOrder::GetByID($ID);
    $user_info=CUser::GetByID($order_info['USER_ID'])->Fetch();
    $ent_list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'NAME'=>$ent__name),false,false,array('NAME', 'ID', 'PROPERTY_ENTITY_ADDR', 'PROPERTY_ENTITY_INN', 'PROPERTY_ENTITY_BIK', 'PROPERTY_ENTITY_KOR_BILL', 'PROPERTY_ENTITY_KPP', 'PROPERTY_ENTITY_OKVED', 'PROPERTY_ENTITY_OKPO', 'PROPERTY_ENTITY_BILL', 'PROPERTY_ENTITY_PHONE'))->Fetch();
    $ent_name=$ent_list['NAME'];
    $ent_inn_value=$ent_list['PROPERTY_ENTITY_INN_VALUE'];
    $ent_kpp_value=$ent_list['PROPERTY_ENTITY_KPP_VALUE'];
    $ent_addr_value=$ent_list['PROPERTY_ENTITY_ADDR_VALUE'];
    $ORDER_LIST='';
    $PRICE=0;
    $i=1;
    
    //$date = date("d.m.Y");
    $date = $order_info['DATE_INSERT'];
    $arDate = ParseDateTime($date, "YYYY.MM.DD");
    
    $currentDate = $arDate["DD"]." ".ToLower(GetMessage("MONTH_".intval($arDate["MM"])."_S"))." ".$arDate["YYYY"]." г.";

    $list=CSaleBasket::GetList(array(),array("ORDER_ID"=>$ID),false,false,array("PRODUCT_ID", 'DATE_INSERT', "QUANTITY", "PRICE", "USER_ID", "ID"));
    while($list1=$list->Fetch()) {
        $date_order=explode(' ',$list1['DATE_INSERT']);
        $date_order_new=explode('.',$date_order[0]);
        $elem=CIBlockElement::GetList(array(),array('ID'=>$list1['PRODUCT_ID']),false,false,array());
        while($elem1=$elem->Fetch()) {
            $ORDER_LIST.='<tr><td>'.$i.'</td><td>'.$elem1['CODE'].'</td><td>'.$elem1['NAME'].'</td><td>'.$list1['QUANTITY'].'</td><td>шт.</td><td>'.round(CCurrencyRates::ConvertCurrency($list1['PRICE'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2).'</td><td>'.round(CCurrencyRates::ConvertCurrency($list1['PRICE']*$list1['QUANTITY'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2).'</td></tr>';
            $i++;
            $PRICE+=round(CCurrencyRates::ConvertCurrency($list1['PRICE']*$list1['QUANTITY'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2);
        }
    }
    $taxes=round($PRICE*0.1525,2);
    $string_price=num2str($PRICE);
    $j=$i-1;  
     require_once 'tcpdf/tcpdf.php'; // Подключаем библиотеку  
    $pdf = new TCPDF('P', 'mm', 'A3', true, 'UTF-8',false);

    $pdf->setFont('freeserif','',12);
    $pdf->SetMargins(20, 30, 20);
    $pdf->AddPage(); // Добавляем страницу
    $pdf->SetXY(20, 50); // Установка текущей точки (в мм)    
    $html= <<<EOF
 <style>  
table {
    border-collapse:collapse;
}
.attention {
    border:1px solid black;
    width:730px;
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
    width:750px;
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
}
.quotes td{
    margin-left:20px;}
</style> 
<table class="attention">
<tr> <td colspan="4">
Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате 
 обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту
 прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.</td></tr>
 <tr><td colspan="2" rowspan="2">  
 <span class="bank_name">$elem_bank_value </span><br><br><span class="table_info">Банк получателя</span></td>
 <td> БИК</td>
 <td>$elem_bik_value</td>
 </tr>
 <tr><td>Сч. №</td><td>$elem_kor_bill_value</td></tr>
 <tr><td> ИНН $elem_inn_value</td><td>КПП</td>
 <td rowspan="2">Сч. №</td><td rowspan="2">$elem_bill_value</td></tr>
 <tr><td colspan="2"><span class="IP_name">Индивидуальный Предприниматель $elem_director_value </span><br><br><span class="table_info">Получатель</span></td></tr>
</table>
<br><br>
<span class="check_info">Счет на оплату № $check_id от $currentDate</span>
<br>  
<p>
<table class="provider_info">
<tr>
<td width="88" style="text-align:left;">Поставщик:</td>
<td>Индивидуальный Предприниматель $elem_director_value, ИНН $elem_inn_value, $elem_addr_value, $elem_phone_value</td></tr>
</table> 
</p>
<table class="provider_info">
<tr>
<td width="88">Покупатель:</td>
<td>$ent_name, ИНН $ent_inn_value, КПП $ent_kpp_value, $ent_addr_value</td></tr>
</table>

<br><br>
<table class="items_list" width="730">
<tr>
<th width="20">№</th>
<th>Артикул</th>
<th width="345">Товары (работы, услуги)</th>
<th width="50">Кол-во</th>
<th width="50">Ед.</th>
<th width="80">Цена</th>
<th width="80">Сумма</th></tr>

$ORDER_LIST
</table>
<br><br>
<table class="price_summ">
<tr>
<td width="650" align="right">Итого:</td>
<td width="85" align="right">$PRICE</td></tr>
<tr>
<td width="650" align="right">В том числе НДС:</td>
<td width="85" align="right">$taxes</td></tr>
<tr>
<td width="650" align="right">Всего к оплате:</td>
<td width="85" align="right">$PRICE</td></tr></table>
<br><br>
<table class="price_summ">
    <tr>
        <td valign="middle" height="100">
        <br><br><br><br><br>
            <span class="total_items">Всего наименований $j, на сумму $PRICE руб.</span> <br>
  
            <span class="string_price">$string_price</span> 
        </td>
    </tr>
</table>
<div class="line" width="935"></div> <br> <br>
<table class="quotes">
    <tr>
        <td width="85">
            <br><br><br><br><br><br><br><div class="chief">Руководитель</div>
        </td>
        <td width="175">
            <br><br><br><br><br><br><br>
            <table class="chief_quote">
            <tr><td height="19">Руководитель<div><img src="/images/line.png"></div></td></tr>
            <tr><td height="13">должность</td></tr></table>
        </td>
        <td width="200">
            <table class="chief_quote quote_2">
            <tr><td><span id="chief_sign" style="color:white;"><img src="$sign_path"></span><div><img src="/images/line.png"></div></td></tr>
            <tr><td>подпись</td></tr></table> 
        </td>
        <td width="200">
            <br><br><br><br><br><br><br>
            <table class="chief_quote quote_2" style="position:relative;">
            <tr><td>$exploding_res<div><img src="/images/line.png"></div></td></tr>
            <tr><td>расшифровка подписи</td></tr></table>
        </td>
     </tr>
</table>
<br><br><br>
<table>
     <tr>
        <td width="260" colspan="2">
            <div class="chief accountant">Главный (старший) бухгалтер</div>
        </td>
        <td width="200">
            <table class="chief_quote quote_2">
            <tr><td><span id="accountant_sign" style="color:white;"></span><div><img src="/images/line.png"></div></td></tr>
            <tr><td>подпись</td></tr></table> 
        </td>
        <td width="200">
            <table class="chief_quote quote_2">
            <tr><td><span style="opacity:0;"></span><div><img src="/images/line.png"></div></td></tr>
            <tr><td>расшифровка подписи</td></tr></table>
        </td>
     </tr>
            
</table>    
            <br><br><br>

EOF;
     $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Cell(30, 10, $tt);
      $pdf->Output($check_id.'.pdf');   
    ?>
    