<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>
<?
CModule::IncludeModule('search');

//$arFields[] = "ID";
$arFilter['>COUNT'] = 100;
$rsData = CSearchStatistic::GetList(array($by => $order), $arFilter, false, true);
/*$rsData->NavStart(10);
while($rsData->NavNext(true, "f_")){
    echo "[".$f_ID."] ".$f_NAME."<br>";    
}  */


?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>