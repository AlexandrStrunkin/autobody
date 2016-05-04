<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Проверка комментариев");
?>

<?
    if (intval($_GET["ID"]) > 0) {            
    //    mysql_query("UPDATE `b_iblock_element` SET `active`='Y' where `iblock_id`=96 and `id`=".intval($_GET["ID"]));
        echo "Комментарий размещен<br>";   
        
         //получаем инфо о добавленном элементе инфоблока
            $el = CIBlockElement::GetList(array(),array("ID"=>intval($_GET["ID"]), "IBLOCK_ID"=>97),false, false, array("NAME","PROPERTY_TEXT","PROPERTY_PRODUCT", "PROPERTY_TEXT"));
            $arElement = $el->GetNext();  
            //получаем инфо о товаре к которому добавлен коммент
            $product = CIBlockElement::GetById($arElement["PROPERTY_PRODUCT_VALUE"]);
            $arProduct = $product->GetNext();  
            
            echo "<a href='/catalog/".$arProduct["IBLOCK_SECTION_ID"]."/".$arProduct["ID"]."/'>перейти к товару</a>";        
    }
    else {
        header ("location: /");
    }

   


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>