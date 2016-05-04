<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    //удаление из корзины
    if ($_GET["delete_from_basket"]) {
        CSaleBasket::Delete(intval($_GET["delete_from_basket"]));
        header("location: /catalog/notebook.php");
    }

    echo ShowError($arResult["ERROR_MESSAGE"]);
    //echo GetMessage("STB_ORDER_PROMT");



    //arshow($arResult);
    //CCurrencyRates::ConvertCurrency($total_price, "USD", "RUR");
?>

<br>
<?if (count($arResult["ITEMS"]["DelDelCanBuy"]) > 0) {?>

<table class=" forward_catalog_new_basket">
    <tr>
        <th width="43">Фото</th>
        <th width="570" style="text-align: left;"><span style="margin:0 0 0 20px;">Наименование (артикул, OEM, год)</span></th>
        <th></th>
        <th width="90">Цена, руб</th>
        <th width="43"><div class="catalog_new_basket_del_icon"></div></th>
    </tr>
    <?
        $i=0;
        foreach($arResult["ITEMS"]["DelDelCanBuy"] as $arBasketItems)
        {
            //arshow($arBasketItems);
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
                    <div class="forward_catalog_new_foto" title="<?=$arElement["NAME"]?>">
                        <div class="forward_catalog_new_foto_container">
                            <div class="forward_catalog_new_foto_container_arr_tail"></div>
                            <div class="forward_catalog_new_item_img"><img src="<?=$img_path?>"></div>
                        </div>
                    </div>
                    <?} else {?>
                    <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                    <?}?>
                <?/*<br><a href="<?=$arElement["ADD_URL"];?>">добавить</a>*/?>

            </td>

            <td >
                <div class="catalog_new_basket_link">
                    <a  href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement['NAME']?>" target="_blank">
                        <?=$arElement["NAME"]?>,
                        <span class="catalog_new_basket_props">(<?=$arElement["CODE"].", ".$arElement["PROPERTY_UNC_VALUE"].", ".$arElement["PROPERTY_SIZE_VALUE"]?>)</span>
                    </a>
                </div>
            </td>
            <td class="border_transparent">

            </td>
            <td class="border_transparent">
                <input type="hidden" id="item_price_<?=$arElement["ID"]?>" value="<?=$arBasketItems["PRICE"]?>">
                <span id="element_price_<?=$arElement["ID"]?>" class="basket_item_price_container"><?=$arBasketItems["PRICE"]*$arBasketItems["QUANTITY"]?></span>
            </td>
            <td><a href="?delete_from_basket=<?=$arBasketItems["ID"]?>" title="удалить товар из блокнота"><div class="catalog_new_basket_del"></div></a></td>


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
<?} else {?>
 <p>В блокноте нет товаров</p>
<?}?>


