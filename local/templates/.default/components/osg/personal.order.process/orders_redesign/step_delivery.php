<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    if ( (checkSite()=="retail") && ($USER->IsAuthorized()) ){
        $rsUser = CUser::GetByID($USER->GetID());
        $arUser = $rsUser->Fetch();
        //arshow($arUser);
    ?>

    <div class="title">ЛИЧНЫЕ ДАННЫЕ</div>

    <table class="delivery">    
        <tr>
            <td>
                <div>ФИО <font class="red-text">*</font></div>

            </td>
            <td>
                <input type="text" class="inptext" name="DATA[PERSONAL_FIO]"  
                    value="<?=$arUser["NAME"]?>"
                    placeholder="Введите ФИО" required/> 
            </td>
        </tr>

        <tr>
            <td>
                <div>Телефон <font class="red-text">*</font></div>

            </td>
            <td>
                <input type="text" placeholder="Введите телефон" name="DATA[PERSONAL_PHONE]"
                    value="<?=$arUser["PERSONAL_PHONE"]?>"
                    required> </input> 
            </td>
        </tr>

        <tr>
            <td>
                <div>Email <font class="red-text">*</font></div>

            </td>
            <td>
                <input type="email" placeholder="Введите email" name="DATA[PERSONAL_EMAIL]" 
                    value="<?=$arUser["EMAIL"]?>"
                    required> </input> 
            </td>
        </tr>
    </table>
    <?}?>

<div class="title">ДОСТАВКА</div>

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



    if ($USER->IsAuthorized())
    {
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
    }
    else
    {
        $user_data_delivery_id = null;
        $user_data_payment_id = null;
        $user_data_city = null;
        $user_data_adress = null;
    } 
    
    // проверка на сущетвование данных из формы
    if ($_POST['DATA']['PERSONAL_CITY']) {
        $user_data_city = $_POST['DATA']['PERSONAL_CITY'];
    }
    
    if ($_POST['DATA']['PERSONAL_STREET']) {
       $user_data_adress = $_POST['DATA']['PERSONAL_STREET'];  
    }

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
<script>
    $(function(){
        //показ описания служб доставки
        /* $(".radio").click(function(){ 
        $(".delivery_description").css("display","none");                   
        var id = ($(this).attr("for")).slice(6);
        $(".delivery_description_" + id).css("display","block");  
        });    */

        //значения по умолнанию дя скрытых полей
        $(".del_desc").html($("#DELID option:checked").attr("rel"));
        $("#DATADEL").val($("#DELID").val());
        $("#DATEPSID").val($("#PAYS_ID").val());

        //смена способа доставки
        $("#DELID").change(function(){
            $(".del_desc").html($("#DELID option:checked").attr("rel"));
            $("#DATADEL").val($(this).val());
        })
        //смена способа оплаты
        $("#PAYS_ID").change(function(){
            $("#DATEPSID").val($(this).val());  
        })

        //$('#main_form').validatr();
        /*$('#main_form').validetta({
        onValid : function( event ) {
        event.preventDefault(); // Will prevent the submission of the form
        //alert( 'Nice, Form is valid.' );
        submit_order_form('NEXT');
        },
        onError : function( event ){
        //alert( 'Stop bro !! There are some errors.');
        }
        });*/
        /*$('#main_form').validate({
        submitHandler: function(form) {
        // some other code
        // maybe disabling submit button
        // then:
        submit_order_form('NEXT');
        }
        });*/ 

    })
</script>

<style type="text/css">
    form label.error {
        display: block;
        background-color: red;
        color: white;
    }    

</style>


<?
    // arshow($arResult["DATA"]);
    $myprice = $_SESSION['OSG']['USER']['BASKET']['TOTAL_PRICE']; /*print_r($_SESSION['OSG']['USER']['BASKET']);*/



    //если с retail то оставляем только нужные склады
    if (checkSite()=="retail") {
        $W_DELIV="489";
        if ($_SESSION["GKWH"] == 1) {
            $W_DELIV.=",688";        
        }    
    }
    else {
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
?>



<table class="delivery">
    <tr> 
        <td>
            <div> Способ доставки <font class="red-text">*</font>  </div>      
        </td>
        <td>
            <input type="hidden" name="DATA[DELIVERY_ID]" id="DATADEL" value=""/>  
            <select class="" name="DELID" id="DELID">
                <?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'] as $DELIVERY_ID => $arDelivery):?>
                    <?//echo $DELIVERY_ID.arshow($arDelivery)?>
                    <?if($USER->IsAuthorized()||$arDelivery['NAME']=='Самовывоз'):?>
                        <?
                            $selected = "N";
                            if (in_array($DELIVERY_ID,$W_DELIV_ARR) or $W_DELIV == "") {?> 
                            <?
                                if($_POST["DATA"]["DELIVERY_ID"] == $DELIVERY_ID) { $selected = "Y";} 
                                else if($user_data_delivery_id==$DELIVERY_ID && !$_POST["DATA"]["DELIVERY_ID"])   {$selected = "Y"; }
                                    else if (!$USER->IsAuthorized()&&$arDelivery['NAME']=='Самовывоз' && !$_POST["DATA"]["DELIVERY_ID"]){  $selected = "Y";}
                            ?>
                            <option value="<?=$DELIVERY_ID?>" <?if($selected == "Y") echo 'selected="selected"'?> id="deliv_<?=$DELIVERY_ID?>" rel="<?=$arDelivery["DESCRIPTION"]?>"><?=$arDelivery['NAME']?></option>
                            <?}?>  
                        <?endif;?> 
                    <?endforeach;?>

            </select>
        </td>

    </tr>
    <tr>
        <td colspan="2">
            <div class="note">
                <font class="red-text del_desc"></font>
            </div>
        </td>
    </tr>


    <tr>
        <td>
            <div>Город <font class="red-text">*</font></div>

        </td>
        <td>
            <?//arshow($_POST); ?>
            <input type="text" class="inptext" name="DATA[PERSONAL_CITY]" value="<?=htmlspecialcharsbx($user_data_city)?>"  placeholder="Введите город"/> 
        </td>
    </tr>

    <tr>
        <td>
            <div>Адрес <font class="red-text">*</font></div>

        </td>
        <td>
            <input type="text" placeholder="Введите адрес" name="DATA[PERSONAL_STREET]" value="<?=htmlspecialcharsbx($user_data_adress)?>"> </input> 
        </td>
    </tr>

    <?if (!$USER->IsAuthorized())
        {?>
        <tr>
            <td>
                <div>Ответственное лицо: <font class="red-text">*</font></div>

            </td>
            <td>
                <input type="text" class="inptext" name="DATA[FIRSTNAME4]" 
                    value="<?=htmlspecialchars($arResult['DATA']['FIRSTNAME4'])?>" 
                    placeholder="ФИО ответственного лица" required/> 
            </td>
        </tr>

        <tr>
            <td>
                <div>E-mail: <font class="red-text">*</font></div>

            </td>
            <td>
                <input type="email" class="inptext" name="DATA[EMAIL4]" 
                    value="<?=htmlspecialchars($arResult['DATA']['EMAIL4'])?>" 
                    placeholder="Email" required/>

            </td>
        </tr>

        <tr>
            <td>
                <div>Телефон: <font class="red-text">*</font></div>

            </td>
            <td>
                <input type="text" class="inptext" name="DATA[PHONE4]" 
                    value="<?=htmlspecialchars($arResult['DATA']['PHONE4'])?>" 
                    placeholder="Телефон" required/>

            </td>
        </tr>


        <?}?>  

</table>


<div class="title">ОПЛАТА</div>

<table class="payment">
    <tr>
        <td>
            <div> Способ оплаты <font class="red-text">*</font>  </div>   
        </td>
        <td>
            <input type="hidden" name="DATA[PAY_SYSTEM_ID]" id="DATEPSID" value=""/>
            <select name="PAYS_ID" id="PAYS_ID">
                <?
                    $paySystem = CSalePaySystem::GetList($arOrder = Array("SORT"=>"ASC", "PSA_NAME"=>"ASC"), Array());
                    $bFirst = True;
                    while ($ptype = $paySystem->Fetch())
                    {
                    // $GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'][$ptype["ID"]] = $ptype;
                    }
                ?>

                <?if (checkSite()=="retail"):?>
                    <?$arPay=each($GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM']);?>    
                    <option value="<?=$arPay["key"]?>" id="psi_<?=$arPay["key"]?>" <?if (($user_data_payment_id==$arPay["key"])||(!$USER->IsAuthorized()&&$arPay["value"]['NAME']=='Наличные')) echo 'selected="selected"'?>><?=$arPay["value"]['NAME']?></option>
                    <?else:?>
                    <?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'] as $PAY_SYSTEM_ID => $arPayment):?>
                        <?//arshow($arPayment)?>
                        <?//if ($arPayment['ACTION'][$arResult['DATA']['UF_USER_TYPE']]):?>
                        <?if($USER->IsAuthorized() || $arPayment['NAME']=='Наличные'):?>
                            <option value="<?=$PAY_SYSTEM_ID?>" id="psi_<?=$PAY_SYSTEM_ID?>" <?if (($_POST["DATA"]["PAY_SYSTEM_ID"] == $PAY_SYSTEM_ID) || ($user_data_payment_id==$PAY_SYSTEM_ID && !$_POST["DATA"]["PAY_SYSTEM_ID"]) || (!$USER->IsAuthorized()&&$arPayment['NAME']=='Наличные' && !$_POST["DATA"]["PAY_SYSTEM_ID"])) echo 'selected="selected"'?>><?=$arPayment['NAME']?></option>
                        <?endif;?>
                    <?//endif?>
                    <?endforeach;?>
                <?endif;?>
            </select>
        </td>
    </tr>        
</table> 


