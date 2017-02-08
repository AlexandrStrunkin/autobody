<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
<?echo bitrix_sessid_post();?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2" class="subcriptionTitle"><?echo GetMessage("subscr_title_settings")?></td></tr></thead>
<tr valign="top" class="subcriptionEmailBlock">
	<td class="subcriptionFirsttd">
		<div class="subcriptionInputTitle"><p><?echo GetMessage("subscr_email")?><span class="starrequired">*</span></div>
		<input type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" /></p>  		
    </td>
	<td class="subcriptionSecondtd">
        <div class="subcriptionSettingsNote">
		    <p><?echo GetMessage("subscr_settings_note1")?></p>
		    <p class="subcriptionBlack"><?echo GetMessage("subscr_settings_note2")?></p>
        </div>
	</td> 
</tr>
<tr class="subcriptionRubrics">
    <td colspan="2">                         
            <div class="subcriptionRubricsTitle"><?echo GetMessage("subscr_rub")?><span class="starrequired">*</span></div>                     
            <table class="subcriptionRubricsList">
                <tr>
                    <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                        <td>
                        <label>
                            <input type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
                                <span class="subscriptionName">
                                    <?=$itemValue["NAME"]?>
                                </span>
                        </label>
                        </td>
                    <?endforeach;?>   
                </tr>       
            </table>
            <input type="submit" name="Save" class="subscriptionChange" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
            <input type="reset" value="<?echo GetMessage("subscr_reset")?>" name="reset" style="display: none;"/> 
    </td>  
</tr>    
</table>
<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<?if($_REQUEST["register"] == "YES"):?>
	<input type="hidden" name="register" value="YES" />
<?endif;?>
<?if($_REQUEST["authorize"]=="YES"):?>
	<input type="hidden" name="authorize" value="YES" />
<?endif;?>
</form>
<br />
