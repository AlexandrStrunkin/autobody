<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Блокнот");
?>
<meta name="robots" content="noindex">
<h1>Блокнот</h1>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "notebook", array(
    "COLUMNS_LIST" => array(
        0 => "NAME",
        1 => "PRICE",
        2 => "QUANTITY",
    ),
    "PATH_TO_ORDER" => "/personal/order.php",
    "HIDE_COUPON" => "Y",
    "QUANTITY_FLOAT" => "N",
    "PRICE_VAT_SHOW_VALUE" => "N",
    "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
    "USE_PREPAYMENT" => "N",
    "SET_TITLE" => "N"
    ),
    false
);?>   
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>