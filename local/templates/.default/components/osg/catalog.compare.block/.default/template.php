<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (is_array($arResult) && count($arResult)):?>
<?//echo '<div style="color:black"><pre>'; print_r($arResult); echo '</pre></div>';?>

<h2>СРАВНЕНИЕ ТОВАРОВ</h2>
<?foreach ($arResult as $SECTION_ID=>$arSection):?>
<form action="/catalog/compare.php" method="GET" id="compare_form_<?=$SECTION_ID?>">
    <table cellpadding="0" cellspacing="0" class="compare_tovar" width="190">
    <?if ($SECTION_ID):?>
        <tr>
        	<td align="left" colspan="3"><h3><?=$arSection['NAME']?></h3></td>
        </tr>
    <?endif?>
    <?foreach ($arSection['ITEMS'] as $ID=>$arr):?>
        <tr height="24" class="compare_border">
        	<td><?=$arr['NAME']?>
                        <div align="left">
            <? 
            $ginfo = COSGPublic::GetIBlockElementByID($ID); 
            echo 
            '<b>Арт.:</b> '.$ginfo['CODE'].'<br />', 
            '<b>OEM:</b> '.$ginfo['PROPS']['UNC']['VALUE'].'<br />', 
            '<b>Год:</b> '.$ginfo['PROPS']['SIZE']['VALUE'].'<br />';
            ?>
            </div>

            </td>
            <td><span><?=CCurrencyRates::ConvertCurrency($arr['PRICE'], "USD", "RUR");?></span></td>           
            <td><input type="checkbox" name="compare_items[]" value="<?=$ID?>" checked> </td>
        </tr>
    <?endforeach;?>
    <tr height="24">
    	<td colspan="2">
    	   <img src="/bitrix/templates/demo/images/close.gif" width="9" height="9" />
    	   <a href="<?=$arSection['URL_CLEAR_LIST']?>">Очистить список</a>
    	</td>
        <td><input type="checkbox" checked onclick="check_all_items('compare_form_<?=$SECTION_ID?>', this.checked);"/></td>
    </tr>
    <?if (count($arSection['ITEMS']) > 1):?>
    <tr class="compare_confirm">
    	<td align="left" colspan="3" height="35">
    	   <a href="#" onclick="document.forms['compare_form_<?=$SECTION_ID?>'].submit();">
    	   <img src="/bitrix/templates/demo/images/rate.gif" width="16" height="14" />Сравнить выделенное</a>
    	</td>
    </tr>
    <?endif?>
    </table>
</form>    
<?endforeach;?>
<SCRIPT>
function check_all_items(form, checked){
    for (var i=0;i < document.forms[form].elements.length;i++) {
      if (document.forms[form].elements[i].type=='checkbox') {
         document.forms[form].elements[i].checked = checked;
      }
   }
}
</SCRIPT>

<?endif?>