<?
$sChainProlog = '<div>';

if ($ITEM_INDEX == $ITEM_COUNT-1){
    $sChainBody .= "<span> $TITLE </span>";
}else{
    $sChainBody .= " $TITLE <img src='/bitrix/templates/demo/images/map_href.gif'> ";
}

$sChainEpilog = '</div>';
?>