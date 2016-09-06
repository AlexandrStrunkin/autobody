<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    /*
    $APPLICATION->SetTitle("Сравнение товаров");?>
    <?if($_GET["action"] == "add_basket_item") {
    header("location: /personal/basket.php");
    }?>
    <?
    if ($_GET["unset_from_compare"])  {
    foreach ($_SESSION['OSG']['USER']['CATALOG_COMPARE'] as $compare_id=>$compare_arr){
    foreach ($compare_arr as $id=>$val) {
    if ($id == $_GET["unset_from_compare"]) {
    unset($_SESSION['OSG']['USER']['CATALOG_COMPARE'][$compare_id][$id]);
    break;
    }
    }
    }
    //unset($_SESSION['OSG']['USER']['CATALOG_COMPARE'][$_GET["unset_from_compare"]]);
    }
    ?>
    <?$APPLICATION->IncludeComponent("osg:catalog.compare", "compare_big_new", Array(
    "URL_NO_PREVIEW_PICTURE" => "images/no_preview_picture.gif",    // URL отсутствующего изображения анонса
    "TITLE_NO_VALUE" => "нет данных",    // Подпись отсутствующего значения свойства
    "DELIMITER" => "<br />",    // Разделитель для множественного значения свойства
    "PROPS_BLACK_LIST" => array(    // Список свойств, не учавствующих в сравнении
    0 => "DESCRIPTION",
    1 => "UNIT",
    2 => "CONSIGNMEN",
    3 => "RESERV",
    4 => "MAX_ORDER",
    5 => "OPT_QUANTITY",
    6 => "OPT_QUANTITY_INC",
    7 => "OPT_PRICE",
    8 => "OPT_PRICE_INC",
    9 => "SPEC_OFFER",
    10 => "ADD_GOODS",
    11 => "ADD_IMAGES",
    12 => "MAIN_SECTION",
    )
    ),
    false
    );*/
?>

<meta name="robots" content="noindex">

<?
    //если в сравнении есть товары, выводим всплывающее окно внизу
    if (count($_SESSION["COMPARE"]) > 0) { ?>
    <script>
        $(function(){
            $(".catalog_compare_hidden_block").fadeIn(500);
        })
    </script>
    <?}?>
<?
    //если в истории есть товары, выводим всплывающее окно внизу
    if (count($_SESSION["CATALOG_HISTORY"]) > 0) { ?>
    <script>
        $(function(){
            $(".catalog_history_hidden_block").fadeIn(500);
        })
    </script>
    <?}?>
<!--<div class="warring">ВНИМАНИЕ! Цена в каталоге указана &mdash; ОПТОВАЯ. Розничные цены на 50 % выше.
<br />
Оптовые цены только для ОПТОВЫХ покупателей, зарегистрированных и имеющих клиентский номер. Зарегистрироваться можно <a href="/personal/" >здесь</a>.</div>-->



<?
    if (count($_SESSION["CATALOG_HISTORY"]) > 0)  {?>
    <div class="name">Вы смотрели: </div>
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


        <?foreach($_SESSION["CATALOG_HISTORY"] as $ID):
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


    <script>
        function showcatdet(ID,quantity)
        {
            $('#dialog').jqmShow();
            $("#catnamem").html($("#item_name_"+ID).val());
            $("#catpricem").html($("#item_price_"+ID).val());
            $("#catartm").html($("#item_code_"+ID).val());
            $("#catyearm").html($("#item_year_"+ID).val());
            $("#catqwm").html($("#item_count_"+ID).val())
            $("#qw").val(1);
            $("#idm").val(ID);
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


            <input type="hidden" name="id" id="idm" value=""/>


            <div class="modtitle">Добавление товара в корзину</div>
            <table>
                <tr class="begin white">
                    <td width="100">Вы выбрали:</td>
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
                    <td>
                        <?
                            $wh = GKCommon::GetWarehouseByID(GKCommon::GetSavedWarehouse());
                            echo $wh;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Количество, шт.</td>
                    <td>
                        <span style="display: none;" id="catqwm"></span>
                        <input type="button" class="minus" value="-" onClick="if (Number($('#qw').val())>1){$('#qw').val(Number($('#qw').val())-1);}" />
                        <input type="text" name="quantity" class="small" id="qw" value="1" onkeyup="if($(this).attr('value')<=0) this.value=1 return false; if($(this).attr('value')>Number($('#catqwm').val())) {alert('Такого кол-ва товара нет на складе'); this.value=Number($('#catqwm').html()); }" />
                        <input type="button" class="plus" value="+" onClick="if (Number($('#qw').val())<Number($('#catqwm').html()))$('#qw').val(Number($('#qw').val())+1);"/>
                        <a href="javascript:add2basket();" class="modalsave">Добавить</a>
                    </td>
                </tr>

            </table>

        </form>
    </div>


    <?}else {
    ?>
    В истории нет товаров.
    <?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>