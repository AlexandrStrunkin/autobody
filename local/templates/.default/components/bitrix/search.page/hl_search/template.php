<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
	CModule::IncludeModule('highloadblock');
	
	use Bitrix\Highloadblock as HL;
	use Bitrix\Main\Entity;
	
	$hl_block = HL\HighloadBlockTable::getById(1)->fetch();
	$entity = HL\HighloadBlockTable::compileEntity($hl_block);
	$entity_data_class = $entity->getDataClass();
	$entity_table_name = $hl_block['TABLE_NAME'];

	$arBasketItemsIDs = getCurrentBasket();    
    $pattern = "/(\W)/u";
	// массив для записи отсортированного результата
	$sorted_result = array(
		"by_name"         => array(),
		"by_article"      => array(),
		"by_oem"          => array(),
		"by_manufacturer" => array()
	);

    //---- block for searching in names

    $patternForNonWord = "/([^a-zA-Z\sа-яА-Я0-9])/u";
    $patternForMultWhitespace = "/(\s{2,})/u";
    $patternForSearch = "/(\s{1,})/u";

    $nameSearch = $_GET['q'];
    $nameSearch = preg_replace($patternForNonWord, "", $nameSearch);
    $nameSearch = preg_replace($patternForMultWhitespace, " ", $nameSearch);
    $nameSearch = preg_replace($patternForSearch, " && ", $nameSearch); // --- данная замена всех пробелов на && позволяет сделать поиск независимым от порядка слов

	$cleared_search = preg_replace($pattern, "", $_GET['q']);
	$search_tips_filter = array(
		'LOGIC' => 'OR',
		array(
			'UF_TITLE' => "%" . $nameSearch . "%"
		),
		array(
			'=%UF_CODE' => "%" . preg_replace($pattern, "", $_GET['q']) . "%",
		),
		array(
			'=%UF_WARRANTY' => "%" . preg_replace($pattern, "", $_GET['q']) . "%",
		),
		array(
			'=%UF_UNC' => "%" . preg_replace($pattern, "", $_GET['q']) . "%"
		),
		array(
			"=%UF_CROSS" => "%" . $_GET['q'] . "%"
		)
	);
	
	$table_id = 'tbl_' . $entity_table_name;
	$result = $entity_data_class::getList(array(
		"select" => array('*'),
		"filter" => $search_tips_filter,
		"limit"  => 500,
		"order"  => array("UF_ORIGINAL_ID" => "ASC")
	));
	$result = new CDBResult($result, $table_id);
	while ($search_result = $result->Fetch()) {
		// если найдено по имени
		if (stripos($search_result['UF_TITLE'], $nameSearch) !== false) {
			array_push($sorted_result['by_name'], $search_result);
		} elseif (stripos($search_result['UF_CODE'], $cleared_search) !== false) {
			// найдено по артикулу
			array_push($sorted_result['by_article'], $search_result);
		} elseif (stripos($search_result['UF_WARRANTY'], $cleared_search) !== false || stripos($search_result['UF_CROSS'], $_GET['q']) !== false) {
			// найдено по номеру производителя
			array_push($sorted_result['by_manufacturer'], $search_result);
		} elseif (stripos($search_result['UF_UNC'], $cleared_search) !== false) {
			// найдено по OEM
			array_push($sorted_result['by_oem'], $search_result);
		}
	}

    if (!empty($_GET['q']) && !empty($_GET['p']) && $result->SelectedRowsCount()) { ?>

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
            foreach ($sorted_result as $result_type => $items) {  

            switch ($result_type) {
                case "by_article": if (count($items)) { ?>
                <tr class="search-field-name">
                    <td colspan="9">
                        <b><? print_r("Найденные товары по артикулу"); ?></b>
                    </td>
                </tr>
                <? } else {
                };
                break;
                case "by_name": if (count($items)) { ?>
                <tr class="search-field-name">
                    <td colspan="9">
                        <b><? print_r("Найденные товары по наименованию"); ?></b>
                    </td>
                </tr>
                <? } else {
                };
                break;
                case "by_manufacturer": if (count($items)) { ?>
                <tr class="search-field-name">
                    <td colspan="9">
                        <b><? print_r("Найденные товары по номеру производителя"); ?></b>
                    </td>
                </tr>
                <? } else {
                };
                break;
                case "by_oem": if (count($items)) { ?>
                <tr class="search-field-name">
                    <td colspan="9">
                        <b><? print_r("Найденные товары по ОЕМ"); ?></b>
                    </td>
                </tr>
                <? } else {
                };
                break;
            }   

            if ($not_found == 4) { print_r("По вашему запросу ничего не найдено."); }

            ?>



            <?
                foreach ($items as $index => $item) {
                    $ar_res = GetCatalogProductPriceList($item["UF_ORIGINAL_ID"], array(), array());
                    //получаем цену товара с указанным ид с учетом текущего поддомена                    
                    $newval = getPriceForId($item["UF_ORIGINAL_ID"]); //описание в init.php
                ?>
                <tr>
                    <td>
                        <? if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/upload/images/" . $item["UF_CODE_DISPLAY"] . ".jpg")) {
                                $img_path = "/upload/images/" . $item["UF_CODE_DISPLAY"] . ".jpg";
                            } elseif (file_exists($_SERVER["DOCUMENT_ROOT"] . "/upload/images/" . $item["UF_CODE_DISPLAY"] . ".JPG")) {
                                $img_path = "/upload/images/" . $item["UF_CODE_DISPLAY"] . ".JPG";
                            } else {
                                $img_path = "";
                            }

                            if ($img_path != "") { ?>
	                            <a property="url" href="<?= $img_path ?>" class="fancybox" title="<?= $item["UF_TITLE"] ?>">
	                                <div property="image" class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото"></div>
	                            </a>
                            <? } else { ?>
                            	<div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                            <?}?>
                    </td>

                    <?
                        $dateCreate = explode(".", substr($arFields["DATE_CREATE"],0,10));
                        $curDate = date("U"); //текущая дата
                        $dif = 86400 * 30; //30 дней
                        $dateCreateLabel = mktime(0,0,0,$dateCreate[1],$dateCreate[0],$dateCreate[2]);  //метка времени даты создания
                    ?>

                    <td  <?if (($curDate - $dateCreateLabel) < $dif) {?> class="catalog_section_item_new_label"<?}?>><?= $item["UF_CODE_DISPLAY"] ?></td>
                    <td>
                    	<?
                            $oem = str_replace("/", "<br>", $item["UF_UNC_DISPLAY"]);
                            $oem = str_replace("+", "<br>+", $oem);
                        ?>
                        <?= trim($oem) ?>
                    </td>
                    <td><?= $item["UF_SIZE"] ?></td>
                    <td>

                        <div class="forward_catalog_new_link_container" vocab="http://schema.org/" typeof="Product">
                            <a property="url" href="<?= $item["UF_DETAIL_URL"] ?>" title="<?= $item["UF_TITLE"] ?>"><?= $item["UF_TITLE"] ?></a>
                        </div>
                        <?if ($item["UF_FIRM_DISPLAY"] || $item["UF_WARRANTY_DISPLAY"]){?>
                            <div class="forward_catalog_new_firm">    
                                <? if ($USER->IsAuthorized()) { ?>
                                    <?= $item["UF_FIRM_DISPLAY"] ?><? if ($item["UF_WARRANTY_DISPLAY"]) { ?>, <?= $item["UF_WARRANTY_DISPLAY"] ?><? } ?>
                                 <? } ?>
                            </div>
                            <?}?>
                    </td>
                    <td><div class="cbox <? if (in_array($item["UF_ORIGINAL_ID"], $_SESSION["COMPARE"])) {echo "cbox_c";} ?>" onclick="check_compare(<?= $item["UF_ORIGINAL_ID"] ?>)"></div></td>
                    <td><span property="highPrice"><?=ceil($newval)?></span></td>
                    <td id="last_cell_<?= $item["UF_ORIGINAL_ID"] ?>">
                        <?global $this_count; $this_count = 0;?>
                        <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "cat_q_list", 
                                array(
                                    "PER_PAGE" => "10",
                                    "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
                                    "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
                                    "USE_MIN_AMOUNT" => "N",
                                    "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                                    "ELEMENT_ID" => $item["UF_ORIGINAL_ID"],
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
                            <input type="hidden" id="item_name_<?= $item["UF_ORIGINAL_ID"] ?>" value="<?= $item["UF_TITLE"] ?>">
                            <input type="hidden" id="item_price_<?= $item["UF_ORIGINAL_ID"] ?>" value="<?= ceil($newval) ?>">
                            <input type="hidden" id="item_code_<?= $item["UF_ORIGINAL_ID"] ?>" value="<?= $item["UF_CODE_DISPLAY"] ?>">
                            <input type="hidden" id="item_year_<?= $item["UF_ORIGINAL_ID"] ?>" value="<?= $item["UF_SIZE"] ?>">
                            <input type="hidden" id="item_count_<?= $item["UF_ORIGINAL_ID"] ?>" value="<?= $this_count ?>">
                            <?
                                if (in_array($item["UF_ORIGINAL_ID"], $arBasketItemsIDs)) {
                                    $in_basket = "Y";
                                }
                                else {$in_basket = "N";}

                                if ($in_basket == "N") {
                                ?>
                                <a onclick="showcatdet('<?=$item["UF_ORIGINAL_ID"]?>',<?=$this_count?>)" href="javascript:void(0)" title="добавить в корзину"><div class="forward_catalog_new_buy"></div></a>
                                <?} else {?>
                                <span class="forward_catalog_new_in_b" ><a href='/personal/basket/' title="корзина">В корзине</a></span>
                                <?}?>

                            <?} else { // если нет в наличии?>

                            <div class="catalog_basket_na" title="товара нет в наличие"></div> 
                            <?}?>
                    </td>

                    <td class="catalog_item_info_cell" id="item_info_<?=$item["UF_ORIGINAL_ID"]?>" title="Нажмите, чтобы посмотреть количество на складах">
                        <div class="catalog_info_container">
                            <div class="warehouses_popup whp_<?=$item["UF_ORIGINAL_ID"]?>"></div>
                        </div>
                    </td>

                </tr>
                <? if ($index == 19) { ?>
                   <tr data-search-param="<?=htmlspecialcharsbx($_GET['q'])?>" data-filter-by="<?= $result_type ?>" data-last-item-id="<?= $item["UF_ORIGINAL_ID"] ?>" class="search-field-name showMoreSearchResults">
                        <td colspan="9">
                            <b><? print_r("Показать еще"); ?></b>
                        </td>
                    </tr>
                <? break; } ?> 
                <? } ?> 
            <? } ?> 
    </table>

    <?
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
            	console.log(data);
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

 