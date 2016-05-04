<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "small_basket_redesign", Array(
                    "PATH_TO_BASKET" => "/personal/basket.php",    // Страница корзины
                    "PATH_TO_ORDER" => "/personal/order.php",    // Страница оформления заказа
                ),
                false
);?>