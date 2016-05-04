<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/favoriteClass/class.php");?>

<?
$favoriteHandlerInstance = '';
if($_POST['delete_item']){
    CIBlockElement::Delete($_POST['id']);
} else if($_POST['delete_all']){ 
     $el_list=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>117,'PROPERTY_USER_ID'=>$USER->GetID()),false,false,array('ID'));      
     while($relElem = $el_list->Fetch()){
         CIBlockElement::Delete($relElem['ID']);
     }
} else {
    switch($_POST['type']){
        case 81:
            $favoriteHandlerInstance = new AddSectionToFavorite($_POST['id'],$_POST['type']);
            break;
        case 82:
            $favoriteHandlerInstance = new AddProductToFavorite($_POST['id'],$_POST['type']);
            break;
    }
}
?>