<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    if ($_POST["id"] and $_POST["quantity"] and $_POST["price"]){

        $arElement = CIBlockElement::GetById($_POST["id"]);
        $arElementProps = $arElement->Fetch();

    //    arshow($_POST); die();

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
        //arshow($arFields);
        $res = CSaleBasket::Add($arFields);   
     
    }

    //чистим кэш
    BXClearCache(true, "/catalog/");

    if ($res) {echo $res;}

?>