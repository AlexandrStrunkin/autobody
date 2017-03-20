<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    if ($_POST["id"] and $_POST["quantity"] and $_POST["price"]){

        $arElement = CIBlockElement::GetById($_POST["id"]);
        $arElementProps = $arElement->Fetch(); 
        
        //Соберем информацию о корзине пользователя, подсчитаем количество элементов
        $arBasketItems = array();
        $dbBasketItems = CSaleBasket::GetList(array(),array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => 's1', "ORDER_ID" => "NULL"), false, false, array()); 
        $totalBasketItems = 0; 
        while ($arItems = $dbBasketItems->Fetch())
        {                       
            $totalBasketItems = ++$totalBasketItems; 
        }
        //Если количество больше максимального значения, передадим сообщение об этом
        if ($totalBasketItems >= MAX_BASKET_ITEMS) {
            $res = 'MoreThanAllowed';
        } else {          
            $arFields = array(
                "PRODUCT_ID" => $_POST["id"],
                "PRICE" => $_POST["price"],
                "CURRENCY" => "RUR",
                "QUANTITY" => $_POST["quantity"],
                "LID" => LANG,
                "DELAY" => "N",
                "CAN_BUY" => "Y",
                "NAME" => $arElementProps["NAME"],
                "PRODUCT_PROVIDER_CLASS"=>"CCatalogProductProvider",
                "MODULE"=>"catalog"
               //"PRODUCT_XML_ID"=>$arElementProps["XML_ID"]
            );                             
            $res = CSaleBasket::Add($arFields);
        } 
    }

    //чистим кэш
    BXClearCache(true, "/catalog/");

    if ($res) {echo $res;}

?>