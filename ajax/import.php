<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?

    $import_step = 500 ;//шаг импорта

    $first_element = intval($_POST["first_elem"]) + 1;
    if ($first_element)
    {
        $first_element = $first_element - 1;
        $import_elements = mysql_query("SELECT * FROM _items ORDER BY id LIMIT ".$first_element.", ".$import_step);


        while ($elem_props = mysql_fetch_assoc($import_elements))
        {
            //nen выполняем необходимые действия с элементами
            $arElement = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>88,"CODE"=>$elem_props["vendor"]),false,false,array("ID","CODE"));
            $element = $arElement->Fetch();


            $arFields = Array(
                "PRODUCT_ID" => $element["ID"],
                "STORE_ID" => $elem_props["id_warehouse"],
                "AMOUNT" => $elem_props["count"],
            );

            ///////////////////////////////////////////
            //запись лога в файл


            $ID = CCatalogStoreProduct::Add($arFields);

            /*
            $somecontent = $arFields["PRODUCT_ID"]." - ".$arFields["STORE_ID"]." - ".$arFields["AMOUNT"]." - ".$ID."; n товар импортирован в битрикс ".date("H:i:s")."\n";
            $filename = "log.txt";
            if (is_writable($filename)) {
                $handle = fopen($filename, 'a');
                fwrite($handle, $somecontent);
                fclose($handle);
            }
            */
        }


        $active_elements_count = mysql_num_rows(mysql_query("SELECT * FROM _items"));
        if ($first_element >= $active_elements_count)
        {
            echo "0";
        }
        else
        {
            echo $first_element + $import_step;
        }
    }

    else
    {
        echo "-1";
    }

    ///////////////////////////////////////////
    //запись лога в файл
    /*
    $filename = '1.txt';


    $somecontent = $first_element + GK_IMPORT_STEP."\n";

    $handle = fopen($filename, 'a');
    fwrite($handle, $somecontent);
    fclose($handle);
    */

?>