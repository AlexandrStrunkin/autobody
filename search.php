<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск по сайту");?>

<?$APPLICATION->IncludeComponent("osg:search", "", Array(
	"ON_PAGE"	=>	"10",
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>