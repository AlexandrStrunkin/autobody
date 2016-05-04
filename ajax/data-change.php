<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?

    $el = new CIBlockElement;

    //arshow($_POST);

    $PROP = array();
    $PROP["PHONE"] = $_POST["PHONE"];
    $PROP["EMAIL"] = $_POST["EMAIL"];
    $PROP["FIO"] = $_POST["FIO"];

    $arChangeArray = Array(         
        "IBLOCK_TYPE"      => 'info',
        "IBLOCK_ID"      => 102,
        "PROPERTY_VALUES"=> $PROP,
        "NAME"           => "Заявка на изменение данных",
    );

    if($PRODUCT_ID = $el->Add($arChangeArray))
        echo "New ID: ".$PRODUCT_ID;
    else
        echo "Error: ".$el->LAST_ERROR;
        
        

    if (CEvent::Send("DATA_CHANGE", array(SITE_ID), $_POST)){
        echo"ok";
    }else{
        echo"error";
    }

