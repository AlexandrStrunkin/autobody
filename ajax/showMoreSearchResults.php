<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('highloadblock');

global $USER;

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

$nameSearch = $_POST['search_param'];
$nameSearch = preg_replace($patternForNonWord, "", $nameSearch);
$nameSearch = preg_replace($patternForMultWhitespace, " ", $nameSearch);
$nameSearch = preg_replace($patternForSearch, " && ", $nameSearch); // --- данная замена всех пробелов на && позволяет сделать поиск независимым от порядка слов

$cleared_search = preg_replace($pattern, "", $_POST['search_param']);

switch($_POST['filter_by']){
    case "by_article": 
    		$search_tips_filter = array('>UF_ORIGINAL_ID' => $_POST['last_item'], '=%UF_CODE' => "%" . $cleared_search . "%");
        break;
    case "by_name": 
    		$search_tips_filter = array('>UF_ORIGINAL_ID' => $_POST['last_item'], 'UF_TITLE' => "%" . $nameSearch . "%");
        break;
    case "by_manufacturer": 
			$search_tips_filter = array(
				'LOGIC' => 'OR',
				array('>UF_ORIGINAL_ID' => $_POST['last_item'], '=%UF_WARRANTY' => "%" . $cleared_search . "%"),
				array('>UF_ORIGINAL_ID' => $_POST['last_item'], '=%UF_CROSS' => "%" . $_POST['search_param'] . "%")
			);
        break;
    case "by_oem":
    		$search_tips_filter = array('>UF_ORIGINAL_ID' => $_POST['last_item'], '=%UF_UNC' => "%" . $cleared_search . "%");
        break;
}

$table_id = 'tbl_' . $entity_table_name;
$result = $entity_data_class::getList(array(
	"select" => array('*'),
	"filter" => $search_tips_filter,
	"limit"  => 21,
	"order"  => array("UF_ORIGINAL_ID" => "ASC")
));
	
$result = new CDBResult($result, $table_id);
while ($search_result = $result->Fetch()) {
	array_push($sorted_result[$_POST['filter_by']], $search_result);
}
if (!empty($_POST['search_param']) && $result->SelectedRowsCount()) {
        foreach ($sorted_result as $result_type => $items) { 
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
            <? if ($index == 20) { ?>
               <tr data-search-param="<?=htmlspecialcharsbx($_POST['search_param'])?>" data-filter-by="<?= $_POST['filter_by'] ?>" data-last-item-id="<?= $item["UF_ORIGINAL_ID"] ?>" class="search-field-name showMoreSearchResults">
                    <td colspan="9">
                        <b><? print_r("Показать еще"); ?></b>
                    </td>
                </tr>
            <? } ?> 
            <? } ?>
        <? } ?>
	<? } ?>