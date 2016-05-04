<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Проверка картинок");
?>

<?
    if (intval($_GET["ID"]) > 0) {

        $el_id = intval($_GET["ID"]);
        $el = CIBlockElement::GetById($el_id);     
        $arElement = $el->Fetch();
        //получаем свойтво "файл" для данного элемента
        $file = CIBlockElement::GetProperty(96,$arElement["ID"], Array(), Array("CODE"=>"FILE"));
        $arFile = $file->GetNext();  

        $file_path = $_SERVER["DOCUMENT_ROOT"];
        $file_path .= CFile::GetPath($arFile["VALUE"]); //путь к картинке, которую перемещаем в каталог
        $new_path = $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement["NAME"].".jpg"; 

        //получаем свойто "товар" для данного элемента     
        $product = CIBlockElement::GetList(array(), array("CODE"=>$arElement["NAME"], "IBLOCK_ID"=>88), false, false, array());
        $arProduct = $product->GetNext(); 
      

        //echo "старый путь: ".$file_path."<br>новый путь: ".$new_path."<br>";


        $res = copy($file_path, $new_path);
        if($res){
            echo "изображение для товара ".$arElement["NAME"]." размещено в каталоге<br>";
            echo "<a href='/catalog/".$arProduct["IBLOCK_SECTION_ID"]."/".$arProduct["ID"]."/'>перейти к торару</a>";
        }
        else {
            echo "изображение не перемещено!";       
        }

    } else {
        header("location: /");
    }


    //  arshow(error_get_last()); 





?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>