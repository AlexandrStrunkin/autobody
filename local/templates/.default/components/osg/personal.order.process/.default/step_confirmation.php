<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<strong>Проверьте правильность введенной Вами информации. </strong> <br /><br />

<pre>
<?//print_r($_SESSION['OSG']['USER'])?>
</pre>
<h3>
<?if ($USER->IsAuthorized()):?>
Если что-то не соответствует действительности, напишите об этом в поле дополнительной информации.<br>
Вы также можете сначала внести изменения в разделе &laquo;<a href="/personal/">Мои данные</a>&raquo; и потом вернуться к оформлению заказа.
<?else:?>
Если что-то не соответствует действительности, вернитесь на несколько шагов назад и исправьте информацию, все остальные поля останутся при этом без изменения.
<?endif?>
</h3>

<table cellpadding="0" cellspacing="0" width="100%" class="oplata_dostavka">
<tr>
	<td colspan="2">
    	<strong>Информация о покупателе</strong><br /><br />
    </td>
</tr>
<tr>
	<td width="130"><div>Тип плательщика</div></td>
    <td><?=$GLOBALS['OSG_STRUCTURE']['SALE']['PERSON_TYPE'][$arResult['DATA']['UF_USER_TYPE']]['NAME']?></td>
</tr>
<?if ($arResult['DATA']['UF_USER_TYPE'] == 'LEGAL'):?>
    <tr>
        <td><div>Название организации:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['WORK_COMPANY'])?></td>
    </tr>
    <tr>
        <td><div>ИНН:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_INN'])?></td>
    </tr>
        <td><div>Корреспондентский счет:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_KS'])?></td>
    <tr>
        <td><div>Расчетный счет:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_RS'])?></td>
    </tr>
        <td><div>Название банка:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_BANK'])?></td>
    <tr>
        <td><div>БИК банка:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_BIK'])?></td>
    </tr>
        <td><div>Юридический адрес:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_ADDRESS_U'])?></td>

    <?if ($arResult['DATA']['UF_USER_OKPO']):?>
    <tr>
        <td><div>ОКПО:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_OKPO'])?></td>
    </tr>
    <?endif?>

    <?if ($arResult['DATA']['UF_USER_OKNH']):?>
    <tr>
        <td><div>ОКНХ:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['UF_USER_OKNH'])?></td>
    </tr>
    <?endif?>

    <?if ($arResult['DATA']['WORK_PHONE']):?>
    <tr>
        <td><div>Рабочий телефон:</div></td>
        <td><?=htmlspecialchars($arResult['DATA']['WORK_PHONE'])?></td>
    </tr>
    <?endif?>

<?endif?>
<tr>
	<td><div>Ф.И.О.</div></td>
    <td>
    <?if($USER->IsAuthorized()):?>
    <?=htmlspecialchars($arResult['DATA']['LAST_NAME'])?> <?=htmlspecialchars($arResult['DATA']['NAME'])?> <?=htmlspecialchars($arResult['DATA']['SECOND_NAME'])?>
    <?else:?>
    <?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])?>
    <?endif;?>
    </td>
</tr>
<tr>
	<td><div>E-mail</div></td>
    <td>
    <?if($USER->IsAuthorized()):?>
    <?=htmlspecialchars($arResult['DATA']['EMAIL'])?>
    <?else:?>
    <?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])?>
    <?endif;?>
    </td>
</tr>
<tr>
    <td><div>Контактный телефон:</div></td>
    <td>
    <?if($USER->IsAuthorized()):?>
    <?if ($arResult['DATA']['PERSONAL_PHONE']):?>
    <?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?>
    <?else:?>
    не указан
    <?endif?>
    <?else:?>
    <?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])?>
    <?endif;?>
    </td>
</tr>
<tr>
	<td colspan="2">
		<br />
    	<strong>Оплата и доставка</strong><br />
    </td>
</tr>
<tr>
    <td><div>Тип оплаты:</div></td>
    <td><?=$GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'][$arResult['DATA']['PAY_SYSTEM_ID']]['NAME']?></td>
</tr>
<tr>
    <td><div>Тип доставки:</div></td>
    <td><?=$GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'][$arResult['DATA']['DELIVERY_ID']]['NAME']?></td>
</tr>
<? if($arResult['DATA']['PERSONAL_COUNTRY']):?>
<tr>
    <td><div>Страна:</div></td>
    <td><?=GetCountryByID($arResult['DATA']['PERSONAL_COUNTRY'])?></td>
</tr>
<?endif?>
<? if($arResult['DATA']['PERSONAL_STATE']):?>
<tr>
    <td><div>Область:</div></td>
    <td><?=htmlspecialchars($arResult['DATA']['PERSONAL_STATE'])?></td>
</tr>
<?endif?>
<? if($arResult['DATA']['PERSONAL_CITY']):?>
<tr>
    <td><div>Город:</div></td>
    <td><?=htmlspecialchars($arResult['DATA']['PERSONAL_CITY'])?></td>
</tr>
<?endif?>
<? if($arResult['DATA']['PERSONAL_STREET']):?>
<tr>
    <td><div>Адрес:</div></td>
    <td><?=htmlspecialchars($arResult['DATA']['PERSONAL_STREET'])?></td>
</tr>
<?endif?>
<? if($arResult['DATA']['PERSONAL_ZIP']):?>
<tr>
    <td><div>Индекс:</div></td>
    <td><?=htmlspecialchars($arResult['DATA']['PERSONAL_ZIP'])?></td>
</tr>
<?endif?>
<?if($USER->IsAuthorized()):?>
<tr>
    <td colspan="2">
        <br />
        <strong>Прочие пожелания:</strong>
    </td>
</tr>
<tr>
    <td colspan="2">
        <i><input type="checkbox" name="DATA[PACK]" id="pack" onchange="$('#ud_regular').trigger('keyup');"><label for="pack">Требуется жесткая упаковка</label></i><br />


Ответственное лицо: <input style="margin-left:118px" name="DATA[name5]" id="name5" onchange="$('#ud_regular').trigger('keyup');"><br />
Телефон ответственного лица: <input style="margin-left:62px" name="DATA[phone5]" id="phone5" onchange="$('#ud_regular').trigger('keyup');"><br />
Режим работы заказчика: <input style="margin-left:87px" name="DATA[regime]" id="regime" onchange="$('#ud_regular').trigger('keyup');"><br />
    </td>
</tr>
<tr>
<td colspan="2">

<?
// Здесь у нас тип используемой базы в зависимости от редакции:
// ‘mysql’ или ‘oracle'’
global $DBType;
// Подключаем библиотеки админовского интерфейса
require_once($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/classes/'.$DBType.'/favorites.php');
require_once($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/interface/admin_lib.php');
// Определяем константу темы интерфейса
define('ADMIN_THEME_ID', CAdminTheme::GetCurrentTheme());
// Отображаем JS для работы календаря
echo CAdminPage::ShowScript();
?>
Желаемая дата доставки (мин. +1 день):
<?
echo CalendarDate('DATE_ITEM', '', 'curform','');
?>
<script>
$('input[name=DATE_ITEM]').attr('onChange','$(\'#ud_regular\').trigger(\'keyup\')');
$('input[name=DATE_ITEM]').attr('onKeyUp','$(\'#ud_regular\').trigger(\'keyup\')');
$('input[name=DATE_ITEM]').attr('onClick','$(\'#ud_regular\').trigger(\'keyup\')');
$('input[name=DATE_ITEM]').attr('onBlur','$(\'#ud_regular\').trigger(\'keyup\')');

//$('td').attr('onClick','$(\'#ud_regular\').trigger(\'keyup\')');
</script>

</td>
</tr>
<?endif;?>
<tr>
	<td colspan="2">
		<br />
    	<strong>Дополнительная информация</strong><br />
    </td>
</tr>
<tr>
    <td colspan="2"><textarea id="ud_regular" <?if(!$USER->IsAuthorized()):?>onkeyup="
    glue = $(this).attr('value') + '\nФ.И.О.: <?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])?>
    \nE-mail.: <?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])?>
    \nPhone: <?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])?>
    ';
    $('#ud_repeat').attr('value',glue);
    "
    <?else:?>
    onkeyup="
    /*alert('xx');*/
    /*alert($('input[name=DATE_ITEM]').attr('value')+' vs <?=date('d.m.Y')?>');*/
    if($('input[name=DATE_ITEM]').attr('value')=='<?=date('d.m.Y')?>')
    {
    alert('Доставка возможна только на следующий день после заказа');
    $('input[name=DATE_ITEM]').attr('value','');
    }
    glue = $(this).attr('value');
    if($('input[name=DATE_ITEM]').attr('value')!='') glue = 'Желаемая дата доставки: '+$('input[name=DATE_ITEM]').attr('value')+'\n\n'+glue;
    if($('#name5').attr('value')!='') glue = 'Ответственное лицо: '+$('#name5').attr('value')+'\n\n'+glue;
    if($('#phone5').attr('value')!='') glue = 'Телефон ответственного лица: '+$('#phone5').attr('value')+'\n\n'+glue;
    if($('#regime').attr('value')!='') glue = 'Режим работы заказчика: '+$('#regime').attr('value')+'\n\n'+glue;
    if($('#pack').attr('checked')!='') glue = 'Требуется жесткая упаковка!'+'\n\n'+glue;
    $('#ud_repeat').attr('value',glue);
    "
    <?endif;?> rows="3" name="DATA[USER_DESCRIPTION]"><?=htmlspecialchars($arResult['DATA']['USER_DESCRIPTION'])?></textarea>
    <?if(!$USER->IsAuthorized()):?>
<textarea rows="3" name="DATA[USER_DESCRIPTION]" id="ud_repeat" style="display:none">
Ф.И.О.: <?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])."\r\n"?>
E-mail.: <?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])."\r\n"?>
Phone: <?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])."\r\n"?></textarea>
    <?else:?>
<textarea rows="3" name="DATA[USER_DESCRIPTION]" id="ud_repeat" style="display:none"></textarea>
    <?endif;?>
    </td>
</tr>
</table>