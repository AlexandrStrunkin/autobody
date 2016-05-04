<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//arshow($_SERVER)


    if (!strstr($APPLICATION->GetCurPage(), "search" ) and $_GET["parent_id"] == "0")  {

        header("location: /catalog/search.php?parent_id=0");
    }

?>
<form action="/catalog/search.php" method="post" id="searchform" name="searchform">
    <div class="filtermark">
        <div class="filtername">Поиск по каталогу</div>
        <?
            //получаем дату последнего обновления
            $last_date = GKCommon::GetLastUpdateDate();
            $last_dateTime = substr($last_date,11,5);
            $last_date = substr($last_date,0,10);

            $last_date = explode("-",$last_date);
        ?>
        <div class="filternamer">Последнее обновление остатков: <?=$last_date[2].".".$last_date[1].".".$last_date[0]." ".$last_dateTime;?></div>
        <table>
            <tr class="topp">
                <td>Выберите где искать</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>

                    <input type="hidden" name="parent_id" value="<?=htmlspecialcharsbx($_REQUEST['parent_id'])?>">

                    <?
                        $sect = $_REQUEST['section_id'];
                        if(array_key_exists($sect,$GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'])) {
                            $par = $GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'][$sect]['PARENT_ID'];
                        }
                    ?>

                    <select name="section_id" style="width:320px" onChange="if ($(this).attr('value') != -1) {location.href='/catalog/search.php?parent_id='+$(this).attr('value'); }">
                        <option value="0"> Весь каталог</option>
                        <?foreach ($GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'] as $ID => $arr):?>
                            <?//arshow($arr)?>
                            <?if($arr['DEPTH_LEVEL']<=2):?>
                                <option class="spos_<?=$arr['PARENT_ID']?>" value="<?=$ID?>" <?if($par==$ID||$_REQUEST['parent_id']==$ID||$_REQUEST['section_id']==$ID) echo 'selected'?>>
                                    <?for ($i=1; $i<=$arr['DEPTH_LEVEL']; $i++):?> -- <?endfor;?>
                                    <?=$arr['NAME']?>
                                    <?endif;?>
                            </option>
                            <?endforeach;?>
                    </select>

                </td>
                <td >
                    <select name="section_id" style="display:none" id="select2">

                        <?foreach ($GLOBALS['OSG_STRUCTURE']['IBLOCK']['OSG_CATALOG']['SECTIONS'] as $ID => $arr):?>

                            <?if($arr['DEPTH_LEVEL']>2 && ( ($arr['PARENT_ID']==$_REQUEST['parent_id']) || (($par)&&($arr['PARENT_ID']==$par)) ||  ($arr["PARENT_ID"] == $_REQUEST["section_id"]) )):?>
                                <?//arshow($arr)?>
                                <option class="spos_<?=$arr['PARENT_ID']?>" value="<?=$ID?>" <?if ($_REQUEST['section_id']==$ID) echo 'selected'?>>
                                    <script>$('#select2').css('display','');</script>
                                    <?for ($i=1; $i<=$arr['DEPTH_LEVEL']; $i++):?> -- <?endfor;?>
                                    <?=$arr['NAME']?>
                                    <?endif;?>
                            </option>
                            <?endforeach;?>

                    </select>
                </td>
            </tr>
            <tr class="topp">
                <td><?/*Артикул товара*/?></td>
                <td><?/*Наименование*/?></td>
            </tr>
            <tr>
                <td><input class="allwidth" type="text" placeholder="Поиск по артикулу" name="CODE" value="<?=htmlspecialchars($_REQUEST['CODE'])?>"></td>
                <td ><input type="text" class="allwidth" placeholder="Поиск по наименованию" name="NAME" value="<?=htmlspecialchars($_REQUEST['NAME'])?>"></td>
            </tr>
            <tr class="topp">

                <td>
                    <div class="oemdiv"><?/*OEM#*/?></div>
                    <?/* <div class="timepost">Ожидаемая дата поступления</div>
                    */?>
                </td>

                <?/* <td>№ Производителя</td>   */?>
            </tr>
            <tr>

                <td class="small" >
                    <input style="width:150px;" type="text" placeholder="Поиск по OEM" name="PROPS[UNC]" value="<?=htmlspecialchars($_REQUEST['PROPS']['UNC'])?>">
                    <?/* <input style="width:150px;" type="text" placeholder="По дате ожидания:22 июн" name="PROPS[WARRANTY]" value="<?=htmlspecialchars($_REQUEST['PROPS']['WARRANTY'])?>"> */?>
                </td>
                <?/*     <td><input type="text" placeholder="Поиск по № производителя"  id ="nproizv" /></td>  */?>

            </tr>
        </table>

        <div>
            <input class="find" type="reset" value="Сбросить" />
            <input class="find" type="submit" name="search" value="Найти" />
        </div>

    </div>
</form>

<?if ($_REQUEST['search']){
        $APPLICATION->IncludeComponent(
            "osg:catalog.grid",
            "autobody_new",
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
