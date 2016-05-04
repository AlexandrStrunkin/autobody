<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    if ($_POST["section_id"]) {
        $iblock_section_list = CIBLockSection::GetList(array(), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y", "SECTION_ID"=>$_POST["section_id"]), false, array("ID","NAME","DEPTH_LEVEL"), false);
        if ($iblock_section_list->SelectedRowsCount() > 0){?>
        <select name="section_id2" style="display:none" id="section_id2">
        <option value="0">---</option>
            <?while ($iblock_section = $iblock_section_list->Fetch()){ ?>
                <option value="<?=$iblock_section["ID"]?>" id="opt<?=$iblock_section["ID"]?>"><?for ($i=0;$i<$iblock_section["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section["NAME"]?></option>
                <?}?>
        </select>
        <?
        }
    }
?>
