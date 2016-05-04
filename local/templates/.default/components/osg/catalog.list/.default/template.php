<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? //if(!$_REQUEST['search']){?>
<?if (($arResult['ITEMS'])):?>
<div class="sort">
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
</div>

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

<?foreach ($arResult['ITEMS'] as $key=>$arItem):?>
    <?if ($_SESSION['OSG']['USER']['SETTINGS']['CATALOG_VIEW'] == 'LENTA'){?>
        <!-- ------------------------- -->
        <table width="100%" cellpadding="0" cellspacing="0">
        <tr class="categody_line">
            <td width="137" valign="top">
               <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem['PREVIEW_PICTURE']?>" alt="<?=$arItem['NAME']?>" width="114"/></a>
            </td>
            <td class="category_content">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="category_href"><?=$arItem['NAME']?></a>
            <h3><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], "USD", "RUR");?> руб.</h3>

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
                <span><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?> руб.</span>


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
            <h3><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?> руб.</h3>
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
<?$APPLICATION->IncludeFile("page_nav.php", Array('ON_PAGE'=>$arParams['ON_PAGE'], 'TOTAL'=>$arResult['TOTAL']));?>
<?else:?>
    <?if ($arParams['SHOW_NO_RESULTS']=='Y'):?>
        Не найдено ни одного товара
    <?endif?>
<?endif?>

<? //} ?>
