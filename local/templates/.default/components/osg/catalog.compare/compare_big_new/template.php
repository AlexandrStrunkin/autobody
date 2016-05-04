<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//print_r($_GET);
    $getstring="?";
    foreach ($_GET as $ar=>$getal)
    {
        if (is_array($getal))
        {
            foreach ($getal as $geta)
                $getstring.=$ar."[]=".$geta."&";
        }

        else{
            $getstring.=$ar."=".$getal."&";
        }
    }
    //print_r($getstring);
    //arshow($arResult['ITEMS']);
    //arshow($_SESSION['OSG']['USER']['CATALOG_COMPARE']);
?>
<div class="name">Сравнение товаров</div>
<table class="conparisons">
    <tr class="tr1">
        <td class="td1"><b></b></td>
        <?foreach ($arResult['ITEMS']  as $prevpict){?>
            <?
                // arshow($prevpict);
                // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$prevpict['CODE'].".jpg")) {$img_path = "/upload/images/".$prevpict['CODE'].".jpg";}
                else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$prevpict['CODE'].".JPG")) {$img_path = "/upload/images/".$prevpict['CODE'].".JPG";}
                else {$img_path = "/bitrix/templates/.default/components/osg/catalog.compare/compare_big_new/images/no_preview_picture.gif"; }

            ?>

            <td><div class="imgborder"><a href="/catalog/item.php?item_id=<?=$prevpict["ID"]?>"><img src="<?=$img_path?>" /></a></div>

                <?$item_quantity = GKCommon::GetItemsCountForWarehouse(GKCommon::GetSavedWarehouse(),$prevpict['CODE']);?>
                <input type="hidden" id="name<?=$prevpict["ID"]?>" value="<?=$prevpict['NAME']?>">
                <input type="hidden" id="price<?=$prevpict["ID"]?>" value="<?=CCurrencyRates::ConvertCurrency($prevpict['PRICE']['PRICE'], $prevpict['PRICE']['CURRENCY'], "RUR");?>">
                <input type="hidden" id="atricul<?=$prevpict["ID"]?>" value="<?=$prevpict['CODE']?>">
                <input type="hidden" id="year<?=$prevpict["ID"]?>" value="<?=$prevpict['PROPS']['SIZE']['VALUE']?>">
                <input type="hidden" id="quantity<?=$prevpict["ID"]?>" value="<?=$item_quantity["COUNT"]?>">
            </td>
            <?}?>
    </tr>
    <tr class="tr1">
        <td class="td1"><b>Наименоввание</b></td>
        <?foreach ($arResult['ITEMS']  as $prevpict){?>
            <td><a href="/catalog/item.php?item_id=<?=$prevpict["ID"]?>"><?=$prevpict["NAME"]?></a></td>
            <?}?>
    </tr>
    <tr class="tr2">
        <td><b>Цена </b>            </td>
        <?foreach ($arResult['ITEMS']  as $prevpict){?>
            <td>
                <?$newval = CCurrencyRates::ConvertCurrency($prevpict[PRICE][PRICE], "USD", "RUB");?>
                <?=$newval?> руб.</td>
            <?}?>
    </tr>
    <tr class="tr1"><td></td>
        <?foreach ($arResult['ITEMS']  as $prevpict){?>
            <td>
                <?
                    //проверяем наличие на текущем складе
                    $wh = array();
                    $wh = GKCommon::GetItemsCount($prevpict["CODE"]);
                ?>
                <?if($wh["COUNT"]){?>
                    <a  onclick="showcatdet('<?=$prevpict["ID"]?>')" href="javascript:void(0)">Добавить в корзину</a><br/>
                    <?}?>
                <a href="/catalog/compare.php<?=str_replace("compare_items[]=".$prevpict[ID], "", $getstring)?>&unset_from_compare=<?=$prevpict[ID]?>">Удалить из сравнения</a>
            </td>
            <?}?>

    </tr>
    <?foreach ($arResult['PROPS'] as $PROP_CODE=>$arProp):
            if($arProp['NAME']=="") continue;
            if ($arProp['PRESENCE']&&$arProp['NAME']!='Срок годности'):?>
            <tr class="tr2">
                <td><b>
                        <?
                            if($arProp['NAME']=='Гарантия') continue; /*echo 'Ожид. дата поступления';*/
                            elseif($arProp['NAME']=='Размер') echo 'Год';
                            elseif($arProp['NAME']=='УНК') echo 'OEM #';
                            else echo $arProp['NAME'];
                        ?>
                    </b></td>
                <?foreach ($arProp['ITEMS'] as $VALUE):?>
                    <?
                        if($arProp['NAME']=='Гарантия') continue; /*echo 'Ожид. дата поступления';*/
                    ?>
                    <td>
                        <?if (!$arProp['DIFFERENT']):?> <span> <?endif?>
                            <?=$VALUE?>
                        <?if (!$arProp['DIFFERENT']):?> </span> <?endif?>
                    </td>
                    <?endforeach;?>
            </tr>
            <?endif?>

        <?endforeach;?>

    <tr class="tr2">
        <td><b>Ожид. дата поступления</b>            </td>
        <?foreach ($arResult['ITEMS']  as $prevpict){?>
            <?
                //получаем дату доставки
                $item_info = "";
                $item_info = GKCommon::GetItemInfo($prevpict['CODE']);

            ?>
            <td>
                <?=$item_info["supply_date"]?>
            </td>
            <?}?>
    </tr>


</table>



<script>
    function showcatdet(ID)
    {
        $("#qw").attr("value","1");
        $("#idm").val(ID);
        $("#catnamem").html($("#name"+ID).val());
        $("#catpricem").html($("#price"+ID).val());
        $("#catartm").html($("#atricul"+ID).val());
        $("#catyearm").html($("#year"+ID).val());
        $("#catqwm").html($("#quantity"+ID).val());
        $('#dialog').jqmShow();
    }

</script>


<script>
    $().ready(function() {
            $('#dialog').jqm();
    });
</script>
<div class="jqmWindow" id="dialog">

    <a href="#" id="closemodal" class="jqmClose"></a>
    <form method="get" name="addbaskmod">

        <input type="hidden" name="action" value="add_basket_item"/>
        <input type="hidden" name="id" id="idm" value=""/>
        <input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>"/>
        <input type="hidden" name="page" value="<?=htmlspecialcharsbx($_REQUEST['page'])?>"/>

        <div class="modtitle">Добавление товара в корзину</div>
        <table>
            <tr class="begin white">
                <td>Вы выбрали:</td>
                <td id="catnamem"></td>
            </tr>
            <tr class="nowhite">
                <td>Цена:</td>
                <td id="catpricem"></td>
            </tr>
            <tr class="white">
                <td>Артикул:</td>
                <td id="catartm"></td>
            </tr>
            <tr class="nowhite">
                <td>Год:</td>
                <td id="catyearm"></td>
            </tr>
            <tr class="white end">
                <td>Текущий склад:</td>
                <?
                    $whss = GKCommon::GetWarehouses();
                    //arshow($_SESSION);
                    //получаем имя текущего склада
                    foreach($whss as $whs){

                        if ($whs["ID"] == $_SESSION["OSG"]["GKWH"] or $whs["ID"] == $_SESSION["GKWH"]) {
                            //  arshow($whs);
                            $WH_NAME = $whs["TITLE"];
                        }
                    }
                ?>
                <td><?=$WH_NAME?></td>
            </tr>
            <tr>
                <td>Количество, шт.</td>
                <td>
                    <span style="display: none;" id="catqwm"></span>
                    <input type="button" class="minus" value="-" onClick="if (Number($('#qw').val())>1){$('#qw').val(Number($('#qw').val())-1);}" />
                    <input type="text" name="quantity" class="small" id="qw" value="1" onkeyup="if($(this).attr('value')<=0) this.value=1 return false; if($(this).attr('value')>Number($('#catqwm').val())) {alert('Такого кол-ва товара нет на складе'); this.value=Number($('#catqwm').html()); }" />
                    <input type="button" class="plus" value="+" onClick="if (Number($('#qw').val())<Number($('#catqwm').html()))$('#qw').val(Number($('#qw').val())+1);"/>
                </td>
            </tr>
            <tr>
                <td class="tdul">В наличии на складе<br/>
                    <?/*
                        <ul>
                        <li>Дмитровка</li>
                        <li>Печатники </li>
                        <li>Санкт-Петербург</li>
                        </ul>      */
                    ?>
                </td>
                <td style="text-align:center;">
                    <a href="javascript:document.addbaskmod.submit();" class="modalsave">Добавить</a>
                </td>

            </tr>

        </table>

    </form>
</div>










