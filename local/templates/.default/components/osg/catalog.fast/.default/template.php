<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>    

<?//echo '<pre>'; print_r($arResult); echo '</pre>';?>

<? // Default template for catalog.fast ?>
<h3>Быстрый выбор товаров по артикулам</h3>
<form action="" method="post">
<input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>">
<input type="hidden" name="action" value="getfast">
<table id="fast_table" class="tfast" style="background:#adc7e0;">
<tr>
<td><b>Артикулы</b></td>
<td><b>Количество</b></td>
<td></td>
</tr>
<?for($i=0;$i<max($arResult['ON_PAGE'],$arResult['ARR_SIZE']);$i++):?>
<tr>
<td><input name="query[<?=$i?>][CODE]" value="<?=htmlspecialcharsbx($_REQUEST['query'][$i]['CODE'])?>" /></td>
<td align="center"><input style="width:30px" name="query[<?=$i?>][QUANTITY]" value="<?=htmlspecialcharsbx($_REQUEST['query'][$i]['QUANTITY'])?>" /></td>
<td>
<?if($_REQUEST['action']=='getfast'){?>
<?if($arResult['FOUNDS'][$i]['ID']) {?>
<? if(!$arResult['FOUNDS'][$i]['OVERFLOW']){?>
<span style="color:green"><span style="display:none">Есть в наличии!</span>
<?if($arResult['FOUNDS'][$i]['WAS_ADD']) {?>Добавлено в корзину!<?}?>
</span><? } else {?><span style="color:red">Такого кол-ва нет на сладе!</span><?}?>
<?} elseif($_REQUEST['query'][$i]['CODE']) {?>Не найден!<?}?>
<?} else {?><div style="width:100px"></div><?}?>
</td>
</tr>
<?endfor;?>
</table>
<script>
i=<?=$i?>;
</script>
<input type="reset" value="Сбросить" /> &nbsp;
<input type="submit" value="Добавить в корзину" /> &nbsp;

<a onClick="
for(j=0;j<<?=$arResult['ON_PAGE']?>;j++) {
$('#fast_table').append('<tr><td><input name=query['+i+'][CODE]></td><td align=center><input style=&quot;width:30px&quot; name=query['+i+'][QUANTITY] /></td><td></td></tr>');i++;}
return false;
" href="#">Добавить поля</a>  

</form>

<br /><br />