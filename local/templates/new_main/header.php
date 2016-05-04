<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|PT+Sans+Narrow:400,700|PT+Sans+Caption:400,700&subset=latin,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <script type="text/javascript" src="/js/jquery-1.7.1.js"></script>
    <!--<script type="text/javascript" src="js/slide_menu.js"></script>-->

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
        header('location: http://www.'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    }
 
  
//удаление дублей страниц    
if (strpos($_SERVER['REQUEST_URI'], 'index.php') || preg_match("~(\/\?)+(.)?$~", $_SERVER['REQUEST_URI'])) {
    header('location: /');
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
<?$APPLICATION->IncludeComponent(
            "bitrix:search.form",
            "new_search",
            Array(
            )
        );?>

</div>
<div id="main">
<div id="left">
    <div class="cattitle">Каталог запчастей</div>

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
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y"
            ),
            false
        );?>

     
     <div class="cattitle">Бренды</div>   
     <?$APPLICATION->IncludeComponent("bitrix:menu", "left_brands", Array(
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
        
        
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "news_list_new", array(
            "IBLOCK_TYPE" => "LENTA",
            "IBLOCK_ID" => "10",
            "NEWS_COUNT" => "20",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                0 => "ID",
                1 => "CODE",
                2 => "XML_ID",
                3 => "NAME",
                4 => "TAGS",
                5 => "SORT",
                6 => "PREVIEW_TEXT",
                7 => "PREVIEW_PICTURE",
                8 => "DETAIL_TEXT",
                9 => "DETAIL_PICTURE",
                10 => "DATE_ACTIVE_FROM",
                11 => "ACTIVE_FROM",
                12 => "DATE_ACTIVE_TO",
                13 => "ACTIVE_TO",
                14 => "SHOW_COUNTER",
                15 => "SHOW_COUNTER_START",
                16 => "IBLOCK_TYPE_ID",
                17 => "IBLOCK_ID",
                18 => "IBLOCK_CODE",
                19 => "IBLOCK_NAME",
                20 => "IBLOCK_EXTERNAL_ID",
                21 => "DATE_CREATE",
                22 => "CREATED_BY",
                23 => "CREATED_USER_NAME",
                24 => "TIMESTAMP_X",
                25 => "MODIFIED_BY",
                26 => "USER_NAME",
                27 => "",
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
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "Y",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "PAGER_TEMPLATE" => "",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "",
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
            <div class="mainviews_title">Опрос</div>
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

<script type="text/javascript" src="/js/coin-slider.min.js"></script>

<? //выбираем из инфоблока с банерами те, которые относятся к типу "главный"
    $baner_list = CIBlockElement::GetList(array("SORT"=>"ASC"), array("IBLOCK_ID"=>98,"PROPERTY_CATEGORY"=>18, "ACTIVE"=>"Y"),false,false, array("ID","PROPERTY_CATEGORY","PROPERTY_LINK","PREVIEW_PICTURE","ACTIVE","NAME","SORT"));
    //если есть банеры у которых категория - главный, то выводим блок под банеры
    if ($baner_list->SelectedRowsCount() > 0) {
    ?>
    <div id="posterm">

        <?
            //если банер 1 - отключаем автопрокрутку слайдера
            if ($baner_list->SelectedRowsCount() == 1) {
                $auto = "";
            }
            else {$auto = "auto:5000,";}

            $butns = "";
            $btns_cnt = $baner_list->SelectedRowsCount();
            for($i = 1; $i<=$btns_cnt; $i++) {
                $butns = $butns."\".d".$i."\",";
            }
            $butns = substr($butns,0,strlen($butns)-1);
        ?>
        <!--инициализация слайдера -->
        <script>
            $(function() {
                $(".anyClass2").jCarouselLite({
                    visible: 1,
                    <?=$auto?>
                    speed: 500,
                    btnGo:
                    [<?=$butns?>]
                });
            });

        </script>

        <div class="car_box2">
            <div class="anyClass2">
                <ul>
                    <?while ($baner = $baner_list->Fetch()) {?>
                        <?//arshow($baner);
                            $img_path = CFile::GetPath($baner["PREVIEW_PICTURE"]);
                        ?>
                        <li>
                            <a href="<?=$baner["PROPERTY_LINK_VALUE"]?>" title="" target="_blank">
                                <?$file2 = CFile::ResizeImageGet($baner["PREVIEW_PICTURE"], array('width'=>860, 'height'=>275), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                                <img src="<?=$file2['src']?>" alt="<?=$baner["NAME"]?>" title="<?=$baner["NAME"]?>">
                            </a>

                        </li>
                        <?}?>
                </ul>

            </div>

            <? //если слайдов > 1 выводим навигацию
                if ($btns_cnt > 1) {?>
                <div class="car_top_nav">
                    <? for ($i = 1; $i<=$btns_cnt; $i++) {?>
                        <div class='d<?=$i?> <?if ($i == 1) {?>btnGoActive<?} else {?>but <?}?>'></div>
                        <?}?>
                </div>
                <?}?>
        </div>
    </div>

    <?} else {?>
    <br><br>
    <?}?>

<script>$(document).ready(function() {
        //  $('#posterm').coinslider({ hoverPause: false, width: 857, height: 270 });
        // $(".sale_bestseller").parent().attr("id","");
    });
</script>



<div id="marki">Каталог запчастей*</div>
<div id="rightpart4">
    <?
        $pictavtmarcs="pictavtmarcs=[";
        $count=1;
        $arFilter = Array('IBLOCK_ID'=>88, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>2);
        $db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
        while($ar_result = $db_list->GetNext())
        {
            
            //print_r($ar_result[SECTION_PAGE_URL]);
            if (!$ar_result["DETAIL_PICTURE"]){
                $detpic="/bitrix/components/osg/catalog.sections/templates/.default/images/no_preview_picture.gif";
            }
            else
                $detpic=CFile::GetPath($ar_result["DETAIL_PICTURE"]);

            if (!$ar_result["PICTURE"])
                $pic="/bitrix/components/osg/catalog.sections/templates/.default/images/no_preview_picture.gif";
            else
                $pic=CFile::GetPath($ar_result["PICTURE"]);

            $pictavtmarcs.="['".$pic."','".$detpic."'],";

        ?>
        <div class="brand_container">
            <?$file = CFile::ResizeImageGet($ar_result['PICTURE'], array('width'=>130, 'height'=>185), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
            <a href="<?=$ar_result["SECTION_PAGE_URL"];?>" title="<?=$ar_result["NAME"]?>" ><img  rel="<?=$count;?>" id="peugeot" src="<?=$file['src'];?>" alt="<?=$ar_result["NAME"]?>" tittle="<?=$ar_result["NAME"]?>" /></a><br> 
            <?=$ar_result["NAME"]?> <br>
        </div>

        <?
            $count++;
            if ($count==11)  break;
        }
        $pictavtmarcs.="];";

    ?>
    <script>
        <?print_r($pictavtmarcs);?>
        //alert(pictavtmarcs[0]);
    </script>


    <div class="allmarks"><a class="" href="/allbrands/">Бренды</a></div>
    <br>
    <div class="allmarks_desc">* Товарные знаки и логотипы являются собственностью своих законных владельцев и правообладателей.<br></div>


</div> 
            <div id="marki"><h1><?$APPLICATION->IncludeFile(SITE_DIR."include/h1_main.php", Array(),Array("MODE"=>"html"));?></h1></div>
            <div id="rightpart5">
