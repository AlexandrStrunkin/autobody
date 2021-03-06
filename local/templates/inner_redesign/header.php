<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|PT+Sans+Narrow:400,700|PT+Sans+Caption:400,700&subset=latin,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <?/*<link rel="stylesheet" type="text/css" href="/css/style.css"/>*/?>
    <link rel="stylesheet" type="text/css" href="/css/style_redesign.css"/>
    <link rel="icon" type="image/png" href="/images/favicon.png"/> 
    <script type="text/javascript" src="/js/jquery-1.7.1.js"></script>

    <script type='text/javascript' src='/js/jquery.rating.js'></script>

    <link href="/css/dcaccordion.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='/js/jquery.hoverIntent.minified.js'></script>
    <script type='text/javascript' src='/js/jquery.dcjqaccordion.2.7.js'></script>


    <script type="text/javascript" src="/js/jcarousellite.js"></script>
    <link href="/css/carousel.css" type="text/css" rel="stylesheet" />


    <link href="/css/jqModal.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jqModal.js'></script>

    <script type='text/javascript' src='/js/script.js'></script>


    <link rel="stylesheet" href="/css/coin-slider-styles.css" type="text/css" />


    <link href="/css/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.fancybox.js'></script>

    <script src="/js/jquery.selectbox.min.js"></script>  

    <script>  
        (function($) {  
            $(function() {  
                $('select').selectbox();  
            })  
        })(jQuery)  
    </script> 

    <?
        //  if ($_SERVER['REQUEST_URI']=='/personal/' ) { 
    ?>
    <script src="/js/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/css/uniform.default.css" type="text/css" media="screen">
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $("input").uniform();
        });
    </script>   
    <?
        //   }
    ?>

    <script type="text/javascript">
        $(document).ready(function($){

            filterPopUp();

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

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        <?$store_list = CCatalogStore::GetList(array(), array("ID"=>$_SESSION["GKWH"]), false, false, array());
            $arStore = $store_list->Fetch();?>

        function initialize() { //инициализация карты складов
            var latlng = new google.maps.LatLng(<?=$arStore["GPS_N"]?>,<?=$arStore["GPS_S"]?>);
            var myOptions = {
                zoom: 17,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true

            };
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(<?=$arStore["GPS_N"]?>,<?=$arStore["GPS_S"]?>),
                map: map,
                draggable: true
            });


        }

    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter23257468 = new Ya.Metrika({id:23257468,
                        webvisor:true,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true});
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/23257468" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Rating@Mail.ru counter -->
    <script type="text/javascript">
        var _tmr = _tmr || [];
        _tmr.push({id: "2544150",  type: "pageView", start: (new Date()).getTime()});
        (function (d, w) {
            var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true;
            ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
            var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
            if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
        })(document, window);
    </script><noscript><div style="position:absolute;left:-10000px;">
            <img src="//top-fwz1.mail.ru/counter?id=2544150;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
        </div></noscript>
    <!-- //Rating@Mail.ru counter -->

    <?$APPLICATION->ShowMeta("robots")?>
    <?if (!CModule::IncludeModule("iblock")){
        CModule::IncludeModule("iblock");
    }?>



</head>

<body onload="initialize()">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="div-header">

<?include $_SERVER["DOCUMENT_ROOT"]."/bitrix/_top_redesign.php";?>       


<div class="wrapper" >

<div class="header-logo">

     <div class="logo-container">
                <a href="/">
                    <? if (checkSite() == 'opt') {?>
                         <?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php", Array(),Array("MODE"=>"html"));?>
                <?   }  else {?>
                
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/logo_retail.php", Array(),Array("MODE"=>"html"));?> 
                    
                    <? } ?>                  
                </a>
            </div>

    <div class="text-logo">
        <table>
            <tr>              
                <td><font class="white-text text-logo-font-bold"><?$APPLICATION->IncludeFile(SITE_DIR."include/header_line_1.php", Array(),Array("MODE"=>"html"));?></font></td>
            </tr>
            <tr>
                <td><font class="white-text text-logo-font"><?$APPLICATION->IncludeFile(SITE_DIR."include/header_line_2.php", Array(),Array("MODE"=>"html"));?></font></td>
            </tr>
            <tr>
                <td>
                    <img class="lk-logo" src="/images/phone-icon.png" alt=""/>
                    <font class="white-text text-logo-font-bold">
                        <?$APPLICATION->IncludeFile(SITE_DIR."include/header_line_3.php", Array(),Array("MODE"=>"html"));?>                               
                    </font></td>
            </tr>
        </table>
    </div>
</div>

<div class="top-menu">              
    <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_redesign", array(
            "ROOT_MENU_TYPE" => "top",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "Y"
            ),
            false
        );?>

</div>

<?/*
    <div class="under-top-menu">
    <table class="under-top-menu-items">
    <tr>
    <td class="under-top-menu-item under-top-menu-active">
    <a class="url" href="#">РљР°Рє РєСѓРїРёС‚СЊ</a>
    </td>
    <td class="under-top-menu-item">
    <a class="url" href="#">Р“Р°СЂР°РЅС‚РёРё</a>
    </td>
    <td class="under-top-menu-item">
    <a class="url" href="#">Р”РѕСЃС‚Р°РІРєР°</a>
    </td>
    <td class="under-top-menu-item">
    <a class="url" href="#">РўСЂР°СЃРїРѕСЂС‚РЅС‹Рµ РєРѕРјРїР°РЅРёРё</a>
    </td>
    <td class="under-top-menu-item">
    <a class="url" href="#">РќР°С€Рё РґРёР»РµСЂС‹</a>
    </td>
    </tr>
    </table>
    </div>
*/?>

<?$APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "newSearch",
        Array(
            "USE_SUGGEST" => "N",
            "PAGE" => "/search_result.php"
        ),
        false
    );?>

<!--<div class="search-div">
<input type="text" class="search-input" placeholder="РџРѕРёСЃРє РїРѕ Р°СЂС‚РёРєСѓР»Сѓ, РЅР°РёРјРµРЅРѕРІР°РЅРёСЋ, РїРѕ РЅРѕРјРµСЂСѓ РїСЂРѕРёР·РІРѕРґРёС‚РµР»СЏ, РїРѕ РѕСЂРёРіРёРЅР°Р»СЊРЅРѕРјСѓ РЅРѕРјРµСЂСѓ">
</div>-->

<table vertical-align="top">
<tr>
<td valign="top">
    <div class="left-menu">
        <div class="left-menu-list">
            <div class="left-menu-title-brand">КАТАЛОГ</div>

            <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "left_menu_redesign", array(
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
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y"
                    ),
                    false
                );?>  
        </div>
        <div class="left-menu-list">

            <?/*$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "left_menu_redesign", array(
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
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y"
                ),
                false
            );*/?>                             

        </div>
    </div>

    <div class="left-menu-brand">
        <div class="left-menu-list-brand">
            <div class="left-menu-title-brand">БРЕНДЫ</div>

            <?$APPLICATION->IncludeComponent("bitrix:menu", "left_brands_redesign", Array(
                    "ROOT_MENU_TYPE" => "left",    // 
                    "MAX_LEVEL" => "1",    //
                    "CHILD_MENU_TYPE" => "left",    //
                    "USE_EXT" => "N",    //
                    "DELAY" => "N",    // 
                    "ALLOW_MULTI_SELECT" => "N",    //
                    "MENU_CACHE_TYPE" => "N",    //
                    "MENU_CACHE_TIME" => "3600",    // 
                    "MENU_CACHE_USE_GROUPS" => "Y",    // 
                    "MENU_CACHE_GET_VARS" => "",    // 
                    ),
                    false
                );?>                                   

        </div>
    </div>


</td>
<td colspan="2" class="categories"> 

<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumps_new", array(
        "START_FROM" => "0",
        "PATH" => "",
        "SITE_ID" => "-"
        ),
        false
    );?>   

<h1 class="cabinet-title"><?=$APPLICATION->ShowTitle()?></h1>

<?

    if ($USER->IsAdmin()) {
        // arshow($_SERVER);
    }
    if ($APPLICATION->GetCurDir() != '/personal/' && $APPLICATION->GetCurDir() != '/personal/order/') {   
    ?>       
    <?$APPLICATION->IncludeComponent("bitrix:menu", "personal_menu_redesign", Array(
            "ROOT_MENU_TYPE" => "personal",    // 
            "MAX_LEVEL" => "1",    //
            "CHILD_MENU_TYPE" => "left",    //
            "USE_EXT" => "N",    //
            "DELAY" => "N",    // 
            "ALLOW_MULTI_SELECT" => "N",    //
            "MENU_CACHE_TYPE" => "N",    //
            "MENU_CACHE_TIME" => "3600",    // 
            "MENU_CACHE_USE_GROUPS" => "Y",    // 
            "MENU_CACHE_GET_VARS" => "",    // 
            ),
            false
        );?>   
    <?}?>