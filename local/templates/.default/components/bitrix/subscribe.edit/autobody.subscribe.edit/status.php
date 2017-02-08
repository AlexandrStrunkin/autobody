<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//status and unsubscription/activation section
//***********************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
	<thead><tr><td colspan="3" class="subcriptionTitle"><?echo GetMessage("subscr_title_status")?></td></tr></thead>
	<tr valign="top">
		<td class="subcriptionStatusFirsttd" nowrap><?echo GetMessage("subscr_conf")?></td>
		<td nowrap class="<?echo ($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"? "notetext subcriptionStatusSecondtd":"errortext subcriptionStatusSecondtd")?>"><?echo ($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"? GetMessage("subscr_yes"):GetMessage("subscr_no"));?></td>
		<td rowspan="2" width="370px" class="subcriptionSecondtd">
			<?if($arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"):?>
				<p><span class="errortext"><?echo GetMessage("subscr_title_status_note_error1")?></span><?echo GetMessage("subscr_title_status_note_error2")?></p>
			<?elseif($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>
				<p><?echo GetMessage("subscr_title_status_note2")?></p>   
			<?else:?>
				<p><?echo GetMessage("subscr_status_note4")?></p>    
			<?endif;?>
		</td>
	</tr>
	<tr>
		<td class="subcriptionStatusFirsttd" nowrap><?echo GetMessage("subscr_act")?></td>
		<td nowrap class="<?echo ($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"? "notetext subcriptionStatusSecondtd":"errortext subcriptionStatusSecondtd")?>"><?echo ($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"? GetMessage("subscr_yes"):GetMessage("subscr_no"));?></td>
	</tr>
	<tr>
		<td class="subcriptionStatusFirsttd" nowrap><?echo GetMessage("adm_id")?></td>
		<td class="subcriptionStatusSecondtd" nowrap><?echo $arResult["SUBSCRIPTION"]["ID"];?>&nbsp;</td>
        <td rowspan="3" width="370px" class="subcriptionSecondtdBottom">            
            <?if($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"):?>
                <table>
                    <tr>            
                    <?if($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>            
                        <td>
                            <p><?echo GetMessage("subscr_status_note3")?></p>
                        </td>
                        <td>
                            <input type="submit" name="unsubscribe" value="<?echo GetMessage("subscr_unsubscr")?>" />
                            <input type="hidden" name="action" value="unsubscribe" />
                        </td>
                    <?else:?>
                        <td>
                            <p><?echo GetMessage("subscr_status_note5")?></p>
                        </td>
                        <td>
                            <input type="submit" name="activate" value="<?echo GetMessage("subscr_activate")?>" />
                            <input type="hidden" name="action" value="activate" />
                        </td>
                    <?endif;?>
                    </tr>
                </table>         
            <?endif;?>
        </td> 
	</tr>
	<tr>
		<td class="subcriptionStatusFirsttd" nowrap><?echo GetMessage("subscr_date_add")?></td>
		<td class="subcriptionStatusSecondtd" nowrap><?echo $arResult["SUBSCRIPTION"]["DATE_INSERT"];?>&nbsp;</td>
	</tr>
	<tr>
		<td class="subcriptionStatusFirsttd" nowrap><?echo GetMessage("subscr_date_upd")?></td>
		<td class="subcriptionStatusSecondtd" nowrap><?echo $arResult["SUBSCRIPTION"]["DATE_UPDATE"];?>&nbsp;</td>
	</tr>

</table>
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<?echo bitrix_sessid_post();?>
</form>
<br />