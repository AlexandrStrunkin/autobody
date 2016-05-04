<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|PT+Sans+Narrow:400,700|PT+Sans+Caption:400,700&subset=latin,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <script type="text/javascript" src="/js/jquery-1.7.1.js"></script>
    <!--<script type="text/javascript" src="js/slide_menu.js"></script>-->

    <link href="/css/dcaccordion.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='/js/jquery.hoverIntent.minified.js'></script>
    <script type='text/javascript' src='/js/jquery.dcjqaccordion.2.7.js'></script>
    <script type='text/javascript' src='/js/script.js'></script>

    <link href="/css/ratingbig.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.rating.js'></script>

    <link href="/css/jqModal.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jqModal.js'></script>


    <link href="/css/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.fancybox.js'></script>


    <script src="/js/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/css/uniform.default.css" type="text/css" media="screen">
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $("input,  select").uniform();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function($){
            $('#accordion-1').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: true,
                disableLink: true,
                speed: 'slow',
                showCount: false,
                autoExpand: true,
                cookie    : 'dcjq-accordion-1',
                classExpand     : 'dcjq-current-parent'
            });
        });
    </script>

    <?$APPLICATION->ShowMeta("robots")?>
    <?if (!CModule::IncludeModule("iblock")){
        CModule::IncludeModule("iblock");
    }?>

    <?
        if($_SERVER['SERVER_NAME']=='autobody.ru') {
            //$_SERVER['SERVER_NAME']='www.autobody.ru';
            header('location: http://www.'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
        }
        //удаление дублей страниц    
        if (preg_match("~(\/\?)+(.)?$~", $_SERVER['REQUEST_URI'])) {
            $_SERVER['REQUEST_URI']=preg_replace("~(\/\?)+(.)?$~", '', $_SERVER['REQUEST_URI']);
            header('location: '.$_SERVER['REQUEST_URI']);
        }
    ?>

</head>

<body>
<?CModule::IncludeModule('osg');?>
<?COSGUser::SetUserInfo()?>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="all">

<?include $_SERVER["DOCUMENT_ROOT"]."/bitrix/_top.php";?>

<div id="menusearch">
    <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_new", array(
            "ROOT_MENU_TYPE" => "top",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N"
            ),
            false
        );?>
    <?$APPLICATION->IncludeComponent(
            "bitrix:search.form",
            "new_search",
            Array(
            )
        );?>
</div>
<div id="main">
<div id="left">
    <div class="cattitle">Каталог товаров</div>

    <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "left_menu", array(
            "IBLOCK_TYPE" => "OSG_WEB_SHOP",
            "IBLOCK_ID" => "88",
            "SECTION_ID" => $_REQUEST["SECTION_ID"],
            "SECTION_CODE" => "",
            "COUNT_ELEMENTS" => "N",
            "TOP_DEPTH" => "1",
            "SECTION_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "SECTION_URL" => "",
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y"
            ),
            false
        );?>

    <div class="cattitle">Бренды</div>   
    <?$APPLICATION->IncludeComponent("bitrix:menu", "left_brands", Array(
            "ROOT_MENU_TYPE" => "left",    // РўРёРї РјРµРЅСЋ РґР»СЏ РїРµСЂРІРѕРіРѕ СѓСЂРѕРІРЅСЏ
            "MAX_LEVEL" => "1",    // РЈСЂРѕРІРµРЅСЊ РІР»РѕР¶РµРЅРЅРѕСЃС‚Рё РјРµРЅСЋ
            "CHILD_MENU_TYPE" => "left",    // РўРёРї РјРµРЅСЋ РґР»СЏ РѕСЃС‚Р°Р»СЊРЅС‹С… СѓСЂРѕРІРЅРµР№
            "USE_EXT" => "N",    // РџРѕРґРєР»СЋС‡Р°С‚СЊ С„Р°Р№Р»С‹ СЃ РёРјРµРЅР°РјРё РІРёРґР° .С‚РёРї_РјРµРЅСЋ.menu_ext.php
            "DELAY" => "N",    // РћС‚РєР»Р°РґС‹РІР°С‚СЊ РІС‹РїРѕР»РЅРµРЅРёРµ С€Р°Р±Р»РѕРЅР° РјРµРЅСЋ
            "ALLOW_MULTI_SELECT" => "N",    // Р Р°Р·СЂРµС€РёС‚СЊ РЅРµСЃРєРѕР»СЊРєРѕ Р°РєС‚РёРІРЅС‹С… РїСѓРЅРєС‚РѕРІ РѕРґРЅРѕРІСЂРµРјРµРЅРЅРѕ
            "MENU_CACHE_TYPE" => "N",    // РўРёРї РєРµС€РёСЂРѕРІР°РЅРёСЏ
            "MENU_CACHE_TIME" => "3600",    // Р’СЂРµРјСЏ РєРµС€РёСЂРѕРІР°РЅРёСЏ (СЃРµРє.)
            "MENU_CACHE_USE_GROUPS" => "Y",    // РЈС‡РёС‚С‹РІР°С‚СЊ РїСЂР°РІР° РґРѕСЃС‚СѓРїР°
            "MENU_CACHE_GET_VARS" => "",    // Р—РЅР°С‡РёРјС‹Рµ РїРµСЂРµРјРµРЅРЅС‹Рµ Р·Р°РїСЂРѕСЃР°
            ),
            false
        );?>   


    <?$APPLICATION->IncludeComponent("bitrix:news.list", "news_list_new", array(
            "IBLOCK_TYPE" => "LENTA",
            "IBLOCK_ID" => "10",
            "NEWS_COUNT" => "2",
            "SORT_BY1" => "ID",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => "200",
            "ACTIVE_DATE_FORMAT" => "d.M.Y",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "PAGER_TEMPLATE" => "",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Р СњР С•Р Р†Р С•РЎРѓРЎвЂљР С‘",
            "PAGER_SHOW_ALWAYS" => "Y",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_OPTION_ADDITIONAL" => ""
            ),
            false
        );?>

    <?if ($USER->IsAuthorized()) {?>
        <div class="mainviews">
            <div class="mainviews_title">Ваше мнение</div>
            <?$APPLICATION->IncludeComponent("bitrix:voting.form", "vote_form", array(
                    "VOTE_ID" => "6",
                    "VOTE_RESULT_TEMPLATE" => "?VOTE_ID=#VOTE_ID#",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600"
                    ),
                    false
                );?>

        </div>
        <?}?>


</div>
<div id="middle">&nbsp;</div>
<div id="right">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumps_new", array(
        "START_FROM" => "0",
        "PATH" => "",
        "SITE_ID" => "-"
        ),
        false
    );?>

<div class="detail">


<div align="right"> <iframe scrolling="no" frameborder="0" allowtransparency="true" style="border: medium none; overflow: hidden; width: 370px; height: 80px;" src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fautobody.ru&amp;width=370&amp;height=80&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false"></iframe></div>
<hr/> 
<div align="right"> 
<div align="center"> 
<br />   
<div vocab="http://schema.org/" typeof="Organization">
    <font color="#002056">
        <b>
            <font color="#002056">
            <span property="name" >
                Единый <font color="#2F3192">бесплатный</font> телефон для всех офисов:</span> 
            <br />

            <br />
            <font color="#0000FF">
                <font color="#2F3192">
                    <span property="telephone">8 (800) 707-78-13</span> 
                    <br />

                    <br />
                </font>
            </font>
        </b>
    </font>
    <b><span property="name" >Единый <font color="#0000FF">московский</font> телефон для всех офисов:</span></b> 
    <br />

    <br />
    <font color="#0000FF">
        <span property="telephone">8 (495) 788-78-13</span>
    </font> 
    <br />

    <br />
    <hr/>

                        </div>

                                     

  

    
  