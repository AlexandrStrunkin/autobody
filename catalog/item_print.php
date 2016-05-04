<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?><?$APPLICATION->IncludeComponent(
    "osg:catalog.item",
    "print",
    Array(
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "0",
        "URL_NO_DETAIL_PICTURE" => "images/no_detail_picture.gif",
        "URL_NO_PREVIEW_PICTURE" => "images/no_preview_picture.gif"
    )
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>