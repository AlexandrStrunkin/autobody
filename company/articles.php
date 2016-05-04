<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статьи");?>

<?$APPLICATION->IncludeComponent("osg:news", ".default", Array(
	"AJAX_MODE"	=>	"N",
	"AJAX_OPTION_SHADOW"	=>	"N",
	"AJAX_OPTION_JUMP"	=>	"N",
	"AJAX_OPTION_STYLE"	=>	"N",
	"AJAX_OPTION_HISTORY"	=>	"N",
	"IBLOCK_CODE"	=>	"ARTICLES",
	"ON_PAGE"	=>	"15",
	"URL_NO_PREVIEW_PICTURE"	=>	"images/no_preview_picture.gif",
	"URL_NO_DETAIL_PICTURE"	=>	"images/no_detail_picture.gif",
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>