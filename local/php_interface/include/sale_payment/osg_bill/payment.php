<?
$resBasket = CSaleBasket::GetList(array(), array('ORDER_ID'=>$ORDER_ID));
while ($arBasket = $resBasket->Fetch()){	
    $GLOBALS['SALE_INPUT_PARAMS']['BASKET'][] = $arBasket;
}	
?>
<?//echo '<pre>'.print_r($GLOBALS["SALE_CORRESPONDENCE"], true).'</pre>';?>
<?//echo '<pre>'.print_r($GLOBALS['SALE_INPUT_PARAMS'], true).'</pre>';?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8">
<TITLE></TITLE>
<STYLE TYPE="text/css">
body { background: #ffffff; margin: 0; font-family: Arial; font-size: 8pt; font-style: normal; }
tr.R0{ height: 11pt; }
tr.R0 td.R0C1{ text-align: center; vertical-align: medium; }
td.R10C1{ font-family: Arial; font-size: 8pt; font-style: normal; text-align: left; vertical-align: medium; border-left: #000000 1px solid; border-top: #ffffff 0px none; border-bottom: #000000 1px solid; }
td.R12C1{ font-family: Arial; font-size: 14pt; font-style: normal; font-weight: bold; vertical-align: medium; }
tr.R14{ height: 7pt; }
tr.R14 td.R14C1{ border-bottom: #000000 2px solid; }
tr.R14 td.R22C1{ border-top: #000000 2px solid; }
tr.R14 td.R27C33{ border-bottom: #ffffff 2px none; }
td.R16C1{ font-family: Arial; font-size: 10pt; font-style: normal; vertical-align: medium; }
td.R16C5{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; vertical-align: top; }
td.R20C1{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; text-align: center; vertical-align: medium; border-left: #000000 2px solid; border-top: #000000 2px solid; }
td.R20C2{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; text-align: center; vertical-align: medium; border-left: #000000 1px solid; border-top: #000000 2px solid; }
td.R20C6{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; text-align: center; vertical-align: medium; border-left: #000000 1px solid; border-top: #000000 2px solid; border-right: #000000 2px solid; }
td.R21C1{ text-align: center; vertical-align: top; border-left: #000000 2px solid; border-top: #000000 1px solid; }
td.R21C2{ text-align: left; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; }
td.R21C3{ text-align: right; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; }
td.R21C6{ text-align: right; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-right: #000000 2px solid; }
td.R23C5{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; text-align: right; vertical-align: top; }
td.R25C1{ font-family: Arial; font-size: 10pt; font-style: normal; }
td.R30C1{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; vertical-align: medium; }
td.R30C15{ font-family: Arial; font-size: 9pt; font-style: normal; }
td.R30C6{ border-bottom: #000000 1px solid; }
td.R34C10{ text-align: right; vertical-align: medium; border-bottom: #000000 1px solid; }
td.R34C6{ vertical-align: medium; border-bottom: #000000 1px solid; }
td.R4C1{ font-family: Arial; font-size: 10pt; font-style: normal; text-align: left; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; }
td.R4C19{ font-family: Arial; font-size: 10pt; font-style: normal; vertical-align: medium; border-left: #000000 1px solid; border-top: #000000 1px solid; }
td.R4C22{ font-family: Arial; font-size: 10pt; font-style: normal; text-align: left; vertical-align: medium; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #ffffff 0px none; border-right: #000000 1px solid; }
td.R5C22{ font-family: Arial; font-size: 10pt; font-style: normal; text-align: left; vertical-align: top; border-left: #000000 1px solid; border-top: #ffffff 0px none; border-right: #000000 1px solid; }
td.R6C1{ border-left: #000000 1px solid; border-right: #000000 1px solid; }
td.R7C19{ font-family: Arial; font-size: 10pt; font-style: normal; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; }
td.R7C22{ font-family: Arial; font-size: 10pt; font-style: normal; text-align: left; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
td.R7C3{ font-family: Arial; font-size: 10pt; font-style: normal; text-align: left; vertical-align: medium; border-top: #000000 1px solid; }
tr.R8{ height: 12pt; }
tr.R8 td.R8C1{ font-family: Arial; font-size: 10pt; font-style: normal; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; }
table {table-layout: fixed; padding: 0 0 0 1px; width: 100%; font-family: Arial; font-size: 8pt; font-style: normal; }
td { padding-left: 3px; }
</STYLE>
</HEAD>
<BODY>
<TABLE CELLSPACING=0>
<COL WIDTH="7">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="106">
<TR CLASS=R0>
<TD>&nbsp;</TD>
<TD CLASS=R0C1 COLSPAN=32 ROWSPAN=3>Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате <BR> обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту<BR> прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.</TD>
<TD>&nbsp;</TD>
</TR>
<TR CLASS=R0>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R4C1 COLSPAN=18 ROWSPAN=2><?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_BANK"))?></TD>
<TD CLASS=R4C19 COLSPAN=3>БИК</TD>
<TD CLASS=R4C22 COLSPAN=11><?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_BIK"))?></TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R4C1 COLSPAN=3 ROWSPAN=2>Сч.&nbsp;№</TD>
<TD CLASS=R5C22 COLSPAN=11 ROWSPAN=2><?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_KS"))?></TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R6C1 COLSPAN=18>Банк&nbsp;получателя</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R4C19 COLSPAN=2>ИНН</TD>
<TD CLASS=R7C3 COLSPAN=7><?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_INN"))?></TD>
<TD CLASS=R4C19 COLSPAN=2>КПП&nbsp;&nbsp;</TD>
<TD CLASS=R7C3 COLSPAN=7><?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_KPP"))?></TD>
<TD CLASS=R7C19 COLSPAN=3 ROWSPAN=4>Сч.&nbsp;№</TD>
<TD CLASS=R7C22 COLSPAN=11 ROWSPAN=4><?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_RS"))?></TD>
<TD>&nbsp;</TD>
</TR>
<TR CLASS=R8>
<TD>&nbsp;</TD>
<TD CLASS=R8C1 COLSPAN=18 ROWSPAN=2><?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_NAME"))?></TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R10C1 COLSPAN=18>Получатель</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
</TABLE>
<TABLE CELLSPACING=0>
<COL WIDTH="7">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="106">
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R12C1 COLSPAN=32 ROWSPAN=2>Счет&nbsp;на&nbsp;оплату&nbsp;№&nbsp;<?=$GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']['NUM_INVOICE']?></TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR CLASS=R14>
<TD>&nbsp;</TD>
<TD CLASS=R14C1 COLSPAN=32>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR CLASS=R14>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
</TABLE>
<TABLE CELLSPACING=0>
<COL WIDTH="7">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R16C1 COLSPAN=4>Поставщик:</TD>
<TD CLASS=R16C5 COLSPAN=28>
	ИНН <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_INN"))?>, 
	КПП <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_KPP"))?>, 
	<?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_NAME"))?>, 
	<?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_ADDRESS"))?>, 
	тел.: <?=htmlspecialcharsEx(CSalePaySystemAction::GetParamValue("SELLER_PHONE"))?>
</TD>
<TD>&nbsp;</TD>
</TR>
<TR CLASS=R14>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
</TABLE>
<TABLE CELLSPACING=0>
<COL WIDTH="7">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R16C1 COLSPAN=4>Покупатель:</TD>
<TD CLASS=R16C5 COLSPAN=28>
	<?if ($GLOBALS['SALE_INPUT_PARAMS']['USER']['UF_USER_TYPE']=='LEGAL'):?>	
		ИНН <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['UF_USER_INN']?>, 
		<?if ($GLOBALS['SALE_INPUT_PARAMS']['USER']['UF_USER_KPP']):?> КПП <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['UF_USER_KPP']?>, <?endif?> 
		<?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['WORK_COMPANY']?>, 
		<?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['UF_USER_ADDRESS_U']?>, 
		<?if ($GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_PHONE']):?> тел.: <?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['PERSONAL_PHONE']?> <?endif?> 
	<?else:?>
		<?=$GLOBALS['SALE_INPUT_PARAMS']['USER']['NAME']?>
	<?endif?>
</TD>
<TD>&nbsp;</TD>
</TR>
<TR CLASS=R14>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
</TABLE>
<TABLE CELLSPACING=0>
<COL WIDTH="7">
<COL WIDTH="42">
<COL WIDTH="429">
<COL WIDTH="63">
<COL WIDTH="48">
<COL WIDTH="77">
<COL WIDTH="98">
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R20C1>№</TD>
<TD CLASS=R20C2>Товар</TD>
<TD CLASS=R20C2>Кол-во</TD>
<TD CLASS=R20C2>Ед.</TD>
<TD CLASS=R20C2>Цена</TD>
<TD CLASS=R20C6>Сумма</TD>
<TD>&nbsp;</TD>
</TR>
<?foreach ($GLOBALS['SALE_INPUT_PARAMS']['BASKET'] as $key=>$arBasket):?>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R21C1><?=($key+1)?></TD>
<TD CLASS=R21C2><?=$arBasket['NAME']?></TD>
<TD CLASS=R21C3><?=$arBasket['QUANTITY']?></TD>
<TD CLASS=R21C2>шт</TD>
<? $price = CCurrencyRates::ConvertCurrency($arBasket["PRICE"], "USD", "RUR"); ?>
<TD CLASS=R21C3><?= SaleFormatCurrency($price, $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["CURRENCY"], true) ?></TD>
<TD CLASS=R21C6><?= SaleFormatCurrency($price*$arBasket['QUANTITY'], $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["CURRENCY"], true) ?></TD>
<TD>&nbsp;</TD>
</TR>
<?endforeach;?>
<TR CLASS=R14>
<TD>&nbsp;</TD>
<TD CLASS=R22C1>&nbsp;</TD>
<TD CLASS=R22C1>&nbsp;</TD>
<TD CLASS=R22C1>&nbsp;</TD>
<TD CLASS=R22C1>&nbsp;</TD>
<TD CLASS=R22C1>&nbsp;</TD>
<TD CLASS=R22C1>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD CLASS=R23C5 COLSPAN=6>Итого:</TD>
<TD CLASS=R23C5><?=SaleFormatCurrency($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["PRICE"], $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["CURRENCY"])?></TD>
<TD>&nbsp;</TD>
</TR>

</TABLE>
<TABLE CELLSPACING=0>
<COL WIDTH="7">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R25C1 COLSPAN=32>
	Всего&nbsp;наименований&nbsp;<?=count($GLOBALS["SALE_INPUT_PARAMS"]["BASKET"])?>,&nbsp;
	на&nbsp;сумму&nbsp;<?=SaleFormatCurrency($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["PRICE"], $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["CURRENCY"])?>
</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R16C5 COLSPAN=31><?=Number2Word_Rus($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["PRICE"])?></TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
</TABLE>
<TABLE CELLSPACING=0>
<COL WIDTH="7">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="21">
<COL WIDTH="106">
<COL WIDTH="7">
<TR CLASS=R14>
<TD>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R14C1>&nbsp;</TD>
<TD CLASS=R27C33>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R30C1 COLSPAN=5>Руководитель</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C10>/&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R30C15 COLSPAN=15></TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R30C1 COLSPAN=5>Бухгалтер</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C10>/&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R30C15 COLSPAN=15></TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<TR>
<TD>&nbsp;</TD>
<TD CLASS=R30C1 COLSPAN=5>Менеджер</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C6>&nbsp;</TD>
<TD CLASS=R34C10>/&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R34C10>&nbsp;</TD>
<TD CLASS=R30C15 COLSPAN=15></TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
</TABLE>
</BODY>
</HTML>