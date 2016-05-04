<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>

<?
// ---- code for index banners
function prepareForQuery($sectionCode){
    return "%-".$sectionCode."%";
}

$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>118,"ACTIVE"=>"Y","ID"=>2363984), false, false, Array("ID","IBLOCK_ID","NAME"));
if($ob = $res->GetNextElement()){
    $arp = $ob->GetProperties();
    $sections = array_map("prepareForQuery",$arp['RELATED_SECTIONS']['VALUE']);   
}

//arshow($sections);

$arSelect = Array("NAME","CODE");
$arFilter = Array("IBLOCK_ID"=>88,"CODE"=>$sections,"ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("rand"=>"asc"), $arFilter, false,Array("nPageSize"=>20), $arSelect);
while($ob = $res->GetNextElement()){
    $arf = $ob->GetFields(); 
    arshow($arf);
}
 
//CIBlockElement::SetPropertyValuesEx(2362416, 118, array("RELATED_SECTIONS" => array("GG","BB","NN")));
 
?> 