<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($USER->IsAuthorized()):?>

<?if ($arResult['MESSAGE']):?> <div class="message"><?=$arResult['MESSAGE']?></div> <?endif?>

<form id="main_form" action="<?=$APPLICATION->GetCurPage()?>" method="POST">

<table width="100%" cellpadding="0" cellspacing="4" class="main_form">
<tr>
	<td width="40%"><h3>Тип плательщика</h3></td>
	<td width="60%" nowrap>
		<a href="#" onclick="show_legal_block('NATURAL'); return false;" id="NATURAL">Физическое лицо</a>
	    <a href="#" onclick="show_legal_block('LEGAL'); return false;" id="LEGAL">Юридическое лицо</a>
	    <INPUT  type="hidden" name="DATA[UF_USER_TYPE]" id="UF_USER_TYPE">
	</td>
</tr>
<tr  id="legal_block">
	<td align="right" <?if (in_array('WORK_COMPANY', $arResult['ERRORS'])) echo 'class="error"'?>>Название организации<span>*</span></td>
    <td><input type="text" name="DATA[WORK_COMPANY]" value="<?=htmlspecialchars($arResult['DATA']['WORK_COMPANY'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right" <?if (in_array('UF_USER_INN', $arResult['ERRORS'])) echo 'class="error"'?>>ИНН<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_INN]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_INN'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right" <?if (in_array('UF_USER_KS', $arResult['ERRORS'])) echo 'class="error"'?>>Корреспондентский счет<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_KS]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_KS'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right" <?if (in_array('UF_USER_RS', $arResult['ERRORS'])) echo 'class="error"'?>>Расчетный счет<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_RS]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_RS'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right" <?if (in_array('UF_USER_BANK', $arResult['ERRORS'])) echo 'class="error"'?>>Название банка<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_BANK]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_BANK'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right" <?if (in_array('UF_USER_BIK', $arResult['ERRORS'])) echo 'class="error"'?>>БИК банка<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_BIK]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_BIK'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right" <?if (in_array('UF_USER_ADDRESS_U', $arResult['ERRORS'])) echo 'class="error"'?>>Юридический адрес<span>*</span></td>
    <td><input type="text" name="DATA[UF_USER_ADDRESS_U]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_ADDRESS_U'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right">ОКПО</td>
    <td><input type="text" name="DATA[UF_USER_OKPO]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_OKPO'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right">ОКНО</td>
    <td><input type="text" name="DATA[UF_USER_OKNH]" value="<?=htmlspecialchars($arResult['DATA']['UF_USER_OKNH'])?>" /></td>
</tr>
<tr  id="legal_block">
	<td align="right">Рабочий телефон</td>
    <td><input type="text" name="DATA[WORK_PHONE]" value="<?=htmlspecialchars($arResult['DATA']['WORK_PHONE'])?>" /></td>
</tr>

<tr>
    <td colspan="2"><h3>Контактная информация</h3></td>
</tr>
<tr>
    <td align="right" <?if (in_array('NAME', $arResult['ERRORS'])) echo 'class="error"'?>>ФИО: <span>*</span></td>
    <td><input type="text" name="DATA[NAME]" value="<?=htmlspecialchars($arResult['DATA']['NAME'])?>"/></td>
</tr>

<tr>
    <td align="right" <?if (in_array('EMAIL', $arResult['ERRORS'])) echo 'class="error"'?>>E-mail: <span>*</span></td>
    <td><input type="text" name="DATA[EMAIL]" value="<?=htmlspecialchars($arResult['DATA']['EMAIL'])?>"/></td>
</tr>

<tr>
    <td align="right">Контактный телефон:</td>
    <td><input type="text" name="DATA[PERSONAL_PHONE]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?>"/></td>
</tr>

<?if (!$USER->IsAuthorized()):?>


<tr>
    <td colspan="2"><h3>Данные для авторизации на сайте</h3></td>
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
<?endif?>

<tr>
    <td colspan="2"><h3>Адрес для доставки товара</h3></td>
</tr>
<tr>
    <td  align="right" <?if (in_array('PERSONAL_COUNTRY', $arResult['ERRORS'])) echo 'class="error"'?>>Страна: <span>*</span></td>
    <td><?=SelectBoxFromArray("DATA[PERSONAL_COUNTRY]", GetCountryArray(), $arResult['DATA']['PERSONAL_COUNTRY'], '', 'class="textbox"')?></td>
</tr>

<tr>
    <td align="right">Область:</td>
    <td><input type="text" class="textbox" name="DATA[PERSONAL_STATE]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_STATE'])?>"></td>
</tr>

<tr>
    <td  align="right" <?if (in_array('PERSONAL_CITY', $arResult['ERRORS'])) echo 'class="error"'?>> Город: <span>*</span></td>
    <td><input type="text" class="textbox" name="DATA[PERSONAL_CITY]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_CITY'])?>"/></td>
</tr>

<tr>
    <td  align="right" <?if (in_array('PERSONAL_STREET', $arResult['ERRORS'])) echo 'class="error"'?>>Адрес: <span>*</span></td>
    <td><input type="text" class="textbox" name="DATA[PERSONAL_STREET]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_STREET'])?>"/></td>
</tr>

<tr>
    <td align="right">Индекс:</td>
    <td><input type="text" class="textbox" name="DATA[PERSONAL_ZIP]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_ZIP'])?>"/></td>
</tr>

<tr>
    <td valign="top"> <h3>Дополнительная информация</h3> </td>
    <td> <TEXTAREA name="DATA[PERSONAL_NOTES]"><?=htmlspecialchars($arResult['DATA']['PERSONAL_NOTES'])?></TEXTAREA> </td>
    
</tr>

</table>   

<div align="right"><input type="submit" name="save" value="Готово" /></div>

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
<?else:?>


<?$APPLICATION->IncludeComponent(
    "bitrix:form",
    "",
    Array(
        "AJAX_MODE" => "N",
        "SEF_MODE" => "N",
        "WEB_FORM_ID" => "1",
        "RESULT_ID" => $_REQUEST[RESULT_ID],
        "START_PAGE" => "new",
        "SHOW_LIST_PAGE" => "Y",
        "SHOW_EDIT_PAGE" => "Y",
        "SHOW_VIEW_PAGE" => "Y",
        "SUCCESS_URL" => "",
        "SHOW_ANSWER_VALUE" => "N",
        "SHOW_ADDITIONAL" => "N",
        "SHOW_STATUS" => "Y",
        "EDIT_ADDITIONAL" => "N",
        "EDIT_STATUS" => "Y",
        "NOT_SHOW_FILTER" => "",
        "NOT_SHOW_TABLE" => "",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "USE_EXTENDED_ERRORS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_NOTES" => "",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "VARIABLE_ALIASES" => Array(
            "action" => "action"
        )
    )
);?>

<?endif;?>