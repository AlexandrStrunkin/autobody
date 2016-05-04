<dl>
	<dt><strong>ICQ КОНСУЛЬТАНТЫ</strong></dt>
<?
 $arFilter = Array(
   "IBLOCK_CODE"=>"OSG_MANAGERS",
   "ACTIVE"=>"Y"
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter,false,array('nTopCount'=>2));
$total = $res->SelectedRowsCount();
if($total>0){
while($ar_fields = $res->GetNext())
{

$db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc", Array("CODE"=>"ICQ"));
if($ar_props = $db_props->Fetch()){
	$ICQ = $ar_props["VALUE"];
}	

 echo '<dd><a href="http://www.icq.com/whitepages/cmd.php?uin='.$ICQ.'&action=message" target=_blank>'.$ar_fields["NAME"].'</a></dd>';
}
}



	
?>
</dl>	