<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

    if ($_GET['parent_id']==0) {?>
    <meta name="robots" content="noindex">
    <?}

    if ($_REQUEST["q"]) {
        $title = 'Результаты поиска по запросу "'.$_REQUEST["q"].'"';
    }
    else {$title = "поиск";}

    $APPLICATION->SetTitle($title);

    //очищаем кэш
    BXClearCache(true, "/catalog/");
?>
<? //arshow($_REQUEST);

    $arFilter = array();
    $arFilter["IBLOCK_ID"] = 88;
    $arFilter["SECTION_ID"] = array();
    //разбираем то что пришло

    //по чему ищем
    $search_by_id = intval($_REQUEST["search_type"]);
    switch ($_REQUEST["search_type"]) {
        case 1: $arFilter["NAME"] = "%".trim($_REQUEST["q"])."%"; $search_by = "Поиск по названию"; break; //по имени

        case 2: $arFilter["CODE"] = "%".trim($_REQUEST["q"])."%"; $search_by = "Поиск по артикулу"; break; //по артикулу

        case 3: $arFilter["PROPERTY_UNC"] = "%".trim($_REQUEST["q"])."%"; $search_by = "Поиск по OEM"; break; //по OEM

        case 4:
            /*получаем ID производителя*/
            $firms = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>86,"NAME"=>"%".trim($_REQUEST["q"])."%"));
            $arFirm = $firms->Fetch();
            $arFilter["PROPERTY_FIRM"] = $arFirm["ID"];
            $search_by = "Поиск по производителю"; break; //по производителю; break;

        case 5: $arFilter["PROPERTY_WARRANTY"] = "%".trim($_REQUEST["q"])."%"; $search_by = "Поиск номеру производителя"; break; //по номеру производителя; break;

        default :  $search_by = "Поиск по названию"; break;
    }

    //параметры первого раздела
    $section1 = intval($_REQUEST["section_id1"]);
    $srSection1 = CIBLockSection::GetById($section1);
    $arSection1_params = $srSection1->Fetch();

    //параметры второго раздела

    $section2 = intval($_REQUEST["section_id2"]);
    $srSection2 = CIBLockSection::GetById($section2);
    $arSection2_params = $srSection2->Fetch();



    if ($section1 == 0) { //поиск по всему каталогу
        $arSection1_params["NAME"] = "Весь каталог";
        $sections_all = CIBLockSection::GetTreeList(array($arFilter["IBLOCK_ID"]),array("ID"));
        while($arSections_all = $sections_all->Fetch()) {
            $arFilter["SECTION_ID"][] = $arSections_all["ID"];
        }
    }


    //если есть раздел второго уровня
    if ($section1 > 0) {
        $arFilter["SECTION_ID"][] = $section2;
        if ($section2 > 0) {} else {
            $arSection2_params["NAME"] = "---";
        }

        $sections_1 = CIBLockSection::GetList(array(), array($arFilter["IBLOCK_ID"],"SECTION_ID"=>$section1), false, array("ID"),false);
        while($arSections1 = $sections_1->Fetch()) {
            //собираем подразделы
            $sections_2 = CIBLockSection::GetList(array(), array($arFilter["IBLOCK_ID"],"SECTION_ID"=>$arSections1["ID"]), false, array("ID"),false);
            while($arSections2 = $sections_2->Fetch()) {
                $arFilter["SECTION_ID"][] = $arSections2["ID"];
            }

            $arFilter["SECTION_ID"][] = $arSections1["ID"];
        }
    }


    //если есть раздел второго уровня
    if ($section2 > 0) {
        $arFilter["SECTION_ID"] = array();
        $arFilter["SECTION_ID"][] = $section2;

        $sections_2 = CIBLockSection::GetList(array(), array($arFilter["IBLOCK_ID"],"SECTION_ID"=>$section2), false, array("ID"),false);
        while($arSections2 = $sections_2->Fetch()) {
            $arFilter["SECTION_ID"][] = $arSections2["ID"];
        }

    }



    // arshow($arFilter);



?>

<?
    //если в сравнении есть товары, выводим всплывающее окно внизу
    if (count($_SESSION["COMPARE"]) > 0) { ?>
    <script>
        $(function(){
            $(".catalog_compare_hidden_block").fadeIn(500);
        })
    </script>
    <?}?>

<div class="warring">ВНИМАНИЕ! Цена в каталоге указана &mdash; ОПТОВАЯ. Розничные цены на 50 % выше.
    <br />
    Оптовые цены только для ОПТОВЫХ покупателей, зарегистрированных и имеющих клиентский номер. Зарегистрироваться можно <a href="/personal/" >здесь</a>.</div>

<form action="/catalog/search.php" method="get" id="searchform" name="searchform">
    <div class="filtermark">
        <div class="filtername">Поиск по каталогу</div>
        <?
            //получаем дату последнего обновления
            $last_date = GKCommon::GetLastUpdateDate();
            $last_dateTime = substr($last_date,11,5);
            $last_date = substr($last_date,0,10);

            $last_date = explode("-",$last_date);
        ?>
        <div class="filternamer">Последнее обновление остатков: <?=$last_date[2].".".$last_date[1].".".$last_date[0]." ".$last_dateTime;?></div>
        <table>
            <tr class="topp">
                <td width="142">Выберите где искать:</td>

                <td width="395" class="search_page_section_1">

                    <?/*
                        <select name="section_id1" id="select1" style="width:320px" onchange="get_subsections($(this).val())">
                        <option value="0" id="section0"> Весь каталог</option>
                        <?
                        $iblock_section_list = CIBLockSection::GetList(array("left_margin"=>"asc"), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y","<DEPTH_LEVEL"=>3), false, array("ID","NAME","DEPTH_LEVEL"), false); ?>
                        <?while ($iblock_section = $iblock_section_list->Fetch()){ ?>
                        <option value="<?=$iblock_section["ID"]?>" id="opt<?=$iblock_section["ID"]?>" ><?for ($i=0;$i<$iblock_section["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section["NAME"]?></option>
                        <? }?>
                        </select>
                    */?>


                    <div class="search_select_type" id="select">
                        <div><?=$arSection1_params["NAME"]?></div>
                        <div>
                            <input type="hidden" name="section_id1" value="<?=$section1?>">
                            <p onclick="set_search_type(this), get_subsection(this)" id="op0">Весь каталог</p>
                            <?
                                $iblock_section_list = CIBLockSection::GetList(array("left_margin"=>"asc"), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y","<DEPTH_LEVEL"=>3), false, array("ID","NAME","DEPTH_LEVEL"), false); ?>
                            <?while ($iblock_section = $iblock_section_list->Fetch()){ ?>
                                <p onclick="set_search_type(this), get_subsection(this)" id="op<?=$iblock_section["ID"]?>"><?for ($i=0;$i<$iblock_section["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section["NAME"]?></p>
                                <?}?>

                        </div>
                    </div>



                </td>

                <td id="select_2_block" class="search_page_section_2">
                    <?/*
                        <?if ($_REQUEST["section_id1"]) {?>
                        <select name="section_id2" style="display:none" id="select2">
                        <option value="0">---</option>
                        <?
                        $iblock_section_list2 = CIBLockSection::GetList(array(), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y","SECTION_ID"=>$_REQUEST["section_id1"]), false, array("ID","NAME","DEPTH_LEVEL"), false); ?>
                        <?while ($iblock_section2 = $iblock_section_list2->Fetch()){ ?>
                        <option value="<?=$iblock_section2["ID"]?>" id="opt<?=$iblock_section2["ID"]?>" ><?for ($i=0;$i<$iblock_section2["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section2["NAME"]?></option>
                        <? }?>
                        </select>
                        <?}?>

                    */?>

                    <div class="search_select_type" id="select2">

                        <?if ($_REQUEST["section_id1"]) {?>

                            <div><?=$arSection2_params["NAME"]?></div>
                            <div>
                                <input type="hidden" name="section_id2" value="<?=$section2?>">
                                <p id="op0" onclick="set_search_type(this)">---</p>
                                <?  $iblock_section_list2 = CIBLockSection::GetList(array(), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y","SECTION_ID"=>$_REQUEST["section_id1"]), false, array("ID","NAME","DEPTH_LEVEL"), false); ?>
                                <?while ($iblock_section2 = $iblock_section_list2->Fetch()){ ?>
                                    <p onclick="set_search_type(this)" id="op<?=$iblock_section2["ID"]?>"><?for ($i=0;$i<$iblock_section2["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section2["NAME"]?></p>
                                    <? }?>
                            </div>
                            <?} else {?>
                            <div class="search_select_unactive">-</div><div></div>
                            <?}?>

                    </div>

                </td>
            </tr>

            <tr>

                <td class="small search_page_buts" colspan="3" >

                    <input type="text" placeholder="Поиск по номеру производителя, наименованию, артикулу и OEM" name="q" value="<?=trim(htmlspecialchars($_REQUEST['q']))?>" class="search_form_q">

                    <div class="search_select_type">
                        <div><?=$search_by?></div>
                        <div>
                            <input type="hidden" name="search_type" value="<?=$search_by_id?>">
                            <p onclick="set_search_type(this)" id="st1">Поиск по названию</p>
                            <p onclick="set_search_type(this)" id="st2">Поиск по артикулу</p>
                            <p onclick="set_search_type(this)" id="st3">Поиск по OEM</p>
                            <p onclick="set_search_type(this)" id="st4">Поиск по производителю</p>
                            <p onclick="set_search_type(this)" id="st5">Поиск по номеру произодителя</p>
                            <?/*<p onclick="set_search_type(this)" id="st4">Поиск по номеру производителя</p>*/?>
                        </div>
                    </div>

                    <div>
                        <input  type="submit" name="s" value="Найти" />
                        <input  type="reset" value="Сбросить" onclick="document.location.href='/catalog/search.php'"/>
                    </div>

                </td>

            </tr>
        </table>



    </div>
</form>


<?
    //получаем список элементов, соответствующих запросу
    if (strlen($_REQUEST["q"]) > 0) {
        $items = CIBLockElement::GetList(array("NAME"=>"ASC"), $arFilter, false, false, array("ID","NAME","PROPERTY_UNC","CODE","PROPERTY_SIZE","IBLOCK_SECTION_ID","PROPERTY_WARRANTY","PROPERTY_FIRM", "DATE_CREATE"));


        if ($items->SelectedRowsCount() > 0) {
            $items->NavStart(100,false,false);
            echo $items->GetPageNavStringEx($navComponentObject,"", ".default", true);

        ?>


        <div class="catalog-sectionclickon">

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

                <?while ($arElement = $items->Fetch()) {

                        // arshow($arElement);

                        $arElement["DETAIL_PAGE_URL"] = "/catalog/".$arElement["IBLOCK_SECTION_ID"]."/".$arElement["ID"]."/";

                        $arElement["PRICES"]["PRICE_1"] = CPrice::GetBasePrice($arElement["ID"]);
                        $arElement["PRICES"]["PRICE_1"]["PRICE"] = CCurrencyRates::ConvertCurrency($arElement["PRICES"]["PRICE_1"]["PRICE"], "USD", "RUR");
                        $arElement["PRICES"]["PRICE_1"]["CURRENCY"] = "RUR";
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



                    <?} // foreach($arResult["ITEMS"] as $arElement):?>


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
        </div>

        <?         
            echo $items->GetPageNavStringEx($navComponentObject,"", ".default", true);
        }

        else {
        ?>

        <div style="margin:20px 0 0; overflow: hidden;">Ничего не найдено</div>

        <?}
    }
?>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>