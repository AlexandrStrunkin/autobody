<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Новые товары");
?> 

    <script>
        $(function(){
            var allNewItemsHeaders = document.querySelectorAll(".new_item_header");
            Array.prototype.forEach.call(allNewItemsHeaders, function(el, i){
                el.addEventListener("click",function(e){
                    var blockHeader;
                    e.target.classList.contains("open_close_arrow") ? blockHeader = e.target.parentElement : blockHeader = e.target;
                    var relatedList = blockHeader.nextElementSibling;
                    if(parseInt(relatedList.style.height)){
                        relatedList.style.height = "0";
                        relatedList.parentElement.style.boxShadow = "0px 0px 3px 0px rgba(0,0,0,0.25)";
                        relatedList.style.overflow = "hidden";
                        blockHeader.children[0].style.backgroundPosition = "0 100%";
                    } else {
                        var listHeight = blockHeader.nextElementSibling.scrollHeight + "px";
                        blockHeader.nextElementSibling.style.height = listHeight;
                        relatedList.parentElement.style.boxShadow = "0px 0px 3px 0px rgba(0,163,203,0.25)";
                        blockHeader.children[0].style.backgroundPosition = "0 0";
                        setTimeout(function(){
                            relatedList.style.overflow = "visible";
                        },400)
                    }
                },false);
            });
            
            document.querySelector("#close_show_all").addEventListener("click",function(e){ 
                $(".new_item_header").click();
                if(e.target.classList.contains("all_open")){
                    e.target.classList.remove("all_open");
                    e.target.style.background = "";
                    e.target.innerHTML = "Раскрыть все";
                } else {
                    e.target.classList.add("all_open");
                    e.target.style.background = "#ff2a36";
                    e.target.innerHTML = "Свернуть все";
                }
            },false)
        })
    </script>

<?                          
      $APPLICATION->IncludeComponent(
        "bitrix:subscribe.form", 
        "subscr_new_products", 
        array(
            "USE_PERSONALIZATION" => "Y",
            "PAGE" => "#SITE_DIR#company/subscr_edit.php",
            "SHOW_HIDDEN" => "N",
            "ALLOW_ANONYMOUS" => "Y", 
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "CACHE_NOTES" => "",
            "COMPONENT_TEMPLATE" => "subscr_new_products"
        ),
        false
      );
?>
<br>
<h1 class="new_items_header">Новые товары</h1>

<form method="get" action="/new_products/">
    <table>
        <tr>
            <td>
                Выбрать последние за&nbsp;
            </td>
            <td class="new_items_select">  
                <select name="days"> 
                    <option value="0">30</option>  
                    <?for ($i=1; $i<=30; $i++){?>
                        <option value="<?=$i?>" <?if ($_GET["days"] > 0 && $_GET["days"]== $i){?>selected="selected"<?}?>><?=$i?></option>
                        <?}?>
                </select>
            </td>
            <td>  
                &nbsp;&nbsp;&nbsp;дней
            </td>
        </tr>
    </table> 
    <!--<div class="store-info new_items_warning">По умолчанию - за последние 30 дней</div>-->
    <br />
    <input class="new_items_buttons" type="submit" value="Показать" /> 
    <input class="new_items_buttons new_items_confirm" type="button" onclick="document.location.href='<?=$APPLICATION->GetCurPage()?>'" value="Сбросить" />

</form> <?
    //получаем список элементов
    $arFilter = array();
    $arFilter["IBLOCK_ID"] = 88;
    $arFilter["SECTION_ID"] = array();
    $sections_all = CIBLockSection::GetTreeList(array($arFilter["IBLOCK_ID"]),array("ID"));
    while($arSections_all = $sections_all->Fetch()) {
        $arFilter["SECTION_ID"][] = $arSections_all["ID"];
    }

    if ($_GET["days"] > 0) {
        $days_count = $_GET["days"]; 
    }

    else {$days_count = 30;}

    $arFilter[">=DATE_CREATE"] = date($DB -> DateFormatToPHP(CLang::GetDateFormat("SHORT")), date("U") - 86400*$days_count);
    $resultArray = Array();

    $items = CIBLockElement::GetList(array("IBLOCK_SECTION_ID"=>"ASC"), $arFilter, false, false, array("ID","NAME","PROPERTY_UNC","CODE","PROPERTY_SIZE","IBLOCK_SECTION_ID","PROPERTY_WARRANTY","PROPERTY_FIRM"));


    if ($items->SelectedRowsCount() > 0) {
        //$items->NavStart(100,false,false);
        //echo $items->GetPageNavStringEx($navComponentObject,"", ".default", true);

    ?> 
    <!--noindex-->
    <div class="catalog-sectionclickon">

        <table class="forward_catalog_new catalog_table">
            <tr>
                <th width="43">Фото</th>
                <th width="108">Артикул</th>
                <th width="98">OEM#</th>
                <th width="58">Год</th>
                <th width="332">Наименование</th>
                <th width="68">Сравнить</th>
                <th width="69">Цена, руб</th>
                <th width="75">Купить</th>
                <th width="37">Инфо</th>
            </tr>
       </table>
       <div id="close_show_all">Раскрыть все</div>
       <!--<a rel="nofollow" href="/catalog/<?=$arSection["ID"]?>/" ><?=$arSection["NAME"];?></a>-->

            <?
                //проверяем корзину пользователя.
                //если текущий товар уже есть в корзине, то вместо кнопки добавления выводим соответствующее сообщение
                $arBasketItemsIDs = array();  //массив ID товаров, которые в корзине на данный момент

                $dbBasketItems = CSaleBasket::GetList(
                    array(
                        "NAME" => "ASC",
                        "ID" => "ASC"
                    ),
                    array(
                        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                        "LID" => SITE_ID,
                        "ORDER_ID" => "NULL",
                        "DELAY" => "N"
                    ),
                    false, false,
                    array(
                        "PRODUCT_ID"
                    )
                );

                while ($arItems = $dbBasketItems->Fetch())
                {
                    $arBasketItemsIDs[] = $arItems["PRODUCT_ID"];
                }

                $prev_section = 0;
            ?>
            <?while ($arElement = $items->Fetch()) {
                    $arElement["DETAIL_PAGE_URL"] = "/catalog/".$arElement["IBLOCK_SECTION_ID"]."/".$arElement["ID"]."/";

                    $arElement["PRICES"]["PRICE_1"] = CPrice::GetBasePrice($arElement["ID"]);
                    $arElement["PRICES"]["PRICE_1"]["PRICE"] = CCurrencyRates::ConvertCurrency($arElement["PRICES"]["PRICE_1"]["PRICE"], "USD", "RUR");
                    $arElement["PRICES"]["PRICE_1"]["CURRENCY"] = "RUR";
                ?>

                <?if ($arElement["IBLOCK_SECTION_ID"] != $prev_section) {
                        $section = CIBlockSection::GetById($arElement["IBLOCK_SECTION_ID"]);
                        $arSection = $section->Fetch();
                        $resultArray[$arSection["NAME"]] = Array();
                    }?>
                <?array_push($resultArray[$arSection["NAME"]],$arElement);?>
                <?
                    $prev_section = $arElement["IBLOCK_SECTION_ID"];
                }?>
        
        <?
            ksort($resultArray);
            $prevKey = "";
            foreach ($resultArray as $key => $arElementsArr) {?>
                <div class="new_items_block_wrapper">
                    <div class="new_item_header"><span class="open_close_arrow"></span><?=$key?></div>
                    <div class="new_item_list">
                    <table class="forward_catalog_new catalog_table">
                        
                         <tr>
                            <td width="43"></td>
                            <td width="108"></td>
                            <td width="98"></td>
                            <td width="58"></td>
                            <td width="332"></td>
                            <td width="68"></td>
                            <td width="69"></td>
                            <td width="75"></td>
                            <td width="37"></td>
                        </tr>
                    <?foreach($arElementsArr as $arElement){?>

                
                         <tr>
                    <td>
                        <?  
                            if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".jpg")) {$img_path = "/upload/images/".$arElement['CODE'].".jpg";}
                            else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".JPG")) {$img_path = "/upload/images/".$arElement['CODE'].".JPG";}
                                else {$img_path = "";}
                        ?>
                        <?if ($img_path != ""){?>
                            <a rel="nofollow" href="<?=$img_path?>" class="fancybox" title="<?=$arElement["NAME"]?>">
                                <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                                </div>
                            </a>
                            <?} else {?>
                            <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                            <?}?>
                    </td>

                    <td><?=$arElement['CODE']?></td>
                    <td><?
                            $oem = str_replace("/","<br>",$arElement['PROPERTY_UNC_VALUE']);
                            $oem = str_replace("+","<br>+",$oem);
                        ?>
                        <?=trim($oem)?>
                    </td>
                    <td><?=$arElement['PROPERTY_SIZE_VALUE']?></td>
                    <td>

                        <div class="forward_catalog_new_link_container">
                            <a rel="nofollow" href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement['NAME']?>"><?echo $arElement['NAME'];?></a>
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
                    <td><?=ceil($arElement["PRICES"]["PRICE_1"]["PRICE"])?></td>

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
                            <input type="hidden" id="item_price_<?=$arElement["ID"]?>" value="<?=ceil($arElement["PRICES"]["PRICE_1"]["PRICE"])?>">
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
                                <a rel="nofollow" onclick="showcatdet('<?=$arElement["ID"]?>',<?=$this_count?>)" href="javascript:void(0)" title="добавить в корзину"><div class="forward_catalog_new_buy"></div></a>
                                <?} else {?>
                                <span class="forward_catalog_new_in_b"><a rel="nofollow" href='/personal/basket.php' title="корзина">В корзине</a></span>
                                <?}?>

                            <?} else { // если нет в наличии?>
                            <div class="catalog_basket_na" title="товара нет в наличие"></div> 
                            <?}?>
                    </td>

                    <td class="catalog_item_info_cell" id="item_info_<?=$arElement["ID"]?>" title="Нажмите, чтобы посмотреть количество на складах">
                        <div class="catalog_info_container">
                            <div class="warehouses_popup whp_<?=$arElement["ID"]?>"></div>
                        </div>
                    </td>


                </tr>
                <?}?>
               </table>
              </div>
            </div>
            <?}
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
        </script>
        <div class="jqmWindow" id="dialog">

            <a rel="nofollow" href="#" id="closemodal" class="jqmClose"></a>
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
                            <a rel="nofollow" href="javascript:add2basket();" class="modalsave">Добавить</a>
                        </td>
                    </tr>

                </table>

            </form>
        </div>
    </div>
    
    <!--/noindex-->
    <?        

    }

    else {
    ?> 
    <div style="margin: 20px 0px 0px; overflow: hidden;">Ничего не найдено</div>
    <?}?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>