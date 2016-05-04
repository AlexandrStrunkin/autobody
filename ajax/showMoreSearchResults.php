<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $arBasketItemsIDs = getCurrentBasket();    
    $pattern = "/(\W)/u";


    //---- block for searching in names

    $patternForNonWord = "/([^a-zA-Z\sа-яА-Я0-9])/u";
    $patternForMultWhitespace = "/(\s{2,})/u";
    $patternForSearch = "/(\s{1,})/u";

    $nameSearch = $_POST['search_param'];
    $nameSearch = preg_replace($patternForNonWord,"",$nameSearch);
    $nameSearch = preg_replace($patternForMultWhitespace," ",$nameSearch);
    $nameSearch = preg_replace($patternForSearch," && ",$nameSearch); // --- данная замена всех пробелов на && позволяет сделать поиск независимым от порядка слов
    
                switch($_POST['filter_by']){
                    case 1: $arFilter = array("IBLOCK_ID"=>88,">ID"=>$_POST['last_item'],"PROPERTY_SEARCH_CODE"=>"%".preg_replace($pattern,"",$_POST['search_param'])."%");
                            $arOrder = array("ID"=>"ASC"); 
                        break;
                    case 2: $arFilter = Array("IBLOCK_ID"=>88,">ID"=>$_POST['last_item'],"?NAME"=>$nameSearch);
                            $arOrder = array("ID"=>"ASC");
                        break;
                    case 3: $arFilter = array("IBLOCK_ID"=>88,">ID"=>$_POST['last_item'],array("LOGIC"=>"OR",array("PROPERTY_SEARCH_WARRANTY"=>"%".preg_replace($pattern,"",$_POST['search_param'])."%"),array("PROPERTY_CROSS_NUM"=>"%".trim($_POST['search_param'])."%")));
                            $arOrder = array("ID"=>"ASC");
                        break;
                    case 4 :$arFilter = array("IBLOCK_ID"=>88,">ID"=>$_POST['last_item'],"PROPERTY_SEARCH_UNC"=>"%".preg_replace($pattern,"",$_POST['search_param'])."%");
                            $arOrder = array("ID"=>"ASC");
                        break;
                } 

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
     <?}?>
     
     <?if($res->SelectedRowsCount()>20){?>
                   <tr data-search-param="<?=htmlspecialcharsbx($_POST['search_param'])?>" data-filter-by="<?=htmlspecialcharsbx($_POST['filter_by'])?>" data-last-item-id="<?=$arFields["ID"]?>" class="search-field-name showMoreSearchResults">
                        <td colspan="9">
                            <b><? print_r("Показать еще"); ?></b>
                        </td>
                    </tr>
     <?}?>
