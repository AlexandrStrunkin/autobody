<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CModule::IncludeModule("iblock");
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
    $arFilter = array(
        "IBLOCK_ID" => 88,
        "INCLUDE_SUBSECTIONS" => "Y",
        array(
            "LOGIC" => "OR",
            array("PROPERTY_SEARCH_CODE"=>"%".preg_replace($pattern,"",$arResult["query"])."%"),
            array("?NAME"=>$nameSearch),
            array("PROPERTY_SEARCH_WARRANTY"=>"%".preg_replace($pattern,"",$arResult["query"])."%"),
            array("PROPERTY_CROSS_NUM"=>"%".trim($arResult["query"])."%"),
            array("PROPERTY_SEARCH_UNC"=>"%".preg_replace($pattern,"",$arResult["query"])."%")
        )
    );
    $arSelect = Array('ID','NAME','DETAIL_PAGE_URL','PROPERTY_SIZE','PROPERTY_FIRM');
    $res = CIBlockElement::GetList(array("ID"=>"ASC"), $arFilter, false, Array("nPageSize" => 6), $arSelect);
    while($ob = $res->Fetch()) {
        $arResult["CATEGORIES"][$i]["ITEMS"][] = $ob;
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
