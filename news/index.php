<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "✔Новости компании Форвард на рынке автозапчастей✔");
$APPLICATION->SetTitle("Новости");
?>

<?
  if(!$USER->IsAuthorized()){
      $APPLICATION->IncludeComponent(
	"bitrix:subscribe.form", 
	"subscr_news", 
	array(
		"USE_PERSONALIZATION" => "Y",
		"PAGE" => "#SITE_DIR#company/subscr.php",
		"SHOW_HIDDEN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"COMPONENT_TEMPLATE" => "subscr_news"
	),
	false
);   
  }else{
    $APPLICATION->IncludeComponent("bitrix:subscribe.simple", "subscr_news", Array(
        "AJAX_MODE" => "N",    // Включить режим AJAX
            "SHOW_HIDDEN" => "Y",    // Показать скрытые рубрики подписки
            "CACHE_TYPE" => "A",    // Тип кеширования
            "CACHE_TIME" => "3600",    // Время кеширования (сек.)
            "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
            "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
            "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        ),
        false
    );
  } 
 
?>
<br>
<? if (checkSite() == 'opt') {?>
                         
                          <?$APPLICATION->IncludeComponent(
    "bitrix:news", 
    "news", 
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "N",
        "SEF_MODE" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "LENTA",
        "IBLOCK_ID" => "10",
        "NEWS_COUNT" => "2",
        "USE_SEARCH" => "N",
        "USE_RSS" => "N",
        "USE_RATING" => "N",
        "USE_CATEGORIES" => "N",
        "USE_REVIEW" => "N",
        "USE_FILTER" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "CHECK_DATES" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "145",
        "LIST_ACTIVE_DATE_FORMAT" => "d/m",
        "LIST_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "LIST_PROPERTY_CODE" => array(
            0 => "NEWS_MAIN",
            1 => "",
        ),
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "DISPLAY_NAME" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
        "DETAIL_PAGER_TITLE" => "РЎС&sbquo;СЂР&deg;РЅРёС&dagger;Р&deg;",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_SHOW_ALL" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_ELEMENT_CHAIN" => "N",
        "USE_PERMISSIONS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_NOTES" => "",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "РќРѕРІРѕСЃС&sbquo;Рё",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "SEF_FOLDER" => "/news/",
        "AJAX_OPTION_ADDITIONAL" => "",
        "SEF_URL_TEMPLATES" => array(
            "news" => "",
            "section" => "",
            "detail" => "#ELEMENT_ID#/",
        )
    ),
    false
);?>
                         
                <?   }  else {?>
                
                  <?$APPLICATION->IncludeComponent(
    "bitrix:news", 
    "news1", 
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "N",
        "SEF_MODE" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "LENTA",
        "IBLOCK_ID" => "10",
        "NEWS_COUNT" => "5",
        "USE_SEARCH" => "N",
        "USE_RSS" => "N",
        "USE_RATING" => "N",
        "USE_CATEGORIES" => "N",
        "USE_REVIEW" => "N",
        "USE_FILTER" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "CHECK_DATES" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "145",
        "LIST_ACTIVE_DATE_FORMAT" => "d/m",
        "LIST_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "LIST_PROPERTY_CODE" => array(
            0 => "NEWS_MAIN",
            1 => "RETAIL_POST",
            2 => "",
        ),
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "DISPLAY_NAME" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
        "DETAIL_PAGER_TITLE" => "РЎС&sbquo;СЂР&deg;РЅРёС&dagger;Р&deg;",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_SHOW_ALL" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_ELEMENT_CHAIN" => "N",
        "USE_PERMISSIONS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_NOTES" => "",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "РќРѕРІРѕСЃС&sbquo;Рё",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "SEF_FOLDER" => "/news/",
        "AJAX_OPTION_ADDITIONAL" => "",
        "COMPONENT_TEMPLATE" => "news1",
        "SET_LAST_MODIFIED" => "N",
        "DETAIL_SET_CANONICAL_URL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "SEF_URL_TEMPLATES" => array(
            "news" => "",
            "section" => "",
            "detail" => "#ELEMENT_ID#/",
        )
    ),
    false
);?>
                    
                    <? } ?>   




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>