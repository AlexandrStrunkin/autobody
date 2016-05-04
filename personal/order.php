<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
header("location: /personal/order/");
$APPLICATION->SetTitle("Оформление заказа");?>
<meta name="robots" content="noindex">
<?$APPLICATION->IncludeComponent("osg:personal.order.process", "orders_redesign", Array(
    "URL_BASKET"    =>    "/personal/basket.php",
    "URL_ORDER_HISTORY"    =>    "/personal/cabinet.php"
    )
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>