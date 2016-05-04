<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/new_products/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/new_products/index.php",
	),
	array(
		"CONDITION" => "#^/company/contacts/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/contacts/index.php",
	),
	array(
		"CONDITION" => "#^/personal/cabinet/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/cabinet/index.php",
	),
	array(
		"CONDITION" => "#^/personal/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/personal/news/index.php",
	),
	array(
		"CONDITION" => "#^/news/([0-9]+)/#",
		"RULE" => "ELEMENT_ID=\$1",
		"ID" => "",
		"PATH" => "/news/news-detail.php",
	),
	array(
		"CONDITION" => "#^/contacts/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/contacts/index.php",
	),
	array(
		"CONDITION" => "#^/personal/#",
		"RULE" => "",
		"ID" => "bitrix:form",
		"PATH" => "/personal/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>