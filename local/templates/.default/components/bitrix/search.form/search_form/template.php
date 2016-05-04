<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="/catalog/search.php" method="get" id="searchform" name="searchform">
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
                <td>Выберите где искать:</td>

                <td>
                    <select name="section_id1" id="select1" style="width:320px" onchange="get_subsections($(this).val())">
                        <option value="0" id="section0"> Весь каталог</option>
                        <?
                            $iblock_section_list = CIBLockSection::GetList(array("left_margin"=>"asc"), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y","<DEPTH_LEVEL"=>3), false, array("ID","NAME","DEPTH_LEVEL"), false); ?>
                        <?while ($iblock_section = $iblock_section_list->Fetch()){ ?>
                            <option value="<?=$iblock_section["ID"]?>" id="opt<?=$iblock_section["ID"]?>" ><?for ($i=0;$i<$iblock_section["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section["NAME"]?></option>
                            <? }?>
                    </select>

                </td>
                <td id="select_2_block">
                    <?if ($_REQUEST["section_id1"]) {?>
                        <select name="section_id2" style="display:none" id="select2">
                            <option value="0">---</option>
                            <?
                                $iblock_section_list2 = CIBLockSection::GetList(array(), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y","SECTION_ID"=>$_REQUEST["section_id1"]), false, array("ID","NAME","DEPTH_LEVEL"), false); ?>
                            <?while ($iblock_section2 = $iblock_section_list2->Fetch()){ ?>
                                <option value="<?=$iblock_section2["ID"]?>" id="opt<?=$iblock_section2["ID"]?>" ><?for ($i=0;$i<$iblock_section2["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section2["NAME"]?></option>
                                <? }?>
                        </select>

                        <?}?>
                </td>
            </tr>

            <tr class="topp">
                <td colspan="3"></td>
            </tr>

                       <tr>

                <td class="small" colspan="3">
                    <input type="text" placeholder="Поиск по номеру производителя, наименованию, артикулу и OEM" name="q" value="<?=htmlspecialchars($_REQUEST['q'])?>" class="search_form_q">
                </td>

            </tr>
        </table>

        <div>
            <input class="find" type="reset" value="Сбросить" onclick="document.location.href='/catalog/search.php'"/>
            <input class="find" type="submit" name="s" value="Найти" />
        </div>

    </div>
</form>