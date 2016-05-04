<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Подтверждение регистрации");
?>


<?//arshow($_GET);
    CModule::IncludeModule("subscribe");
    //изслекаем результаты из массива
    function getResFromArray($array){
        $res = array();
        foreach ($array as $item) {
            $res[] = $item["ANSWER_TEXT"]; 
        }  

        $str = implode(", ",$res);
        return $str;       
    } 

    $res_id = intval($_GET["res_id"]);
    $hash = $_GET["h"];

    //проверяем корректность пришедших данных
  //  $data_check = mysql_query("SELECT * from `_registration_confirm` WHERE res_id=".$res_id." AND hash='".$hash."'");
//    $data = mysql_fetch_assoc($data_check);
//    if ($data["res"] == "N") { //если пользователь еще не подтверждал регистрацию
        //обновляем запись в таблице с подтверждениями
    //    mysql_query("UPDATE `_registration_confirm` SET res='Y' WHERE id=".$data["id"]);

        //получаем результаты заполнения формы
        $result = CFormResult::GetDataByID($res_id); 
        // arshow($result);

        $arRegFields = array(
            'RS_DATE_CREATE' => date("d.m.Y"),
            'RS_USER_EMAIL' => $result["SIMPLE_QUESTION_635"][0]["USER_TEXT"],
            'RS_USER_NAME' => $result["SIMPLE_QUESTION_631"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_363' => $result["SIMPLE_QUESTION_363"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_213' => $result["SIMPLE_QUESTION_213"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_635' => $result["SIMPLE_QUESTION_635"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_659' => $result["SIMPLE_QUESTION_659"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_338' => getResFromArray($result["SIMPLE_QUESTION_338"]),
            'SIMPLE_QUESTION_631_k7LDR' => $result["SIMPLE_QUESTION_631_k7LDR"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_631' => $result["SIMPLE_QUESTION_631"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_252' => $result["SIMPLE_QUESTION_252"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_166' => $result["SIMPLE_QUESTION_166"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_917' => getResFromArray($result["SIMPLE_QUESTION_917"]),
            'SIMPLE_QUESTION_778' => getResFromArray($result["SIMPLE_QUESTION_778"]),
            'SIMPLE_QUESTION_932' => $result["SIMPLE_QUESTION_932"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_951' => $result["SIMPLE_QUESTION_951"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_215' => $result["SIMPLE_QUESTION_215"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_203' => getResFromArray($result["SIMPLE_QUESTION_203"]),
            'SIMPLE_QUESTION_947' => $result["SIMPLE_QUESTION_947"][0]["ANSWER_TEXT"],
            'SIMPLE_QUESTION_520' => $result["SIMPLE_QUESTION_520"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_599' => $result["SIMPLE_QUESTION_599"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_264' => $result["SIMPLE_QUESTION_264"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_365' => $result["SIMPLE_QUESTION_365"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_815' => $result["SIMPLE_QUESTION_815"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_313' => $result["SIMPLE_QUESTION_313"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_592' => $result["SIMPLE_QUESTION_592"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_414' => $result["SIMPLE_QUESTION_414"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_935' => $result["SIMPLE_QUESTION_935"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_437' => $result["SIMPLE_QUESTION_437"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_636' => $result["SIMPLE_QUESTION_636"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_514' => $result["SIMPLE_QUESTION_514"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_399' => $result["SIMPLE_QUESTION_399"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_672' => $result["SIMPLE_QUESTION_672"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_403' => getResFromArray($result["SIMPLE_QUESTION_403"]),
            'SIMPLE_QUESTION_563' => getResFromArray($result["SIMPLE_QUESTION_563"]),
            'SIMPLE_QUESTION_511' => $result["SIMPLE_QUESTION_511"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_209' => $result["SIMPLE_QUESTION_209"][0]["USER_TEXT"],
            'SIMPLE_QUESTION_611' => $result["SIMPLE_QUESTION_611"][0]["USER_TEXT"]

        );

        //добавляем пользователю выбранные подписки
        if (count($result["SIMPLE_QUESTION_338"]) > 0) {
            $arFields = Array(
                "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
                "FORMAT" => ($FORMAT <> "html"? "text":"html"),
                "EMAIL" => $result["SIMPLE_QUESTION_635"][0]["USER_TEXT"],
                "ACTIVE" => "Y",
                "RUB_ID" => 1,
                "SEND_CONFIRM" => "N"
            );
            $subscr = new CSubscription;

            $ID = $subscr->Add($arFields);                  
        }


        //отправляем письмо с результатами админу и пользователю
        $mail = CEvent::Send("NEW_REGISTRATION","s1",$arRegFields,"N",77);


        echo "<p>Ваша регистрация подтверждена!</p>";
//    }
 //   else if ($data["res"] == "Y") {
 //       echo "<p>Вы уже подтвердили свою регистрацию!</p>";
 //   }       

 //   else {
//        header("location: /");
//    }





?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>