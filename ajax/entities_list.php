<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");  
CModule::IncludeModule('iblock');
CModule::IncludeModule('main'); 
$el_list=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>116, 'ID'=>$_POST['entity_id'], 'ACTIVE'=>'Y'), false, false, array())->Fetch();
if ($el_list) {
    echo 'yes';
}else {
    echo 'no';
    
}?>