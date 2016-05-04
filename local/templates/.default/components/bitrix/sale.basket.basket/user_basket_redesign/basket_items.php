<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    //удаление из корзины
    if ($_GET["delete_from_basket"]) {
        CSaleBasket::Delete(intval($_GET["delete_from_basket"]));
        header("location: /personal/basket.php");
    }

    echo ShowError($arResult["ERROR_MESSAGE"]);
    //echo GetMessage("STB_ORDER_PROMT");



    //arshow($arParams);
    //CCurrencyRates::ConvertCurrency($total_price, "USD", "RUR");
?>


<script type="text/javascript">
    $(function(){

        $(".apply-not-auth-order").click(function(e){ 

            if(($(".user-check").parent().hasClass('checked'))) {
                $(".button2").removeAttr("disabled");
            } else {
                $(".button2").attr("disabled", "disabled");
            }

        });

    });
</script>

<script>
    //увеличение, уменьшение количества в корзине
    function basket_quantity_change(id,dir) {
        var max_count = parseInt($("#item_max_count_" + id).val());
        var cur_count = parseInt($("#element_quantity_" + id).val());
        var cur_price = parseInt($("#item_price_" + id).val());
        var new_count;
        // alert(cur_count);
        // alert(max_count);
        switch (dir) {
            case "-": new_count =  cur_count - 1; if (new_count < 1) {new_count = 1;} break;
            case "+": new_count =  cur_count*1+1; if (new_count > max_count) {new_count = max_count;}break;
        }

        var new_price = new_count * cur_price;

        $("#element_quantity_" + id).val(new_count);
        $("#element_price_" + id).html(new_price);

        var allsum = 0;
        $(".basket_item_price_container").each(function(){
            allsum += parseInt($(this).html());
        })

        $("#all_basket_summ").html(allsum + " рублей");


    }

</script>

<br>
<table class="basket-catalog">
    <tr>
        <th width="43">Фото</th>
        <th width="370" style="text-align: left;"><span style="margin:0 0 0 20px;">Наименование (артикул, OEM, год)</span></th>
        <th width="90">Цена, руб</th>
        <th>Количество, шт</th>
        <th width="90">Сумма, руб</th>
    </tr>
    <?
        $i=0;
        foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
        {
            // arshow($arBasketItems);


            //если пользоваткль не авторизован и сайт оптовый, то все равно показываем оптовые цены
            if (!$USER->IsAuthorized() && checkSite() != "retail"){
                $productPrice = CPrice::GetList( array(),array("PRODUCT_ID" => $arBasketItems["PRODUCT_ID"], "CATALOG_GROUP_ID"=>1), false, false, array())->Fetch();
                $arBasketItems["PRICE"] = $productPrice["PRICE"];
            }


            $element = CIBlockElement::GetList(array(), array("ID"=>$arBasketItems["PRODUCT_ID"]), false, false, array("PROPERTY_UNC","PROPERTY_SIZE","ID","CODE","NAME","IBLOCK_SECTION_ID"));
            $arElement = $element->Fetch();

            // arshow($arElement);

            $arBasketItems["PRICE"] = ceil(CCurrencyRates::ConvertCurrency($arBasketItems["PRICE"], "USD", "RUR"));
            $arBasketItems["CURRENCY"] = "RUR";
            $arBasketItems["PRICE_FORMATED"] = $arBasketItems["PRICE"]." руб";

            $arElement["DETAIL_PAGE_URL"] = "/catalog/".$arElement["IBLOCK_SECTION_ID"]."/".$arElement["ID"]."/";
        ?>

        <tr>
            <td>
                <?
                    // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".jpg")) {$img_path = "/upload/images/".$arElement['CODE'].".jpg";}
                    else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".JPG")) {$img_path = "/upload/images/".$arElement['CODE'].".JPG";}
                        else {$img_path = "";}
                ?>
                <?if ($img_path != ""){?>
                    <a href="<?=$img_path?>" class="fancybox" title="<?=$arElement["NAME"]?>">
                        <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                            <?/*
                                <div class="forward_catalog_new_foto_container">
                                <div class="forward_catalog_new_foto_container_arr_tail"></div>
                                <div class="forward_catalog_new_item_img"><img src="<?=$img_path?>"></div>
                                </div>
                            */?>
                        </div>
                    </a>
                    <?} else {?>
                    <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                    <?}?>
                <?/*<br><a href="<?=$arElement["ADD_URL"];?>">добавить</a>*/?>

            </td>

            <td >
                <div class="catalog_new_basket_link">
                    <a  href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement['NAME']?>" >
                        <font class="blue-text"><?=$arElement["NAME"]?></font> <br>
                        <span class="catalog_new_basket_props">(<?=$arElement["CODE"].", ".$arElement["PROPERTY_UNC_VALUE"].", ".$arElement["PROPERTY_SIZE_VALUE"]?>)</span>
                    </a>
                </div>
            </td>
            <td class="border_transparent">

                <span class=""><?=$arBasketItems["PRICE"]?></span>
            </td>
            <td class="border_transparent">
                <?//получаем максимальное количество товара для текущего склада?>
                <?global $this_count; $this_count = 0;?>
                <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "cat_q_list", array(
                        "ELEMENT_ID" => $arElement["ID"]
                        ),
                        $component
                    );?>
                <input type="hidden" id="item_max_count_<?=$arElement["ID"]?>" value="<?=$this_count?>">
                <div class="catalog_new_minus" id="catalog_new_minus" onclick="basket_quantity_change(<?=$arElement["ID"]?>,'-')">-</div>
                <div class="catalog_new_quantity_container">
                    <div class="input_locker"></div>
                    <input maxlength="18" type="text" id="element_quantity_<?=$arElement["ID"]?>" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" class="catalog_new_quantity">
                </div>
                <div class="catalog_new_plus" id="catalog_new_plus" onclick="basket_quantity_change(<?=$arElement["ID"]?>,'+')">+</div>
            </td>
            <td class="border_transparent">
                <input type="hidden" id="item_price_<?=$arElement["ID"]?>" value="<?=$arBasketItems["PRICE"]?>">
                <div><span id="element_price_<?=$arElement["ID"]?>" class="basket_item_price_container"><?=$arBasketItems["PRICE"]*$arBasketItems["QUANTITY"]?></span></div>
                <a href="?delete_from_basket=<?=$arBasketItems["ID"]?>" title="удалить товар из корзины" ><img src="/images/delete-item-basket.png"/></a>
            </td>
            <!--<td><a href="?delete_from_basket=<?=$arBasketItems["ID"]?>" title="удалить товар из корзины"><div class="catalog_new_basket_del"></div></a></td> -->


        </tr>
        <?/*

            <tr>
            <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
            <td><?
            if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
            ?><a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>"><?
            endif;
            ?><b><?=$arBasketItems["NAME"] ?></b><?
            if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
            ?></a><?
            endif;
            ?></td>
            <?endif;?>
            <?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
            <td>
            <?
            foreach($arBasketItems["PROPS"] as $val)
            {
            echo $val["NAME"].": ".$val["VALUE"]."<br />";
            }
            ?>
            </td>
            <?endif;?>
            <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
            <td align="right"><?=$arBasketItems["PRICE_FORMATED"]?></td>
            <?endif;?>
            <?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
            <td><?=$arBasketItems["NOTES"]?></td>
            <?endif;?>
            <?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
            <td><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
            <?endif;?>
            <?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
            <td align="center"><input maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3" ></td>
            <?endif;?>
            <?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
            <td align="center"><input type="checkbox" name="DELETE_<?=$arBasketItems["ID"] ?>" id="DELETE_<?=$i?>" value="Y"></td>
            <?endif;?>
            <?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
            <td align="center"><input type="checkbox" name="DELAY_<?=$arBasketItems["ID"] ?>" value="Y"></td>
            <?endif;?>
            <?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
            <td align="right"><?=$arBasketItems["WEIGHT_FORMATED"] ?></td>
            <?endif;?>
        </tr>      */?>
        <?
            $i++;
        }
    ?>
</table>
<script>
    function sale_check_all(val)
    {
        for(i=0;i<=<?=count($arResult["ITEMS"]["AnDelCanBuy"])-1?>;i++)
        {
            if(val)
                document.getElementById('DELETE_'+i).checked = true;
            else
                document.getElementById('DELETE_'+i).checked = false;
        }
    }
</script>



<?/*
    <table width="100%">

    <tr>
    <td width="118">
    <?
    //получаем имя текущего склада
    $cur_wh = GKCommon::GetWarehouseByID(GKCommon::GetSavedWarehouse());
    ?>
    <input type="submit" value='Оформить на складе "<?=$cur_wh?>" ' name="BasketOrder"  id="basketOrderButton2" class="new_catalog_make_order">
    </td>
    <td >
    <input type="submit" value="Пересчитать" name="BasketRefresh" class="new_catalog_basket_refresh">
    </td>
    <td align="right">
    <?$arResult["allSum_FORMATED"] = ceil(CCurrencyRates::ConvertCurrency($arResult["allSum"], "USD", "RUR"))." рублей";?>

    <span id="all_basket_summ"><?=$arResult["allSum_FORMATED"]?></span>
    <span class="catalog_new_all_summ_caption">ИТОГО: </span>


    </td>
    </tr>
    </table>
*/?>

<?
    //получаем имя текущего склада
    $cur_wh = GKCommon::GetWarehouseByID(GKCommon::GetSavedWarehouse());
    
?>

<?if (($USER->IsAuthorized() && checkSite()=="opt") || checkSite()!="opt"){?>
<div class="store-info">Заказ будет оформлен на складе <?=$cur_wh?>!</div>
<?}?>

<?if (!($USER->IsAuthorized()) && checkSite()=="opt"){?>
    <div class="store-info"><div class="store-warning">Внимание! Для оформления заказа по оптовым ценам Вам необходимо <a href="javascript:void(0)" class="authFromBasket" onclick="$('.top_auth_form').toggle();">авторизоваться на сайте</a> как оптовый покупатель. Для оформления заказа по розничным ценам вы можете перейти в <a href="http://retail.autobody.ru/personal/basket/">розничный магазин.</a></div>
        <?/*
        <div class="apply-not-auth-order">
            <div class="checker"><span><input type="checkbox" id="5" value="5" style="opacity: 0;" class="user-check"></span></div>
            <label for="5">Я согласен</label>
        </div>
        */?>
    </div>

    <?
}  ?>

<?$arResult["allSum_FORMATED"] = ceil(CCurrencyRates::ConvertCurrency($arResult["allSum"], "USD", "RUR"));?>
<div class="sum-score">ИТОГО: <span id="all_basket_summ"><?=$arResult["allSum_FORMATED"]?></span><font class="rouble">i</font>
    <?if (($USER->IsAuthorized() && checkSite()=="opt") || checkSite()!="opt"){?>
    <input class="button2" type="submit" name="BasketOrder" id="basketOrderButton2" value="ОФОРМИТЬ">   
    <?}?>  
    <input class="button1" type="submit" name="BasketRefresh" value="ПЕРЕСЧИТАТЬ">
</div>

<?/*if (!$USER->IsAuthorized()){?>
    <p>
    Внимание! Вы не авторизованы на сайте, заказ будет оформлен на Частное лицо. Цены будут заменены на розничные (оптовые + 50%).
    </p>
    <br>
    <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "basket_auth", array(
    "REGISTER_URL" => "/personal/",
    "FORGOT_PASSWORD_URL" => "/personal/forgot_pass.php",
    "PROFILE_URL" => "/personal/",
    "SHOW_ERRORS" => "Y"
    ),
    false
    );?>
    <?}?>
<?*/