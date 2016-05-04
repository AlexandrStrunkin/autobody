<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h3>Укажите данные контактного лица</h3>

<table width="100%" cellpadding="0" cellspacing="4" class="main_form">
<tr>
    <td width="40%" align="right" <?if (in_array('NAME', $arResult['ERRORS'])) echo 'class="error"'?>>ФИО: <span>*</span></td>
    <td width="60%"><input type="text" class="textbox" name="DATA[NAME]" value="<?=htmlspecialchars($arResult['DATA']['NAME'])?>"/></td>
</tr>

<tr>
    <td align="right" <?if (in_array('EMAIL', $arResult['ERRORS'])) echo 'class="error"'?>>E-mail: <span>*</span></td>
    <td><input type="text" class="textbox" name="DATA[EMAIL]" value="<?=htmlspecialchars($arResult['DATA']['EMAIL'])?>"/></td>
</tr>

<tr>
    <td align="right">Контактный телефон:</td>
    <td><input type="text" class="textbox" name="DATA[PERSONAL_PHONE]" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?>"/></td>
</tr>
</table>  