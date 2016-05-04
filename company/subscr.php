<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
    global $USER;
    $arFields = Array(
        "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
        "FORMAT" => ($FORMAT <> "html"? "text":"html"),
        "EMAIL" => $_POST["sf_EMAIL"],
        "ACTIVE" => "Y",
        "RUB_ID" => $_POST["sf_RUB_ID"]
    );

    $subscrib = CSubscription::GetList(
        array("ID"=>"ASC"),
        array("EMAIL"=>$_POST["sf_EMAIL"], "USER_ID" => false)
    );
    
    while(($subscr_arr = $subscrib->Fetch())){ 
        $subscr_id = $subscr_arr["ID"];                  
    }
    
    $aSubscrRub = CSubscription::GetRubricArray($subscr_id);

    
    if($subscr_id){
        $aSubscrRub[] = $_POST["sf_RUB_ID"][0];
        $subscr = new CSubscription;
         
        //can add without authorization
        $ID = $subscr->Update($subscr_id, array("RUB_ID"=>$aSubscrRub));
        
        if($ID>0){
            echo "Вы успешно подписались на рассылку!";
        }else{
            echo "Произошла ошибка, попробуйте подписаться заново.";
        } 
    }else{
  
        $subscr = new CSubscription;
         
        //can add without authorization
        $ID = $subscr->Add($arFields);
        
        if($ID>0){
            CSubscription::Authorize($ID);
            echo "Вы успешно подписались на рассылку!";
        }else{
            //$strWarning .= "Error adding subscription: ".$subscr->LAST_ERROR."<br>";
            echo "Произошла ошибка, попробуйте подписаться заново.";
        } 
    }
?>