<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("main");
    //if (isset($_REQUEST['entity_adding_button'])) {
    $user_info=CUser::GetByID($USER->GetID())->Fetch();
    $sect_list=CIBlockSection::GetList(array(),array('IBLOCK_ID'=>116, 'CODE'=>strval($USER->GetID())),false,array(),false)->Fetch();
    if ($sect_list) {
        $element = new CIBlockElement;
        $PROP=array();
        $PROP['ENTITY_ADDR']=htmlspecialcharsbx($_REQUEST['ent_addr']);
        $PROP['ENTITY_INN']=htmlspecialcharsbx($_REQUEST['ent_inn']);
        $PROP['ENTITY_BIK']=htmlspecialcharsbx($_REQUEST['ent_bik']);
        $PROP['ENTITY_KOR_BILL']=htmlspecialcharsbx($_REQUEST['ent_kor_bill']);
        $PROP['ENTITY_KPP']=htmlspecialcharsbx($_REQUEST['ent_kpp']);
        $PROP['ENTITY_OKVED']=htmlspecialcharsbx($_REQUEST['ent_okved']);
        $PROP['ENTITY_OKPO']=htmlspecialcharsbx($_REQUEST['ent_okpo']);
        $PROP['ENTITY_BILL']=htmlspecialcharsbx($_REQUEST['ent_bill']);
        $PROP['ENTITY_PHONE']=htmlspecialcharsbx($_REQUEST['ent_phone']);
        $arLoadArray = array(
            'IBLOCK_ID'=>116,
            'IBLOCK_SECTION_ID'=>$sect_list['ID'],
            'ACTIVE'=>'Y',
            'NAME'=>htmlspecialcharsbx($_REQUEST['ent_name']),
            'PROPERTY_VALUES'=>$PROP
        );
        if($element->Add($arLoadArray)) {
            if ($USER->IsAuthorized())
            {
                echo showHtmlNote('ёридическое лицо добавлено. <script type="text/javascript"> function form_res() { $("#entity_form").find("input:visible").each(function() { if(($(this).attr("name"))) $(this).val(""); $(this).css("display","none");}); $("#entity_form").find("ul:visible").each(function() {$(this).css("display","none");})}; form_res(); </script>');  
            }
        }
    }else{
        $new_sect=new CIBlockSection;
        $arFields = Array(
            "ACTIVE" => 'Y',
            //"IBLOCK_SECTION_ID" => $USER->GetID(),
            "IBLOCK_ID" => 116,
            "CODE" => strval($USER->GetID()),
            'NAME'=>$user_info['NAME'].' '.$user_info['LAST_NAME']
        );
        $sect=$new_sect->Add($arFields);
        $sect_getlist=CIBlockSection::GetList(array(),array('IBLOCK_ID'=>116,'CODE'=>strval($USER->GetID())),false,array('ID'),false)->Fetch();
        $element = new CIBlockElement;
        $PROP=array();
        $PROP['ENTITY_ADDR']=htmlspecialcharsbx($_REQUEST['ent_addr']);
        $PROP['ENTITY_INN']=htmlspecialcharsbx($_REQUEST['ent_inn']);
        $PROP['ENTITY_BIK']=htmlspecialcharsbx($_REQUEST['ent_bik']);
        $PROP['ENTITY_KOR_BILL']=htmlspecialcharsbx($_REQUEST['ent_kor_bill']);
        $PROP['ENTITY_KPP']=htmlspecialcharsbx($_REQUEST['ent_kpp']);
        $PROP['ENTITY_OKVED']=htmlspecialcharsbx($_REQUEST['ent_okved']);
        $PROP['ENTITY_OKPO']=htmlspecialcharsbx($_REQUEST['ent_okpo']);
        $PROP['ENTITY_BILL']=htmlspecialcharsbx($_REQUEST['ent_bill']);
        $PROP['ENTITY_PHONE']=htmlspecialcharsbx($_REQUEST['ent_phone']);
        $arLoadArray = array(
            'IBLOCK_ID'=>116,
            'IBLOCK_SECTION_ID'=>$sect_getlist['ID'],
            'ACTIVE'=>'Y',
            'NAME'=>htmlspecialcharsbx($_REQUEST['ent_name']),
            'PROPERTY_VALUES'=>$PROP
        );
        if($element->Add($arLoadArray)) {
            if ($USER->IsAuthorized())
            {
                echo showHtmlNote('ёридическое лицо добавлено. <script type="text/javascript"> function form_res() { $("#entity_form").find("input:visible").each(function() { if(($(this).attr("name"))) $(this).val(""); $(this).css("display","none");}); $("#entity_form").find("ul:visible").each(function() {$(this).css("display","none");})}; form_res(); </script>');  
            }
            //  }
        }
}?>