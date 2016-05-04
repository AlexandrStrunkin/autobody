<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");?>
<meta name="robots" content="noindex">
<?$APPLICATION->IncludeComponent("osg:personal.order.process", "orders_redesign", Array(
    "URL_BASKET"    =>    "/personal/basket/",
    "URL_ORDER_HISTORY"    =>    "/personal/cabinet/"
    )
);?>        
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>