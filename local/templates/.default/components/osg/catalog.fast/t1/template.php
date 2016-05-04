<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>    


<form method="get" action="<?$APPLICATION->GetCurPageParam();?>">
<input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>">
<input type="hidden" name="action" value="tryit">
<table>
<tr>
<td>Артикулы</td>
<td>Количество</td>
</tr>
<?for($i=0;$i<$arResult['ON_PAGE'];$i++):?>
<tr>
<td><input name="query[<?=$i?>][CODE]" value="" /></td>
<td><input name="query[<?=$i?>][QUANTITY]" value="" /></td>
</tr>
<?endfor;?>
<input type="submit" value="Подача запроса">
</table>
</form>
