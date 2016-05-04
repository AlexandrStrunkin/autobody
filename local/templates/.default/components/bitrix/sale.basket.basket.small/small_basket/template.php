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
<a href="/personal/basket.php?clear_cache=Y" id="korz1">В корзине <?=$total_quantity?> товаров</a>
<span id="korz2">На сумму <?=CCurrencyRates::ConvertCurrency($total_price, "USD", "RUR");?> руб.</span>
<a href="/catalog/notebook.php" id="korz3">В блокноте <?=$delay_quantity?> товаров</a>
