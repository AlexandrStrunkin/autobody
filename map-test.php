<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("map_test");
?><?$APPLICATION->IncludeComponent("bitrix:map.google.view", "map_contacts", Array(
	"INIT_MAP_TYPE" => "ROADMAP",	// Стартовый тип карты
		"MAP_DATA" => "a:3:{s:10:\"google_lat\";s:7:\"55.7383\";s:10:\"google_lon\";s:7:\"37.5946\";s:12:\"google_scale\";i:13;}",	// Данные, выводимые на карте
		"MAP_WIDTH" => "600",	// Ширина карты
		"MAP_HEIGHT" => "500",	// Высота карты
		"CONTROLS" => array(	// Элементы управления
			0 => "SMALL_ZOOM_CONTROL",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"OPTIONS" => array(	// Настройки
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
			3 => "ENABLE_KEYBOARD",
		),
		"MAP_ID" => "",	// Идентификатор карты
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>