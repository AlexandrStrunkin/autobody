<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Корзина");?>
<?//CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());?>
<?if ($_GET['clear_cache']=='Y') {?>
    <meta name="robots" content="noindex">
    <?}?>

  

<?
if (checkSite()=="opt") 
{
    $APPLICATION->IncludeComponent("osg:catalog.fast", "catalog_fast_new_redesign", array(
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "SET_TITLE" => "Y",
            "ON_PAGE" => "5",
            "AJAX_OPTION_ADDITIONAL" => ""
            ),
            false
    );
}
    ?>

<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "user_basket_redesign", array(
        "COLUMNS_LIST" => array(
            0 => "NAME",
            1 => "QUANTITY",
            2 => "PRICE",
        ),
        "PATH_TO_ORDER" => "/personal/order/",
        "HIDE_COUPON" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
        "USE_PREPAYMENT" => "N",
        "SET_TITLE" => "Y"
        ),
        false
    );?>


<?$APPLICATION->IncludeComponent("osg:sale.bestsellers", "bestsellers_new_redesign", array(
    "AJAX_MODE" => "Y",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "86400",
    "BY" => array(
        0 => "AMOUNT",
    ),
    "COLS" => "4",
    "ROWS" => "2",
    "URL_NO_PREVIEW_PICTURE" => "images/no_preview_picture.gif",
    "PERIOD" => array(
        0 => "",
        1 => "",
    ),
    "FILTER_NAME" => "",
    "ORDER_FILTER_NAME" => "",
    "ITEM_COUNT" => "",
    "DETAIL_URL" => "",
    "AJAX_OPTION_ADDITIONAL" => "",
    "PRICE_CODE" => array(
            0=>$_GLOBALS["SITE_VARIABLES"]["PRICE_CODE"],
    )
    ),
    false
    );?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>