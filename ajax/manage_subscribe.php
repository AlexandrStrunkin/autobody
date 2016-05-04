<?
require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>

<?
    global $USER;
    
    $el = new CIBlockElement;
    
    $PROP = array();
    $PROP[468] = $_POST['subscriber_mail']; // ---- email
    $PROP[469] = $_POST['required_quantity']; // ---- quantity
    $PROP[470] = $_POST['wh_id']; // ---- warehouse
    
    $arLoadProductArray = Array("IBLOCK_SECTION_ID" => false, "IBLOCK_ID" => 121, "PROPERTY_VALUES" => $PROP, "NAME" => $_POST['good_id']);
    
    if ($relationId = $el -> Add($arLoadProductArray)) {
        echo "Done";
    } else {
        echo "Error";
    }
?>