<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "➨Условия покупки запчастей, а также сотрудничества с компанией Форвард");
    $APPLICATION->SetTitle("Оплата и гарантии");?> 

 <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu_redesign_second", 
	array(
		"ROOT_MENU_TYPE" => "top_sec_lvl",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		)
	),
	false
);?>
 
<?if (checkSite()=="retail") 
{
    $APPLICATION->IncludeFile("/include/payment.php");    
}
else
{
    $APPLICATION->IncludeFile("/include/payment.php");    
}


?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>