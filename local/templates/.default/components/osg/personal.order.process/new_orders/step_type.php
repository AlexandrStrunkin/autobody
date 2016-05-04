<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<table width="100%" cellpadding="0" cellspacing="4" class="main_form">
<tr>
	<td width="40%"><h3>Укажите тип плательщика</h3></td>
	<td width="60%" nowrap>
		<a href="#" onclick="show_legal_block('NATURAL'); return false;" id="NATURAL">Физическое лицо</a>
	    <a href="#" onclick="show_legal_block('LEGAL'); return false;" id="LEGAL">Юридическое лицо</a>
	    <INPUT  type="hidden" name="DATA[UF_USER_TYPE]" id="UF_USER_TYPE">
	</td>
</tr>
<tr id="legal_block">
	<td width="40%" align="right" <?if (in_array('WORK_COMPANY', $arResult['ERRORS'])) echo 'class="error"'?>>Название организации<span>*</span></td>
    <td width="60%"><input type="text" name="DATA[WORK_COMPANY]" value="<?=htmlspecialchars($arResult['DATA']['WORK_COMPANY'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right" <?if (in_array('UF_USER_INN', $arResult['ERRORS'])) echo 'class="error"'?>>ИНН<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_INN]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_INN'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right" <?if (in_array('UF_USER_KS', $arResult['ERRORS'])) echo 'class="error"'?>>Корреспондентский счет<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_KS]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_KS'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right" <?if (in_array('UF_USER_RS', $arResult['ERRORS'])) echo 'class="error"'?>>Расчетный счет<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_RS]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_RS'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right" <?if (in_array('UF_USER_BANK', $arResult['ERRORS'])) echo 'class="error"'?>>Название банка<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_BANK]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_BANK'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right" <?if (in_array('UF_USER_BIK', $arResult['ERRORS'])) echo 'class="error"'?>>БИК банка<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_BIK]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_BIK'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right" <?if (in_array('UF_USER_ADDRESS_U', $arResult['ERRORS'])) echo 'class="error"'?>>Юридический адрес<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_ADDRESS_U]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_ADDRESS_U'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right">ОКПО</td>
    <td><input type="text" name="DATA[UF_USER_OKPO]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_OKPO'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right">ОКНО</td>
    <td><input type="text" name="DATA[UF_USER_OKNH]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_OKNH'])?>" /></td>
</tr>
<tr id="legal_block">
	<td align="right">Рабочий телефон</td>
    <td><input type="text" name="DATA[WORK_PHONE]" value="<?=htmlspecialchars($arResult['DATA']['WORK_PHONE'])?>" /></td>
</tr>

<tr>
    <td colspan="2"><h3>
    Данные для авторизации на сайте. <br />
    Если Вы уже зарегистрированы на нашем сайте, настоятельно рекомендуем Вам авторизоваться перед процедурой оформления заказа. <br />
    Иначе заполните расположенные ниже поля для того, чтобы в дальнейшем иметь возможность отслеживать выполнение сделанных заказов.
    </h3></td>
</tr>
<tr>
    <td align="right" <?if (in_array('LOGIN', $arResult['ERRORS'])) echo 'class="error"'?>>Логин (мин 3 символа): <span>*</span></td>
    <td><input type="text" name="DATA[LOGIN]" value="<?=htmlspecialchars($arResult['DATA']['LOGIN'])?>"/></td>
</tr>

<tr>
    <td align="right" <?if (in_array('PASSWORD', $arResult['ERRORS'])) echo 'class="error"'?>>Пароль (мин 6 символов): <span>*</span></td>
    <td><input type="password" name="DATA[PASSWORD]" value="<?=htmlspecialchars($arResult['DATA']['PASSWORD'])?>"></td>
</tr>

<tr>
    <td align="right" <?if (in_array('CONFIRM_PASSWORD', $arResult['ERRORS'])) echo 'class="error"'?>>Подтверждение пароля: <span>*</span></td>
    <td><input type="password" name="DATA[CONFIRM_PASSWORD]" value="<?=htmlspecialchars($arResult['DATA']['CONFIRM_PASSWORD'])?>"></td>
</tr>
</table>   

<script>
function show_legal_block(active_type){
    
	var active_type = (active_type=='LEGAL') ? 'LEGAL' : 'NATURAL';
	var none_active_type = (active_type=='LEGAL') ? 'NATURAL' : 'LEGAL';
	var legal_block_style = (active_type=='LEGAL') ? '' : 'none';
	
	document.getElementById(active_type).className = 'active';
	<?if ($USER->IsAuthorized()):?>
	document.getElementById(none_active_type).style.display = 'none';
	<?else:?>
	document.getElementById(none_active_type).className = 'none_active';
	<?endif?>
	
    list = document.getElementsByTagName('*');
    for (i=0; i<list.length; i++){
        if (list[i].id == 'legal_block'){
            list[i].style.display = legal_block_style;
        }
    }
    document.getElementById('UF_USER_TYPE').value = active_type;
}

show_legal_block('<?=$arResult['DATA']['UF_USER_TYPE']?>');

</script>