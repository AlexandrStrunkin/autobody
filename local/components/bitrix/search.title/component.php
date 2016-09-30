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
    $arResult["phrase"] = stemming_split($query, LANGUAGE_ID);

    $arParams["NUM_CATEGORIES"] = intval($arParams["NUM_CATEGORIES"]);
    if($arParams["NUM_CATEGORIES"] <= 0)
        $arParams["NUM_CATEGORIES"] = 1;

    $arParams["TOP_COUNT"] = intval($arParams["TOP_COUNT"]);
    if($arParams["TOP_COUNT"] <= 0)
        $arParams["TOP_COUNT"] = 5;

    $arOthersFilter = array("LOGIC"=>"OR");

    for($i = 0; $i < $arParams["NUM_CATEGORIES"]; $i++)
    {
        $category_title = trim($arParams["CATEGORY_".$i."_TITLE"]);
        if(empty($category_title))
        {
            if(is_array($arParams["CATEGORY_".$i]))
                $category_title = implode(", ", $arParams["CATEGORY_".$i]);
            else
                $category_title = trim($arParams["CATEGORY_".$i]);
        }
        if(empty($category_title))
            continue;

        $arResult["CATEGORIES"][$i] = array(
            "TITLE" => htmlspecialcharsbx($category_title),
            "ITEMS" => array()
        );

        $exFILTER = array(
            0 => CSearchParameters::ConvertParamsToFilter($arParams, "CATEGORY_".$i),
        );
        $exFILTER[0]["LOGIC"] = "OR";

        if($arParams["CHECK_DATES"] === "Y")
            $exFILTER["CHECK_DATES"] = "Y";

        $arOthersFilter[] = $exFILTER;
        
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
        "IBLOCK_ID"=>$iblock_filter,
        "INCLUDE_SUBSECTIONS" => "Y",
        array(
            "LOGIC" => "OR",
            array("PROPERTY_SEARCH_CODE"=>"%".preg_replace($pattern,"",$arResult["query"])."%"),
            array("?NAME"=>$arResult["query"]),
            array("PROPERTY_SEARCH_WARRANTY"=>"%".preg_replace($pattern,"",$arResult["query"])."%"),
            array("PROPERTY_CROSS_NUM"=>"%".trim($arResult["query"])."%"),
            array("PROPERTY_SEARCH_UNC"=>"%".preg_replace($pattern,"",$arResult["query"])."%")
        )
    );
    $arSelect = Array('ID','PROPERTY_SEARCH_CODE','NAME','DATE_CREATE','DETAIL_PAGE_URL','PROPERTY_SEARCH_UNC','PROPERTY_SIZE','PROPERTY_FIRM','PROPERTY_SEARCH_WARRANTY');
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
    $ob = $res->GetNextElement();
    if(!empty($arFilter) && !empty($ob)){

            $res = CIBlockElement::GetList(array("ID"=>"ASC"), $arFilter, false, Array("nPageSize"=>20), $arSelect);
            while($ob = $res->GetNextElement()) {
                $j++;
                if ($j > $arParams["TOP_COUNT"]) {
                    break;
                } else {
                    $arFields = $ob->GetFields();
                    $arProps = $ob->GetProperties();
                    $arResult["CATEGORIES"][$i]["ITEMS"][] = array_merge($arFields, $arProps);
                }    
            }    
        }
        /* This code adds not fixed keyboard link to the category
        if($arResult["alt_query"] != "")
        {
            $params = array(
                "q" => $arResult["query"],
                "spell" => 1,
            );

            $url = CHTTP::urlAddParams(
                str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"])
                ,$params
                ,array("encode"=>true)
            ).CSearchTitle::MakeFilterUrl("f", $exFILTER);

            $arResult["CATEGORIES"][$i]["ITEMS"][] = array(
                "NAME" => GetMessage("CC_BST_QUERY_PROMPT", array("#query#"=>$arResult["query"])),
                "URL" => htmlspecialcharsex($url),
            );
        }
        */
        if(!$j)
        {
            unset($arResult["CATEGORIES"][$i]);
        }
    }

    if($arParams["SHOW_OTHERS"] === "Y")
    {
        $arResult["CATEGORIES"]["others"] = array(
            "TITLE" => htmlspecialcharsbx($arParams["CATEGORY_OTHERS_TITLE"]),
            "ITEMS" => array(),
        );

        $j = 0;
        $obTitle = new CSearchTitle;
        $obTitle->setMinWordLength($_REQUEST["l"]);
        if($obTitle->Search(
            $arResult["alt_query"]? $arResult["alt_query"]: $arResult["query"]
            ,$arParams["TOP_COUNT"]
            ,$arOthersFilter
            ,true
            ,$arParams["ORDER"]
        ))
        {
            while($ar = $obTitle->Fetch())
            {
                $j++;
                if($j > $arParams["TOP_COUNT"])
                {
                    //it's really hard to make it working
                    break;
                }
                else
                {
                    $arResult["CATEGORIES"]["others"]["ITEMS"][] = array(
                        "NAME" => $ar["NAME"],
                        "URL" => htmlspecialcharsbx($ar["URL"]),
                        "MODULE_ID" => $ar["MODULE_ID"],
                        "PARAM1" => $ar["PARAM1"],
                        "PARAM2" => $ar["PARAM2"],
                        "ITEM_ID" => $ar["ITEM_ID"],
                    );
                }
            }
        }

        if(!$j)
        {
            unset($arResult["CATEGORIES"]["others"]);
        }

    }

    if(!empty($arResult["CATEGORIES"]))
    {
        $arResult["CATEGORIES"]["all"] = array(
            "TITLE" => "",
            "ITEMS" => array()
        );

        $params = array(
            "q" => $arResult["alt_query"]? $arResult["alt_query"]: $arResult["query"],
            "p" => "name",
        );
        $url = CHTTP::urlAddParams(
            str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"])
            ,$params
            ,array("encode"=>true)
        );
        $arResult["CATEGORIES"]["all"]["ITEMS"][] = array(
            "NAME" => GetMessage("CC_BST_ALL_RESULTS"),
            "URL" => $url,
        );
        /*
        if($arResult["alt_query"] != "")
        {
            $params = array(
                "q" => $arResult["query"],
                "spell" => 1,
            );

            $url = CHTTP::urlAddParams(
                str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"])
                ,$params
                ,array("encode"=>true)
            );

            $arResult["CATEGORIES"]["all"]["ITEMS"][] = array(
                "NAME" => GetMessage("CC_BST_ALL_QUERY_PROMPT", array("#query#"=>$arResult["query"])),
                "URL" => htmlspecialcharsex($url),
            );
        }
        */
    }
}

if (isset($arResult["CATEGORIES"])) {
    unset($arResult["CATEGORIES"]);
}
$arResult["FORM_ACTION"] = htmlspecialcharsbx(str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"]));

if (
    $_REQUEST["ajax_call"] === "y"
    && (
        !isset($_REQUEST["INPUT_ID"])
        || $_REQUEST["INPUT_ID"] == $arParams["INPUT_ID"]
    )
    && (isset($arResult["CATEGORIES"])) 
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
