<?
    include($_SERVER["DOCUMENT_ROOT"]."/include/common.php");

    function arshow($array, $adminCheck = false){
        global $USER;
        $USER = new Cuser;
        if ($adminCheck) {
            if (!$USER->IsAdmin()) {
                return false;
            } 
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    CModule::IncludeModule('sale');
    CModule::IncludeModule('catalog');
    CModule::IncludeModule('iblock');
    CModule::IncludeModule('vote');
    CModule::IncludeModule('form');
    CModule::IncludeModule('main');
    CModule::IncludeModule('subscribe');
    if (CModule::IncludeModule('osg')) {
        COSGUser::SetUserInfo();    
    }
    
    // AddEventHandler("sale", "OnOrderUpdate", "OnOrderStatus");  //почтовое сообщение о смене статуса заказа

    AddEventHandler("sale", "OnOrderAdd", Array("MyAction", "OnOrderAdd"));
    AddEventHandler("sale", "OnBeforeOrderAdd", "order_check");   //проверка полей заказа


    AddEventHandler("sale", "OnBeforeBasketAdd", "delayCheck");
    //  AddEventHandler("sale", "OnBasketAdd", "basketRedirect");
    AddEventHandler("main", "OnBeforeUserAdd","generateToken");
    AddEventHandler("main", "OnAfterUserAdd", Array("user_check", "OnAfterUserAddHandler"));
    AddEventHandler("main", "OnAfterUserUpdate", Array("user_check", "OnAfterUserUpdateHandler"));
    //AddEventHandler("main", "OnEpilog", "fixCatalogDuplication");
    AddEventHandler("iblock", "OnAfterIBlockElementAdd", "NewItemInfo");   
    AddEventHandler("iblock", "OnAfterIBlockElementUpdate","UpdateItemInfo");

    //подмена поля "кем изменен"
    AddEventHandler("iblock", "OnBeforeIBlockElementAdd", array("itemDataChange","changeModifier"));   
    AddEventHandler("iblock", "OnBeforeIBlockElementUpdate",array("itemDataChange","changeModifier"));

    class itemDataChange {
        function changeModifier(&$arFields) {
            $arFields["MODIFIED_BY"] = 2; 
        }
    }



    //заполнение веб-формы
    AddEventHandler('form', 'onAfterResultAdd', 'SendConfirmEmail'); //заполнена веб-форма регистрации

    //Регистрируем обработчик события при регистрации нового пользователя
    AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
    //Для редиректа на retail
    AddEventHandler("main", "OnBeforeProlog", "MyOnBeforePrologHandler");

    /*----Редирект для дублирующих ссылок в каталоге----*/
    function fixCatalogDuplication(){
        $subdir = explode('/', $GLOBALS["APPLICATION"] -> GetCurPage());
        if(strpos($GLOBALS["APPLICATION"] -> GetCurPage(),'catalog') && $subdir[2] && $subdir[3] && !strpos($subdir[3],'ndex.php')){
            $arFilter = Array('SECTION_ID'=>$subdir[2]);
            $db_list = CIBlockSection::GetList(Array(), $arFilter, true);
            if($ar_result = $db_list->GetNext()){
                LocalRedirect("/404.php", "404 Not Found",301);
                exit();
            }
        }
    }

    function generateToken(&$arFields){
        $arFields['UF_RESTTOKEN'] = md5(uniqid(rand(), true));
    }



    class user_check
    {
        // создаем обработчик события "OnAfterUserAdd"
        function OnAfterUserAddHandler($arFields)  {
            //отправляем новому пользователю на почту письмо с регистрационными данными

            if ($arFields["ID"]>0) {
                if ( checkSite()=="opt" ) { 
                    $arPost = array(
                        "LOGIN"             => $arFields["LOGIN"],
                        "EMAIL"             => $arFields["EMAIL"],
                        "NAME"              => $arFields["NAME"],
                        "PASS"              => $arFields["CONFIRM_PASSWORD"],
                        "WORK_COMPANY"      => $arFields["WORK_COMPANY"],
                        "PERSONAL_PHONE"    => $arFields["PERSONAL_PHONE"],
                        "PERSONAL_CITY"     => $arFields["PERSONAL_CITY"],
                        "PERSONAL_ZIP"      => $arFields["PERSONAL_ZIP"],
                        "PERSONAL_ADRESS"   => $arFields["PERSONAL_STREET"],
                        "WORK_FAX"          => $arFields["WORK_FAX"],
                        "WORK_INN"          => $arFields["UF_USER_INN"],
                        "WORK_ADRESS"       => $arFields["UF_USER_ADDRESS_U"],
                        "WORK_BANK"         => $arFields["UF_USER_BANK"],
                        "WORK_BIK"          => $arFields["UF_USER_BIK"],
                        "WORK_RS"           => $arFields["UF_USER_RS"],
                        "WORK_KS"           => $arFields["UF_USER_KS"],
                        "WORK_OKPO"         => $arFields["UF_USER_OKPO"],
                        "WORK_OKNH"         => $arFields["UF_USER_OKNH"]
                    );
                    //arshow($arFields);
                    //die();
                    CEvent::Send("NEW_USER_REGISTER", "s1", $arPost,"N", 64);
                }
                else {
                    $arPost = array(
                        "LOGIN"             => $arFields["LOGIN"],
                        "EMAIL"             => $arFields["EMAIL"],
                        "NAME"              => $arFields["NAME"]      
                    );
                    //arshow($arFields);
                    //die();
                    CEvent::Send("NEW_USER_REGISTER_RETAIL", "s1", $arPost,"N", 84);    
                }    
            }



        }

        // создаем обработчик события "OnAfterUserUpdate"
        function OnAfterUserUpdateHandler($arFields)  {
            //отправляем пользователю на почту письмо с измененными регистрационными данными

            $arPost = array(
                "LOGIN"             => $arFields["LOGIN"],
                "EMAIL"             => $arFields["EMAIL"],
                "NAME"              => $arFields["NAME"],
                "PASS"              => $arFields["CONFIRM_PASSWORD"],
                "WORK_COMPANY"      => $arFields["WORK_COMPANY"],
                "PERSONAL_PHONE"    => $arFields["PERSONAL_PHONE"],
                "PERSONAL_CITY"     => $arFields["PERSONAL_CITY"],
                "PERSONAL_ZIP"      => $arFields["PERSONAL_ZIP"],
                "PERSONAL_ADRESS"   => $arFields["PERSONAL_STREET"],
                "WORK_FAX"          => $arFields["WORK_FAX"],
                "WORK_INN"          => $arFields["UF_USER_INN"],
                "WORK_ADRESS"       => $arFields["UF_USER_ADDRESS_U"],
                "WORK_BANK"         => $arFields["UF_USER_BANK"],
                "WORK_BIK"          => $arFields["UF_USER_BIK"],
                "WORK_RS"           => $arFields["UF_USER_RS"],
                "WORK_KS"           => $arFields["UF_USER_KS"],
                "WORK_OKPO"         => $arFields["UF_USER_OKPO"],
                "WORK_OKNH"         => $arFields["UF_USER_OKNH"]
            );
            //  arshow($arFields);
            //   die();
            CEvent::Send("USER_UPDATE","s1", $arPost,"N", 65);
        }
    }


    function order_check(&$arFields){
        //global $USER;
        //if($USER->GetID()==172333){
        if(!empty($_COOKIE['comment_city']) && !empty($_COOKIE['comment_street'])){
            $arFields['USER_DESCRIPTION'] = $arFields['USER_DESCRIPTION'].'
            Город: ['.$_COOKIE['comment_city'].'];
            Адрес: ['.$_COOKIE['comment_street'].']';
            unset($_COOKIE['comment_city']);
            unset($_COOKIE['comment_street']);
        }
        //arshow($arFields);
        //die();
        //}
    }



    class MyAction{
        function OnOrderAdd($ID, $arFields){
            //добавляем к заказу свойство "количество мест" - номер склада
            $arFields = array("ORDER_ID"=>$ID,"ORDER_PROPS_ID"=>156, "NAME"=>"Количество мест", "VALUE"=>GKCommon::GetSavedWarehouse(), "CODE"=>"ROOM_NUMBER" );
            // $prop_id = CSaleOrderPropsValue::Add($arFields);

        }
    }


    function image_resize($path,$max_width,$max_height) {
        $image_sizes = getimagesize($path);

        $width = $image_sizes[0];
        $height = $image_sizes[1];

        if ($width < $height) {
            $new_height = $max_height;
            $style = "margin: 0 auto; height: ".$max_height;

        }

        else {
            $new_width = $max_width;
            $new_height = $height * $new_width / $width;
            $margin_top = ($max_height - $new_height)/2;
            $style = "margin: ".$margin_top."px auto 0; width: ".$new_width;
        }

        return $style;
    }


    //меняем валюту при добавлении в корзину
    function currencyChange(&$arFields){    
        //$arFields["CURRENCY"] = "RUR";
        //arshow($arFields);
        //die();                            
    }




    //функция для сортировки массива  
    function cmpMyArray($a, $b){
        $aa = intval($a["PRICES"]["BASE"]["VALUE_NOVAT"]);
        $bb = intval($b["PRICES"]["BASE"]["VALUE_NOVAT"]);

        //$a < $b
        if ($aa < $bb) {
            return -1;
        }
        //$a > $b
        else if ($aa > $bb) {
            return 1;
        }
        //$a = $b
        else {
            return 0;
        }

    }


    //откладываем товары
    function delayCheck(&$arFields){
        //arshow($_GET);
        if ($_GET["DELAY"] == "Y") {
            $arFields["DELAY"] = "Y";
        }
        else {
            $arFields["DELAY"] = "N";
        }
        //arshow($arFields);
        //die();
    }



    //письмо о подтверждении регистрации и добавление в бд записи для проверки
    function SendConfirmEmail($WEB_FORM_ID, $RESULT_ID) {
        //die();
        if ($WEB_FORM_ID == 1) {//форма регистрации
            $hash = md5(date("U"));
            $link = "http://autobody.ru/reg_confirm.php?h=".$hash."&res_id=".$RESULT_ID;
            //добавляем в базу запись для подтверждения авторизации
            //    mysql_query("INSERT INTO `_registration_confirm` (id,res_id,hash,res) VALUES (NULL,".$RESULT_ID.",'".$hash."','N')");

            //получаем email из формы
            $result = CFormResult::GetDataByID($RESULT_ID);

            $arRegFields = array(
                'EMAIL' => $result["SIMPLE_QUESTION_635"][0]["USER_TEXT"],
                'LINK' => $link,
            );
            //генерируем почтовое событие
            $mail = CEvent::Send("EMAIL_CONFIRM","s1",$arRegFields,"N",76);
        }
    }


    function NewItemInfo($arFields) {
        //предложение картинок
        if ($arFields["IBLOCK_ID"] == 96) {   

            $el = CIBlockElement::GetById($arFields["ID"]);     
            $arElement = $el->Fetch();

            if ($arElement["WF_NEW"] == "Y") {
                //получаем свойтво "файл" для данного элемента
                $file = CIBlockElement::GetProperty(96,$arElement["ID"], Array(), Array("CODE"=>"FILE"));
                $arFile = $file->GetNext();  

                $file_path = "http://autobody.ru";
                $file_path .= CFile::GetPath($arFile["VALUE"]); //путь к картинке, которую перемещаем в каталог

                $action = "http://autobody.ru/img_check.php?ID=".$arFields["ID"];    

                //получаем свойто "товар" для данного элемента     
                $product = CIBlockElement::GetList(array(), array("CODE"=>$arElement["NAME"], "IBLOCK_ID"=>88), false, false, array());
                $arProduct = $product->GetNext(); 

                $item_link = "http://autobody.ru/catalog/".$arProduct["IBLOCK_SECTION_ID"]."/".$arProduct["ID"]."/";

                $arRegFields = array(
                    "ART" => $arElement["NAME"],
                    "IMG_LINK" => $file_path,
                    "ACTION_LINK" => $action,
                    "ITEM_LINK" =>  $item_link
                );
                //генерируем почтовое событие
                $mail = CEvent::Send("NEW_IMAGE","s1",$arRegFields,"N",78);    
            }
        }


        //добавление комментария к товару
        if ($arFields["IBLOCK_ID"] == 97) {

            //получаем инфо о добавленном элементе инфоблока
            $el = CIBlockElement::GetList(array(),array("ID"=>$arFields["ID"], "IBLOCK_ID"=>97),false, false, array("NAME","PROPERTY_TEXT","PROPERTY_PRODUCT", "PROPERTY_TEXT"));
            $arElement = $el->GetNext(); 
            //получаем инфо о товаре к которому добавлен коммент
            $product = CIBlockElement::GetById($arElement["PROPERTY_PRODUCT_VALUE"]);
            $arProduct = $product->GetNext();      

            $arRegFields = array(
                "ART" => $arProduct["CODE"],
                "TEXT" => $arElement["PROPERTY_TEXT_VALUE"],
                "ACTION_LINK" => "http://autobody.ru/comment_check.php?ID=".$arFields["ID"],
                "ITEM_LINK" =>  "http://autobody.ru/catalog/".$arProduct["IBLOCK_SECTION_ID"]."/".$arProduct["ID"]."/"    
            );    

            //отправляем оповещение о новом комменте
            $mail = CEvent::Send("NEW_COMMENT","s1",$arRegFields,"N",79);   
        }

        //дублируем свойства для поиска
        if ($arFields["IBLOCK_ID"] == 88) {
            addSearchProps($arFields["ID"]);
        }


    }


    //дублируем свойства для поиска
    function UpdateItemInfo($arFields) {
        if ($arFields["IBLOCK_ID"] == 88) {
            addSearchProps($arFields["ID"]);
        }
    }

    //Функция которая инициализирует почтовое событие при смене статуса заказа через 1с
    /*  function OnOrderStatus($ID, $arFields){            
    $order_res = CSaleOrder::GetList(
    Array(),
    Array("ID" => $ID),
    false,
    false,
    array()
    );
    $order_ob = $order_res ->Fetch();
    $basket_res = CSaleBasket::GetList(
    array(),
    array("ORDER_ID" => $ID),
    false,
    false,
    array()
    );
    $order_status_info = CSaleStatus::GetByID(
    $order_ob["STATUS_ID"]
    );
    $order_list = "";
    while($basket_ob = $basket_res ->Fetch()):
    $date_basket=explode(" ", $order_ob["DATE_INSERT"]);
    $date_baket_new=explode(".", $date_basket[0]);
    if (CModule::IncludeModule('currency')) {
    $price_basket = CCurrencyRates::ConvertCurrency($basket_ob["PRICE"], "USD", "RUB", $date_baket_new[2]."-".$date_baket_new[1]."-".$date_baket_new[0]);   
    };
    $order_list .= $basket_ob["NAME"]." Количество: ".$basket_ob["QUANTITY"]." Цена: ".$price_basket." руб.\n";
    endwhile;
    $fields["ORDER_USER"] = $order_ob["USER_LAST_NAME"]." ".$order_ob["USER_NAME"];
    $fields["ORDER_LIST"] = $order_list;
    $fields["ORDER_ID"] = $ID;
    $fields["ORDER_DATE"] = $order_ob["DATE_INSERT"];
    $fields["ORDER_STATUS"] =  $order_status_info["NAME"];
    $fields["USER_EMAIL"] = $order_ob["USER_EMAIL"];
    //  $fields["PRICE"] = $order_ob["PRICE"];
    CEvent::Send("ORDERS_STATUS", "s1", $fields, "N");
    }*/

?>
<?
    /*define("PREFIX_PATH_404", "/404.php");

    AddEventHandler("main", "OnAfterEpilog", "Prefix_FunctionName");

    function Prefix_FunctionName() {  
    global $APPLICATION;

    // Check if we need to show the content of the 404 page
    if (!defined('ERROR_404') || ERROR_404 != 'Y') {
    return;
    }

    // Display the 404 page unless it is already being displayed
    if ($APPLICATION->GetCurPage() != PREFIX_PATH_404) {
    header('X-Accel-Redirect: '.PREFIX_PATH_404);
    exit();
    }    
    }*/


    //получаем ID товаров в корзине
    function getCurrentBasket() {
        $arBasketItemsIDs = array();  //массив ID товаров, которые в корзине на данный момент

        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                "DELAY" => "N"
            ),
            false, false,
            array(
                "PRODUCT_ID"
            )
        );

        while ($arItems = $dbBasketItems->Fetch())
        {
            //  arshow($arItems);
            $arBasketItemsIDs[] = $arItems["PRODUCT_ID"];
        }

        return $arBasketItemsIDs;
    }



    //добавляем свойства CODE, UNC и WARRANTY в доп поля для поиска для элемента $ID
    function addSearchProps($ID) {     
        $el = CIBLockElement::GetLIst(array(), array("IBLOCK_ID"=>88, "ID"=>$ID), false, false, array("ID","CODE","PROPERTY_UNC","PROPERTY_WARRANTY"));
        while($arElement = $el->Fetch()) {
            $pattern = "/(\W)/";      
            $arElement["CODE"] = preg_replace($pattern,"",$arElement["CODE"]);
            $arElement["PROPERTY_WARRANTY_VALUE"] = preg_replace($pattern,"",$arElement["PROPERTY_WARRANTY_VALUE"]);
            $arElement["PROPERTY_UNC_VALUE"] = preg_replace($pattern,"",$arElement["PROPERTY_UNC_VALUE"]); 

            if (strpos($arElement["PROPERTY_UNC_VALUE"],"/") > 0) {
                $s = "/"; 
                $unc = explode($s,$arElement["PROPERTY_UNC_VALUE"]);
            }           
            elseif (strpos($arElement["PROPERTY_UNC_VALUE"],"+") > 0) {
                $s = "+";
                $unc = explode($s,$arElement["PROPERTY_UNC_VALUE"]);
            } 
            else {
                $unc = $arElement["PROPERTY_UNC_VALUE"];
            }        
            CIBlockElement::SetPropertyValuesEx($arElement["ID"], 88, array("SEARCH_CODE"=>$arElement["CODE"]));
            CIBlockElement::SetPropertyValuesEx($arElement["ID"], 88, array("SEARCH_WARRANTY"=>$arElement["PROPERTY_WARRANTY_VALUE"])); 
            CIBlockElement::SetPropertyValuesEx($arElement["ID"], 88, array("SEARCH_UNC"=>$unc));  
        }        
    }


    function checkSite() {
        $site = "";
        if (substr_count($_SERVER["HTTP_HOST"], "retail.autobody.ru") > 0) {
            $site = 'retail'; 
        }
        else {
            $site = 'opt';
        }
        return $site;
    }


    //пишем в сессию массив с данными для передачи на сайт:
    if (checkSite() == 'retail') {

        $_GLOBALS["SITE_VARIABLES"] = array(            
            "PRICE_CODE" => 'PRICE_2',
        );          
    }

    else {                           

        $_GLOBALS["SITE_VARIABLES"] = array(            
            "PRICE_CODE" => 'PRICE_1',
        );
    }

    function getPriceForId($product_id) {
        if (checkSite() == 'retail') {      
            $price_code = 'PRICE_2';
        }
        else {                           
            $price_code = 'PRICE_1';
        }

        $res=CIBlockPriceTools::GetCatalogPrices(88,array($price_code));
        $price_code=$res[$price_code]["ID"]; 

        $dbPrice=CPrice::GetList(
            array(),
            array("PRODUCT_ID" => $product_id),
            false,
            false,
            array("PRICE","CATALOG_GROUP_ID"));
        $arPriceCode=array();
        while ($arPrice = $dbPrice->Fetch()) {
            $arPriceCode[$arPrice["CATALOG_GROUP_ID"]]=$arPrice["PRICE"];    
        }

        return CCurrencyRates::ConvertCurrency($arPriceCode[$price_code], "USD", "RUB");
    }




    //Если регистрация с сайта retail, то изменяем группу 
    function OnBeforeUserRegisterHandler($args)
    {
        if (checkSite() == 'retail') {
            $args["GROUP_ID"]=array(11); //11 - клиенты розничного магазина
        }
        return true;
    }

    /*если юзер в группе 11(клиенты розничного магазина) и находится не на retail
    редиректим на тотже url, но с retail*/
    function MyOnBeforePrologHandler()
    {
        global $USER;
        global $APPLICATION;

        //если админ, то не редиректим
        if (!$USER->IsAdmin()) {
            //$strCurHost=$_SERVER["HTTP_HOST"];   
            $strCurHost=SITE_SERVER_NAME;  //домен www.autobody.ru
            $strCurDir=$APPLICATION->GetCurPageParam("",array(),false); //страница и GET параметры

            if (checkSite()=="opt") {
                //url = autobody.ru и юзер в группе 11(клиенты розницы)
                if ( in_array(11,$USER->GetUserGroupArray()) ) {
                    $arCurHost=explode(".", $strCurHost);

                    if ( $arCurHost[0]=="www" )
                        $arCurHost[0]="retail";
                    else
                        array_unshift($arCurHost,"retail");

                    $strCurHost=implode(".",$arCurHost);
                    $strCurHost="http://".$strCurHost.$strCurDir;
                    header("Location: ".$strCurHost);         
                }    
            }
            else if (checkSite()=="retail") {
                //url = retail.autobody.ru и юзер НЕ в группе 11(клиенты розницы)
                if ( !in_array(11,$USER->GetUserGroupArray()) && $USER->IsAuthorized() ) {            
                    $strCurHost="http://".$strCurHost.$strCurDir;
                    header("Location: ".$strCurHost);
                    //echo $_SERVER['SERVER_NAME']; die();
                }

            }
        }  
    }




    AddEventHandler('sale', 'OnOrderUpdate', 'OnOrderUpdateFunc');
    function OnOrderUpdateFunc ($ID, $arFields) {          
        global $USER;       
        $order_info=CSaleOrder::GetByID($ID);         
        
        //проверяем, если статус изменился только что, отсылаем письмо
        $curTimestamp = date("U");
        $orderStatusTimestamp = MakeTimeStamp($order_info["DATE_STATUS"], "YYYY-MM-DD HH:MI:SS"); 
        $sendMessage = true;
        //если между текущей меткой времени и меткой времени смены статуса заказа больше минуты - письмо не отправляем
        if (($curTimestamp - $orderStatusTimestamp) > 60) {
           $sendMessage = false; 
        }
        if ($order_info['STATUS_ID']!='N' && $sendMessage) {
            if(strstr($order_info['DATE_UPDATE'],date('Y-m-d H:i')) || strstr($order_info['DATE_STATUS'],date('Y-m-d H:i'))){
                $status=CSaleStatus::GetByID($order_info['STATUS_ID']);          
                $delivery = CSaleDelivery::GetByID($order_info['DELIVERY_ID']);
                $payment = CSalePaySystem::GetByID($order_info['PAY_SYSTEM_ID']);
                $THIS_ORDER_LIST="";
                $list=CSaleBasket::GetList(array(),array("ORDER_ID"=>$ID),false,false,array("PRODUCT_ID", "QUANTITY", "PRICE", "USER_ID", "ID"));
                while ($list_fetch=$list->Fetch()) {
                    $elem=CIBlockElement::GetList(array(), array("ID" => $list_fetch["PRODUCT_ID"]), false, false, array("CODE", "PROPERTY_UNC", "PROPERTY_SIZE", "IBLOCK_SECTION_ID", "ID", "NAME"));
                    while ($elem_fetch=$elem->Fetch()) {
                        $rsUser=CUser::GetByID($order_info['USER_ID'])->Fetch();
                        $props_list=CSaleBasket::GetPropsList(array(),array('BASKET_ID'=>$list_fetch['ID'], 'CODE'=>'Code'),false,false,array());
                        // if ($props_list->SelectedRowsCount()) {
                        while ($props_fetch=$props_list->Fetch()) {
                            $props_value=$props_fetch['VALUE'];
                        }
                        //  }
                        $props_list_disallowed=CSaleBasket::GetPropsList(array(),array('BASKET_ID'=>$list_fetch['ID'], 'CODE'=>'StatusPosition'),false,false,array());
                        //  if ($props_list_disallowed->SelectedRowsCount()) {
                        while ($disallowed_fetch=$props_list_disallowed->Fetch()) {
                            $disallowed_value=$disallowed_fetch['VALUE'];
                        }
                        //  }
                        $props_list_executed=CSaleBasket::GetPropsList(array(),array('BASKET_ID'=>$list_fetch['ID'], 'CODE'=>'QuantityExecuted'),false,false,array());
                        // if ($props_list_executed->SelectedRowsCount()) {
                        while ($executed_fetch=$props_list_executed->Fetch()) {
                            $executed_value=$executed_fetch['VALUE'];
                        }
                        // }
                        $THIS_ORDER_LIST .= ' <tr style="height:88px;text-align:center;border-bottom:1px solid #dddddd;">
                        <td style="text-align:left;"><a href="http://www.autobody.ru/catalog/'.$elem_fetch['IBLOCK_SECTION_ID'].'/'.$elem_fetch["ID"].'/" style="color:#0094c8;line-height:25px;border-bottom:1px solid #0094c8;padding-bottom:2px;text-decoration:none;">'.$elem_fetch["NAME"].'</a><br>
                        <span class="item_descr" style="font-size:11px;color:#808080;line-height:25px;">('.$elem_fetch["CODE"].', '.$elem_fetch["PROPERTY_UNC_VALUE"].', '.$elem_fetch["PROPERTY_SIZE_VALUE"].')</span></td>
                        <td>'.$props_value.'</td>
                        <td>'.$executed_value.'</td>
                        <td>-</td>
                        <td>'.$disallowed_value.'</td>   
                        <td>'.$list_fetch["QUANTITY"].'</td>
                        <td>'.CCurrencyRates::ConvertCurrency($list_fetch['PRICE'], "USD", "RUR").'</td>
                        <td><b>'.(CCurrencyRates::ConvertCurrency($list_fetch['PRICE'], "USD", "RUR")*$list_fetch["QUANTITY"]).'</b></td>
                        </tr> ';
                    }
                }
                $list1=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, "CODE"=>"ROOM_NUMBER"), false, false, array())->Fetch();
                $res_number=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, "CODE"=>"NUM_INVOICE"), false, false, array())->Fetch();
                $res_date=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, "CODE"=>"INCREMENT_ID"), false, false, array())->Fetch();
                $num_ticket=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$ID, "CODE"=>"NUM_TICKET"), false, false, array())->Fetch();
                $store=CCatalogStore::GetList(array(), array('ID'=>$list1['VALUE']), false, false, array())->Fetch();


                $mail_fields=array(
                    "WAREHOUSE_EMAIL" => $store['EMAIL'],
                    "ORDER_USER" => $rsUser['NAME'].$rsUser['LAST_NAME'],
                    "ORDER_ID" => $ID,
                    "ORDER_DATE" => $order_info['DATE_INSERT'],
                    "ORDER_STATUS" => $status['NAME'],
                    "RES_NUMBER" => $res_number['VALUE'],
                    "RES_DATE" => $res_date['VALUE'],
                    "NUM_TICKET" => $num_ticket['VALUE'],
                    //"PRICE" => CCurrencyRates::ConvertCurrency($list_fetch['PRICE'], "USD", "RUR")+$delivery['PRICE'],
                    "PRICE" => $order_info['PRICE'],
                    "ORDER_LIST" => $THIS_ORDER_LIST, 
                    "EMAIL" =>  $rsUser['EMAIL'],
                    "WAREHOUSE" => $store['TITLE'],
                    "DELIVERY" => $delivery["NAME"],
                    "DELIVERY_PRICE" => $delivery['PRICE'],
                    "PAYMENT" => $payment["NAME"]             


                );
                //  $fields["PRICE"] = $order_ob["PRICE"];
                //  if ($mail_fields['RES_NUMBER']) {
                if ((is_numeric($mail_fields['RES_NUMBER']) && $order_info['STATUS_ID']!='F') || ($order_info['STATUS_ID']=='F' && strstr($mail_fields['RES_NUMBER'], '('))) {
                    CEvent::Send("ORDERS_STATUS", "s1", $mail_fields, "N", 87);
                }  
            }
        }
    }
    // } 
    function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }


    function num2str($num) { 
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('копейка' ,'копейки' ,'копеек',     1),
            array('рубль'   ,'рубля'   ,'рублей'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop 
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));    
    }

    /*---Banners on index page----*/

    /**
    * Prepare section code for query
    * %ccc% - this pattern will search for a needle presence in the string
    * https://dev.1c-bitrix.ru/api_help/iblock/filters/string.php
    * 
    * @param string $sectionCodePrefix
    * @return string
    * 
    * */

    function prepareForQuery($sectionCodePrefix){
        return "%-".$sectionCodePrefix."%";
    }

    /**
    * 
    * @param string $sectionCode
    * @return array $sections
    * 
    * */

    function getSectionsPrefixArr($sectionCode){

        $bannersSections = Array(
            "kuzovnoy-remont" => 2363984,
            "optics" => 2363988,
            "tuning" => 2363990,
            "cooling" => 2363987,
            "mechanics" => 2363985,
            "mirrors" => 2363986
        );

        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>118,"ACTIVE"=>"Y","ID"=>$bannersSections[$sectionCode]), false, false, Array("ID","IBLOCK_ID","NAME"));
        if($ob = $res->GetNextElement()){
            $arp = $ob->GetProperties();
            $sections = array_map("prepareForQuery",$arp['RELATED_SECTIONS']['VALUE']);   
        }
        return $sections;
    }

    /**
    * @param string $fileName
    * @return string|void
    * 
    * */

    function isMinifiedExist($fileName){
        if (file_exists($fileName)){
            return true;
        }
    }

    /**
    * 
    * @param string $code
    * @return string $image
    * 
    * */

    function isImageExist($code){
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$code.'.jpg')) {
            $image = $_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$code.'.jpg';
        } else if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$code.'.JPG')) {
            $image = $_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$code.'.JPG';
        } else {
            $image = '';
        }
        return $image;
    }

    /**
    * 
    * @param string $item_code
    * @return string $path
    * 
    * */

    function getResizedIMGPath($item_code,$width=150,$height=150){
        $tmp_fold = $_SERVER["DOCUMENT_ROOT"]."/upload/catalog_resized/".$item_code.".jpg";
        if(!isMinifiedExist($tmp_fold)){
            $image = isImageExist($item_code);
            if($image){
                CFile::ResizeImageFile(
                    $image, 
                    &$tmp_fold, 
                    array('width'=>$width, 'height'=>$height), 
                    BX_RESIZE_IMAGE_PROPORTIONAL
                );
                $path = "/upload/catalog_resized/".$item_code.".jpg";
            } else {
                $path = "/i/nofoto.png";
            }
        } else {
            $path = "/upload/catalog_resized/".$item_code.".jpg";
        }
        return $path;
    }

    function getRelatedSectionsForBanner($curSection){
        $responseArray = Array();
        $counter = 0;
        $sections = getSectionsPrefixArr($curSection);
        $arSelect = Array("NAME","CODE","DETAIL_PAGE_URL");
        $arFilter = Array("IBLOCK_ID"=>88,"CODE"=>$sections,"ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array("rand"=>"asc"), $arFilter, false,Array("nPageSize"=>100), $arSelect);
        while(($ob = $res->GetNextElement()) && ($counter<20)){
            $arf = $ob->GetFields();
            if(isImageExist($arf['CODE'])){
                array_push($responseArray,$arf);
                $counter++;
            } 
        }
        return $responseArray;
    }
?>