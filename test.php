<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница (1)");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"search_title", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_OSG_WEB_SHOP",
		),
		"CATEGORY_0_TITLE" => "Результат",
		"CATEGORY_0_iblock_OSG_WEB_SHOP" => array(
			0 => "88",
		),
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "search_title",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "/search_result.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "N"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>