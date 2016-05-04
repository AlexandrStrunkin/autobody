<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка на рассылку");
?>
<?$APPLICATION->IncludeComponent("bitrix:subscribe.simple", "subscr", Array(
	"AJAX_MODE" => "N",	// Включить режим AJAX
		"SHOW_HIDDEN" => "Y",	// Показать скрытые рубрики подписки
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>