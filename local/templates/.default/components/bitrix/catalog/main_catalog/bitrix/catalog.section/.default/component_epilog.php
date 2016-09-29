<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
/* Скрипт вывода всплывающего окна на странице каталога */
    $(document).ready(function(){
        if ($.cookie('info_popup') != 'Y') {
            $(".forward_catalog_new_info_popup").toggle(500);
            $("body").on("click", ".forward_catalog_new_popup_close_button",  function(){
                $(".forward_catalog_new_info_popup").toggle(500);
                $.cookie('info_popup', 'Y', { expires: 365, path: '/'});
            });
        }
    });
</script>
<?
$db_list = CIBlockSection::GetList(Array(), Array('IBLOCK_ID'=>$arResult['IBLOCK_ID'], 'ID'=>$arResult['ID']), false, array('UF_*'), array());
    $ar_result = $db_list->Fetch();
    if($_REQUEST["PAGEN_1"]):
        $page = " - страница ".$_REQUEST["PAGEN_1"];

    endif;

if (!$ar_result['UF_TITLE']) {
    $ar_result['UF_TITLE'] = $ar_result["NAME"]." - купить оптом со склада в Москве, Омске, Санкт-Петербурге, Екатеребурге".$page;
}

if (!$ar_result['UF_DESCR']) {
    $ar_result['UF_DESCR'] =  "Выгодные цены на ".$ar_result["NAME"].": оптом в интернет магазине 8 (800) 707-78-13. Доставка в Москву, Екатеринбург, Омск, Санкт-Питербург".$page; 
}

if (!$ar_result['UF_KEYWORDS']) {
    $ar_result['UF_KEYWORDS'] = "купить ".$ar_result["NAME"].", цена, оптом, Москва, Санкт-питербург, Омск, Екатеринбург "; 
}

if ($_REQUEST["q"]) {
    $ar_result['UF_TITLE'] = 'Результаты поиска по запросу "'.$_REQUEST["q"].'"'; 
}

$APPLICATION->SetPageProperty("keywords", $ar_result['UF_KEYWORDS']);
$APPLICATION->SetPageProperty("title", $ar_result['UF_TITLE']);
$APPLICATION->SetPageProperty("description", $ar_result['UF_DESCR']);
?>