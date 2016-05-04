<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule('iblock');
    CModule::IncludeModule('main');

    global $USER;

    $userID = $USER->GetID();

    if ($userID > 0) {

        $elem_getlist=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>117, "PROPERTY_USER_ID"=>$userID, "PROPERTY_ELEMENT_ID"=>htmlspecialcharsbx($_POST['eid']), 'PROPERTY_TYPE_ID_ENUM_ID'=>$_POST['type'], 'NAME'=>$_POST['URL']), false, false, array("NAME", "ID", "PROPERTY_TYPE_ID", "PROPERTY_ELEMENT_ID", "PROPERTY_USER_ID"));
        if ($elem_getlist->Fetch()) {
            CIBlockElement::Delete($elem_getlist['ID' ]);
        } else {
            $new_elem = new CIBlockElement;
            $PROP=array();
            $PROP['USER_ID']=$userID;
            $PROP['ELEMENT_ID']=$_POST['eid'];
            $PROP['TYPE_ID']=$_POST['type'];
            $arLoadArray = array(
                "IBLOCK_ID"=>117,
                "PROPERTY_VALUES"=>$PROP,
                "NAME"=>$_POST['URL'],
                "ACTIVE"=>"Y"
            );
            $new_elem->Add($arLoadArray);
            echo 'add';
        }

    }
?>