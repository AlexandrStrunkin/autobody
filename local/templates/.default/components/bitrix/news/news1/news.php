<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?if($arParams["USE_RSS"]=="Y"):?>
    <?
    if(method_exists($APPLICATION, 'addheadstring'))
        $APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
    ?>
    <a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
    "bitrix:search.form",
    "flat",
    Array(
        "PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
    ),
    $component
);?>
<br />
<?endif?>

<?if($arParams["USE_FILTER"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.filter",
    "",
    Array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "FILTER_NAME" => $arParams["FILTER_NAME"],
        "FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
        "PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
    ),
    $component
);
?>
<br />
<?endif?>

<?
    //находим главную новость с наибольшим id 
    $arFilter=Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "PROPERTY_NEWS_MAIN_VALUE" => "Y",
        "IBLOCK_LID" => "s1",
        "ACTIVE" => "Y",
        "CHECK_PERMISSIONS" => "Y",
        "ACTIVE_DATE" => "Y"
        );
    $arSelectFields=Array("ID", "PREVIEW_PICTURE","NAME", "PREVIEW_TEXT",
        "DETAIL_PAGE_URL","DATE_CREATE_UNIX");
    $res = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, Array("nTopCount"=>1), $arSelectFields);
    global $arRes;
    $arRes=$res->GetNext();
    
    //находим новость с максимальным id без учета главной новости 
    $arFilter=Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_LID" => "s1",
        "ACTIVE" => "Y",
        "CHECK_PERMISSIONS" => "Y",
        "ACTIVE_DATE" => "Y",
        "!ID" => $arRes['ID']
        );
    $res = CIBlockElement::GetList(Array("ID" => "ASC"), $arFilter, false, Array("nTopCount"=>1), Array("ID"));
    global $newsCounter;
    $newsCounter=$res->GetNext();
    
    //исключаем главную новость из вывода компонента    
    global $arrFilter;
    $arrFilter=Array("!ID" => $arRes['ID']);
    
    define('PREVIEW_TEXT_LENGTH', 150); //желаемая длина строки     
    //уменьшаем длину строки не разрывая слова    
    $strPT=&$arRes["PREVIEW_TEXT"];
    $strPT=wordwrap($strPT,PREVIEW_TEXT_LENGTH,"#end#",true);
    $strPT=strstr($strPT,"#end#",true);
    $strPT.="...";
    
    $arRes["PREVIEW_TEXT"]=htmlspecialcharsex($arRes["PREVIEW_TEXT"]);
    $arRes["NAME"]=htmlspecialcharsex($arRes["NAME"]);
 ?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "",
    Array(
        "IBLOCK_TYPE"    =>    $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID"    =>    $arParams["IBLOCK_ID"],
        "NEWS_COUNT"    =>    $arParams["NEWS_COUNT"],
        "SORT_BY1"    =>    $arParams["SORT_BY1"],
        "SORT_ORDER1"    =>    $arParams["SORT_ORDER1"],
        "SORT_BY2"    =>    $arParams["SORT_BY2"],
        "SORT_ORDER2"    =>    $arParams["SORT_ORDER2"],
        "FIELD_CODE"    =>    $arParams["LIST_FIELD_CODE"],
        "PROPERTY_CODE"    =>    $arParams["LIST_PROPERTY_CODE"],
        "DETAIL_URL"    =>    $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
        "SECTION_URL"    =>    $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "IBLOCK_URL"    =>    $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
        "DISPLAY_PANEL"    =>    $arParams["DISPLAY_PANEL"],
        "SET_TITLE"    =>    $arParams["SET_TITLE"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "INCLUDE_IBLOCK_INTO_CHAIN"    =>    $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
        "CACHE_TYPE"    =>    $arParams["CACHE_TYPE"],
        "CACHE_TIME"    =>    $arParams["CACHE_TIME"],
        "CACHE_FILTER"    =>    $arParams["CACHE_FILTER"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "DISPLAY_TOP_PAGER"    =>    $arParams["DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER"    =>    $arParams["DISPLAY_BOTTOM_PAGER"],
        "PAGER_TITLE"    =>    $arParams["PAGER_TITLE"],
        "PAGER_TEMPLATE"    =>    $arParams["PAGER_TEMPLATE"],
        "PAGER_SHOW_ALWAYS"    =>    $arParams["PAGER_SHOW_ALWAYS"],
        "PAGER_DESC_NUMBERING"    =>    $arParams["PAGER_DESC_NUMBERING"],
        "PAGER_DESC_NUMBERING_CACHE_TIME"    =>    $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
        "DISPLAY_DATE"    =>    $arParams["DISPLAY_DATE"],
        "DISPLAY_NAME"    =>    "Y",
        "DISPLAY_PICTURE"    =>    $arParams["DISPLAY_PICTURE"],
        "DISPLAY_PREVIEW_TEXT"    =>    $arParams["DISPLAY_PREVIEW_TEXT"],
        "PREVIEW_TRUNCATE_LEN"    =>    $arParams["PREVIEW_TRUNCATE_LEN"],
        "ACTIVE_DATE_FORMAT"    =>    $arParams["LIST_ACTIVE_DATE_FORMAT"],
        "USE_PERMISSIONS"    =>    $arParams["USE_PERMISSIONS"],
        "GROUP_PERMISSIONS"    =>    $arParams["GROUP_PERMISSIONS"],
        "FILTER_NAME"    =>    "arrFilter",
        "HIDE_LINK_WHEN_NO_DETAIL"    =>    $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
        "CHECK_DATES"    =>    $arParams["CHECK_DATES"],
    ),
    $component
);?>
