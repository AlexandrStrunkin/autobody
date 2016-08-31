<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>      
<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|PT+Sans+Narrow:400,700|PT+Sans+Caption:400,700&subset=latin,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <?/*<link rel="stylesheet" type="text/css" href="/css/style.css"/>*/?>
    <link rel="stylesheet" type="text/css" href="/css/style_redesign.css"/>
    <script type="text/javascript" src="/js/jquery-1.7.1.js"></script>
    <link rel="icon" type="image/png" href="/images/favicon.png"/> 
    <link rel="apple-touch-icon" href="/images/favicon-iphone.png"/>  
    <script type='text/javascript' src='/js/jquery.rating.js'></script>

    <!--<link rel="stylesheet" type="text/css" href="/css/catalog_style.css" />     -->

    <link href="/css/dcaccordion.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='/js/jquery.hoverIntent.minified.js'></script>
    <script type='text/javascript' src='/js/jquery.dcjqaccordion.2.7.js'></script>

    <link rel="stylesheet" href="/css/perfect-scrollbar.min.css" />
    <script src="/js/perfect-scrollbar.jquery.min.js"></script>
    <script type="text/javascript" src="/js/perfect-scrollbar.min.js"></script>


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

    <script src="/js/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <!--    <link rel="stylesheet" href="/css/uniform.default.css" type="text/css" media="screen">
    <script type="text/javascript" charset="utf-8">
    $(function(){
    $("input,  select").uniform();
    });
    </script>   -->

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

    <script type="text/javascript">
        $(function(){

            /*$(".feedback-popup").click(function(e){
            $(".popup-overlay").show();
            $(".popup-form").slideDown();
            });*/

            $(".popup-overlay").click(function(e){
                $(".popup-overlay").hide();
                $(".popup-form").hide();
                $(".popup-done").hide();
                //Очищение всех input в всплывающем окне при закрытии окна
                $("input").val(
                    function(x){
                        x="";
                        return x;
                    }
                )
                //Очищение textarea в всплывающем окне при закрытии окна
                $("textarea").val(
                    function(x){
                        x="";
                        return x;
                    }
                )
                $(".form_alert").css("display","none");
            });

            $(".popup-done").click(function(e){
                $(".popup-overlay").hide();
                $(".popup-done").hide();
            });

            $(".button2").click(function(e){
                $(".popup-done").show();
            });

        });
    </script>




    <?$APPLICATION->ShowMeta("robots")?>
    <?if (!CModule::IncludeModule("iblock")){
        CModule::IncludeModule("iblock");
    }?>




    <?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
</head>

<body onload="initialize(); ">
<?
    CModule::IncludeModule('osg');
    COSGUser::SetUserInfo();
?>
<div class="new_overlay"></div>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="div-header">

    <div>
        <div class="popup-overlay" style="display: none;"></div>
        <div class="popup-form" style="display: none;">
            <?$APPLICATION->IncludeComponent("osg:feedback", "feedback-main-redesign", Array(
                ));?>
        </div>
        <div class="popup-done" style="display: none;">
            <div class="change-done" >
                <div class="done-title">НОВЫЕ ДАННЫЕ УСПЕШНО ОТПРАВЛЕНЫ</div>


                <div class="done-info">В ближайшее время ваша заявка будет <br>
                    рассмотрена.   </div>

                <img class="change-data-done" src="/images/change-data-done.png" alt=""/>
            </div>

        </div>

    </div> 



    <?include $_SERVER["DOCUMENT_ROOT"]."/bitrix/_top_redesign.php";?>       

    <div id="shadow"></div>
    <div class="wrapper" >
        <!--<img src="/img/forw_y_1.jpg" class="newYearBalls">-->
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
                </table>
            </div>

            <div class="phone">
                <img class="lk-logo" src="/images/phone-icon.jpg" alt=""/>
                <font class="white-text text-logo-font-bold ">
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/header_line_3.php", Array(),Array("MODE"=>"html"));?>                               
                </font>
            </div>
        </div>
        <?if (checkSite()=="retail") {
                $menu_type="top_retail"; 
                $menu_template = "top_menu_redesign";
            }
            else {
                $menu_template = "top_menu_redesign2";
                $menu_type="top";
        }?>
        <div class="top-menu">              
            <?$APPLICATION->IncludeComponent("bitrix:menu", $menu_template, Array(
                    "ROOT_MENU_TYPE" => $menu_type,	// Тип меню для первого уровня
                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "ALLOW_MULTI_SELECT" => "Y",	// Разрешить несколько активных пунктов одновременно
                    ),
                    false
                );?>

        </div>

        <?/*
            <div class="under-top-menu">
            <table class="under-top-menu-items">
            <tr>
            <td class="under-top-menu-item under-top-menu-active">
            <a class="url" href="#">Как купить</a>
            </td>
            <td class="under-top-menu-item">
            <a class="url" href="#">Гарантии</a>
            </td>
            <td class="under-top-menu-item">
            <a class="url" href="#">Доставка</a>
            </td>
            <td class="under-top-menu-item">
            <a class="url" href="#">Траспортные компании</a>
            </td>
            <td class="under-top-menu-item">
            <a class="url" href="#">Наши дилеры</a>
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

        <table vertical-align="top">
            <tr>
                <td valign="top">
                    <div class="left-menu">
                        <div class="left-menu-list">
                            <div class="left-menu-title-brand">КАТАЛОГ</div>

                            <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section.list", 
                                    "left_menu_redesign", 
                                    array(
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


                    <div class="left-vote">

                        <?$APPLICATION->IncludeComponent(
	"bitrix:voting.current", 
	"vote-main", 
	array(
		"CHANNEL_SID" => "RANDOM",
		"VOTE_ID" => "8",
		"VOTE_ALL_RESULTS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "vote-main"
	),
	false
);?> 

                        <!--<div class="left-vote-title">КАК ВАМ НОВЫЙ <br> ДИЗАЙН?</div>
                        <div class="left-vote-note">Поделитесь Вашим <br> мнением с нами, <br> учавствуйте в опросе!</div>

                        <label class="custom-radio"><input name="test" value="1" type="radio"/>Отлично</label>
                        <label class="custom-radio"><input name="test" value="2" type="radio"/>Дизайн по тренду</label>
                        <label class="custom-radio"><input name="test" value="3" type="radio"/>Нормально</label>
                        <label class="custom-radio"><input name="test" value="4" type="radio"/>Стало хуже</label>    


                        <button class="vote-button" type="submit">ГОЛОСОВАТЬ</button> --> 

                    </div>

                </td>
                <td colspan="2" class="categories">            
                    <div class="categories-back">

                        <div class="categories-title">Основные категории</div>                            
                        <!--<div class="categories-title">С новым годом</div> -->
                        <!--<img src="/images/forward_2015_1.png"> -->

                        <?$res_cat=CIBlockElement::GetList(
                                Array("SORT"=>"ASC"),
                                Array("IBLOCK_CODE"=>"MAJOR_CATECORIES"),
                                false,
                                false,
                                Array("NAME","PREVIEW_PICTURE","PROPERTY_LINK_CATEGORIES")
                            );
                            $n==1;
                            while($ob_cat=$res_cat->Fetch()):
                                if($n%3==0):
                                    $class="categories-section";
                                    else:
                                    $class="categories-section-next";
                                    endif;

                                $path_img=CFile::GetPath(
                                    $ob_cat["PREVIEW_PICTURE"]
                                );
                            ?>  

                            <div class="<?=$class?> blackout-effect">  
                                <img title="<?=htmlspecialchars($ob_cat["NAME"])?>" alt="Форвард - <?=htmlspecialchars($ob_cat["NAME"])?>" class="img-categories" src="<?=$path_img?>" /> 
                                <div class="mask2">
                                    <div class="mask"></div>
                                    <div class="categories-name-visible"><?=$ob_cat["NAME"]?></div> 
                                    <div class="icon-visible2"></div>
                                    <a class="url" href="<?=$ob_cat["PROPERTY_LINK_CATEGORIES_VALUE"]?>"><div class="categories-icon-more">Подробнее</div></a> 
                                </div> 
                            </div>
                            <?
                                $n++;
                                endwhile;  
                        ?>


                        <div class="categories-info">Наши менеджеры помогут вам с подбором запчастей, <br><a class="feedback-popup" href="/feedback/"><font class="info-font">заказать обратный звонок.</font></a></div>

                    </div>

                    <table class="wrap_table">
                        <tr>
                            <td valign="top" class="wrap_table_1">
                                <div class="news-back">


                                    <div class="news-title">ПОСЛЕДНИЕ НОВОСТИ</div>

                                    <?$APPLICATION->IncludeComponent(
                                            "bitrix:news.list", 
                                            "news_main", 
                                            array(
                                                "DISPLAY_DATE" => "Y",
                                                "DISPLAY_NAME" => "Y",
                                                "DISPLAY_PICTURE" => "Y",
                                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                                "AJAX_MODE" => "N",
                                                "IBLOCK_TYPE" => "LENTA",
                                                "IBLOCK_ID" => "10",
                                                "NEWS_COUNT" => "20",
                                                "SORT_BY1" => "ACTIVE_FROM",
                                                "SORT_ORDER1" => "DESC",
                                                "SORT_BY2" => "",
                                                "SORT_ORDER2" => "ASC",
                                                "FILTER_NAME" => "",
                                                "FIELD_CODE" => array(
                                                    0 => "DATE_ACTIVE_FROM",
                                                    1 => "",
                                                ),
                                                "PROPERTY_CODE" => array(
                                                    0 => "NEWS_MAIN",
                                                    1 => "",
                                                ),
                                                "CHECK_DATES" => "Y",
                                                "DETAIL_URL" => "/news/#ELEMENT_ID#/ ",
                                                "PREVIEW_TRUNCATE_LEN" => "80",
                                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                                "SET_TITLE" => "N",
                                                "SET_BROWSER_TITLE" => "N",
                                                "SET_META_KEYWORDS" => "N",
                                                "SET_META_DESCRIPTION" => "N",
                                                "SET_STATUS_404" => "N",
                                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                                "ADD_SECTIONS_CHAIN" => "N",
                                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                                "PARENT_SECTION" => "",
                                                "PARENT_SECTION_CODE" => "",
                                                "INCLUDE_SUBSECTIONS" => "Y",
                                                "CACHE_TYPE" => "A",
                                                "CACHE_TIME" => "36000000",
                                                "CACHE_NOTES" => "",
                                                "CACHE_FILTER" => "N",
                                                "CACHE_GROUPS" => "N",
                                                "PAGER_TEMPLATE" => ".default",
                                                "DISPLAY_TOP_PAGER" => "N",
                                                "DISPLAY_BOTTOM_PAGER" => "N",
                                                "PAGER_TITLE" => "Новости",
                                                "PAGER_SHOW_ALWAYS" => "N",
                                                "PAGER_DESC_NUMBERING" => "N",
                                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                                "PAGER_SHOW_ALL" => "N",
                                                "AJAX_OPTION_JUMP" => "N",
                                                "AJAX_OPTION_STYLE" => "Y",
                                                "AJAX_OPTION_HISTORY" => "N",
                                                "AJAX_OPTION_ADDITIONAL" => "",
                                                "COMPONENT_TEMPLATE" => "news_main",
                                                "SET_LAST_MODIFIED" => "N",
                                                "PAGER_BASE_LINK_ENABLE" => "N",
                                                "SHOW_404" => "N",
                                                "MESSAGE_404" => ""
                                            ),
                                            false
                                        );?>
                                </div> 
                            </td>
                            <td class="wrap_table_2"> 
                                <div class="right-menu-new">  
                                    <div class="right-menu-items">
                                        <div class="right-menu-title">НОВЫЕ ТОВАРЫ</div>

                                        <?
                                            //получаем список элементов каталога за последние 30 дней
                                            $arFilter = array();
                                            $arFilter["IBLOCK_ID"] = 88;
                                            $arFilter["SECTION_ID"] = array();
                                            $sections_all = CIBLockSection::GetTreeList(array($arFilter["IBLOCK_ID"]),array("ID"));
                                            while($arSections_all = $sections_all->Fetch()) {
                                                $arFilter["SECTION_ID"][] = $arSections_all["ID"];
                                            }                                               

                                            $days_count = 30;

                                            $arFilter[">=DATE_CREATE"] = date($DB -> DateFormatToPHP(CLang::GetDateFormat("SHORT")), date("U") - 86400*$days_count);


                                            $items = CIBLockElement::GetList(array("RAND"=>"ASC"), $arFilter, false, array("nTopCount"=>4), array("ID","NAME","CODE","PROPERTY_SIZE","IBLOCK_SECTION_ID","DATE_CREATE"));

                                        ?> 
                                        <?while ($arElement = $items->Fetch()){?>
                                            <div class="right-menu-item"> 
                                                <?$dateCreate = explode(".",substr($arElement["DATE_CREATE"],0,10));?>
                                                <div class="new-item-date"><?=$dateCreate[0]?>/<?=$dateCreate[1]?></div> 
                                                <br> 
                                                <a class="url" href="/catalog/<?=$arElement["IBLOCK_SECTION_ID"]?>/<?=$arElement["ID"]?>/">
                                                    <?
                                                        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".jpg")) {$img_path = "/upload/images/".$arElement['CODE'].".jpg";}
                                                        else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".JPG")) {$img_path = "/upload/images/".$arElement['CODE'].".JPG";}
                                                            else {$img_path = "";}
                                                    ?>
                                                    <?if ($img_path != ""){?>
                                                        <img title="<?=htmlspecialchars($arElement["NAME"])?>" src="<?=$img_path?>" alt="Форвард - <?=htmlspecialchars($arElement["NAME"])?>"/>
                                                        <?}?>
                                                    <div class="new-item-code blue-text"><?=$arElement["CODE"]?></div>
                                                </a>
                                                <div class="deleter"></div>
                                                <div class="new-item-note"><?=$arElement["NAME"]?></div>
                                            </div>

                                            <?}?>    



                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>                  
    </div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    <?if (!$_SESSION["GKWH"]) {$_SESSION["GKWH"] = 1;}?>
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

<?
    // --- favorite popup

    $APPLICATION->IncludeFile(SITE_DIR."include/favorite_popup.php", Array(),Array("MODE"=>"html"));  
