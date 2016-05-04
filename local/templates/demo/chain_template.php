<?
$sChainProlog =  
'<table cellpadding="0" cellpadding="0">
<tr class="map_href">
	<td>';

if ($ITEM_INDEX == $ITEM_COUNT-1){
    $sChainBody .= $TITLE."<h2>".mb_strtoupper($TITLE)."</h2>";
}else{
    $sChainBody .= "<a href='$LINK'>$TITLE</a> <img src='/bitrix/templates/demo/images/map_href.gif'> ";
}

$sChainEpilog = 
    '</td>
</tr>
</table>';
?>