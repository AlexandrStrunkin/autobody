<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>

<?  
    //echo date("d F Y \г.");
    // выведем дату в виде "23 февраля, 2012"

    $date = date("d.m.Y"); // формат даты сайта
    
    // FORMAT_DATETIME - константа с форматом времени сайта
    $arDate = ParseDateTime($date, FORMAT_DATETIME);
    
    echo $arDate["DD"]." ".ToLower(GetMessage("MONTH_".intval($arDate["MM"])."_S"))." ".$arDate["YYYY"];
?>