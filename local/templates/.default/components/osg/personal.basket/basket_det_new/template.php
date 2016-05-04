<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($_SESSION['OSG']['USER']['CAN_BUY'] == 'N'):?>
    <div class="message">
        <br/>
        К сожалению, зарегистрированные пользователи интернет-магазина, не входящие в группу покупателей, не могут оформлять заказы на нашем сайте.
    </div>
    <?endif?>
<?

?>

<?
    //arshow($_REQUEST);
   // arshow($_POST);
    //arshow($_SESSION['OSG']);
?>

<div class="names">Таблица со списком заказываемых товаров</div>
<?if ($arResult):?>
    <form action="<?=$APPLICATION->GetCurPage()?>" method="POST" id="main_form">

        <INPUT type="hidden" name="action" value="continue">
        <?foreach ($arResult as $arItem):?>
            <input type="hidden" name="price_id[<?=$arItem['PRODUCT_ID']?>]">
            <input type="hidden" name="q_<?=$arItem['PRODUCT_ID']?>" value="<?=$arItem['QUANTITY']?>" id="q_<?=$arItem['PRODUCT_ID']?>">
            <?endforeach;?>
        <div class="spiszaktov">
            <table class="findtable">
                <tr>
                    <th class="th1"></th>
                    <th class="th2">Наименование</th>
                    <th class="th3">Цена, руб./шт.</th>
                    <th class="th4">Количество, шт.</th>
                    <th class="th5">Сумма, руб.</th>
                </tr>
                <?foreach ($arResult as $arItem):?>
                    <?//arshow($arItem)?>
                    <tr class="tr1">


                        <td class="td1">
                            <?
                                // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                                if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg")) {$img_path = "/upload/images/".$arItem['CODE'].".jpg";}
                                else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".JPG")) {$img_path = "/upload/images/".$arItem['CODE'].".JPG";}
                            else {$img_path = "/i/ico_noimg.gif"; }
                        ?>
                        <a href="<?=$arItem['URL']?>"><img src="/i/find-small.png"/><img src="<?=$img_path?>"  class="showh"/></a>
                        <table>
                            <tr>
                                <td><span>Артикул:</span></td>
                                <td><?=$arItem['CODE']?></td>
                            </tr>
                            <?if ($arItem["PROPS"]["SIZE"]["VALUE"]) {?>
                                <tr>
                                    <td><span>Год:</span></td>
                                    <td><?=$arItem["PROPS"]["SIZE"]["VALUE"];?></td>
                                </tr>
                                <?}?>
                            <?if ($arItem["PROPS"]["UNC"]["VALUE"]) {?>
                                <tr>
                                    <td><span>OEM#:</span></td>
                                    <td><?=$arItem["PROPS"]["UNC"]["VALUE"];?></td>
                                </tr>
                                <?}?>
                        </table>
                    </td>
                    <td class="td2"><a href="<?=$arItem['URL']?>"><?=$arItem['NAME']?></a></td>
                    <td class="td3" id="price_item[<?=$arItem['PRODUCT_ID']?>]"></td>
                    <td class="td4">
                        <span id="catqwm<?=$arItem['PRODUCT_ID']?>" style="display: none;"><?$max_q = GKCommon::GetItemsCountForWarehouse(GKCommon::GetSavedWarehouse(),$arItem['CODE']); echo $max_q["COUNT"];/*=$arItem['MAX_QUANTITY'];*/?></span>
                        <input type="button" value="-" class="minus" onClick="if (Number($('#qw<?=$arItem['PRODUCT_ID']?>').val())>0){$('#qw<?=$arItem['PRODUCT_ID']?>').val(Number($('#qw<?=$arItem['PRODUCT_ID']?>').val())-1); $('#q_<?=$arItem['PRODUCT_ID']?>').val($('#qw<?=$arItem['PRODUCT_ID']?>').val())} set_prices();"/>
                        <input type="text" class="kolvo" id="qw<?=$arItem['PRODUCT_ID']?>" name="quantity[<?=$arItem['PRODUCT_ID']?>]" value="<?=(int) $arItem['QUANTITY']?>" onkeyup="set_prices();" disabled="disabled"/>
                        <input type="button" value="+" class="plus" onClick=" if (Number($('#qw<?=$arItem['PRODUCT_ID']?>').val())<Number($('#catqwm<?=$arItem['PRODUCT_ID']?>').html())) {$('#qw<?=$arItem['PRODUCT_ID']?>').val(Number($('#qw<?=$arItem['PRODUCT_ID']?>').val())+1); $('#q_<?=$arItem['PRODUCT_ID']?>').val($('#qw<?=$arItem['PRODUCT_ID']?>').val())};set_prices()" />
                        <input type="hidden" id="qw<?=$arItem['PRODUCT_ID'];?>" value="<?=GKCommon::GetItemsCountForWarehouse(GKCommon::GetSavedWarehouse(),$arItem['CODE'])?>">

                    </td>
                    <td class="td5"><span id="price_total[<?=$arItem['PRODUCT_ID']?>]"></span><br><br><a href="?action=del_basket_item&id=<?=$arItem['ID']?>" title="удалить товар из корзины"><img src="/i/close.gif"></a></td>
                </tr>
                <?endforeach;?>
        </table>
        <?if ($_SESSION['OSG']['USER']['CAN_BUY'] == 'Y'){?>
            <input type="submit" value="Оформить заказ" class="recalk"/>
            <input type="submit" value="Пересчитать" name="BasketRefresh"/>
            <?}?>
        <div class="result">
            <table>
                <tr>

                    <td>Общая сумма, руб.:</td>
                    <td class="td2" id="basket_summ">
                        <span style="display: none;" id="discount_value"></span>
                        <span style="display: none;" id="basket_quantity"></span>
                    </td>
                </tr>
                <tr>
                    <td>Скидка рассчитывается после обработки заказа:</td>
                    <td class="td2" id="discount_summ"></td>
                </tr>
                <tr>
                    <td>Итого, руб.:</td>
                    <td class="td2" id="final_basket_summ"></td>
                </tr>
            </table>
        </div>
    </div>



    <!-- end basket table -->
    <!--
    <table width="100%" cellpadding="0" cellspacing="0" id="basket_submit">
    <tr class="oformlenie">
    <td><a href="#" onclick="basket_refresh();">Сохранить изменения в корзине</a></td>
    <td class="summa" colspan="2">
    <?if ($_SESSION['OSG']['USER']['CAN_BUY'] == 'Y'):?>
        <div class="message">
        Оформление заказа подтверждает согласие с условиями продажи и возврата.
        </div>
        <input type="submit" value="Оформить заказ"/>

        <?endif?></td>
    </tr>
    </table>-->


</form>

<?if ($_SESSION['OSG']['USER']['CAN_BUY'] == 'Y'):?>

    <?if(!$USER->IsAuthorized()):?>

        <?if($_REQUEST['trans_s']!='Y'):
                $_SESSION['OSG']['USER']['oldbasket'] = $_SESSION['OSG']['USER']['BASKET'];
                endif;?>

        <div>
            <span style="font-size:14px;color:#EF135B;">
                Внимание! Вы не авторизованы на сайте, заказ будет оформлен на Частное лицо. Цены будут заменены на розничные ( оптовые + 50%).</span></br>
            <br><span style="font-size:14px;color:#EF135B;">Для оформления на пользователя, пожалуйста, авторизуйтесь:
            </span></br>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:system.auth.form",
                    "",
                    Array(),
                    false
                );?>
        </div>
        <?else:?>
        <?endif;?>

    <!--pre>
    <?print_r($_SESSION['OSG']['USER'])?>
    </pre-->

    <?endif;?>


<script>
    PRICE_VARIANTS = new Array;
    PRICE_VARIANTS['VALUES'] = new Array;
    PRICE_VARIANTS['MAX_QUANTITY'] = new Array;
    <?foreach ($arResult as $arItem):?>
        PRICE_VARIANTS['MAX_QUANTITY'][<?=$arItem['PRODUCT_ID']?>] = <?=$arItem['MAX_QUANTITY']?>;
        PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>] = new Array;
        <?foreach ($arItem['PRICE_VARIANTS'] as $N=>$arr):?>
            PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>] = new Array;
            PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>]['MIN_QUANTITY'] = <?=$arr['MIN_QUANTITY']?>;
            PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>]['PRICE'] = <?=CCurrencyRates::ConvertCurrency($arr['PRICE'], $arr['CURRENCY'], "RUR");?>;
            PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>]['PRICE_ID'] = <?=$arr['PRICE_ID']?>;

            <?endforeach;?>
        <?endforeach;?>

    DISCOUNTS = new Array;
    <?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['DISCOUNT'] as $ID=>$arDiscount):?>
        DISCOUNTS[<?=$ID?>] = new Array;
        DISCOUNTS[<?=$ID?>]['PRICE_FROM'] = <?=$arDiscount['PRICE_FROM']?>;
        DISCOUNTS[<?=$ID?>]['DISCOUNT_VALUE'] = <?=$arDiscount['DISCOUNT_VALUE']?>;
        <?endforeach;?>


    function set_prices(){
        var BASKET_SUMM = 0;
        var BASKET_QUANTITY = 0;
        var ERROR_QUANTITY = 0;
        <?foreach ($arResult as $arItem):?>
            var PRODUCT_ID = <?=$arItem['PRODUCT_ID']?>;

            var QUANTITY =  Number(document.forms['main_form'].elements['quantity['+PRODUCT_ID+']'].value);
            if (!QUANTITY) QUANTITY = 0;
            for (var PRICE_NUMBER in PRICE_VARIANTS['VALUES'][PRODUCT_ID]){
                if (QUANTITY >= PRICE_VARIANTS['VALUES'][PRODUCT_ID][PRICE_NUMBER]['MIN_QUANTITY']){
                    var PRICE_ITEM = PRICE_VARIANTS['VALUES'][PRODUCT_ID][PRICE_NUMBER]['PRICE'];
                    var PRICE_ID = PRICE_VARIANTS['VALUES'][PRODUCT_ID][PRICE_NUMBER]['PRICE_ID'];
                }
            }

            var MAX_QUANTITY = Number(PRICE_VARIANTS['MAX_QUANTITY'][PRODUCT_ID]);
            if (QUANTITY>MAX_QUANTITY){
                ERROR_QUANTITY = 1;
            }
            var PRICE_TOTAL = PRICE_ITEM*QUANTITY;
            BASKET_SUMM += PRICE_TOTAL;
            BASKET_QUANTITY += QUANTITY;

            //document.forms['main_form'].elements['quantity['+PRODUCT_ID+']'].value = QUANTITY;
            document.getElementById('price_item['+PRODUCT_ID+']').innerHTML = PRICE_ITEM.toFixed(2);
            document.getElementById('price_total['+PRODUCT_ID+']').innerHTML = PRICE_TOTAL.toFixed(2);
            document.forms['main_form'].elements['price_id['+PRODUCT_ID+']'].value = PRICE_ID;
            <?endforeach;?>


        var DISCOUNT_VALUE = 0;
        for (var ID in DISCOUNTS){
            if (BASKET_SUMM > DISCOUNTS[ID]['PRICE_FROM']){
                DISCOUNT_VALUE = DISCOUNTS[ID]['DISCOUNT_VALUE'];
            }
        }
        DISCOUNT_VALUE += <?=$_SESSION['OSG']['USER']['BASKET']['DISCOUNT']['VALUE']?>;

        var DISCOUNT_SUMM = BASKET_SUMM*DISCOUNT_VALUE/100;
        var FINAL_BASKET_SUMM = BASKET_SUMM - DISCOUNT_SUMM;


        document.getElementById('basket_summ').innerHTML = BASKET_SUMM.toFixed(2);
        // document.getElementById('basket_quantity').innerHTML = BASKET_QUANTITY;
        //document.getElementById('discount_value').innerHTML = DISCOUNT_VALUE ? DISCOUNT_VALUE+'%' : '';
        document.getElementById('discount_summ').innerHTML = DISCOUNT_SUMM.toFixed(2);
        document.getElementById('final_basket_summ').innerHTML = FINAL_BASKET_SUMM.toFixed(2);

        <?if ($arParams['NO_LIMIT'] != 'Y'):?>
            if (ERROR_QUANTITY){
                //alert("К сожалению, такого количества товара нет на складе");
                //document.getElementById('basket_submit').style.display = 'none';
            }else{
                //document.getElementById('basket_submit').style.display = '';
            }
            <?endif?>
    }

    function basket_refresh(){
        document.forms['main_form'].elements['action'].value = 'refresh';
        document.forms['main_form'].submit();
    }

    set_prices();
</script>

<?if($_REQUEST['trans_s']=='Y'):?>
    <script>
        location.reload(true);
    </script>
    <?endif;?>

<?else:?>
    Ваша корзина пуста.<br>
    Чтобы отложить товар в корзину, зайдите на страницу детального описания этого товара.
    <?endif?>