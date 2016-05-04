<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
    <link href="/js/lytebox.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/lytebox.js"></script>
    <? $APPLICATION->ShowPanel()?>
    <?$APPLICATION->ShowMeta("robots")?>
    <?

        if (!CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
        }


        if(htmlspecialchars($_REQUEST['item_id'])){
            $SOME_ID=htmlspecialchars($_REQUEST['item_id']);

            $arFilter = Array(
                "IBLOCK_CODE"=>'OSG_SEO_PRODUCT',
                "ACTIVE"=>"Y",
                "PROPERTY_PRODUCT_ID"=>$SOME_ID
            );


            $res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter);
            while($ar_fields = $res->GetNext())
            {
                $title=$ar_fields["NAME"];
                $keywords=$ar_fields["PREVIEW_TEXT"];
                $description=$ar_fields["DETAIL_TEXT"];
            }


        }elseif(htmlspecialchars($_REQUEST['section_id'])){
            $SOME_ID=htmlspecialchars($_REQUEST['section_id']);

            $arFilter = Array(
                "IBLOCK_CODE"=>'OSG_SEO_SECTION',
                "ACTIVE"=>"Y",
                "PROPERTY_SECTION_ID"=>$SOME_ID
            );


            $res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter);
            while($ar_fields = $res->GetNext())
            {
                $title=$ar_fields["NAME"];
                $keywords=$ar_fields["PREVIEW_TEXT"];
                $description=$ar_fields["DETAIL_TEXT"];
            }

        }else{
            $SOME_ID='';
        }



        if($SOME_ID!=""){
            echo '
            <meta name="keywords" content="'.$keywords.'" />
            <meta name="description" content="'.$description.'" />
            <title>'.$title.'</title>
            ';
        }else{
        ?>
        <?$APPLICATION->ShowMeta("keywords")?>
        <?$APPLICATION->ShowMeta("description")?>
        <title><?$APPLICATION->ShowTitle()?></title>
        <?
        }
    ?>
    <?$APPLICATION->ShowCSS();?>
    <?$APPLICATION->ShowHeadStrings()?>
    <?$APPLICATION->ShowHeadScripts()?>
</head>

<body>

<?CModule::IncludeModule('osg');?>
<?COSGUser::SetUserInfo()?>
<!-- H E A D E R -->
<table class="conteiner" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
    <td colspan="3"><?$APPLICATION -> ShowPanel();?></td>
</tr>
<!-- 			1 tr 			-->
<tr>
    <td width="20%" rowspan="2" align="center">
        <?$APPLICATION->IncludeFile("include/header_banner.php");?>
        <br /><a href="<?=$APPLICATION->GetCurPageParam("clear_cache=Y", array("clear_cache"));?>">Обновить закешированные данные</a>
    </td>
    <td class="header_top_menu" valign="top">
        <?$APPLICATION->IncludeComponent("osg:personal.menu", ".default", Array(

                ),
                false
            );?>
    </td>
    <td width="20%" height="60" class="rec">
        <?$APPLICATION->IncludeComponent("osg:personal.basket.line", "basket_new", Array(

                ),
                false
            );?>
    </td>
</tr>
<tr height="19">
    <td class="main_menu">
        <?$APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
                    "ROOT_MENU_TYPE"	=>	"top",
                    "MAX_LEVEL"	=>	"1",
                    "CHILD_MENU_TYPE"	=>	"left",
                    "USE_EXT"	=>	"N"
                )
            );?>

    </td>
    <td align="right" class="ico">
        <?$APPLICATION->IncludeFile('include/header_icons.php', array())?>
    </td>
</tr>
<tr>
<td class="left_menu" valign="top">

    <?$APPLICATION->IncludeComponent("osg:catalog.menu", "autobody", Array(
                "AJAX_MODE" => "Y",	// Включить режим AJAX
                "AJAX_OPTION_SHADOW" => "N",	// Включить затенение
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                "CACHE_TYPE" => "N",	// Тип кеширования
                "CACHE_TIME" => "86400",	// Время кеширования (сек.)
                "SHOW_FIRMS" => "Y",	// Показывать бренды
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            ),
            false
        );?>


    <div class="services left_block">
        <dl>
            <dt><strong>УСЛОВИЯ ПОКУПКИ</strong></dt>
            <?$APPLICATION->IncludeComponent("bitrix:menu", "left", Array(
                        "ROOT_MENU_TYPE"	=>	"left",
                        "MAX_LEVEL"	=>	"1",
                        "CHILD_MENU_TYPE"	=>	"left",
                        "USE_EXT"	=>	"N"
                    )
                );?>
        </dl>
    </div><!--leftBlock-->



    <div class="left_block search">
        <?$APPLICATION->IncludeFile('include/search.php', array())?>

    </div><!--leftBlock-->

    <div class="left_block icq">
        <?$APPLICATION->IncludeFile('include/isq.php', array())?>
    </div><!--leftBlock-->

</td>


<td valign="top"><!-- 	start content	 -->
<?$APPLICATION->ShowNavChain();?>
<table cellpadding="0">
    <tbody>
        <tr class="map_href"> 	<td>
                <div></div>
        </td> </tr>
    </tbody>
</table>
