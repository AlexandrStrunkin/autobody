<?
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?
    if ($USER->IsAdmin()) {
     /*
       $list = array('NAME;CODE;');
        $sections = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>88),array("ID","NAME","IBLOCK_SECTION_ID","PROPERTY_UNC","CODE"));
        while ($arSection = $sections->Fetch()) {
            $list[] = $arSection["NAME"].";".$arSection["CODE"];
        }



        $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/test/catalog.csv', 'w');

        foreach ($list as $line) {
            fputcsv($fp, explode(';', $line),";");
        }

        fclose($fp);
      */  
       
    }           
?>