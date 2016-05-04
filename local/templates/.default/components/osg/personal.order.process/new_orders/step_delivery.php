<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($arResult)
    //проверяем текущую корзину пользователя, чтобы посчитать сумму заказа для выбора службы доставки
    $arBasketItemsIDs = array();  //массив ID товаров, которые в корзине на данный момент

    $dbBasketItems = CSaleBasket::GetList(
        array(
            "NAME" => "ASC",
            "ID" => "ASC"
        ),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            "DELAY" => "N"
        ),
        false, false,
        array(
            //  "PRODUCT_ID"
        )
    );

    $total_price = 0; //общая стоимость заказа

    while ($arItems = $dbBasketItems->Fetch())
    {
        // arshow($arItems);
        $total_price+= $arItems["PRICE"]*$arItems["QUANTITY"];
    }

    //переводим цену в рубли
    $total_price = ceil(CCurrencyRates::ConvertCurrency($total_price, "USD", "RUR"));   



    //получаем пользовательские данные из соответствующего инфоблока
    $arSelect = array(
        "PROPERTY_DELIVERY",
        "PROPERTY_PAYMENT",
        "PROPERTY_CITY",
        "PROPERTY_ADRESS",
        "PROPERTY_PACK",
        "PROPERTY_MAIN_MAN",
        "PROPERTY_MAIN_MAN_PHONE",
        "PROPERTY_INFO",
        "PROPERTY_REGIME"
    );       
    
    $user_data = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>99, "NAME"=>$USER->GetLogin()), false, false, $arSelect);
    $arData = $user_data->Fetch();

    $user_data_delivery_id = $arData["PROPERTY_DELIVERY_VALUE"];
    $user_data_payment_id = $arData["PROPERTY_PAYMENT_VALUE"];
    $user_data_city = $arData["PROPERTY_CITY_VALUE"];
    $user_data_adress = $arData["PROPERTY_ADRESS_VALUE"]; 
    
    //arshow($arData);
    /*
    [PROPERTY_DELIVERY_VALUE] => 688
    [PROPERTY_DELIVERY_VALUE_ID] => 8642754
    [PROPERTY_PAYMENT_VALUE] => 43
    [PROPERTY_PAYMENT_VALUE_ID] => 8642755
    [PROPERTY_CITY_VALUE] => 
    [PROPERTY_CITY_VALUE_ID] => 
    [PROPERTY_ADRESS_VALUE] => 
    [PROPERTY_ADRESS_VALUE_ID] => 
    [PROPERTY_PACK_VALUE] => Да
    [PROPERTY_PACK_ENUM_ID] => 19
    [PROPERTY_PACK_VALUE_ID] => 8642756
    [PROPERTY_MAIN_MAN_VALUE] => 123
    [PROPERTY_MAIN_MAN_VALUE_ID] => 8642757
    [PROPERTY_MAIN_MAN_PHONE_VALUE] => 
    [PROPERTY_MAIN_MAN_PHONE_VALUE_ID] => 
    [PROPERTY_INFO_VALUE] => 
    [PROPERTY_INFO_VALUE_ID] => 
    [PROPERTY_REGIME_VALUE] => 
    [PROPERTY_REGIME_VALUE_ID] => 
    */

?>
 <table>
<tr>
    <td>
        <script>
            $(function(){
                //показ описания служб доставки
                $(".radio").click(function(){ 
                    $(".delivery_description").css("display","none");                   
                    var id = ($(this).attr("id")).slice(14);
                    $(".delivery_description_" + id).css("display","block");  
                })
            })
        </script>
        <div class="names">Способ доставки</div><br/>
        <input type="hidden" name="DATA[DELIVERY_ID]" id="DATADEL"/>
        <?
            // arshow($arResult["DATA"]);
            $myprice = $_SESSION['OSG']['USER']['BASKET']['TOTAL_PRICE']; /*print_r($_SESSION['OSG']['USER']['BASKET']);*/



            //проверяем доступность служб доставки
            $query = "select * from `_warehouses` where `id`=".$_SESSION["GKWH"];
            $res = $DB->Query($query);
            if($row = $res->Fetch()){
                //  arshow($row);
                $row["name"] = str_replace("]","",$row["name"]);
                $row["name"] = trim($row["name"]);
                $nameArr = explode("[", $row["name"]);

                // arshow($nameArr);

                $warehouse_params = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>95 ,"NAME"=>$nameArr[1]), false, false, array("NAME","PROPERTY_347"));
                if ($warehouse = $warehouse_params->Fetch()){
                    //arshow($warehouse);
                    $W_DELIV = $warehouse["PROPERTY_347_VALUE"];
                }
            }
            //разбиавем строку со списком складов на массив значений
            $W_DELIV_ARR = explode(",",$W_DELIV);
            foreach ($W_DELIV_ARR as $n=>$val) {
                $W_DELIV_ARR[$n] = trim($val);
            }

            $GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'] = array();
            // так и не понял откуда берется этот массив($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY']) поэтому соберу заново
            $delivery_list = CSaleDelivery::GetList(array("SORT"=>"ASC"), array("ACTIVE"=>"Y"), false, false, array());
            while ($Delivery = $delivery_list->Fetch()) {
                if (intval($Delivery["ORDER_PRICE_TO"]) > 0) {  
                    if (intval($Delivery["ORDER_PRICE_FROM"]) <= $total_price && $total_price <= intval($Delivery["ORDER_PRICE_TO"])){
                        $GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'][$Delivery["ID"]] = $Delivery; 
                    }
                }
                else {

                    if (intval($Delivery["ORDER_PRICE_FROM"]) <= $total_price ){
                        $GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'][$Delivery["ID"]] = $Delivery; 
                    }
                }


            }

            // arshow($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY']);

            foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'] as $DELIVERY_ID => $arDelivery):?>
            <?//echo $DELIVERY_ID.arshow($arDelivery)?>
            <?if($USER->IsAuthorized()||$arDelivery['NAME']=='Самовывоз'):?>

                <?if (in_array($DELIVERY_ID,$W_DELIV_ARR) or $W_DELIV == "") {?>
                    <input type="radio" name="DELID" value="<?=$DELIVERY_ID?>" <?if(($user_data_delivery_id==$DELIVERY_ID)||(!$USER->IsAuthorized()&&$arDelivery['NAME']=='Самовывоз')) echo 'checked'?> id="deliv_<?=$DELIVERY_ID?>"> 
                    <label style="<?if($dis):?>color:gray<?endif;?>" for="deliv_<?=$DELIVERY_ID?>">
                        <?=$arDelivery['NAME']?>, 
                        <span class="order_delivery_price"><?=$arDelivery['PRICE']?> руб.</span>
                    </label><br>
                    <?if ($arDelivery["DESCRIPTION"]){?> 
                        <span class="delivery_description_<?=$DELIVERY_ID?> delivery_description" <?if($user_data_delivery_id==$DELIVERY_ID){?>style='display:block'<?}?> >(<i><?=$arDelivery["DESCRIPTION"]?>)</i></span>
                        <?}?>
                    <?}?>
                <?endif;?>


            <?endforeach;?>

    </td>
    <td></td>
    </tr>
    <tr>
    <td>
        <div class="names">Оплата</div><br/>
        <input type="hidden" name="DATA[PAY_SYSTEM_ID]" id="DATEPSID" />
        <input type="hidden">
        <?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'] as $PAY_SYSTEM_ID => $arPayment):?>
            <?//arshow($arPayment)?>
            <?//if ($arPayment['ACTION'][$arResult['DATA']['UF_USER_TYPE']]):?>
            <?if($USER->IsAuthorized() || $arPayment['NAME']=='Наличные'):?>
                <input type="radio" class="checkbox" name="PAYS_ID" value="<?=$PAY_SYSTEM_ID?>" id="psi_<?=$PAY_SYSTEM_ID?>" <?if (($user_data_payment_id==$PAY_SYSTEM_ID)||(!$USER->IsAuthorized()&&$arPayment['NAME']=='Наличные')) echo 'checked'?> > <label for="psi_<?=$PAY_SYSTEM_ID?>"><?=$arPayment['NAME']?></label> <br>
                <?endif;?>
            <?//endif?>
            <?endforeach;?>
    </td>
    <td></td>
</tr>

<?if ($USER->IsAuthorized()){?>
    <tr>
        <td>
            <div class="names">Данные для доставки</div>
            <div class="curs">При доставке укажите город и адрес</div>
            <br>
            <?/*
                <span class="color">Страна</span><br/>
                <?=SelectBoxFromArray("DATA[PERSONAL_COUNTRY]", GetCountryArray(), $arResult['DATA']['PERSONAL_COUNTRY'], '', 'class="textbox"')?>
                <br/><br/>
                Область<br/>
                <input type="text" class="inptext" name="DATA[PERSONAL_STATE]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_STATE'])?>">
                <br/>
            */?>
            <span class="color">Город</span><br/>
            <input type="text" class="inptext" name="DATA[PERSONAL_CITY]" value="<?=$user_data_city?>"/>
            <br/>
            <span class="color">Адрес</span><br/>
            <?/*  <input type="text" class="inptext" name="DATA[PERSONAL_STREET]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_STREET'])?>"/>  */?>

            <textarea cols="20" rows="5" name="DATA[PERSONAL_STREET]"><?=$user_data_adress?></textarea>
            <?/*
                <br/>
                Индекс<br/>
                <input type="text" class="inptextsmall" name="DATA[PERSONAL_ZIP]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_ZIP'])?>"/>
                <br/>
            */?>
        </td>
        <td></td>
    </tr>
    <?}
    else
    {?>
    <tr>
        <td>
        <div class="names">Укажите данные для связи с Вами.</div>
        <span class="color">Ответственное лицо:</span><br/>
        <input type="text" class="inptext" name="DATA[FIRSTNAME4]" value="<?=htmlspecialchars($arResult['DATA']['FIRSTNAME4'])?>"/>
        <br/><br/>
        <span class="color">E-mail:</span><br/>
        <input type="text" class="inptext" name="DATA[EMAIL4]" value="<?=htmlspecialchars($arResult['DATA']['EMAIL4'])?>"/>
        <br/><br/>
        <span class="color">Телефон:</span><br/>
        <input type="text" class="inptext" name="DATA[PHONE4]" value="<?=htmlspecialchars($arResult['DATA']['PHONE4'])?>"/>
        <br/>
    </tr>



    <?}?>
	</table>

