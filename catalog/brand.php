<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
if ($ID = (int) $_REQUEST['brand_id']){
    $addFilter = array('PROPERTY_FIRM' => $ID);
    $addTitle = $GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_FIRMS']['ELEMENTS'][$ID]['NAME'];
}
?>
<?$APPLICATION->IncludeComponent(
    "osg:catalog.list",
    "",
    Array(
        "ON_PAGE" => "15",
        "URL_NO_PREVIEW_PICTURE" => "images/no_preview_picture.gif",
        "INCLUDE_SUBSECTIONS" => "Y",
        "ADDITIONAL_FILTER" => $addFilter,
        "ADDITIONAL_TITLE" => $addTitle,
        "SET_TITLE" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N"
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>