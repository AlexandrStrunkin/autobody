<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<div class="forward_catalog_new_arr_tail3"></div>

<?
$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "popup_with_sub", 
    array(
        "PER_PAGE" => "10",
        "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
        "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
        "USE_MIN_AMOUNT" => "N",
        "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
        "ELEMENT_ID" => $_POST["id"],
        "STORE_PATH" => $arParams["STORE_PATH"],
        "MAIN_TITLE" => $arParams["MAIN_TITLE"],
        "STORES" => array(
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "4",
        ),
        "ELEMENT_CODE" => "",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "36000",
        "USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SHOW_EMPTY_STORE" => "Y",
        "SHOW_GENERAL_STORE_INFORMATION" => "N"
    ),
    $component
    );?>