<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
header("location: /personal/cabinet/");
    $APPLICATION->SetTitle("Р—Р°РєР°Р·С‹");?> 
<?if ($_GET['message']=='individual') {?>
       <meta name="robots" content="noindex">
<?}?>



<?$APPLICATION->IncludeComponent(
    "osg:catalog.fast", 
    "catalog_fast_new_redesign", 
    array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "SET_TITLE" => "Y",
        "ON_PAGE" => "5",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);?>


    <br>
    <h1>РЎРїРёСЃРѕРє Р·Р°РєР°Р·РѕРІ </h1>

    <?$APPLICATION->IncludeComponent("osg:personal.order.history", "new_order_list", Array(
            "ON_PAGE" => "15",    // Р РµР·СѓР»СЊС‚Р°С‚РѕРІ РЅР° СЃС‚СЂР°РЅРёС†Рµ
        ),
        false
    );?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>