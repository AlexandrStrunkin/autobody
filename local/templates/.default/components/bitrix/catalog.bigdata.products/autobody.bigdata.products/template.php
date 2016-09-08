<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin("");

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
    'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

$injectId = 'bigdata_recommeded_products_'.rand();

?>

<script type="application/javascript">
    BX.cookie_prefix = '<?=CUtil::JSEscape(COption::GetOptionString("main", "cookie_name", "BITRIX_SM"))?>';
    BX.cookie_domain = '<?=$APPLICATION->GetCookieDomain()?>';
    BX.current_server_time = '<?=time()?>';

    BX.ready(function(){
        bx_rcm_recommendation_event_attaching(BX('<?=$injectId?>_items'));
    });

</script>

<?

if (isset($arResult['REQUEST_ITEMS']))
{
    CJSCore::Init(array('ajax'));

    // component parameters
    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $signedParameters = $signer->sign(
        base64_encode(serialize($arResult['_ORIGINAL_PARAMS'])),
        'bx.bd.products.recommendation'
    );
    $signedTemplate = $signer->sign($arResult['RCM_TEMPLATE'], 'bx.bd.products.recommendation');

    ?>

    <span id="<?=$injectId?>" class="bigdata_recommended_products_container"></span>

    <script type="application/javascript">
        BX.ready(function(){
            bx_rcm_get_from_cloud(
                '<?=CUtil::JSEscape($injectId)?>',
                <?=CUtil::PhpToJSObject($arResult['RCM_PARAMS'])?>,
                {
                    'parameters':'<?=CUtil::JSEscape($signedParameters)?>',
                    'template': '<?=CUtil::JSEscape($signedTemplate)?>',
                    'site_id': '<?=CUtil::JSEscape(SITE_ID)?>',
                    'rcm': 'yes'
                }
            );
        });
    </script>

    <?
    $frame->end();
    return;
}


if (!empty($arResult['ITEMS']))
{
    ?><script type="text/javascript">
    BX.message({
        CBD_MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CVP_TPL_MESS_BTN_BUY')); ?>',
        CBD_MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CVP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',

        CBD_MESS_BTN_DETAIL: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',

        CBD_MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',
        CBD_BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
        BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
        CBD_ADD_TO_BASKET_OK: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
        CBD_TITLE_ERROR: '<? echo GetMessageJS('CVP_CATALOG_TITLE_ERROR') ?>',
        CBD_TITLE_BASKET_PROPS: '<? echo GetMessageJS('CVP_CATALOG_TITLE_BASKET_PROPS') ?>',
        CBD_TITLE_SUCCESSFUL: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
        CBD_BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CVP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
        CBD_BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
        CBD_BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
    });
    </script>
    <span id="<?=$injectId?>_items" class="bigdata_recommended_products_items">
    <input type="hidden" name="bigdata_recommendation_id" value="<?=htmlspecialcharsbx($arResult['RID'])?>">
    <?

    $arSkuTemplate = array();
    if(is_array($arResult['SKU_PROPS']))
    {
        foreach ($arResult['SKU_PROPS'] as $iblockId => $skuProps)
        {
            $arSkuTemplate[$iblockId] = array();
            foreach ($skuProps as &$arProp)
            {
                ob_start();
                if ('TEXT' == $arProp['SHOW_MODE'])
                {
                    if (5 < $arProp['VALUES_COUNT'])
                    {
                        $strClass = 'bx_item_detail_size full';
                        $strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
                        $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                        $strSlideStyle = '';
                    }
                    else
                    {
                        $strClass = 'bx_item_detail_size';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    ?>
                <div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
                    <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>

                    <div class="bx_size_scroller_container">
                        <div class="bx_size">
                            <ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
                                foreach ($arProp['VALUES'] as $arOneValue)
                                {
                                    ?>
                                <li
                                    data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                    data-onevalue="<? echo $arOneValue['ID']; ?>"
                                    style="width: <? echo $strOneWidth; ?>;"
                                    ><i></i><span class="cnt"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></span>
                                    </li><?
                                }
                                ?></ul>
                        </div>
                        <div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                        <div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                    </div>
                    </div><?
                }
                elseif ('PICT' == $arProp['SHOW_MODE'])
                {
                    if (5 < $arProp['VALUES_COUNT'])
                    {
                        $strClass = 'bx_item_detail_scu full';
                        $strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
                        $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                        $strSlideStyle = '';
                    }
                    else
                    {
                        $strClass = 'bx_item_detail_scu';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    ?>
                <div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
                    <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>

                    <div class="bx_scu_scroller_container">
                        <div class="bx_scu">
                            <ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
                                foreach ($arProp['VALUES'] as $arOneValue)
                                {
                                    ?>
                                <li
                                    data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID'] ?>"
                                    data-onevalue="<? echo $arOneValue['ID']; ?>"
                                    style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
                                    ><i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>
                            <span class="cnt"><span class="cnt_item"
                                                    style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
                                                    title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
                                    ></span></span></li><?
                                }
                                ?></ul>
                        </div>
                        <div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                        <div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                    </div>
                    </div><?
                }
                $arSkuTemplate[$iblockId][$arProp['CODE']] = ob_get_contents();
                ob_end_clean();
                unset($arProp);
            }
        }
    }

    ?>
    <div class="bx_item_list_you_looked_horizontal col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
    <div class="bx_item_list_title"><? echo GetMessage('CVP_TPL_MESS_RCM') ?></div>
    <div class="bx_item_list_section">
    <div class="bx_item_list_slide active">
    <div style="clear: both;"></div>
    <table class="forward_catalog_new catalog_table">
        <tr>
            <th width="43">Фото</th>
            <th width="108">Артикул</th>
            <th width="98">OEM#</th>
            <th width="58">Год</th>
            <th width="245">Наименование</th>
            <th width="40">Срав.</th>
            <th width="69">Цена, руб</th>
            <th width="75">Купить</th>
            <th width="37">Инфо</th>
        </tr>

        <?
            //проверяем корзину пользователя.
            //если текущий товар уже есть в корзине, то вместо кнопки добавления выводим соответствующее сообщение
            $arBasketItemsIDs = getCurrentBasket();  //массив ID товаров, которые в корзине на данный момент                 
        ?>

        <?foreach($arResult['ITEMS'] as $ID):
                $Element = CIBLockElement::GetList(array(),array("IBLOCK_ID"=>88,"ID"=>$ID), false, false, array("ID","NAME", "CODE","IBLOCK_SECTION_ID","PROPERTY_UNC", "PROPERTY_SIZE","PROPERTY_FIRM","PROPERTY_WARRANTY","DATE_CREATE"));
                $arElement = $Element->Fetch();

                $arElement["DETAIL_PAGE_URL"] = "/catalog/".$arElement["IBLOCK_SECTION_ID"]."/".$arElement["ID"]."/";

                //получаем цену товара с указанным ид с учетом текущего поддомена
                $newval=getPriceForId($arElement["ID"]);  //описание в init.php

                /*$arElement["PRICES"]["PRICE_1"] = CPrice::GetBasePrice($arElement["ID"]);
                $arElement["PRICES"]["PRICE_1"]["PRICE"] = CCurrencyRates::ConvertCurrency($arElement["PRICES"]["PRICE_1"]["PRICE"], "USD", "RUR");
                $arElement["PRICES"]["PRICE_1"]["CURRENCY"] = "RUR";*/
                // $ar_res=CCatalogProduct::GetByID($arElement['ID']);

                //проверяем дату создания
                $dateCreate = explode(".", substr($arElement["DATE_CREATE"],0,10));
                $curDate = date("U"); //текущая дата
                $dif = 86400 * 30; //30 дней
                $dateCreateLabel = mktime(0,0,0,$dateCreate[1],$dateCreate[0],$dateCreate[2]);  //метка времени даты создания

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


                <td <?if (($curDate - $dateCreateLabel) < $dif) {?> class="catalog_section_item_new_label"<?}?>><?=$arElement['CODE']?></td>
                <td><?
                        $oem = str_replace("/","<br>",$arElement['PROPERTY_UNC_VALUE']);
                        $oem = str_replace("+","<br>+",$oem);
                    ?>
                    <?=trim($oem)?>
                </td>
                <td><?=$arElement['PROPERTY_SIZE_VALUE']?></td>
                <td>

                    <div class="forward_catalog_new_link_container">
                        <a  href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement['NAME']?>"><?echo $arElement['NAME'];?></a>
                    </div>
                    <?if ($arElement['PROPERTY_FIRM_VALUE'] || $arElement['PROPERTY_WARRANTY_VALUE']){?>
                        <div class="forward_catalog_new_firm">
                            <?//получаем название производителя   
                                if ($USER->IsAuthorized()) {
                                    $firm = CIBlockElement::GetById($arElement['PROPERTY_FIRM_VALUE']);
                                    $arFirm = $firm->Fetch();
                                ?>
                                <?=$arFirm["NAME"]?><?if ($arElement['PROPERTY_WARRANTY_VALUE']){?>, <?=$arElement['PROPERTY_WARRANTY_VALUE']?><?}?>
                                <?}?>
                        </div>
                        <?}?>
                </td>
                <td><div class="cbox <?if (in_array($arElement["ID"],$_SESSION["COMPARE"])){echo "cbox_c";}?>" onclick="check_compare(<?=$arElement["ID"]?>)"></div></td>
                <td><?=ceil($newval)?></td>
                <td id="last_cell_<?=$arElement["ID"]?>">
                    <?global $this_count; $this_count = 0;?>
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "cat_q_list", 
                            array(
                                "PER_PAGE" => "10",
                                "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
                                "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
                                "USE_MIN_AMOUNT" => "N",
                                "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                                "ELEMENT_ID" => $arElement["ID"],
                                "STORE_PATH" => $arParams["STORE_PATH"],
                                "MAIN_TITLE" => $arParams["MAIN_TITLE"],
                                "STORES" => array(
                                    0 => "1",
                                    1 => "2",
                                    2 => "3",
                                    3 => "4",
                                ),
                                "ELEMENT_CODE" => "",
                                "CACHE_TYPE" => "N",
                                "CACHE_TIME" => "36000",
                                "USER_FIELDS" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "FIELDS" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "SHOW_EMPTY_STORE" => "Y",
                                "SHOW_GENERAL_STORE_INFORMATION" => "N"
                            ),
                            $component
                        );?>

                    <? if ($this_count > 0) { //если товар в наличии на текущем складе?>
                        <input type="hidden" id="item_name_<?=$arElement["ID"]?>" value="<?=$arElement['NAME']?>">
                        <input type="hidden" id="item_price_<?=$arElement["ID"]?>" value="<?=ceil($newval)?>">
                        <input type="hidden" id="item_code_<?=$arElement["ID"]?>" value="<?=$arElement['CODE']?>">
                        <input type="hidden" id="item_year_<?=$arElement["ID"]?>" value="<?=$arElement['PROPERTY_SIZE_VALUE']?>">
                        <input type="hidden" id="item_count_<?=$arElement["ID"]?>" value="<?=$this_count?>">
                        <?
                            if (in_array($arElement["ID"],$arBasketItemsIDs)) {
                                $in_basket = "Y";
                            }
                            else {$in_basket = "N";}

                            if ($in_basket == "N") {
                            ?>
                            <a onclick="showcatdet('<?=$arElement["ID"]?>',<?=$this_count?>)" href="javascript:void(0)" title="добавить в корзину"><div class="forward_catalog_new_buy"></div></a>
                            <?/*<a onclick="showcatdet('<?=$arElement["ID"]?>')" href="<?=$arElement["ADD_URL"]?>"><span style="color:Green;">КУПИТЬ</span></a>*/?>
                            <?} else {?>
                            <span class="forward_catalog_new_in_b"><a href='/personal/basket.php' title="корзина">В корзине</a></span>
                            <?}?>

                        <?} else { // если нет в наличии?>
                        <?/*<div class="forward_catalog_new_na" onmouseover="check_delivery_date(<?=$arElement["ID"]?>,'<?=$arElement["CODE"]?>')" title="товара нет в наличии">Нет в наличии
                            <div class="forward_catalog_new_date">
                            <div class="forward_catalog_new_arr_tail2"></div>
                            <div class="forward_catalog_new_date_h">Ожидаемое<br>поступление: <span class="forward_catalog_new_date_t" id="deliv_date_<?=$arElement["ID"]?>">...</span>
                            </div>

                            </div>
                        </div>*/?>
                        <div class="catalog_basket_na" title="товара нет в наличие"></div> 
                        <?}?>
                </td>

                <td class="catalog_item_info_cell" id="item_info_<?=$arElement["ID"]?>" title="Нажмите, чтобы посмотреть количество на складах">
                    <div class="catalog_info_container">
                        <div class="warehouses_popup whp_<?=$arElement["ID"]?>"></div>
                    </div>
                </td>


            </tr>



            <?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>


    </table>
    </div>
    </div>
    </div>
    </span>
<?
}

$frame->end();?>