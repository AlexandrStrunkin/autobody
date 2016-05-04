<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    if (!$arResult['PROPERTIES']['TITLE']['VALUE']) {
        $arResult['PROPERTIES']['TITLE']['VALUE'] = $arResult["NAME"]." - купить оптом со склада в Москве, Омске, Санкт-Петербурге, Екатеребурге - ".$arResult["CODE"];
    }

    if (!$arResult['PROPERTIES']['DESCR']['VALUE']) {
        $arResult['PROPERTIES']['DESCR']['VALUE'] =  "Выгодные цены на ".$arResult["NAME"].": оптом в интернет магазине 8 (800) 707-78-13. Доставка в Москву, Екатеринбург, Омск, Санкт-Питербург - ".$arResult["CODE"]; 
    }

    if (!$arResult['PROPERTIES']['KEYWORDS']['VALUE']) {
        $arResult['PROPERTIES']['KEYWORDS']['VALUE'] = "купить ".$arResult["NAME"].", цена, оптом, Москва, Санкт-питербург, Омск, Екатеринбург "; 
    }

    $PRICE_CODE = $arParams["PRICE_CODE"][0]; 

    $APPLICATION->SetPageProperty("keywords", $arResult['PROPERTIES']['KEYWORDS']['VALUE']);
    $APPLICATION->SetPageProperty("title", $arResult['PROPERTIES']['TITLE']['VALUE']);
    $APPLICATION->SetPageProperty("description", $arResult['PROPERTIES']['DESCR']['VALUE']);
?>



<div class="detail" vocab="http://schema.org/" typeof="Product">      


    <?//arshow($arResult);
        if ($_REQUEST["action"]) { header("location: /catalog/".$arResult["SECTION"]["ID"]."/".$arResult["ID"]."/");}
    ?>
    <? //echo '<div style="color:black"><pre>'; print_r($arResult); echo '</pre></div>';?>
    <? $arItem['ID'] = $arResult['ID'];?>
    <link href="/css/shadowbox.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="/js/shadowbox.js"></script>
    <script>
        $(document).ready(function(){
            Shadowbox.init({
                displayCounter: false,
                fadeDuration: 0.1,
                resizeDuration: 0.1,
                viewportPadding: 0
            });

        })

        function get_cur_q(item) {
            var cur_q = $("#qw").attr("value");
            document.location.href = "<?=$APPLICATION->GetCurPage()?>?action=add_basket_item&id=<?=$arItem['ID']?>&item_id=<?=$arItem['ID']?>&quantity=" + cur_q + "&clear_cache=Y";
        }


        //обновление кнопок при добавлении в корзину
        function status_change() {
            $(".inbasket").remove();
            $(".buts").prepend('<div class="catalog_card_in_basket"><a href="/personal/basket/" title="Перейти в корзину">в корзине</a></div>');
        }
    </script>

    <script>
        $(function(){
            //обработка кнопки сравнения
            $(".addtocompare").click(function(){
                if ($(this).hasClass("in_compare")) {
                    $(this).removeClass("in_compare");
                    $(this).html("Добавить к сравнению");
                }
                else {
                    $(this).addClass("in_compare");
                    $(this).html("Убрать из сравнения");
                }
            })
        })
    </script>

    <script type="text/javascript">

        document.write(VK.Share.button({
            url: "<?echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>",
            title: "<?=$arResult["NAME"]?>",
            description: '<?=$arResult["NAME"]?>',
            image: "<?=$_SERVER["HTTP_HOST"]?>/logo-image.png",
            noparse: true
        }));

    </script>

    <h1 class="name"><?=$arResult["NAME"]?></h1>
    <form id="main_form" method="POST" action="?item_id=<?=$arResult['ID']?>">

        <?global $this_count; ?>      

        <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "cat_q_list", 
                array(
                    "PER_PAGE" => "10",
                    "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
                    "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
                    "USE_MIN_AMOUNT" => "N",
                    "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                    "ELEMENT_ID" => $arResult["ID"],
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
            <input type="hidden" id="idm" value="<?=$arResult["ID"]?>">
            <input type="hidden" id="item_price_<?=$arResult["ID"]?>" value="<?=ceil($arResult["PRICES"][$PRICE_CODE]["VALUE_NOVAT"])?>">
            <input type="hidden" id="item_count_<?=$arResult["ID"]?>" value="<?=$this_count?>">
            <?}?>


        <input type="hidden" name="basket_action" value="add">
        <input type="hidden" name="price_id">


        <?
            //проверяем дату создания
            $dateCreate = explode(".", substr($arResult["DATE_CREATE"],0,10));
            $curDate = date("U"); //текущая дата
            $dif = 86400 * 30; //30 дней
            $dateCreateLabel = mktime(0,0,0,$dateCreate[1],$dateCreate[0],$dateCreate[2]);  //метка времени даты создания
        ?>




        <table>
            <tr>
                <td width="365">
                    <div class="photo">

                        <?
                            if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arResult['CODE'].".jpg")) {$img_path = "/upload/images/".$arResult['CODE'].".jpg";}
                            else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arResult['CODE'].".JPG")) {$img_path = "/upload/images/".$arResult['CODE'].".JPG";}
                                else {$img_path = "/i/nofoto.png"; }
                        ?>
                        <?if ($img_path != "/i/nofoto.png"){?>
                            <a href="<?=$img_path?>" class="fancybox" title="<?=$arResult["NAME"]?>">
                                <img property="image" class="detimg" src="<?=$img_path;?>" title="Кликните, чтобы посмотреть картинку в полном размере" alt=<?=$arResult["NAME"]?>/>
                            </a>
                            <?} else {?>
                            <img property="image" class="detimg" src="<?=$img_path;?>" />
                            <?}?>

                        <?/*if ($img_path == "/i/nofoto.png"){?>
                            <div class="ownfoto"><a href="/ajax/new_foto.php?art=<?=$arResult['CODE']?>" rel="shadowbox;height=300;width=500">Предложить свое фото</a></div>
                        <?}*/?>

                    </div>
                </td>
                <td>
                    <div class="price-cart">
                        <div class="title">ЦЕНА</div>
                        <div class="deliter"></div>
                        <div class="price"><?=ceil($arResult["PRICES"][$PRICE_CODE]["VALUE_NOVAT"])?> <font class="rouble">c</font></div>


                        <table class="table-favor-comp">
                            <tr>
                                <?
                                  if($USER->IsAuthorized()){
                                ?>
                                <td>
                                    <?$el_list=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>117, 'PROPERTY_ELEMENT_ID'=>$arResult["ID"],'PROPERTY_USER_ID'=>$USER->GetID()),false,false,array('ID', 'PROPERTY_ELEMENT_ID'));?>       
                                    <?$relElem = $el_list->Fetch();?>
                                    <div class="favorite_in_card manage_favotite" <?if($relElem){?> style="background-position:100% 0" data-related-element="<?=$relElem['ID']?>" data-delete-el="Y" title="Удалить из избранного" <?} else{?>title="Добавить в избранное"<?}?> id="<?=$arResult["ID"]?>" data-action-from="public" data-elem-type="82" ></div>
                                </td>
                                <?}?>
                                <td><div class="favor-comp">  
                                        <?if(in_array($arResult["ID"],$_SESSION["COMPARE"])){$text = "Убрать из сравнения";} else {$text = "Добавить к сравнению";}?>
                                        <a class="addtocompare <?if(in_array($arResult["ID"],$_SESSION["COMPARE"])){?>in_compare<?}?>" href="javascript:check_compare(<?=$arResult["ID"]?>)"><?=$text?></a>                              
                                    </div>

                                </td>
                                <td id="add_vk"></td>
                            </tr>
                        </table> 
                        <?//получаем количество на текущем складе
                            $item_quantity = GKCommon::GetItemsCountForWarehouse(GKCommon::GetSavedWarehouse(),$arResult['CODE']);
                        ?> 
                        <div class="tovcall">
                            <input type="hidden" id="catqwm" value="<?=$item_quantity["COUNT"]?>">
                            <div class="card_q_change" onClick="if (Number($('#qw').val())>1){$('#qw').val(Number($('#qw').val())-1);}">-</div>
                            <input class="quant" property="offerCount" type="text" name="quantity" id="qw" disabled value="1" onkeyup=" if($(this).attr('value')<=0) this.value=1; else if($(this).attr('value')>Number($('#catqwm').val())) { this.value=Number($('#catqwm').html()); } ;"/>
                            <div class="card_q_change" onClick="if (Number($('#qw').val())<Number($('#catqwm').val()))$('#qw').val(Number($('#qw').val())+1); ">+</div>
                        </div>     
                        <?
                            //проверяем корзину пользователя.
                            //если текущий товар уже есть в корзине, то вместо кнопки добавления выводим соответствующее сообщение
                            $arBasketItemsIDs = getCurrentBasket();  //массив ID товаров, которые в корзине на данный момент                         

                        ?>
                        
                        

                        <div class="buts">
                            <?
                                //проверяем наличие детали по всем складам, если есть на текущем складе - выводим кнопку в корзину
                                //                                arshow($this_count);

                                if ($this_count > 0) {
                                    if (in_array($arResult["ID"], $arBasketItemsIDs)) {?>
                                    <div class="catalog_card_in_basket"><a href="/personal/basket/" title="Перейти в корзину">в корзине</a></div>
                                    <?} else {?>
                                    <a class="inbasket active button" href="javascript:add2basket(); status_change()" >в корзину</a>
                                    <?}?>
                                <?} else {?>
                                <div class="catalog_card_no_item">нет в наличии</div>
                                <?}?>
                                
                        </div>


                    </div>
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <div>
                        <div class="tech-title">ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ</div>
                        <table class="tech">
                            <tr class="tr1">
                                <td>Артикул</td>
                                <td><?=$arResult['CODE']?></td>
                            </tr>
                            <?if ($val = $arResult['PROPERTIES']['UNC']['VALUE']):?>
                                <tr class="tr2">
                                    <td>ОЕМ#</td>
                                    <td><?=$val?></td>
                                </tr>
                                <?endif?>
                            <?if ($val = $arResult['PROPERTIES']['COUNTRY']['VALUE']):?>
                                <tr class="tr1">
                                    <td>№ производителя</td>
                                    <td><?=$val?></td>
                                </tr>
                                <?endif?>

                            <?if ($val = $arResult['PROPERTIES']['SIZE']['VALUE']):?>
                                <tr class="tr2">
                                    <td>Год</td>
                                    <td><?=$val;?></td>
                                </tr>
                                <?endif?>

                            <?if ($val = $arResult['PROPERTIES']['FIRM']['VALUE']):?>
                                <tr class="tr2">
                                    <td>Производитель</td>
                                    <?//получаем производителя
                                        $manufacturer = CIBLockElement::GetById($val);
                                        $arMan = $manufacturer->Fetch();
                                    ?>
                                    <td><?=$arMan["NAME"];?></td>
                                </tr>
                                <?endif?>


                            <?if ($val = $arResult['PROPERTIES']['WARRANTY']['VALUE']):?>
                                <tr class="tr2">
                                    <td>Номер производителя</td>
                                    <td><?=$val;?></td>
                                </tr>
                                <?endif?>

                            <tr class="tr2">
                                <td>Группа</td>
                                <td><a href="<?=$arResult['SECTION']['SECTION_PAGE_URL']?>"><?=$arResult['SECTION']['NAME']?></a></td>
                            </tr>

                        </table>
                    </div>    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div>
                        <div class="tech-title">
                            НАЛИЧИЕ НА СКЛАДАХ 
                            <div class="relevance_residues_element"><p>Актуальность остатков на <span><?=$date_ubdate = GKCommon::GetLastUpdateDate();?> </span></p></div>
                        </div>
                        <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "item_amount_redesign",
                                array(
                                    "PER_PAGE" => "10",
                                    "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
                                    "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
                                    "USE_MIN_AMOUNT" => "N",
                                    "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                                    "ELEMENT_ID" => $arResult["ID"],
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



                    </div>
                </td>
            </tr>
        </table>


    </form>






    <?/*
        <div class="reviews">
        <div class="name">Отзывы</div>
        <?if ($USER->isAuthorized()) {?>
        <?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "review_add", array(
        "IBLOCK_TYPE" => "info",
        "IBLOCK_ID" => "97",
        "STATUS_NEW" => "2",
        "LIST_URL" => "",
        "USE_CAPTCHA" => "N",
        "USER_MESSAGE_EDIT" => "",
        "USER_MESSAGE_ADD" => "Ваш отзыв добавлен, спасибо! После проверки он будет опубликован.",
        "DEFAULT_INPUT_SIZE" => "30",
        "RESIZE_IMAGES" => "N",
        "PROPERTY_CODES" => array(
        0 => "NAME",
        1 => "344",
        2 => "342",
        3 => "343",
        ),
        "PROPERTY_CODES_REQUIRED" => array(
        0 => "NAME",
        1 => "344",
        ),
        "GROUPS" => array(
        0 => "2",
        ),
        "STATUS" => array(
        ),
        "ELEMENT_ASSOC" => "CREATED_BY",
        "MAX_USER_ENTRIES" => "100000",
        "MAX_LEVELS" => "100000",
        "LEVEL_LAST" => "Y",
        "MAX_FILE_SIZE" => "0",
        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
        "SEF_MODE" => "N",
        "SEF_FOLDER" => "/",
        "CUSTOM_TITLE_NAME" => "Ваше имя",
        "CUSTOM_TITLE_TAGS" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
        "CUSTOM_TITLE_PREVIEW_TEXT" => "",
        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
        "CUSTOM_TITLE_DETAIL_TEXT" => "",
        "CUSTOM_TITLE_DETAIL_PICTURE" => ""
        ),
        false
        );?>
        <hr>
        <?}?>
        </div>



        <?
        $review_list = CIBlockElement::GetList(Array(),array("IBLOCK_ID"=>97,"PROPERTY_PRODUCT"=>$arResult['ID'],"ACTIVE"=>"Y"),false,false,Array("IBLOCK_ID","NAME","PROPERTY_TEXT","PROPERTY_TEMPER","PROPERTY_PRODUCT"));
        while ($review = $review_list->Fetch()) {?>
        <?//arshow($review)?>
        <h3 style="font-size:16px; font-weight: bold;"><?=$review["NAME"]?></h3>
        <p>Характер: <b><?=$review["PROPERTY_TEMPER_VALUE"]?></b><br>
        <i> - <?=$review["PROPERTY_TEXT_VALUE"]?></i>
        </p>
        <hr>
        <?}?>


    */?>

</div>
<?//arshow($arResult)?>
