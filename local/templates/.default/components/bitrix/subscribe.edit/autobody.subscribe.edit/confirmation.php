<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//*************************************
//show confirmation form
//*************************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td class="subcriptionTitle" colspan="2"><?echo GetMessage("subscr_title_confirm")?></td></tr></thead>
<tr valign="top">
	<td class="subcriptionFirsttd">
		<div class="subcriptionInputTitle"><?echo GetMessage("subscr_conf_code")?><span class="starrequired">*</span></div>
		<input type="text" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" />
		<div class="subcriptionConfDate">
            <div class="subcriptionConfDateLeft"><?echo GetMessage("subscr_conf_date")?></div>
		    <div class="subcriptionConfDateRight"><?echo $arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?></div>
        </div>
	</td>
	<td class="subcriptionSecondtd">
        <div class="subcriptionSendButtonBlock">
            <a href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><div class="subcriptionSendCode"><?echo GetMessage("subscr_conf_send")?></div></a>
            <input type="submit" name="confirm" class="subcriptionConfirmCode" value="<?echo GetMessage("subscr_conf_button")?>" />
        </div>
        <div class="subcriptionConfirmNote"> 
		    <?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
	    </div>     
        </td>
</tr>                                         
</table>
<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
<?echo bitrix_sessid_post();?>
</form>
<br />
