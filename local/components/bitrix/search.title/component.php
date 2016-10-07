<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CModule::IncludeModule("iblock");
CModule::IncludeModule('highloadblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hl_block = HL\HighloadBlockTable::getById(1)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hl_block);
$entity_data_class = $entity->getDataClass();
$entity_table_name = $hl_block['TABLE_NAME'];

if(!IsModuleInstalled("search"))
{
    ShowError(GetMessage("CC_BST_MODULE_NOT_INSTALLED"));
    return;
}

if(!isset($arParams["PAGE"]) || strlen($arParams["PAGE"])<=0)
    $arParams["PAGE"] = "#SITE_DIR#search/index.php";

$arResult["CATEGORIES"] = array();

$query = ltrim($_POST["q"]);
if(
    !empty($query)
    && $_REQUEST["ajax_call"] === "y"
    && (
        !isset($_REQUEST["INPUT_ID"])
        || $_REQUEST["INPUT_ID"] == $arParams["INPUT_ID"]
    )
    && CModule::IncludeModule("search")
)
{
    CUtil::decodeURIComponent($query);

    $arResult["alt_query"] = "";
    if($arParams["USE_LANGUAGE_GUESS"] !== "N")
    {
        $arLang = CSearchLanguage::GuessLanguage($query);
        if(is_array($arLang) && $arLang["from"] != $arLang["to"])
            $arResult["alt_query"] = CSearchLanguage::ConvertKeyboardLayout($query, $arLang["from"], $arLang["to"]);
    }

    $arResult["query"] = $query;
	
	$i = 1;
        
	$pattern = "/(\W)/u";
    $patternForNonWord = "/([^a-zA-Z\sа-яА-Я0-9])/u";
    $patternForMultWhitespace = "/(\s{2,})/u";
    $patternForSearch = "/(\s{1,})/u";

    $nameSearch = $arResult["query"];
    $nameSearch = preg_replace($patternForNonWord,"",$nameSearch);
    $nameSearch = preg_replace($patternForMultWhitespace," ",$nameSearch);
    $nameSearch = preg_replace($patternForSearch," && ",$nameSearch);
    $j = 0;
    $iblock_filter = array();
    foreach ($arParams["CATEGORY_".$i] as $iblock_types) {
        foreach ($arParams["CATEGORY_".$i."_".$iblock_types] as $iblock_id) {
            $iblock_filter[] = $iblock_id;
        }
    }
    
    $search_tips_filter = array(
		'LOGIC' => 'OR',
		array(
			'UF_TITLE' => "%" . $nameSearch . "%"
		),
		array(
			'=%UF_CODE' => "%" . preg_replace($pattern, "", $arResult["query"]) . "%",
		),
		array(
			'=%UF_WARRANTY' => "%" . preg_replace($pattern, "", $arResult["query"]) . "%",
		),
		array(
			'=%UF_UNC' => "%" . preg_replace($pattern, "", $arResult["query"]) . "%"
		),
		array(
			"=%UF_CROSS" => "%" . $arResult["query"] . "%"
		)
	);
	
	$table_id = 'tbl_' . $entity_table_name;
	$result = $entity_data_class::getList(array(
		"select" => array('*'),
		"filter" => $search_tips_filter,
		"limit"  => 5,
		"order"  => array("ID" => "ASC")
	));
	$result = new CDBResult($result, $table_id);
	while ($search_tip = $result->Fetch()) {
		$arResult["CATEGORIES"][$i]["ITEMS"][] = array(
			"NAME"                => $search_tip['UF_TITLE'],
			"DETAIL_PAGE_URL"     => $search_tip['UF_DETAIL_URL'],
			"CODE"                => $search_tip['UF_CODE_DISPLAY'],
			"PROPERTY_SIZE_VALUE" => $search_tip['UF_SIZE']
		);
	}
}

$arResult["FORM_ACTION"] = htmlspecialcharsbx(str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"]));

if (
    $_REQUEST["ajax_call"] === "y"
    && (
        !isset($_REQUEST["INPUT_ID"])
        || $_REQUEST["INPUT_ID"] == $arParams["INPUT_ID"]
    )
)
{
    $APPLICATION->RestartBuffer();

    if(!empty($query))
        $this->IncludeComponentTemplate('ajax');
    require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");
    die();
}
else
{   
    if (isset($arResult["CATEGORIES"])) {
        $APPLICATION->AddHeadScript($this->GetPath().'/script.js');
        CUtil::InitJSCore(array('ajax'));
    }
    $this->IncludeComponentTemplate();
}
?>
