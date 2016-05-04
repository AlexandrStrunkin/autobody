<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>

<?  //$sect_array=array();

    if ($_POST["section_id"]) {
        $section_list = CIBlockSection::GetList(array("NAME"=>"ASC"),array("IBLOCK_ID"=>88, "SECTION_ID"=>$_POST["section_id"], "ACTIVE"=>"Y"), array(), false, array("nPageSize"=>999));
        if ($section_list->SelectedRowsCount() > 0) {    //если есть подразделы ?>
        <ul id="ss<?=htmlspecialcharsbx($_POST["section_id"])?>" class="submenu_items">
            <?   while($section = $section_list->Fetch()) {
               // $sect_array[]=$section['SECTION_ID'];
                    // if ($section["DEPTH_LEVEL"] <= 2) {$link = 'javascript:get_submenu('.$section["ID"].')';} else {$link = "/catalog/index.php?section_id=".$section["ID"];}
                    //$link = 'javascript:get_submenu('.$section["ID"].',false)';


                    //проверяем дату создания
                    $dateCreate = explode(".", substr($section["DATE_CREATE"],0,10));
                    $curDate = date("U"); //текущая дата
                    $dif = 86400 * 30; //30 дней

                    $dateCreateLabel = mktime(0,0,0,$dateCreate[1],$dateCreate[0],$dateCreate[2]);  //метка времени даты создания
                ?>
                
                <li class="s<?=$section["ID"]?>">
                    <a href="/catalog/<?=$section["ID"]?>/" rel="<?=$section["ID"]?>" class="leftMenuLink"><?=$section["NAME"]?>
                        <?if (($curDate - $dateCreateLabel) < $dif) {?>
                            <span class="catalog_section_new_label">NEW</span>
                            <?}?>
                    </a> 
                <?
                global $USER;
                if($section['DEPTH_LEVEL']>2 && $USER->IsAuthorized()){
                        
                    $fav_list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>117, 'PROPERTY_ELEMENT_ID'=>$section["ID"], 'PROPERTY_USER_ID'=>$USER->GetID()),false,false,array('ID','PROPERTY_ELEMENT_ID', 'PROPERTY_USER_ID'));?>
                    <span class='section_list_star manage_favotite' <?if($relElem = $fav_list->Fetch()){?> style="background-position:100% 0" data-related-element="<?=$relElem['ID']?>" data-delete-el="Y" title="Удалить из избранного" <?} else {?>title="Добавить в избранное"<?}?> data-action-from="public"  id="<?=$section["ID"]?>" data-elem-type="81"></span>

                <?}?>
                </li>
            <?}?>
        </ul>
        <?}
        //если у раздела нет подразделов, открываем его содержимое
        else {?>
        <script>
            $(function(){
                document.location.href="/catalog/<?=htmlspecialcharsbx($_POST["section_id"])?>/"     //исправить после того, как будет настроен ЧПУ 
            })
        </script>
        <?}
    }
?>

