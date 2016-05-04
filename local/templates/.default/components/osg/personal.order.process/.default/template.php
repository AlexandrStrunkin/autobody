<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="step_img">
<?foreach ($arResult['arSteps'] as $STEP=>$STEP_CODE):?>
<?if ($STEP < $arResult['STEP']):?>
    <img src="/bitrix/templates/demo/images/last<?=$STEP?>.gif" width="49" height="49" />
<?elseif ($STEP == $arResult['STEP']):?>
    <img src="/bitrix/templates/demo/images/active<?=$STEP?>.gif" width="49" height="49" />
<?else:?>    
    <img src="/bitrix/templates/demo/images/gray<?=$STEP?>.gif" width="49" height="49" />
<?endif?>
<?endforeach;?>    
</div>

<?if ($arResult['MESSAGE']):?> <div class="message"><?=$arResult['MESSAGE']?></div> <?endif?>  

<form id="main_form" action="<?=$APPLICATION->GetCurPage()?>" method="POST">
<input type="hidden" name="STEP" value="<?=$arResult['STEP']?>">
<INPUT type="hidden" name="ACTION">
<?foreach ($arResult['DATA'] as $key=>$val):?>
    <input type="hidden" name="DATA[<?=$key?>]" value="<?=htmlspecialchars($val)?>">
<?endforeach;?>

<div class="step">
    <?include('step_'.strtolower($arResult['STEP_CODE']).'.php')?>
</div>  

<table width="100%">
<tr valign="middle">
    <td align="left" height="100">
        <a href="#" title="Назад"  onclick="submit_order_form('PREV')"><img src="/bitrix/templates/demo/images/step_prev.gif" width="138" height="47" alt="Назад" /></a>
    </td>
    <td align="right">
        <a href="#" title="Вперед" onclick="submit_order_form('NEXT')"><img src="/bitrix/templates/demo/images/step_next.gif" width="138" height="47" alt="Вперед" /></a>
    </td> 
    </a></td>
</tr>
</table>

</form>

<SCRIPT>
function submit_order_form(action){
    document.forms['main_form'].elements['ACTION'].value = action;
    document.forms['main_form'].submit();
}
</SCRIPT>

<?//echo '<pre>'.print_r($_REQUEST, true).'</pre>';?>
<?//echo '<pre>'.print_r($arResult, true).'</pre>';?>
