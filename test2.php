<?     require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    
 /*   $APPLICATION->IncludeComponent("bitrix:subscribe.news", "subscribe_news", Array(
	"SITE_ID" => "s1",	// Сайт
		"IBLOCK_TYPE" => "LENTA",	// Тип информационного блока
		"ID" => $IBLOCK,	// Код информационного блока
		"SECTION_ID" => $arRubric,
		"SORT_BY" => "ACTIVE_FROM",	// Поле для сортировки новостей
		"SORT_ORDER" => "DESC",	// Направление сортировки новостей
	),
	false
); */

$arSelect = Array();
$arFilter = Array();
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext())
{
 //arshow($ob);
}
?>
    <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
