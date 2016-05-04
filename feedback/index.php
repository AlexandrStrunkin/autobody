<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Обратная связь");?> <meta name="robots" content="noindex"></meta> <?$APPLICATION->IncludeComponent(
    "osg:feedback",
    "feedback-redesign",
    Array(
    )
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>