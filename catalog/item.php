<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
 <?$APPLICATION->IncludeComponent("osg:catalog.item", "detail_item_new", array(
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "86400",
	"SET_TITLE" => "Y",
	"URL_NO_DETAIL_PICTURE" => "images/no_detail_picture.gif",
	"URL_NO_PREVIEW_PICTURE" => "images/no_preview_picture.gif",
	"NO_LIMIT" => "N"
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>