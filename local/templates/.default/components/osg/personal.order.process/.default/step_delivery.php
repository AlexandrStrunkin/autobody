<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h3>Пожалуйста, выбирете способ оплаты и доставки.</h3>

<table cellpadding="0" cellspacing="0" width="100%" class="oplata_dostavka">
<tr>
	<td width="40%" <?if (in_array('PAY_SYSTEM_ID', $arResult['ERRORS'])) echo 'class="error"'?>><strong>Оплата:</strong><span>*</span></td>
    <td width="60%" <?if (in_array('DELIVERY_ID', $arResult['ERRORS'])) echo 'class="error"'?>><strong>Доставка</strong><span>*</span></td>
</tr>
<tr>
	<td>
    	<?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'] as $PAY_SYSTEM_ID => $arPayment):?>
            <?if ($arPayment['ACTION'][$arResult['DATA']['UF_USER_TYPE']]):?>
                <?if($USER->IsAuthorized()||$arPayment['NAME']=='Наличные'):?>
                <input type="radio" name="DATA[PAY_SYSTEM_ID]" value="<?=$PAY_SYSTEM_ID?>" id="psi_<?=$PAY_SYSTEM_ID?>" <?if (($arResult['DATA']['PAY_SYSTEM_ID']==$PAY_SYSTEM_ID)||(!$USER->IsAuthorized()&&$arPayment['NAME']=='Наличные')) echo 'checked'?> > <label for="psi_<?=$PAY_SYSTEM_ID?>"><?=$arPayment['NAME']?></label> <br>
                <?endif;?>
            <?endif?>
        <?endforeach;?>
    </td>
    <td>
    	<?
        $myprice = $_SESSION['OSG']['USER']['BASKET']['TOTAL_PRICE']; /*print_r($_SESSION['OSG']['USER']['BASKET']);*/
        foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'] as $DELIVERY_ID => $arDelivery):?>
            <?if($USER->IsAuthorized()||$arDelivery['NAME']=='Самовывоз'):?>   
            <input
            <?
            $dis = false;
            if(($myprice>=15000&&$DELIVERY_ID==6)||($myprice<15000&&$DELIVERY_ID==7)) {echo 'disabled'; $dis=true;}
            ?>
            type="radio" name="DATA[DELIVERY_ID]" value="<?=$DELIVERY_ID?>" <?if(($arResult['DATA']['DELIVERY_ID']==$DELIVERY_ID)||(!$USER->IsAuthorized()&&$arDelivery['NAME']=='Самовывоз')) echo 'checked'?> id="deliv_<?=$DELIVERY_ID?>"> <label style="<?if($dis):?>color:gray<?endif;?>" for="deliv_<?=$DELIVERY_ID?>"><?=$arDelivery['NAME']?> (<?=$arDelivery['PRICE']?>) руб.</label><br>
            <?endif;?>
        <?endforeach;?>
    </td>
</tr>
</table>

<?if (!$USER->IsAuthorized()):?>
<h3>Укажите данные для связи с Вами.</h3>  

<table width="100%" cellpadding="0" cellspacing="4" class="main_form">
<tr>
    <td align="right">Ответственное лицо:</td>
    <td><input type="text" class="textbox" name="DATA[FIRSTNAME4]" value="<?=htmlspecialchars($arResult['DATA']['FIRSTNAME4'])?>"/></td>
</tr>
<tr>
    <td align="right">E-mail:</td>
    <td><input type="text" class="textbox" name="DATA[EMAIL4]" value="<?=htmlspecialchars($arResult['DATA']['EMAIL4'])?>"/></td>
</tr>
<tr>
    <td align="right">Телефон:</td>
    <td><input type="text" class="textbox" name="DATA[PHONE4]" value="<?=htmlspecialchars($arResult['DATA']['PHONE4'])?>"/></td>
</tr>
</table>
<?else:?>
<h3>Укажите адрес для доставки товара.</h3>   
<table width="100%" cellpadding="0" cellspacing="4" class="main_form">
<tr>
    <td  align="right" width="20%" <?if (in_array('PERSONAL_COUNTRY', $arResult['ERRORS'])) echo 'class="error"'?>>Страна: <span>*</span></td>
    <td width="80%"><?=SelectBoxFromArray("DATA[PERSONAL_COUNTRY]", GetCountryArray(), $arResult['DATA']['PERSONAL_COUNTRY'], '', 'class="textbox"')?></td>
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
</table>
<?endif?>
<br />