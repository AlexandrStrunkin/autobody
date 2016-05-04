<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!--div><b>This is osg:catalog.grid template!</b></div-->



<!-- top nav -->   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="path">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td nowrap>Товаров в категории: <b><?=$arResult['TOTAL_COUNT']?></b>, &nbsp;  &nbsp;<b>  
<?$APPLICATION->IncludeFile("page_nav_grid.php", Array('ON_PAGE'=>$arParams['ON_PAGE'], 'TOTAL'=>$arResult['TOTAL']));?></td>
<noindex>
<form method="post" action="<?$APPLICATION->GetCurPageParam('',array('pgsize'));?>">
<input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>">
<input type="hidden" name="sort_as" value="<?=htmlspecialcharsbx($_REQUEST['sort_as'])?>">
<input type="hidden" name="sort_by" value="<?=htmlspecialcharsbx($_REQUEST['sort_by'])?>">
<input type="hidden" name="idc" value=1053>
<input type="hidden" name="stype" value=1>
<td nowrap width=90% style="padding-left:20">Показывать в списке товаров: 
<select name="pgsize" onchange="submit();">       
<option value="10" <?if((int)$_REQUEST['pgsize']=='10') echo 'selected';?>>10</option>
<option value="20" <?if((int)$_REQUEST['pgsize']=='20') echo 'selected';?>>20</option>
<option value="50" <?if((int)$_REQUEST['pgsize']=='50') echo 'selected';?>>50</option>
<option value="100" <?if((int)$_REQUEST['pgsize']=='100') echo 'selected';?>>100</option>
</select>
</td>
</form>
<td class="tdborderlabel" nowrap style="padding-right: 100px;"></td>
</noindex>
</tr>
</table>
</td>
</tr>
</table> 
<!-- end of top nav -->   


<?if(($arResult['ITEMS'])):?> 
<!--form name="compare" method="get" action="/Compare.html" target="_blank"> 
<input type="hidden" name="idc" value="1053"--> 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tgrid"> 
<!-- thead -->
<noindex>
<tr align="center">
<td class="goodstop">&nbsp;</td>
<td class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='code'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=code&sort_as='.$sa, array("sort_by", "sort_as"));
?>">Артикул<?if($_REQUEST['sort_by']=='code'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>
<td class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='PROPERTY_UNC'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=PROPERTY_UNC&sort_as='.$sa, array("sort_by", "sort_as"));
?>">ОЕМ<?if($_REQUEST['sort_by']=='PROPERTY_UNC'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>

<td nowrap style="text-align:center" class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='name'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=name&sort_as='.$sa, array("sort_by", "sort_as"));
?>">Наименование<?if($_REQUEST['sort_by']=='name'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>
<td class="goodstop" width="121px">Год</a></td>
<td class="goodstop">Ср</td>
<td class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='price'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=price&sort_as='.$sa, array("sort_by", "sort_as"));
?>">Цена (руб.)<?if($_REQUEST['sort_by']=='price'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>
<td width="30" class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='PROPERTY_STATUS'&&$_REQUEST['sort_as']=='desc') $sa='asc'; else $sa='desc'; 
echo $APPLICATION->GetCurPageParam('sort_by=PROPERTY_STATUS&sort_as='.$sa, array("sort_by", "sort_as")); 
?>"><img src="/i/ico_basket.gif" width=11 height=10 border=0></a></td>
<td class="goodstop">Ожидаем поступл</a></td>
</tr>
</noindex> 
<!-- /thead -->



<!--pre><?print_r($arResult);?></pre-->
<?foreach ($arResult['ITEMS'] as $key=>$arItem): $ar_res=CCatalogProduct::GetByID($arItem['ID']);/*print_r($ar_res);*/?>   
<tr align="center"> 
<td class=goods>
<div id=Pic1065 style="display: block;">
<?if(!strstr($arItem['PREVIEW_PICTURE'],'no_preview_picture.gif')||0):?>
<a target="_blank" class="catalog-detail-images" rel="" href="<?=$arItem['PREVIEW_PICTURE']?>" class="namegoods" alt="<?=$arItem['NAME']?>"><img src='/i/ico_img.gif' border=0 alt="<?=$arItem['NAME']?>" /></a>
<?else:?>
<img src="/i/ico_noimg.gif" border="0" title="нет фото" />
<?endif;?>
</div>
</td> 
<td class=goods nowrap ><?=$arItem['CODE']?></td> 

<td align=left class=goods colspan="3" width="530px"><b><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?><?//substr($arItem['NAME'],3)?></a></b><br>
<table width="100%" style="border:none;">
<tr>
    <td style="border:none;"><?=$arItem['PROPS']['UNC']['VALUE']?></td>
    <td style="border:none;"></td>
    <td style="border:none;"><?=$arItem['PROPS']['SIZE']['VALUE']?></td>
</tr>
</table>
</td> 
<td class=goods><a href="<?=$arItem['COMPARE_URL']?>" target="_self"><img src="/bitrix/templates/demo/images/add.gif" title="Добавить &quot;<?=$arItem['NAME']?>&quot; к сравнению" /></a></td> 
<td align=right class=goods nowrap><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?></td> 
<td class="goods">
<div style="position:relative;">
<?if($arItem['PROPERTY_STATUS_VALUE']):?><a href="<?=$arItem['BASKET_URL']?>" onClick="$('#hov_<?=$key?>').toggle('fast'); return false;"><img src='/i/basket.gif' border=0 title="Добавить в корзину" align=absmiddle></a><div class="hover" id="hov_<?=$key?>"><div><form method="get">

<input type="hidden" name="action" value="add_basket_item">
<input type="hidden" name="id" value="<?=$arItem['ID']?>">
<input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>">
<input type="hidden" name="page" value="<?=htmlspecialcharsbx($_REQUEST['page'])?>">
<?foreach($_REQUEST as $name=>$value):
//if(in_array($name,array('id','section_id','page','parent_id','NAME','CODE','PRICE_FROM','PRICE_TO','search','sort_as','sort_by','pgsize'))):
//if(in_array($name,array('parent_id','NAME','CODE','PRICE_FROM','PRICE_TO','search','sort_as','sort_by','pgsize'))):
if(in_array($name,array('section_id','page','parent_id','NAME','CODE','PRICE_FROM','PRICE_TO','search','sort_as','sort_by','pgsize'))):
?>
<input type="hidden" name="<?=$name?>" value="<?=$value?>">
<?endif;endforeach;?>

<?foreach($_REQUEST['PROPS'] as $name=>$value):?>
<input type="hidden" name="PROPS[<?=$name?>]" value="<?=$value?>">
<?endforeach;?> 

Кол-во: <input name="quantity" value="1" class="quan" onkeyup="
if($(this).attr('value')<0) return false;
if($(this).attr('value')><?=$ar_res['QUANTITY']?>) {alert('Такого кол-ва товара нет на складе'); return false;}
if($(this).attr('value')>0&&$(this).attr('value')<=<?=$ar_res['QUANTITY']?>) {
$('#count_<?=$key?>').attr('innerHTML',(<?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?>*$(this).attr('value')).toFixed(2)+' руб.'); return false;}
">
<span id="count_<?=$key?>"><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?> руб.</span>
<input type="submit" value="Заказать" class="submit" />
<button onClick="$('#hov_<?=$key?>').fadeOut('fast'); return false;">Отм.</button>
</form></div></div><?else:?><img src='/i/basketN.gif' border=0 title="нет в наличии" align=absmiddle><?endif;?>
</div>
</td>  
<td class=goods><table><?=$arItem['PROPS']['WARRANTY']['VALUE']?></table></td> 
</tr>
<?endforeach;?>



<!-- tfoot -->
<noindex>
<tr align="center">
<td class="goodstop">&nbsp;</td>
<td class="goodstop" width="120px"><a href="<?
if($_REQUEST['sort_by']=='code'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=code&sort_as='.$sa, array("sort_by", "sort_as"));
?>">Артикул<?if($_REQUEST['sort_by']=='code'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>
<td class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='PROPERTY_UNC'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=PROPERTY_UNC&sort_as='.$sa, array("sort_by", "sort_as"));
?>">ОЕМ<?if($_REQUEST['sort_by']=='PROPERTY_UNC'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>

<td nowrap align=left style="text-align:center" class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='name'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=name&sort_as='.$sa, array("sort_by", "sort_as"));
?>">Наименование<?if($_REQUEST['sort_by']=='name'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>
<td class="goodstop" width="121px">Год</a></td>
<td class="goodstop">Ср</td>
<td class="goodstop" nowrap><a href="<?
if($_REQUEST['sort_by']=='price'&&$_REQUEST['sort_as']=='asc') $sa='desc'; else $sa='asc';
echo $APPLICATION->GetCurPageParam('sort_by=price&sort_as='.$sa, array("sort_by", "sort_as"));
?>">Цена (руб.)<?if($_REQUEST['sort_by']=='price'){
if($_REQUEST['sort_as']=='asc') echo ' ▼'; else echo ' ▲';
}?></a></td>
<td width="30" class="goodstop"><a href="<?
if($_REQUEST['sort_by']=='PROPERTY_STATUS'&&$_REQUEST['sort_as']=='desc') $sa='asc'; else $sa='desc'; 
echo $APPLICATION->GetCurPageParam('sort_by=PROPERTY_STATUS&sort_as='.$sa, array("sort_by", "sort_as")); 
?>"><img src="/i/ico_basket.gif" width=11 height=10 border=0></a></td>
<td class="goodstop">Ожидаем поступл</a></td>
</tr>
</noindex> 
<!-- /tfoot -->    
</table> 
<?else:?>
<div style="padding:10px!important;">Товары в данной рубрике отстутствуют!</div>
<?endif;?>

<!-- bottom nav -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="path">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td nowrap>Товаров в категории: <b><?=$arResult['TOTAL_COUNT']?></b>, &nbsp;  &nbsp;<b>  
<?$APPLICATION->IncludeFile("page_nav_grid.php", Array('ON_PAGE'=>$arParams['ON_PAGE'], 'TOTAL'=>$arResult['TOTAL']));?></td>
<noindex>
<form method="get" action="<?$APPLICATION->GetCurPageParam();?>">
<input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>">
<input type="hidden" name="sort_as" value="<?=htmlspecialcharsbx($_REQUEST['sort_as'])?>">
<input type="hidden" name="sort_by" value="<?=htmlspecialcharsbx($_REQUEST['sort_by'])?>">
<input type="hidden" name="idc" value=1053>
<input type="hidden" name="stype" value=1>
<td nowrap width=90% style="padding-left:20">Показывать в списке товаров: 
<select name="pgsize" onchange="submit();">       
<option value="10" <?if((int)$_REQUEST['pgsize']=='10') echo 'selected';?>>10</option>
<option value="20" <?if((int)$_REQUEST['pgsize']=='20') echo 'selected';?>>20</option>
<option value="50" <?if((int)$_REQUEST['pgsize']=='50') echo 'selected';?>>50</option>
<option value="100" <?if((int)$_REQUEST['pgsize']=='100') echo 'selected';?>>100</option>
</select>
</td>
</form>
<td class="tdborderlabel" nowrap style="padding-right: 100px;"></td>
</noindex>
</tr>
</table>
</td>
</tr>
</table> 
<!-- end of bottom nav -->





                                                  
<!-- old  -->
<? //if(!$_REQUEST['search']){?>
<?if (($arResult['ITEMS'])):?>
<!--div class="sort">
    <table cellpadding="0" cellspacing="2">
    <tr valign="middle">
        <td><div>Сортировка: </div></td>
        
        <?if ($arResult['SORT_BY']!='DATE'):?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("sort_by=date&sort_as=desc", array("sort_by", "sort_as"))?>">новизна</a></td>                                        
        <?elseif ($arResult['SORT_AS']=='ASC'):?>
            <td class="active sort_up"><a href="<?=$APPLICATION->GetCurPageParam("sort_by=date&sort_as=desc", array("sort_by", "sort_as"))?>">новизна</a></td>
        <?else:?>
            <td class="active sort_down"><a href="<?=$APPLICATION->GetCurPageParam("sort_by=date&sort_as=asc", array("sort_by", "sort_as"))?>">новизна</a></td>
        <?endif?>
        
        <?if ($arResult['SORT_BY']!='PRICE'):?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("sort_by=price&sort_as=asc", array("sort_by", "sort_as"))?>">цена</a></td>
        <?elseif ($arResult['SORT_AS']=='ASC'):?>
            <td class="active sort_up"><a href="<?=$APPLICATION->GetCurPageParam("sort_by=price&sort_as=desc", array("sort_by", "sort_as"))?>">цена</a></td>
        <?else:?>
            <td class="active sort_down"><a href="<?=$APPLICATION->GetCurPageParam("sort_by=price&sort_as=asc", array("sort_by", "sort_as"))?>">цена</a></td>
        <?endif?>
        
        <?if ($arResult['SORT_BY']!='NAME'):?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("sort_by=name&sort_as=asc", array("sort_by", "sort_as"))?>">наименование</a></td>
        <?elseif ($arResult['SORT_AS']=='ASC'):?>
            <td class="active sort_up"><a href="<?=$APPLICATION->GetCurPageParam("sort_by=name&sort_as=desc", array("sort_by", "sort_as"))?>">наименование</a></td>
        <?else:?>
            <td class="active sort_down"><a href="<?=$APPLICATION->GetCurPageParam("sort_by=name&sort_as=asc", array("sort_by", "sort_as"))?>">наименование</a></td>
        <?endif?>
        
        
        
        <td><div class="padd_left">Показывать: </div></td>
        
        <?if ($arResult['VIEW']=='LENTA'):?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("view=lenta", array("view"))?>" class="active_a">лента</a></td>
        <?else:?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("view=lenta", array("view"))?>">лента</a></td>
        <?endif?>
        
        <?if ($arResult['VIEW']=='MOZAIC'):?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("view=mozaic", array("view"))?>" class="active_a">мозайка</a></td>
        <?else:?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("view=mozaic", array("view"))?>">мозайка</a></td>
        <?endif?>
        
        <?if ($arResult['VIEW']=='COLUMN'):?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("view=column", array("view"))?>" class="active_a">2 колонки</a></td>
        <?else:?>
            <td><a href="<?=$APPLICATION->GetCurPageParam("view=column", array("view"))?>">2 колонки</a></td>
        <?endif?>
        
    </tr>
    </table>
</div-->

<div class="form_show">
    <input name="status" type="checkbox" onclick="change_status(this.checked);" <?=$arResult['STATUS'] ? 'checked' : ''?>> Показывать только товары в наличии </input>
</div>

<SCRIPT>
function change_status(status){
    if (status){
        location.href = '<?=str_replace('bxajaxid=','',$APPLICATION->GetCurPageParam("status=1", array("status", "page")))?>';
    }else{
        location.href = '<?=str_replace('bxajaxid=','',$APPLICATION->GetCurPageParam("", array("status", "page")))?>';
    }
}
</SCRIPT>

<?/*foreach ($arResult['ITEMS'] as $key=>$arItem):?>
    <?if ($_SESSION['OSG']['USER']['SETTINGS']['CATALOG_VIEW'] == 'LENTA'){?>
        <!-- ------------------------- -->
        <table width="100%" cellpadding="0" cellspacing="0">
        <tr class="categody_line">
            <td width="137" valign="top">
               <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE']?>" alt="<?=$arItem['NAME']?>" width="114"/></a>
            </td>
            <td class="category_content">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="category_href"><?=$arItem['NAME']?></a>
            <h3><?=$arItem['PRICE']['PRICE']?> руб.</h3>
            
<?

$ar_res=CCatalogProduct::GetByID($arItem['ID']);
//echo $ar_res['QUANTITY']."qq<br>";
//echo $arItem['PROPERTY_UNC']."aa<br>";
//echo $arItem['PROPERTY_RESERV']."aa<br>";
//echo $arItem['PROPERTY_EXPIRED']."aa<br>";



if($ar_res['QUANTITY']<$arItem['PROPERTY_RESERV']){
 //echo '<img src="/bitrix/images/0.jpg" border="0" width="50">';
}elseif(($ar_res['QUANTITY']>$arItem['PROPERTY_RESERV'])&&($ar_res['QUANTITY']<$arItem['PROPERTY_UNC'])){
// echo '<img src="/bitrix/images/1.jpg" border="0" width="50">';
}elseif(($ar_res['QUANTITY']>$arItem['PROPERTY_UNC'])&&($ar_res['QUANTITY']<$arItem['PROPERTY_EXPIRED'])){
// echo '<img src="/bitrix/images/2.jpg" border="0" width="50">';
}else{
// echo '<img src="/bitrix/images/3.jpg" border="0" width="50">';
}
//echo $arResult['ITEM']['PROPS']['UNC']['VALUE']."<br>";
//echo $arResult['ITEM']['PROPS']['EXPIRED']['VALUE']."<br>";
//echo $arResult['ITEM']['PROPS']['RESERV']['VALUE'];

?>              
            
                <?if ($arItem['PROPERTY_STATUS_VALUE']):?>
                    <span class="yes"><img src="/bitrix/templates/demo/images/yes.gif" width="17" height="17" />Есть в наличии</span><br />
                <?else:?>
                    <span class="no"><img src="/bitrix/templates/demo/images/no.gif" width="17" height="17" />Нет в наличии</span><br />
                <?endif?>
                

 
                <p>
                    <?=$arItem['PREVIEW_TEXT']?>
                </p>

<br>
                
        <div>
        <?
         $res = CIBlockElement::GetByID($arItem['PROPS']['FIRM']['VALUE']);
         if($ar_res = $res->GetNext()){
           echo '<p style="color:#000000"><span>Автор:</span>'.$ar_res['NAME'].'<br>';
         }
        ?>        
        <?foreach ($arItem['OSG_PROPS'] as $PROP_CODE=>$arProp):?>
           <?if (is_array($arProp['VALUES']) && $arProp['VALUES']):?>
                <span><?=$arProp['NAME']?>:</span>
                        <?foreach ($arProp['VALUES'] as $VALUE_ID => $VALUE):?>
                            <?=$VALUE?>
                        <?endforeach;?>
                <br>
           <?endif?>
       <?endforeach;?>
       </p>
       </div>                
       <br><br>                            
                    <span><img src="/bitrix/templates/demo/images/otloj.gif" width="17" height="18" alt="Отложить товар" /><a href="<?=$arItem['DELAY_URL']?>" target="_self">Отложить товар</a></span>
                    <span><img src="/bitrix/templates/demo/images/add.gif" width="16" height="18" alt="Добавить к сравнению" /><a href="<?=$arItem['COMPARE_URL']?>" target="_self">Добавить к сравнению</a></span><p></p>

 <?if ($arItem['PROPERTY_STATUS_VALUE']):?>                    
                     <div class="add_box" onclick="document.location.href='<?=$arItem['BASKET_URL']?>'"><input type="button" value="Добавить в корзину"></div> 
 <?else:?>
                    <div>
                       <span><a href="<?=$arItem['LETTER_URL']?>" target="_self">Уведомить о наличии</a></span>
                    </div>
 <?endif?>                    
 
 
                    
            
            </td>
        </tr>
        </table>
    <? }elseif($_SESSION['OSG']['USER']['SETTINGS']['CATALOG_VIEW'] == 'MOZAIC'){ ?>
        <?if ($key%3==0):?>
            <table cellpadding="0" cellspacing="0" width="100%" class="catalog_mozaic">
            <tr>
        <?endif?>
            <td align="center">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="catalog_mozaic name"><?=$arItem['NAME']?> </a>
                <div class="img_tovar">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE']?>" alt="<?=$arItem['NAME']?>" width="114"/></a>
                </div>
                <div class="catalog_img_small">
                    <a href="<?=$arItem['DELAY_URL']?>" target="_self"><img src="/bitrix/templates/demo/images/otloj.gif" width="17" height="18" alt="Отложить товар" title="Отложить товар"/></a>
                    <a href="<?=$arItem['COMPARE_URL']?>" target="_self"><img src="/bitrix/templates/demo/images/add.gif" width="16" height="18" alt="Добавить к сравнению" title="Добавить к сравнению"/></a>
                    <?if ($arItem['PROPERTY_STATUS_VALUE']):?>
                        <img src="/bitrix/templates/demo/images/yes.gif" width="17" height="17" alt="Есть в наличии" title="Есть в наличии"/>
                    <?else:?>
                        <img src="/bitrix/templates/demo/images/no.gif" width="17" height="17" alt="Нет в наличии" title="Нет в наличии"/>
                    <?endif?>
                </div>
                <span><?=$arItem['PRICE']['PRICE']?> руб.</span>


<?

$ar_res=CCatalogProduct::GetByID($arItem['ID']);
//echo $ar_res['QUANTITY']."qq<br>";
//echo $arItem['PROPERTY_UNC']."aa<br>";
//echo $arItem['PROPERTY_RESERV']."aa<br>";
//echo $arItem['PROPERTY_EXPIRED']."aa<br>";



if($ar_res['QUANTITY']<$arItem['PROPERTY_RESERV']){
 echo '<img src="/bitrix/images/0.jpg" border="0" width="50">';
}elseif(($ar_res['QUANTITY']>$arItem['PROPERTY_RESERV'])&&($ar_res['QUANTITY']<$arItem['PROPERTY_UNC'])){
 echo '<img src="/bitrix/images/1.jpg" border="0" width="50">';
}elseif(($ar_res['QUANTITY']>$arItem['PROPERTY_UNC'])&&($ar_res['QUANTITY']<$arItem['PROPERTY_EXPIRED'])){
 echo '<img src="/bitrix/images/2.jpg" border="0" width="50">';
}else{
 echo '<img src="/bitrix/images/3.jpg" border="0" width="50">';
}
//echo $arResult['ITEM']['PROPS']['UNC']['VALUE']."<br>";
//echo $arResult['ITEM']['PROPS']['EXPIRED']['VALUE']."<br>";
//echo $arResult['ITEM']['PROPS']['RESERV']['VALUE'];

?>   <br>     


 <?if ($arItem['PROPERTY_STATUS_VALUE']):?>                    
                     <div class="add_box" onclick="document.location.href='<?=$arItem['BASKET_URL']?>'"><input type="button" value="Добавить в корзину"></div> 
 <?else:?>
                    <div>
                       <span><a href="<?=$arItem['LETTER_URL']?>" target="_self">Уведомить о наличии</a></span>
                    </div>
 <?endif?>                    
                
            </td>
         <?if ($key%3==2 || $key==count($arResult['ITEMS'])-1):?>           
            </tr>
            </table>
         <?endif?>   
    <? }else{
//     echo $key;
    ?>
        <?if ($key==0):?>
            <table cellpadding="0" cellspacing="0" width="100%" border="0">
        <?endif?>    
        
        <? if($key==0){
         echo '<tr class="categody_line">';
        }else{
        ?>
        <?if (($key%2)==0):?>
             </tr><tr class="categody_line">
        <?endif?>    
         <?
        }
        ?>            
            <td width="137" valign="top">
               <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE']?>" alt="<?=$arItem['NAME']?>" width="114"/></a>
            </td>
            <td class="category_content" width="250" style="vertical-align:top">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="category_href"><?=$arItem['NAME']?></a>
            <h3><?=$arItem['PRICE']['PRICE']?> руб.</h3>
            <div class="status">
<?

$ar_res=CCatalogProduct::GetByID($arItem['ID']);
//echo $ar_res['QUANTITY']."qq<br>";
//echo $arItem['PROPERTY_UNC']."aa<br>";
//echo $arItem['PROPERTY_RESERV']."aa<br>";
//echo $arItem['PROPERTY_EXPIRED']."aa<br>";



if($ar_res['QUANTITY']<$arItem['PROPERTY_RESERV']){
 echo '<img src="/bitrix/images/0.jpg" border="0" width="50">';
}elseif(($ar_res['QUANTITY']>$arItem['PROPERTY_RESERV'])&&($ar_res['QUANTITY']<$arItem['PROPERTY_UNC'])){
 echo '<img src="/bitrix/images/1.jpg" border="0" width="50">';
}elseif(($ar_res['QUANTITY']>$arItem['PROPERTY_UNC'])&&($ar_res['QUANTITY']<$arItem['PROPERTY_EXPIRED'])){
 echo '<img src="/bitrix/images/2.jpg" border="0" width="50">';
}else{
 echo '<img src="/bitrix/images/3.jpg" border="0" width="50">';
}
//echo $arResult['ITEM']['PROPS']['UNC']['VALUE']."<br>";
//echo $arResult['ITEM']['PROPS']['EXPIRED']['VALUE']."<br>";
//echo $arResult['ITEM']['PROPS']['RESERV']['VALUE'];

?>
                <?if ($arItem['PROPERTY_STATUS_VALUE']):?>
                    <span class="yes"><img src="/bitrix/templates/demo/images/yes.gif" width="17" height="17" />Есть в наличии</span><br />
                <?else:?>
                    <span class="no"><img src="/bitrix/templates/demo/images/no.gif" width="17" height="17" />Нет в наличии</span><br />
                <?endif?>
                </div>
                
        <div>
        <?
         $res = CIBlockElement::GetByID($arItem['PROPS']['FIRM']['VALUE']);
         if($ar_res = $res->GetNext()){
           echo '<span>Автор:</span>'.$ar_res['NAME'].'<br>';
         }
        ?>               
        <?foreach ($arItem['OSG_PROPS'] as $PROP_CODE=>$arProp):?>
           <?if (is_array($arProp['VALUES']) && $arProp['VALUES']):?>
                <span><?=$arProp['NAME']?>:</span>
                        <?foreach ($arProp['VALUES'] as $VALUE_ID => $VALUE):?>
                            <?=$VALUE?>
                        <?endforeach;?>
                <br>
           <?endif?>
       <?endforeach;?>
       </div> <br>                
            
                    <span><img src="/bitrix/templates/demo/images/otloj.gif" width="17" height="18" alt="Отложить товар" /><a href="<?=$arItem['DELAY_URL']?>" target="_self">Отложить товар</a></span>
                    <span><img src="/bitrix/templates/demo/images/add.gif" width="16" height="18" alt="Добавить к сравнению" /><a href="<?=$arItem['COMPARE_URL']?>" target="_self">Добавить к сравнению</a></span><br>

 <?if ($arItem['PROPERTY_STATUS_VALUE']):?>                    
                     <div class="add_box" onclick="document.location.href='<?=$arItem['BASKET_URL']?>'"><input type="button" value="Добавить в корзину"></div>                     
 <?else:?>
                    <div>
                       <span><a href="<?=$arItem['LETTER_URL']?>" target="_self">Уведомить о наличии</a></span>
                    </div>
 <?endif?>                    
            
            
            
            </td>
 <?
  if($key==(count($arResult['ITEMS'])-1)){
  
//  echo (count($arResult['ITEMS'])-1);
  if(((count($arResult['ITEMS']))%2)!=0){
   echo '<td></td><td></td>';
  }
  
?>
         </tr>
        </table>    
<?  
  }
 ?>        
    <? } ?>
<?endforeach;?>
<?$APPLICATION->IncludeFile("page_nav.php", Array('ON_PAGE'=>$arParams['ON_PAGE'], 'TOTAL'=>$arResult['TOTAL']));*/?>
<?else:?>
    <?/*if ($arParams['SHOW_NO_RESULTS']=='Y'):?>
        Не найдено ни одного товара
    <?endif*/?>
<?endif?>

<? //} ?>
