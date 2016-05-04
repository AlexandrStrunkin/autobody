<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<div style="color:black"><pre>'; print_r($arResult); echo '</pre></div>';?>
<form id="main_form" method="POST" action="?item_id=<?=$arResult['ITEM']['ID']?>">
    <input type="hidden" name="basket_action" value="add">
    <input type="hidden" name="price_id">
    <h2><?=$arResult['ITEM']['NAME']?></h2>
    <table cellpadding="0" cellspacing="0" width="100%" class="item_table">
        <?//arshow($arResult)?>
        <tr valign="top">
            <td width="243">
                <div id="imgBlock">
                    <div class="middleImgWrapper">
                        <!--<img src="/bitrix/templates/demo/images/item.jpg" width="235" height="343" alt="" />-->
                        <?
                            // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                            if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arResult['ITEM']['CODE'].".jpg")) {$img_path = "/upload/images/".$arResult['ITEM']['CODE'].".jpg";}
                            else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arResult['ITEM']['CODE'].".JPG")) {$img_path = "/upload/images/".$arResult['ITEM']['CODE'].".JPG";}
                                else {$img_path = $arResult["ITEM"]["DETAIL_PICTURE"]; }
                        ?>
                        <img alt="<?=$arResult['ITEM']['NAME']?>" id="main_image" width="235" src="<?=$img_path?>"/>
                    </div>
                    <?if (count($arResult['PHOTOGALLERY']) > 1):?>
                        <div class="item_photo">
                            Фотографии:
                            <?foreach ($arResult['PHOTOGALLERY'] as $N=>$PATH):?>
                                <a href="#" onclick="set_main_image(<?=$N?>); return false;" id="photo_nav_<?=$N?>">
                                    <?=$N?>
                                </a>
                                <?endforeach;?>
                        </div>
                        <?endif?>            
                </div>
            </td>
            <td class="item_right">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <div class="about_tovar">
                                <?/*if ($arResult['ITEM']['PROPS']['STATUS']['VALUE']):?>
                                    <span><img src="/bitrix/templates/demo/images/yes.gif" width="17" height="17" /> Есть в наличии</span>
                                    <?else:?>
                                    <span><img src="/bitrix/templates/demo/images/no.gif" width="17" height="17" /> Нет в наличии</span>
                                <?endif?><br /><br />*/?>
                                <span>Артикул:</span> <?=$arResult['ITEM']['CODE']?><br />
                                <?if ($val = $arResult['ITEM']['PROPS']['FIRM']['VALUE']):?>
                                    <span>Бренд: </span><?=$val?><br />
                                    <?endif?>
                                <?if ($val = $arResult['ITEM']['PROPS']['WARRANTY']['VALUE']):?>
                                    <span>Номер производителя: </span><?=$val?><br />
                                    <?endif?>
                                <?if ($val = $arResult['ITEM']['PROPS']['COUNTRY']['VALUE']):?>
                                    <span>Страна производитель: </span><?=$val?><br />
                                    <?endif?>
                                <span>Категория:</span> <?=$arResult['SECTION']['NAME']?><br />

                                <?if ($val = $arResult['ITEM']['PROPS']['UNC']['VALUE']):?>
                                    <span>УНК: </span><?=$val?><br />
                                    <?endif?>
                                <?if ($val = $arResult['ITEM']['PROPS']['SIZE']['VALUE']):?>
                                    <span>Год: </span><?=$val?><br />
                                    <?endif?>



                            </div>
                        </td>
                        <td width="75">

                        </td>
                    </tr>
                </table>
                <div class="tovar_text">	<?=$arResult['ITEM']['DETAIL_TEXT']?> </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="feature">
                    <?foreach ($arResult['ITEM']['OSG_PROPS'] as $PROP_CODE=>$arProp):?>
                        <?if (is_array($arProp['VALUES']) && $arProp['VALUES']):?>
                            <tr>
                            <td><span><?=$arProp['NAME']?>:</span> </td>
                            <td><?=join(', ', $arProp['VALUES'])?></td>
                            <?endif?>
                        <?endforeach;?>
                </table>     

                <?
                    //получаем цену:
                    $price = CCurrencyRates::ConvertCurrency($arResult["PRICE_VARIANTS"][0]["VALUES"][0]["PRICE"], "USD", "RUR");       
                ?> 

                <div class="price">
                    Цена: <span id="price_item"><?=round($price)?></span> руб.
                </div>

                <?/*
                    <table cellpadding="0" cellspacing="0" width="100%" class="table_rezult">
                    <tr>
                    <td class="price_rezult">       
                    <div class="price">
                    <input type="hidden" class="textbox" name="quantity" value="<?=($_REQUEST['quantity']) ? $_REQUEST['quantity'] : 1?>" onkeyup="set_prices();"/> <?=($_REQUEST['quantity']) ? $_REQUEST['quantity'] : 1?> шт. <br>
                    Итого: <span id="price_total"></span> руб.
                    </div>
                    </td>
                    <td width="170" align="center" class="item_submit">
                    </td>
                    </tr>
                    </table>    
                */?>


            </td>
        </tr>
    </table>
</form>




<script>

    function item_print(){
        window.open("item_print.php?item_id=<?=$arResult['ITEM']['ID']?>","","status=no, scrollbars=no, resizable=yes, location=no, width=800, height=600");
    }

    PHOTOGALLERY = new Array;
    <?foreach ($arResult['PHOTOGALLERY'] as $N=>$PATH):?>
        PHOTOGALLERY[<?=$N?>] = '<?=$PATH?>';
        <?endforeach;?>

    function set_main_image(number){
        //  document.getElementById('main_image').src = PHOTOGALLERY[number];
        <?if (count($arResult['PHOTOGALLERY']) > 1):?>
            for (N in PHOTOGALLERY){
                if (N==number){
                    document.getElementById('photo_nav_'+N).style.color = 'red';
                }else{
                    document.getElementById('photo_nav_'+N).style.color = 'black';
                }
            }
            <?endif?>
    }
    set_main_image(1);

    PRICE_VARIANTS = new Array;
    PRICE_VARIANTS['PRICING_PROPS'] = new Array;
    PRICE_VARIANTS['VALUES'] = new Array;
    PRICE_VARIANTS['MAX_QUANTITY'] = new Array;

    <?foreach ($arResult['PRICE_VARIANTS'] as $arPrices):?>
        PRICE_VARIANTS['MAX_QUANTITY'][<?=$arPrices['PRODUCT_ID']?>] = <?=$arPrices['MAX_QUANTITY']?>;
        PRICE_VARIANTS['PRICING_PROPS'][<?=$arPrices['PRODUCT_ID']?>] = new Array;
        <?foreach ($arPrices['PRICING_PROPS'] as $CODE=>$VAL):?>
            PRICE_VARIANTS['PRICING_PROPS'][<?=$arPrices['PRODUCT_ID']?>]['<?=$CODE?>'] = <?=$VAL?>;
            <?endforeach;?>

        PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>] = new Array;
        <?foreach ($arPrices['VALUES'] as $N=>$arr):?>
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>] = new Array;
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>]['MIN_QUANTITY'] = <?=$arr['MIN_QUANTITY']?>;
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>]['PRICE'] = <?=CCurrencyRates::ConvertCurrency($arr['PRICE'], "USD", "RUR")?>;
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>]['PRICE_ID'] = <?=$arr['PRICE_ID']?>;
            <?endforeach;?>
        <?endforeach;?>



    function set_prices(){
        PROPS = new Array;
        for (var i=0; i<document.forms['main_form'].elements.length; i++) {
            if (document.forms['main_form'].elements[i].id=='osg_pricing_prop') {
                PROPS[document.forms['main_form'].elements[i].name] = document.forms['main_form'].elements[i].value;
            }
        }

        var WANTED_PRODUCT_ID = 0;

        for (var PRODUCT_ID in PRICE_VARIANTS['PRICING_PROPS']){
            var flag = true;
            for (var PROP_CODE in PRICE_VARIANTS['PRICING_PROPS'][PRODUCT_ID]){
                if (PRICE_VARIANTS['PRICING_PROPS'][PRODUCT_ID][PROP_CODE] != PROPS[PROP_CODE]){
                    flag = false;
                }
            }
            if (flag){
                WANTED_PRODUCT_ID = PRODUCT_ID;
            }
        }


        var QUANTITY =  Number(document.forms['main_form'].elements['quantity'].value);
        if (!QUANTITY) QUANTITY = 1;

        var MAX_QUANTITY = Number(PRICE_VARIANTS['MAX_QUANTITY'][WANTED_PRODUCT_ID]);

        for (var PRICE_NUMBER in PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID]){
            if (QUANTITY >= PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID][PRICE_NUMBER]['MIN_QUANTITY']){
                var PRICE_ITEM = PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID][PRICE_NUMBER]['PRICE'];
                var PRICE_ID = PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID][PRICE_NUMBER]['PRICE_ID'];
            }
        }

        var PRICE_TOTAL = PRICE_ITEM*QUANTITY;

        //document.forms['main_form'].elements['quantity'].value = QUANTITY;
        document.getElementById('price_item').innerHTML = PRICE_ITEM.toFixed(2);
        document.getElementById('price_total').innerHTML = PRICE_TOTAL.toFixed(2);
        document.forms['main_form'].elements['price_id'].value = PRICE_ID;

        <?if ($arParams['NO_LIMIT'] != 'Y'):?>
            if (QUANTITY>MAX_QUANTITY){
                alert("К сожалению, такого количества товара нет на складе");
                document.forms['main_form'].elements['submit'].disabled = true;
            }else{
                document.forms['main_form'].elements['submit'].disabled = '';
            }
            <?endif?>

        <?if (!$arResult['ITEM']['PROPS']['STATUS']['VALUE']):?>
            document.forms['main_form'].elements['submit'].disabled = true;
            <?endif?>
    }

    //  set_prices();
</script>
<?//echo '<pre>'.print_r($arResult, true).'</pre>';?>