<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetTitle("Баланс по управленческому учету")?>
<?


    global $USER;

    if ($USER->IsAuthorized()) {

        $companies = array();
        $company = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>105),false,false,array("ID","NAME"));
        while($arCompany = $company->Fetch()) {
            $companies[$arCompany["ID"]] = $arCompany["NAME"];  
        }

        $userLogin = $USER->GetLogin();
        $balanceByType = array();
        $balance = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>106,"NAME"=>$userLogin),false,false,array("NAME","PROPERTY_COMPANY","PROPERTY_TYPE","PROPERTY_BALANCE","PROPERTY_DATE"));
        while($arBalance = $balance->Fetch()) {
            $balanceByType[$arBalance["PROPERTY_TYPE_VALUE"]][] = $arBalance; 
        }

        //отправка запроса баланса
        if ($_GET["getBalance"] != "") {
            $user = CUser::GetByLogin($_GET["getBalance"])->Fetch();
            if (!$user["ID"] || $_SESSION["balanceRequestSent"] || $_COOKIE["balanceRequestSent"] ) {
                header("location: /personal/balance/");
            }

            else {
                $to = "forward@autobody.ru";
                $theme = "Запрос баланса на сайте autobody.ru";
                $text = "Пользователь ".$user["LOGIN"]." сделал запрос баланса";
                mail($to,$theme,$text); 
                $_SESSION["balanceRequestSent"] = "Y";
                setcookie("balanceRequestSent","Y",time()+3600*24);//24 часа   

            }
        }

            

        if (count($balanceByType) > 0) {
        ?>  
        
        <? if ($_SESSION["balanceRequestSent"] == "Y" && $_COOKIE["balanceRequestSent"] == "Y") {?>
        <p>Вы отправили запрос о состоянии баланса. В ближайшее время с Вами свяжется менеджер. Спасибо!</p>
        <br>  
        <?}?>
        <table class="balanceTable">
            <tr class="balanceHeaders">
                <td>Юридическое лицо</td>
                <td>Баланс, <span class="rouble" style="color:#000">i</span></td>
                <td>Дата</td>
            </tr>
            <?
                foreach ($balanceByType as $tName => $type) {?>
                <tr >
                    <th colspan="3"><?=$tName?></th>
                </tr>
                <?foreach ($type as $company) {?>
                    <tr>
                        <td><?=$companies[$company["PROPERTY_COMPANY_VALUE"]]?></td> 
                        <?$sign = substr($company["PROPERTY_BALANCE_VALUE"],0,1);
                            if ($sign == "-") {
                                $text = "Аванс&nbsp;";
                                $color = "#00C100";
                                $company["PROPERTY_BALANCE_VALUE"] = substr($company["PROPERTY_BALANCE_VALUE"],1);
                            }
                            else {
                                $text = "Долг&nbsp;"; 
                                $color = "#FF1A12";
                            }
                        ?>
                        <td style="color:<?=$color?>">

                            <?=$text." ".$company["PROPERTY_BALANCE_VALUE"]?>
                        </td>
                        <td><?=$company["PROPERTY_DATE_VALUE"]?></td>
                    </tr>
                    <?}?>  
                <?}?>
        </table>

        <br>
        <?if (!$_SESSION["balanceRequestSent"] && !$_COOKIE["balanceRequestSent"]){?>
            <a href="?getBalance=<?=$userLogin?>" class="getBalance">запрос баланса</a>
            <?}?>
        <? 
        } else {?>
        <p>Информация отсутствует</p>  

        <?} 

    }

    else {
        header("location: /");
    }

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>