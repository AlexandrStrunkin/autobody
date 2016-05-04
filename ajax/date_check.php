<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    if ($_POST["art"])  {

        //получаем дату доставки
        $item_info = "";
        $item_info = GKCommon::GetItemInfo($_POST["art"]);
    ?>
    <?if (strlen($item_info["supply_date"])> 3){
            echo $item_info["supply_date"];
        }
        else {echo "н/д";}
    ?>
    <?}?>