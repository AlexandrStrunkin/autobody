<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    if ($_POST) {
        /*
        delivery: delivery,
        paysystem: paysystem,
        city: city,
        adress: adress,
        pack: pack,
        main_man: main_man,
        main_man_phone: main_man_phone,
        regime: regime,
        info: info,
        user_login: user_login,
        subscribe: subscribe,
        user_id: user_id,
        email: email  
        */  
           
        //��������� ���� �� �������� � ������������
        $res=CSubscription::GetList(Array(),Array("USER_ID" => $_POST["user_id"]));
        
        $user_is_subscribe=false; //�������� � ����� ����
        $user_is_subscribe_new=false;
        $subscribe_active=false;  //�������� �������        
        $arSubscribe=$res->Fetch();
        
        $arRubrics = CSubscription::GetRubricList($arSubscribe['ID']);
        
        while($arRubricsList=$arRubrics->GetNext()) 
        {    
            $arrRubric = CRubric::GetList(
                Array(),
                Array()
            );              
            
            
            if ($arRubricsList['ID']==2)    
            {
                $new_items_sub = $arRubricsList['ACTIVE']; 
                if ($new_items_sub == "Y") {
                    $user_is_subscribe_new = true;
                }
                else
                {
                    $user_is_subscribe_new = false;
                }
            }
            
        }
        if ($arSubscribe) {
            $user_is_subscribe=true;
            if ($arSubscribe["ACTIVE"]=="Y") {
              $subscribe_active=true;  
            }
        } 
         
        switch ($_POST["subscribe"]){
            case "yes":
                if ($user_is_subscribe) {
                  //  if (!$subscribe_active) {
                        $subscribe = 1;
                       /* $subscr = new CSubscription;
                        $subscr->Update($arSubscribe["ID"], Array("ACTIVE" => "Y", "RUB_ID"=>array(1)));*/  
                 //   }
                }
                else {
   
                }   
            break;
            case "no":
               
                if ($user_is_subscribe) {
                    $subscribe = "";
                    /*$subscr = new CSubscription; 
                    $subscr->Update($arSubscribe["ID"], Array("ACTIVE" => "N", "RUB_ID"=>array(1)));  */      
                }
            break;
        }
        
        switch ($_POST["new_subscribe"]){
            case "yes":
                
                if ($user_is_subscribe) {
                    $new_subscribe = 2;
                   /* if (!$subscribe_active && !$user_is_subscribe_new) {
                        $subscr_new = new CSubscription;
                        $subscr_new->Update($arSubscribe["ID"], Array("ACTIVE" => "Y", "RUB_ID"=>array(2)), SITE_ID);    
                    }
                    else if ($subscribe_active && !$user_is_subscribe_new)
                    {
                        $subscr_new = new CSubscription;
                        $subscr_new->Update($arSubscribe["ID"], Array("RUB_ID"=>array(2)), SITE_ID);
                    } */
                }
                else {
                    //� ����� ��� ��������, ������� �������� 
                    /*$subscr = new CSubscription;
                    $arFields = Array(
                        "USER_ID" => $_POST["user_id"],
                        "FORMAT" => "text",
                        "EMAIL" => $_POST["email"],
                        "ACTIVE" => "Y",
                        "SEND_CONFIRM" => "N",
                        "CONFIRMED" => "Y",
                        "RUB_ID" => array(2)
                        );
                    $subscr->Add($arFields);  */      
                }   
            break;
            case "no":
               
                if ($user_is_subscribe) {
                    $new_subscribe = "";
                    /*$subscr = new CSubscription; 
                    $subscr->Update($arSubscribe["ID"], Array("ACTIVE" => "N", "RUB_ID" => array(2)));  */      
                }
            break;
        }

        switch ($_POST["subscribe_price_list"]){
            case "yes":
               
                if ($user_is_subscribe) {
                        $subscribe_price_list = 4;
                }
                else {
     
                }   
            break;
            case "no":
                
                if ($user_is_subscribe) {
                    $subscribe_price_list = "";     
                }
            break;
        }
        
        if ($user_is_subscribe) {
             //������� ����������� �� ����� ��� ��������
            $subscr = new CSubscription; 
            $subscr->Update($arSubscribe["ID"], Array("ACTIVE" => "N", "RUB_ID"=>array($subscribe_price_list, $new_subscribe, $subscribe)));
        }
        else {
            //� ����� ��� ��������, ������� �������� 
            $subscr = new CSubscription;
            $arFields = Array(
                "USER_ID" => $_POST["user_id"],
                "FORMAT" => "text",
                "EMAIL" => $_POST["email"],
                "ACTIVE" => "Y",
                "SEND_CONFIRM" => "N",
                "CONFIRMED" => "Y",
                "RUB_ID" => array($subscribe_price_list, $new_subscribe, $subscribe)
                );
            $subscr->Add($arFields);        
        }  
                
        $delivery = $_POST["delivery"];
        $payment = $_POST["paysystem"];
        if ($_POST["city"] != "no") {$city = $_POST["city"];} else {$city = "";}
        if ($_POST["adress"] != "no") {$adress = $_POST["adress"];} else {$adress = "";}
        if ($_POST["pack"] != "no") {$pack = Array("VALUE" => 19 );} else {$pack = "";}
        if ($_POST["main_man"] != "no") {$main_man = $_POST["main_man"];} else {$main_man = "";}
        if ($_POST["main_man_phone"] != "no") {$main_man_phone = $_POST["main_man_phone"];} else {$main_man_phone = "";}
        if ($_POST["regime"] != "no") {$regime = $_POST["regime"];} else {$regime = "";}
        if ($_POST["info"] != "no") {$info = $_POST["info"];} else {$info = "";}     

        //���������, ���������� �� ��� ������� ������������ ������ � ��������� � �������
        $user_data = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>99, "NAME"=>$_POST["user_login"]));
        //���� ������ ����, ��������� ��
        if ($user_data->SelectedRowsCount() > 0) {
            $el = new CIBlockElement;   
            
            $arData = $user_data->Fetch();

            $PROP = array();     
            $PROP["DELIVERY"] = $delivery;
            $PROP["PAYMENT"] = $payment;
            $PROP["CITY"] = $city;
            $PROP["ADRESS"] = $adress;
            $PROP["PACK"] = $pack;
            $PROP["MAIN_MAN"] = $main_man;
            $PROP["MAIN_MAN_PHONE"] = $main_man_phone;
            $PROP["INFO"] = $info;
            $PROP["REGIME"] = $regime;

            $arLoadProductArray = Array(
                "IBLOCK_SECTION_ID" => false,          // ������� ����� � ����� �������
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => $_POST["user_login"],
                "ACTIVE"         => "Y",            // �������
            );

            $res = $el->Update($arData["ID"], $arLoadProductArray);
        }
        //���� ��� - ���������
        else {
            $el = new CIBlockElement;  


            $PROP = array();     
            $PROP["DELIVERY"] = $delivery;
            $PROP["PAYMENT"] = $payment;
            $PROP["CITY"] = $city;
            $PROP["ADRESS"] = $adress;
            $PROP["PACK"] = $pack;
            $PROP["MAIN_MAN"] = $main_man;
            $PROP["MAIN_MAN_PHONE"] = $main_man_phone;
            $PROP["INFO"] = $info;
            $PROP["REGIME"] = $regime;

            $arLoadProductArray = Array(
                "IBLOCK_SECTION_ID" => false,          // ������� ����� � ����� �������
                "IBLOCK_ID"      => 99,
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => $_POST["user_login"],
                "ACTIVE"         => "Y",            // �������
            );

             

            $PRODUCT_ID = $el->Add($arLoadProductArray);

        }


    }
?>