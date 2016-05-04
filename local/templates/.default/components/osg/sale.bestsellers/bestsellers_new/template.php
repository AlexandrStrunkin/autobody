<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div id="best">Бестселлеры</div>
<?
 //arshow($arResult);
?>
<div class="sale_bestseller">
    <?
        if(!empty($arResult["ELEMENT"]))
        {
            $count=0;
        ?>

        <? if($arParams['COLS']<=0) $arParams['COLS']=3;?>
        <? if($arParams['ROWS']<=0) $arParams['ROWS']=3;?>

        <?foreach ($arResult['ELEMENT'] as $key=>$arItem):?>
            <?
                switch ($count) {
                    case 0: ?><div id="rightpart1"><? break;
                    case 4: ?></div><div id="rightpart2"><? break;
                    case 8: ?></div><div id="rightpart2"><? break;
                    }
                ?>

                <?
                    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg")) {$img_path = "/upload/images/".$arItem['CODE'].".jpg";}
                    else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".JPG")) {$img_path = "/upload/images/".$arItem['CODE'].".JPG";}
                    else {$img_path = $arItem['PREVIEW_PICTURE'];}
                    //echo $img_path;
                ?>

                <?
                    $item_quantity = array();
                    $item_quantity = GKCommon::GetItemsCountForWarehouse(GKCommon::GetSavedWarehouse(),$arItem['CODE']);
                    // arshow ($item_quantity);
                    //в инпут выше нужно вывести количество товара на текущем складе
                ?>

                 <?
                 //проверяем количество товара
                 global $this_count; $this_count = 0;?>
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "cat_q_list", array(
                                "PER_PAGE" => "10",
                                "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
                                "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
                                "USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
                                "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                                "ELEMENT_ID" => $arItem["ID"],
                                "STORE_PATH"  =>  $arParams["STORE_PATH"],
                                "MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
                            ),
                            $component
                        );?>

                <input type="hidden" id="name<?=$arItem["ID"]?>" value="<?=$arItem['NAME']?>">
                <input type="hidden" id="price<?=$arItem["ID"]?>" value="<?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?>">
                <input type="hidden" id="atricul<?=$arItem["ID"]?>" value="<?=$arItem['CODE']?>">
                <input type="hidden" id="year<?=$arItem["ID"]?>" value="<?=$arItem['PROPS']['SIZE']['VALUE']?>">
                <input type="hidden" id="quantity<?=$arItem["ID"]?>" value="<?=$this_count?>">

                <?
                    //echo $img_path;
                    //$img_sizes = image_resize($img_path,120,120);
                    //arshow($img_sizes);
                    if (file_exists($_SERVER["DOCUMENT_ROOT"].$img_path)) {
                        $image_style = image_resize($_SERVER["DOCUMENT_ROOT"].$img_path,130,130);
                    }
                ?>
                <div class="rightpart_mini">
                    <?//echo GKCommon::GetSavedWarehouse()." - ".$item_quantity["COUNT"];?>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="bestseller_img">
                        <img src="<?=$img_path?>" class="rightpic" style="<?=$image_style?>">
                    </a><br>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="rightlink"><?=$arItem['CODE']?></a><br>

                    <span class="price"><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?></span> <span class="rub">руб</span>
                    <?

                        if ($item_quantity["COUNT"] > 0) {

                            if($arItem['PROPERTY_STATUS']){
                            ?>
                            <button class="rightbutton" onclick="showcatdet('<?=$arItem["ID"]?>')">В корзину</button>
                            <?
                            }
                        }
                    ?>
                </div>
                <?
                    $count++;
                    endforeach;?>
        </div>

        <?
        }
    ?>
</div>
<br><br>


<script>
    function showcatdet(ID)
    {
        $("#qw").attr("value","1");
        $("#idm").val(ID);
        $("#catnamem").html($("#name"+ID).val());
        $("#catpricem").html($("#price"+ID).val());
        $("#catartm").html($("#atricul"+ID).val());
        $("#catyearm").html($("#year"+ID).val());
        $("#catqwm").html($("#quantity"+ID).val());
        $('#dialog').jqmShow();
    }
</script>

<script>
    $().ready(function() {
            $('#dialog').jqm();
    });
</script>
<div class="jqmWindow" id="dialog">

    <a href="#" id="closemodal" class="jqmClose"></a>
    <form method="get" name="addbaskmod">

        <input type="hidden" name="action" value="add_basket_item"/>
        <input type="hidden" name="id" id="idm" value=""/>
        <input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>"/>
        <input type="hidden" name="page" value="<?=htmlspecialcharsbx($_REQUEST['page'])?>"/>

        <div class="modtitle">Добавление товара в корзину</div>
        <table>
            <tr class="begin white">
                <td>Вы выбрали:</td>
                <td id="catnamem"></td>
            </tr>
            <tr class="nowhite">
                <td>Цена:</td>
                <td id="catpricem"></td>
            </tr>
            <tr class="white">
                <td>Артикул:</td>
                <td id="catartm"></td>
            </tr>
            <tr class="nowhite">
                <td>Год:</td>
                <td id="catyearm"></td>
            </tr>
            <tr class="white end">
                <td>Текущий склад:</td>
                <?
                    $whss = GKCommon::GetWarehouses();
                    //arshow($_SESSION);
                    //получаем имя текущего склада
                    foreach($whss as $whs){

                        if ($whs["ID"] == $_SESSION["OSG"]["GKWH"] or $whs["ID"] == $_SESSION["GKWH"]) {
                            //  arshow($whs);
                            $WH_NAME = $whs["TITLE"];
                        }
                    }
                ?>
                <td><?=$WH_NAME?></td>
            </tr>
            <tr>
                <td>Количество, шт.</td>
                <td>
                    <span style="display: none;" id="catqwm"></span>
                    <input type="button" class="minus" value="-" onClick="if (Number($('#qw').val())>1){$('#qw').val(Number($('#qw').val())-1);}" />
                    <input type="text" name="quantity" class="small" id="qw" value="1" onkeyup="if($(this).attr('value')<=0) this.value=1 return false; if($(this).attr('value')>Number($('#catqwm').val())) {alert('Такого кол-ва товара нет на складе'); this.value=Number($('#catqwm').html()); }" />
                    <input type="button" class="plus" value="+" onClick="if (Number($('#qw').val())<Number($('#catqwm').html()))$('#qw').val(Number($('#qw').val())+1);"/>
                </td>
            </tr>
            <tr>
                <td class="tdul">В наличии на складе<br/>
                    <?/*
                        <ul>
                        <li>Дмитровка</li>
                        <li>Печатники </li>
                        <li>Санкт-Петербург</li>
                        </ul>      */
                    ?>
                </td>
                <td style="text-align:center;">
                    <a href="javascript:add2basket();" class="modalsave">Добавить</a>
                </td>

            </tr>

        </table>

    </form>
</div>




