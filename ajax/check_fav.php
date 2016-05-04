<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
CModule::IncludeModule('main'); 
$elems=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>117, 'PROPERTY_USER_ID'=>$USER->GetID()), false, false, array('ID', 'PROPERTY_USER_ID', 'PROPERTY_ELEMENT_ID'));
if ($elems->Fetch()) {
    echo 'yes_fav';
}else{
    echo 'no_fav';
}?>
