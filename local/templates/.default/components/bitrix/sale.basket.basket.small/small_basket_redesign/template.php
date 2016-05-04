<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($arResult)?>
<?
    $total_price = 0;
    $total_quantity = 0;
    $delay_quantity = 0;
?>
<?if ($arResult["READY"]=="Y" || $arResult["DELAY"]=="Y" || $arResult["NOTAVAIL"]=="Y" || $arResult["SUBSCRIBE"]=="Y"):?>

    <?
        foreach ($arResult["ITEMS"] as $v)
        {
            if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
            {
                //  arshow($v);
                //если пользоваткль не авторизован и сайт оптовый, то все равно показываем оптовые цены
                if (!$USER->IsAuthorized() && checkSite() != "retail"){
                    $productPrice = CPrice::GetList( array(),array("PRODUCT_ID" => $v["PRODUCT_ID"], "CATALOG_GROUP_ID"=>1), false, false, array())->Fetch();
                    $v["PRICE"] = $productPrice["PRICE"];
                }


                $total_price += $v["PRICE"]*$v["QUANTITY"];
                $total_quantity++;
            }
        }
    ?>

    <?if ($arResult["DELAY"]=="Y"):?>

        <?
            foreach ($arResult["ITEMS"] as $v)
            {
                if ($v["DELAY"]=="Y" && $v["CAN_BUY"]=="Y")
                {
                    $delay_quantity++;
                }
            }
        ?>

        <?endif;?>
    <?endif;?>
<a class="header-url" href="/personal/basket/" title="Корзина">
    <?if ($total_quantity > 0) {?>
        <div class="items_count" title="товаров в корзине: <?=$total_quantity?>"><?=$total_quantity?></div>
        <?}?>
    <img class="lk-logo" src="/images/basket-header.png" alt=""/> 
    <div class="lk-header" style="display: inline;">
        <?if ($total_price > 0) {?>
            <?=ceil(CCurrencyRates::ConvertCurrency($total_price, "USD", "RUR"));?> Р
            <?} else {?>
            Корзина пуста
            <?}?>

    </div>
</a>
<?/*
    <a href="/personal/basket.php?clear_cache=Y" id="korz1">В корзине <?=$total_quantity?> товаров</a>
    <span id="korz2">На сумму <?=CCurrencyRates::ConvertCurrency($total_price, "USD", "RUR");?> руб.</span>
    <a href="/catalog/notebook.php" id="korz3">В блокноте <?=$delay_quantity?> товаров</a>
*/?>
