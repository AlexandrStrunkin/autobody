<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
      
    if (!$_REQUEST) {
       // header("location: /personal/cabinet/?show_all=Y");  
    }

    $APPLICATION->SetTitle("Заказы");?>
<?if ($_GET['message']=='individual') {?>
       <meta name="robots" content="noindex">
<?}?>



<?/*$APPLICATION->IncludeComponent(
    "osg:catalog.fast", 
    "catalog_fast_new_redesign", 
    array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "SET_TITLE" => "Y",
        "ON_PAGE" => "5",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);*/?>
<div class="order">

<?if ( ( $_GET["message"] == "new_order" || $_GET["message"] == "new_user") && $_GET["ORDER_ID"] > 0 ) {
           
            if ( $USER->IsAuthorized() )
            {
                if ( checkSite()=="retail" ) {
                    $arFilter=Array("ID"=>$_GET["ORDER_ID"],"PROPERTY_VAL_BY_CODE_USER_ID"=>$USER->GetId());
                }
                else if ( checkSite()=="opt" ){
                    $arFilter=Array("ID"=>$_GET["ORDER_ID"],"USER_ID"=>$USER->GetId());    
                }    
            } 
            else
            {
                $arFilter=Array("ID"=>$_GET["ORDER_ID"]);
            }      
        
            //проверяем принадлежность заказа пользователю
            $order = CSaleOrder::GetList(Array(), $arFilter, false, false, array());
            $arOrder = $order->Fetch();
            if ($arOrder) {
                //собираем корзину заказа
                $arBasketItems = array();
                $arBasketItemsQuantity = array();
                $dbBasketItems = CSaleBasket::GetList(
                    array(
                        "NAME" => "ASC",
                        "ID" => "ASC"
                    ),
                    array(
                        "LID" => SITE_ID,
                        "ORDER_ID" => $_GET["ORDER_ID"]
                    ),
                    false,
                    false,
                    array("ID",  
                        "PRODUCT_ID", "QUANTITY", "PRICE","NAME")
                );
                while ($arItems = $dbBasketItems->Fetch())
                {  
                    $arBasketItems[] = $arItems["PRODUCT_ID"];
                    $arBasketItemsQuantity[$arItems["PRODUCT_ID"]] = $arItems["QUANTITY"];
                }

                // Печатаем массив, содержащий актуальную на текущий момент корзину
                //собираем инфо о товарах в заказе

                $items = CIBLockElement::GetList(array("NAME"=>"ASC"), array("=ID"=>$arBasketItems), false, false, array("ID","NAME","PROPERTY_UNC","CODE","PROPERTY_SIZE","IBLOCK_SECTION_ID","PROPERTY_WARRANTY","PROPERTY_FIRM", "DATE_CREATE"));
            ?>
            <div class="title">Спасибо за заказ!</div>
            <div class="under-title-note">Ваш заказ <font class="red-text">№<?=htmlspecialcharsbx($_GET["ORDER_ID"])?></font> успешно оформлен и будет обработан в ближайшее время, счет и дальнейшие <br> инструкции придут Вам на почту.</div>
            <div class="title">Состав заказа</div>

            <?//собираем корзину заказа ?>


            <table class="order-basket-table">
                <tr>
                    <th>Фото</th>
                    <th>Наименование (артикул, OEM, год)</th>
                    <th>Цена, <font class="rouble">i</font></th>
                    <th>Кол-во, шт</th>
                    <th>Сумма, <font class="rouble">i</font></th>
                </tr>
                <?  
                while ($arElement = $items->Fetch()){
                        //получаем цену товара с указанным ид с учетом текущего поддомена
                        $curPrice=ceil(getPriceForId($arElement["ID"]));  //описание в init.php
                        
                        //echo $curPrice;
                        
                        $arElement["DETAIL_PAGE_URL"] = "/catalog/".$arElement["IBLOCK_SECTION_ID"]."/".$arElement["ID"]."/";
                        /*$arElement["PRICES"]["PRICE_1"] = CPrice::GetBasePrice($arElement["ID"]);  
                        $arElement["PRICES"]["PRICE_1"]["PRICE"] = CCurrencyRates::ConvertCurrency($arElement["PRICES"]["PRICE_1"]["PRICE"], "USD", "RUR");
                        $arElement["PRICES"]["PRICE_1"]["CURRENCY"] = "RUR";*/
                    ?>
                    <tr>
                        <td>
                            <?
                                if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".jpg")) {$img_path = "/upload/images/".$arElement['CODE'].".jpg";}
                                else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".JPG")) {$img_path = "/upload/images/".$arElement['CODE'].".JPG";}
                                    else {$img_path = "";}
                            ?>
                            <?if ($img_path != ""){?>
                                <a href="<?=$img_path?>" class="fancybox" title="<?=$arElement["NAME"]?>">
                                    <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                                    </div>
                                </a>
                                <?} else {?>
                                <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                                <?}?>    

                        </td>
                        <td>
                            <a class="url-basket" href="<?=$arElement["DETAIL_PAGE_URL"]?>"> <?=$arElement["NAME"]?><br></a>
                            <span class="oem-basket">
                                (<?=$arElement['CODE']?><?if ($arElement['PROPERTY_UNC_VALUE']){?>, <?=trim($arElement['PROPERTY_UNC_VALUE'])?><?}?><?if ($arElement['PROPERTY_SIZE_VALUE']){?>, <?=$arElement['PROPERTY_SIZE_VALUE']?><?}?>)
                            </span>
                        </td>
                        <td><span><?=$curPrice?></span></td>
                        <td><?=$arBasketItemsQuantity[$arElement["ID"]]?></td>
                        <td><?=$curPrice*$arBasketItemsQuantity[$arElement["ID"]]?></td>
                    </tr>
                    <?}?>

            </table>

            <div class="under-basket-table"> 
                <div class="result-basket">Сумма заказа: <?=ceil($arOrder["PRICE"])?> <font class="rouble" style="text-transform: none;">i</font></div>        
                <button class="button" type="button" onclick="document.location.href='/'">Продолжить покупки</button>
            </div> 
            <?
            } else {?>
            <div class="title">Заказ №<?=htmlspecialcharsbx($_GET["ORDER_ID"])?> не найден!</div>    
            <?}
        } 
    ?>

</div>

<?
if ($USER->IsAuthorized()) {

    $APPLICATION->IncludeComponent(
    "bitrix:sale.personal.order", 
    "orders_list", 
    array(
        "PROP_21" => array(
        ),
        "PROP_22" => array(
        ),
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/personal/cabinet/",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "N",
        "ORDERS_PER_PAGE" => "20",
        "PATH_TO_PAYMENT" => "/personal/payment.php",
        "PATH_TO_BASKET" => "/personal/bakset/",
        "SET_TITLE" => "Y",
        "SAVE_IN_SESSION" => "Y",
        "NAV_TEMPLATE" => "",
        "CUSTOM_SELECT_PROPS" => array(
        ),
        "HISTORIC_STATUSES" => array(
            0 => "N",
            1 => "T",
            2 => "S",
            3 => "F",
        ),
        "STATUS_COLOR_N" => "green",
        "STATUS_COLOR_T" => "gray",
        "STATUS_COLOR_S" => "gray",
        "STATUS_COLOR_F" => "gray",
        "STATUS_COLOR_PSEUDO_CANCELLED" => "red",
        "SEF_URL_TEMPLATES" => array(
            "list" => "",
            "detail" => "#ID#/",
            "cancel" => "",
        )
    ),
    false
);
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>