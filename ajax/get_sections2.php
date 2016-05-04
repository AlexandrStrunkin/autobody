<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    if ($_POST["section_id"]) {
        $iblock_section_list = CIBLockSection::GetList(array(), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y", "SECTION_ID"=>$_POST["section_id"]), false, array("ID","NAME","DEPTH_LEVEL"), false);
        if ($iblock_section_list->SelectedRowsCount() > 0){?>

        <div>---</div>
        <div>
            <input type="hidden" name="section_id2" value="0">
            <p id="op0" onclick="set_search_type(this)">---</p>
            <?  $iblock_section_list2 = CIBLockSection::GetList(array(), array("IBLOCK_ID"=>88, "ACTIVE"=>"Y","SECTION_ID"=>$_REQUEST["section_id1"]), false, array("ID","NAME","DEPTH_LEVEL"), false); ?>
            <?while ($iblock_section = $iblock_section_list->Fetch()){ ?>
                <p onclick="set_search_type(this)" id="op<?=$iblock_section["ID"]?>"><?for ($i=0;$i<$iblock_section["DEPTH_LEVEL"];$i++){echo '-';}?><?=$iblock_section["NAME"]?></p>
                <? }?>
        </div>
        <?}?>
    <?} ?>
