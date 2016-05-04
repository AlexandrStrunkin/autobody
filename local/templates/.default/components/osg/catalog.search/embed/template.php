<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>     
<form action="/catalog/search.php" method="post">
<table cellpadding="0" cellspacing="0" width="100%" class="search_form">
<tr class="head">
    <td height="40" width="100">
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="100">Область&nbsp;поиска:</td>
            <td>        

                <input type="hidden" name="parent_id" value="<?=htmlspecialcharsbx($_REQUEST['parent_id'])?>">  

                    <?
                    $sect = $_REQUEST['section_id'];
                    if(array_key_exists($sect,$GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'])) {
                    $par = $GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'][$sect]['PARENT_ID'];
                    }
                    ?>
                
                <select name="section_id" style="width:auto!important" onChange="location.href='<?=/*$APPLICATION->GetCurPageParam();*/$_SERVER['SCRIPT_NAME']?>?parent_id='+$(this).attr('value');">
                    <option value="0"> Весь каталог
                    <?foreach ($GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'] as $ID => $arr):?>
                        <?if($arr['DEPTH_LEVEL']<=2):?>
                        <option class="spos_<?=$arr['section_id']?>" value="<?=$ID?>" <?if($par==$ID||$_REQUEST['parent_id']==$ID||$_REQUEST['section_id']==$ID) echo 'selected'?>> 
                        <?for ($i=1; $i<=$arr['DEPTH_LEVEL']; $i++):?> -- <?endfor;?>
                        <?=$arr['NAME']?>
                        <?endif;?>
                    <?endforeach;?>
                </select>    

                <select name="section_id" style="display:none" id="select2">
                    
                    <?foreach ($GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'] as $ID => $arr):?>
                        <?if($arr['DEPTH_LEVEL']>2&&
                        ((
                        ($_REQUEST['parent_id'])&&($arr['PARENT_ID']==$_REQUEST['parent_id']))
                        ||
                        (($par)&&($arr['PARENT_ID']==$par))       
                        )):?>
                        <option class="spos_<?=$arr['PARENT_ID']?>" value="<?=$ID?>" <?if ($_REQUEST['section_id']==$ID) echo 'selected'?>> 
                        <script>$('#select2').css('display','');</script>
                        <?for ($i=1; $i<=$arr['DEPTH_LEVEL']; $i++):?> -- <?endfor;?>
                        <?=$arr['NAME']?>
                        <?endif;?>
                    <?endforeach;?>
                </select>
                
                
                
            </td>
        </tr>
        </table>
    </td>    
</tr>

<tr>
    <td>
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="35%">    
                <strong>Артикул:</strong>    
                <input type="text" name="CODE" value="<?=htmlspecialchars($_REQUEST['CODE'])?>">
            </td>
          <td width="65%">
                <strong>Наименование:</strong>
                <input type="text" name="NAME" value="<?=htmlspecialchars($_REQUEST['NAME'])?>">
            </td>
            
        </tr>
<tr>
                   

        </table>            
    </td>
</tr>

<tr class="min_input">
    <td>
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="55%">
                <strong>Цена:</strong><br />
                от <input type="text" name="PRICE_FROM" value="<?=htmlspecialchars($_REQUEST['PRICE_FROM'])?>"> 
                до <input type="text" name="PRICE_TO" value="<?=htmlspecialchars($_REQUEST['PRICE_TO'])?>"> руб.
            </td>
            <td width="35%">    
                <strong>Доп. свойства:</strong><br />
                <div>
                <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50">OEM#</td>
                    <td align="right">
                     <input style="width:150px;" type="text" name="PROPS[UNC]" value="<?=htmlspecialchars($_REQUEST['PROPS']['UNC'])?>">
                    </td>
                </tr>
                <tr>
                    <td width="50">Ожид. дата поступления</td>
                    <td align="right">
                     <input style="width:150px;" type="text" name="PROPS[WARRANTY]" value="<?=htmlspecialchars($_REQUEST['PROPS']['WARRANTY'])?>">
                    </td>
                </tr>
                </table>
                </div>
            </td>
        </tr>
        </table>            
    </td>
</tr>
<?if ($arResult['OSG_PROPS']):?>
<tr class="characteristic">
    <td>
        <table cellpadding="0" cellspacing="0" width="100%">
        <?$i=0?>
        <?foreach ($arResult['OSG_PROPS'] as $PROP_CODE => $arProp):?>
            <?if ($i%3==0):?> <tr> <?endif?>
               <td width="33.3%">
                      <strong><?=$arProp['NAME']?></strong><br />
                   <?if ($arProp['VALUES']):?>
                       <select name="PROPS[<?=$PROP_CODE?>]">
                           <option value="0"> Любое значение
                           <?foreach ($arProp['VALUES'] as $ID => $arr):?>
                               <option value="<?=$ID?>" <?if ($_REQUEST['PROPS'][$PROP_CODE]==$ID) echo 'selected'?>> <?=$arr['NAME']?>
                           <?endforeach;?>
                       </select>
                   <?else:?>
                       <input type="text" name="PROPS[<?=$PROP_CODE?>]" value="<?=htmlspecialchars($_REQUEST['PROPS'][$PROP_CODE])?>">
                   <?endif?>
               </td>
            <?if ($i%3==2):?> </tr> <?endif?>
            <?$i++?>
        <?endforeach;?>
        </table>
    </td>
</tr>
<?endif?>

<tr class="search_submit">
    <td>
        <input type="submit" name="search" value="Найти" />
        <input type="reset" value="Сбросить" />
    </td>
</tr>
</table>
</form>


<?if ($_REQUEST['search']){
$APPLICATION->IncludeComponent(
    "osg:catalog.grid",
    ".default",
    Array(
        "ON_PAGE" => $arParams["ON_PAGE"], 
        "URL_NO_PREVIEW_PICTURE" => $arParams["URL_NO_PREVIEW_PICTURE"], 
        "INCLUDE_SUBSECTIONS" => "Y", 
        "ADDITIONAL_FILTER" => $arResult["ADDITIONAL_FILTER"], 
        "SET_TITLE" => "N", 
        "SHOW_NO_RESULTS" => "Y",
        "AJAX_MODE" => $arParams["AJAX_MODE"],  
        "AJAX_OPTION_SHADOW" => $arParams["AJAX_OPTION_SHADOW"], 
        "AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],  
        "AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"], 
        "AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"], 
    )
);    
    
}?>



