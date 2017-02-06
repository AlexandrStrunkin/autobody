<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка на рассылку");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:subscribe.edit", 
    "autobody.subscribe.edit", 
    array(
        "AJAX_MODE" => "N",
        "SHOW_HIDDEN" => "Y",
        "ALLOW_ANONYMOUS" => "Y",
        "SHOW_AUTH_LINKS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "SET_TITLE" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "COMPONENT_TEMPLATE" => "autobody.subscribe.edit",
        "AJAX_OPTION_ADDITIONAL" => "undefined",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>