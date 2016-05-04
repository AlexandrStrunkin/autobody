<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>

<?
    if($_POST['wh_id']){
  $warehouse_params = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>95 ,"NAME"=>$_POST['wh_id']), false, false, array("NAME","PROPERTY_347"));
        if ($warehouse = $warehouse_params->Fetch()){
            //arshow($warehouse);
           $W_DELIV  = $warehouse["PROPERTY_347_VALUE"];
        }
        }
        echo $W_DELIV; 
?>