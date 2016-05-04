<?   require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$ID=456703;
    $ent__name='432423';
    $list1=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, 'CODE' => 'WEIGHT'), false, false, array())->Fetch();
    if ($list1) {
        $inn_value=$list1['VALUE'];
        $elem=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>105, 'PROPERTY_INN'=>$inn_value),false,false,array('PROPERTY_INN', 'NAME', 'PROPERTY_BANK', 'PROPERTY_BIK', 'PROPERTY_KOR_BILL', 'PROPERTY_BILL', 'PROPERTY_FIO_DIRECTOR', 'PROPERTY_ADDRESS', 'PROPERTY_PHONE', 'ID'));
        while($elem1=$elem->Fetch()) {
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
        }   
    };
    $order_info=CSaleOrder::GetByID($ID);
    $ent_list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'NAME'=>htmlspecialcharsbx($ent__name)),false,false,array('NAME', 'ID', 'PROPERTY_ENTITY_ADDR', 'PROPERTY_ENTITY_INN', 'PROPERTY_ENTITY_BIK', 'PROPERTY_ENTITY_KOR_BILL', 'PROPERTY_ENTITY_KPP', 'PROPERTY_ENTITY_OKVED', 'PROPERTY_ENTITY_OKPO', 'PROPERTY_ENTITY_BILL', 'PROPERTY_ENTITY_PHONE'))->Fetch();
    $ent_name=$ent_list['NAME'];
    $ent_inn_value=$ent_list['PROPERTY_ENTITY_INN_VALUE'];
    $ent_kpp_value=$ent_list['PROPERTY_ENTITY_KPP_VALUE'];
    $ent_addr_value=$ent_list['PROPERTY_ENTITY_ADDR_VALUE'];
    $ORDER_LIST='';
    $PRICE=0;
    $i=1;

    $list=CSaleBasket::GetList(array(),array("ORDER_ID"=>$ID),false,false,array("PRODUCT_ID", 'DATE_INSERT', "QUANTITY", "PRICE", "USER_ID", "ID"));
    
    while($list1=$list->Fetch()) {
        $date_order=explode(' ',$list1['DATE_INSERT']);
        $date_order_new=explode('.',$date_order[0]);
        $elem=CIBlockElement::GetList(array(),array('ID'=>$list1['PRODUCT_ID']),false,false,array());
        while($elem1=$elem->Fetch()) {
            $ORDER_LIST.='<tr><td>'.$i.'</td><td>'.$elem1['CODE'].'</td><td>'.$elem1['NAME'].'</td><td>'.$list1['QUANTITY'].'</td><td>??.</td><td>'.round(CCurrencyRates::ConvertCurrency($list1['PRICE'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2).'</td><td>'.round(CCurrencyRates::ConvertCurrency($list1['PRICE']*$list1['QUANTITY'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2).'</td></tr>';
            $i++;
            $PRICE+=round(CCurrencyRates::ConvertCurrency($list1['PRICE']*$list1['QUANTITY'],'USD','RUR',$date_order_new[2].'-'.$date_order_new[1].'-'.$date_order_new[0]),2);
        }
    }
    $taxes=round($PRICE*0.1525,2);
    $string_price=num2str($PRICE);
    echo $string_price;
    $j=$i-1;
    ?>