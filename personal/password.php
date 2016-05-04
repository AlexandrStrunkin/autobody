<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Запрос пароля");?>
<meta name="robots" content="noindex">
<?$APPLICATION->IncludeComponent("bitrix:main.feedback", "password", array(
	"USE_CAPTCHA" => "Y",
	"OK_TEXT" => "Спасибо, ваше сообщение принято.",
	"EMAIL_TO" => "forward@autobody.ru",
	"REQUIRED_FIELDS" => array(
	),
	"EVENT_MESSAGE_ID" => array(
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>