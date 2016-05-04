<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спецпредложения");
$addFilter = array('>PROPERTY_SPEC_OFFER' => 0);
?><?$APPLICATION->IncludeComponent("osg:catalog.specoffers.block", ".default", array(
    "SPEC_OFFER_ID" => "0",
    "COLS" => "4",
    "ROWS" => "9999",
    "URL_NO_PREVIEW_PICTURE" => "images/no_preview_picture.gif",
    "WAITING_FOR" => "Y"
    ),
    false
);?>  <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>