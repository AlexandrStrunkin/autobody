<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("main");
$change_el=new CIBlockElement;
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
$this_sect=CIBlockSection::GetList(array(),array('IBLOCK_ID'=>116, 'CODE'=>strval($USER->GetID())),false,false,array('ID'))->Fetch();

 $arLoadArray=array(
 'IBLOCK_ID'=>116,
 'IBLOCK_SECTION'=>$this_sect['ID'],
 'NAME'=>htmlspecialcharsbx($_REQUEST['ent_name']),
 'PROPERTY_VALUES'=>$PROP);
 $el=$change_el->Update(htmlspecialcharsbx($_REQUEST['updateid']), $arLoadArray);
 mail('raulschokino@yandex.ru', 'fdsfds', $_REQUEST);
?>