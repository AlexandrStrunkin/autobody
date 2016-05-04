<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<div style="color:blue"><pre>'; print_r($arResult); echo '</pre></div>';?>
<table class="compare_table" width="100%">

<tr>
    <td class="title" valign="middle">Товар</td>
    <?foreach ($arResult['ITEMS'] as $ID=>$arItem):?>
        <td align="center" width="<?=ceil(100/($arResult['COUNT']+1))?>%" class="left_border">
            <div class="goods_name"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
            <div class="imgWrapper">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE']?>" width="114" height="114" alt="<?=$arItem['NAME']?>" /></a>
            </div><!--imgWrapper-->
            <span class="goods_price"><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?> руб.</span>             
          </td>
    <?endforeach;?>
</tr>

<?foreach ($arResult['PROPS'] as $PROP_CODE=>$arProp):?>
    <?if ($arProp['PRESENCE']&&$arProp['NAME']!='Срок годности'):?>
    <tr>
        <td class="title top_border" valign="middle"><?
if($arProp['NAME']=='Гарантия') echo 'Ожид. дата поступления';
elseif($arProp['NAME']=='Размер') echo 'Год';
elseif($arProp['NAME']=='УНК') echo 'OEM #';
else echo $arProp['NAME'];
?></td>
        <?foreach ($arProp['ITEMS'] as $VALUE):?>
            <td align="center" class="left_border top_border">
                <?if (!$arProp['DIFFERENT']):?> <span> <?endif?>
                <?=$VALUE?>
                <?if (!$arProp['DIFFERENT']):?> </span> <?endif?>
            </td>
        <?endforeach;?>
    </tr>
    <?endif?>
<?endforeach;?>
    
</table>

