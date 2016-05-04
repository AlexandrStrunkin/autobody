<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>


<?$arBasketItemsIDs = getCurrentBasket();    
    $pattern = "/(\W)/u";


    //---- block for searching in names

    $patternForNonWord = "/([^a-zA-Z\sа-яА-Я0-9])/u";
    $patternForMultWhitespace = "/(\s{2,})/u";
    $patternForSearch = "/(\s{1,})/u";

    $nameSearch = $_GET['q'];
    $nameSearch = preg_replace($patternForNonWord,"",$nameSearch);
    $nameSearch = preg_replace($patternForMultWhitespace," ",$nameSearch);
    $nameSearch = preg_replace($patternForSearch," && ",$nameSearch); // --- данная замена всех пробелов на && позволяет сделать поиск независимым от порядка слов


    $arFilter = array(
        "IBLOCK_ID"=>88,
        array(
            "LOGIC" => "OR",
            array("PROPERTY_SEARCH_CODE"=>"%".preg_replace($pattern,"",$_GET['q'])."%"),
            array("?NAME"=>$nameSearch),
            array("PROPERTY_SEARCH_WARRANTY"=>"%".preg_replace($pattern,"",$_GET['q'])."%"),
            array("PROPERTY_CROSS_NUM"=>"%".trim($_GET['q'])."%"),
            array("PROPERTY_SEARCH_UNC"=>"%".preg_replace($pattern,"",$_GET['q'])."%"),
        )
    );

    $arSelect = Array('ID','CODE','NAME','DATE_CREATE','DETAIL_PAGE_URL','PROPERTY_UNC_VALUE','PROPERTY_SIZE_VALUE','PROPERTY_FIRM_VALUE','PROPERTY_WARRANTY_VALUE');
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
    $ob = $res->GetNextElement();

    if(!empty($arFilter) && !empty($_GET['q']) && !empty($_GET['p']) && !empty($ob)){?>

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
            for ($i = 1; $i<=4; $i++) {  

                switch($i){
                    case 1: $arFilter = array("IBLOCK_ID"=>88,"PROPERTY_SEARCH_CODE"=>"%".preg_replace($pattern,"",$_GET['q'])."%");
                            $arOrder = array("ID"=>"ASC"); 
                        break;
                    case 2: $arFilter = Array("IBLOCK_ID"=>88,"?NAME"=>$nameSearch);
                            $arOrder = array("ID"=>"ASC");
                        break;
                    case 3: $arFilter = array("IBLOCK_ID"=>88,array("LOGIC"=>"OR",array("PROPERTY_SEARCH_WARRANTY"=>"%".preg_replace($pattern,"",$_GET['q'])."%"),array("PROPERTY_CROSS_NUM"=>"%".trim($_GET['q'])."%")));
                            $arOrder = array("ID"=>"ASC");
                        break;
                    case 4 :$arFilter = array("IBLOCK_ID"=>88,"PROPERTY_SEARCH_UNC"=>"%".preg_replace($pattern,"",$_GET['q'])."%");
                            $arOrder = array("ID"=>"ASC");
                        break;
                }

                $res = CIBlockElement::GetList($arOrder, $arFilter, false, Array("nPageSize"=>20), $arSelect);
                $ob = $res->GetNextElement();    

            ?>

            <?
                switch($i){
                    case 1:if (!empty($ob)) { ?>
                    <tr class="search-field-name">
                        <td colspan="9">
                            <b><? print_r("Найденные товары по артикулу"); ?></b>
                        </td>
                    </tr>
                    <? } else {
                    };
                    break;
                    case 2:if (!empty($ob)) { ?>
                    <tr class="search-field-name">
                        <td colspan="9">
                            <b><? print_r("Найденные товары по наименованию"); ?></b>
                        </td>
                    </tr>
                    <? } else {
                    };
                    break;
                    case 3:if (!empty($ob)) { ?>
                    <tr class="search-field-name">
                        <td colspan="9">
                            <b><? print_r("Найденные товары по номеру производителя"); ?></b>
                        </td>
                    </tr>
                    <? } else {
                    };
                    break;
                    case 4:if (!empty($ob)) { ?>
                    <tr class="search-field-name">
                        <td colspan="9">
                            <b><? print_r("Найденные товары по ОЕМ"); ?></b>
                        </td>
                    </tr>
                    <? } else {
                    };
                    break;
                }   

                if ($not_found==4) {print_r("По вашему запросу ничего не найдено.");}

            ?>



            <?
                $arSelect = Array('ID','CODE','NAME','DATE_CREATE','DETAIL_PAGE_URL','PROPERTY_UNC_VALUE','PROPERTY_SIZE_VALUE','PROPERTY_FIRM_VALUE','PROPERTY_WARRANTY_VALUE');
                $res = CIBlockElement::GetList($arOrder, $arFilter, false, Array("nPageSize"=>20), $arSelect);
                
                while($ob = $res->GetNextElement())
                {
                    $arFields = $ob->GetFields();
                    $arProps = $ob->GetProperties();
                    $ar_res = GetCatalogProductPriceList($arFields["ID"],array(),array());

                    //получаем цену товара с указанным ид с учетом текущего поддомена                    
                    $newval = getPriceForId($arFields["ID"]); //описание в init.php
                ?>
                <tr>
                    <td>
                        <?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arFields['CODE'].".jpg")) {
                                $img_path = "/upload/images/".$arFields['CODE'].".jpg";
                            } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arFields['CODE'].".JPG")) {
                                $img_path = "/upload/images/".$arFields['CODE'].".JPG";
                            } else {
                                $img_path = "";
                            }

                            if ($img_path != ""){?>
                            <a property="url" href="<?=$img_path?>" class="fancybox" title="<?=$arFields["NAME"]?>">
                                <div property="image" class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото"></div>
                            </a>
                            <?} else {?>
                            <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                            <?}?>
                    </td>

                    <?
                        $dateCreate = explode(".", substr($arFields["DATE_CREATE"],0,10));
                        $curDate = date("U"); //текущая дата
                        $dif = 86400 * 30; //30 дней
                        $dateCreateLabel = mktime(0,0,0,$dateCreate[1],$dateCreate[0],$dateCreate[2]);  //метка времени даты создания
                    ?>

                    <td  <?if (($curDate - $dateCreateLabel) < $dif) {?> class="catalog_section_item_new_label"<?}?>><?=$arFields['CODE']?></td>
                    <td><?
                            $oem = str_replace("/","<br>",$arProps['UNC']['VALUE']);
                            $oem = str_replace("+","<br>+",$oem);
                        ?>
                        <?=trim($oem)?>
                    </td>
                    <td><?=$arProps['SIZE']['VALUE']?></td>
                    <td>

                        <div class="forward_catalog_new_link_container" vocab="http://schema.org/" typeof="Product">
                            <a property="url" href="<?=$arFields["DETAIL_PAGE_URL"]?>" title="<?=$arFields['NAME']?>"><?echo $arFields['NAME'];?></a>
                        </div>
                        <?if ($arProps['FIRM']['VALUE'] || $arProps['WARRANTY']['VALUE']){?>
                            <div class="forward_catalog_new_firm">    
                                <?//получаем название производителя   
                                    if ($USER->IsAuthorized()) {
                                        $firm = CIBlockElement::GetById($arProps['FIRM']['VALUE']);
                                        $arFirm = $firm->Fetch();
                                    ?>
                                    <?=$arFirm["NAME"]?><?if ($arProps['WARRANTY']['VALUE']){?>, <?=$arProps['WARRANTY']['VALUE']?><?}?>
                                    <?}?>
                            </div>
                            <?}?>
                    </td>
                    <td><div class="cbox <?if (in_array($arFields["ID"],$_SESSION["COMPARE"])){echo "cbox_c";}?>" onclick="check_compare(<?=$arFields["ID"]?>)"></div></td>
                    <td><span property="highPrice"><?=ceil($newval)?></span></td>
                    <td id="last_cell_<?=$arFields["ID"]?>">
                        <?global $this_count; $this_count = 0;?>
                        <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "cat_q_list", 
                                array(
                                    "PER_PAGE" => "10",
                                    "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
                                    "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
                                    "USE_MIN_AMOUNT" => "N",
                                    "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                                    "ELEMENT_ID" => $arFields["ID"],
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
                            <input type="hidden" id="item_name_<?=$arFields["ID"]?>" value="<?=$arFields['NAME']?>">
                            <input type="hidden" id="item_price_<?=$arFields["ID"]?>" value="<?=ceil($newval)?>">
                            <input type="hidden" id="item_code_<?=$arFields["ID"]?>" value="<?=$arFields['CODE']?>">
                            <input type="hidden" id="item_year_<?=$arFields["ID"]?>" value="<?=$arProps['SIZE']['VALUE']?>">
                            <input type="hidden" id="item_count_<?=$arFields["ID"]?>" value="<?=$this_count?>">
                            <?
                                if (in_array($arFields["ID"],$arBasketItemsIDs)) {
                                    $in_basket = "Y";
                                }
                                else {$in_basket = "N";}

                                if ($in_basket == "N") {
                                ?>
                                <a onclick="showcatdet('<?=$arFields["ID"]?>',<?=$this_count?>)" href="javascript:void(0)" title="добавить в корзину"><div class="forward_catalog_new_buy"></div></a>
                                <?} else {?>
                                <span class="forward_catalog_new_in_b" ><a href='/personal/basket/' title="корзина">В корзине</a></span>
                                <?}?>

                            <?} else { // если нет в наличии?>

                            <div class="catalog_basket_na" title="товара нет в наличие"></div> 
                            <?}?>
                    </td>

                    <td class="catalog_item_info_cell" id="item_info_<?=$arFields["ID"]?>" title="Нажмите, чтобы посмотреть количество на складах">
                        <div class="catalog_info_container">
                            <div class="warehouses_popup whp_<?=$arFields["ID"]?>"></div>
                        </div>
                    </td>

                </tr>
                <?}
                    if($res->SelectedRowsCount()>20){?>
                   <tr data-search-param="<?=htmlspecialcharsbx($_GET['q'])?>" data-filter-by="<?=$i?>" data-last-item-id="<?=$arFields["ID"]?>" class="search-field-name showMoreSearchResults">
                        <td colspan="9">
                            <b><? print_r("Показать еще"); ?></b>
                        </td>
                    </tr>
                    <?}
            ?> 
            <?
            }
        ?> 
    </table>

    <?
        $navStr = $res->GetPageNavStringEx($navComponentObject, "Страницы:", ".default");
        //        echo $navStr;
    } else{
        echo 'По вашему запросу ничего не найдено.';
    }
?>

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
    
    // ---- ShowMore Button Handler
    $(document).ready(function(){
    $('body').on('click','.showMoreSearchResults',function(){
            prevResultRow = $(this).prev();
            showMoreButton = $(this);
            $.post("/ajax/showMoreSearchResults.php", {
                filter_by : $(this).data('filter-by'),
                search_param : $(this).data('search-param'),
                last_item : $(this).data('last-item-id')
            }, function(data) {
                $(data).insertAfter(prevResultRow);
                showMoreButton.remove();
            });
        })
    })
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

 