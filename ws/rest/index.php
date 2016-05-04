<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?

    CModule::IncludeModule("iblock");
    CModule::IncludeModule("main");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");


    class CAutobodyWS {

        //функция авторизации
        private function  Authorize($login,$password) {
            if (!is_object($USER)) $USER = new CUser;
            $res = $USER->Login($login,$password,'N','Y');
            if (!is_array($res)) {
                $result = 'Y';
            }
            else {
                $result = 'N';
            }        
            return  $result;
        }


        //получение названия элемента по его ID
        private function GetIblockElementName($id){
            if (intval($id > 0)) {
                $element = CIBlockElement::GetList(array(),array('ID'=>$id),false,false, array('NAME'));
                $arElement = $element->Fetch(); 
            }    
            if ($arElement['NAME']) {              
                $res = $arElement['NAME'];
            }
            else {
                $res = '';
            }      
            return $res;
        }


        //получение информации об одном элементе каталога по его артикулу ($code), ОЕМ - номеру ($oem) или номеру поставщика ($manufacturer_number) 
        public function GetProductInfo($login,$password,$code,$oem,$manufacturer_number)
        {  
            //если авторизация прошла, то запрашиваем товар
            if (CAutobodyWS::Authorize($login,$password) == 'Y')  { 
                if ($code != '' || $oem != '' || $manufacturer_number != '') {
                    $arFilter = array('IBLOCK_ID'=>88,'ACTIVE'=>'Y');
                    if ($code !='') {$arFilter['CODE'] = $code;}
                    if ($oem !='') {$arFilter['PROPERTY_UNC'] = $oem;}
                    if ($manufacturer_number !='') {$arFilter['PROPERTY_WARRANTY'] = $manufacturer_number;}

                    $arSelect = array('NAME','CODE','ID','PROPERTY_COUNTRY','PROPERTY_FIRM','PROPERTY_UNC','PROPERTY_SIZE' ,'SECTION_ID','PROPERTY_WARRANTY','XML_ID');

                    $element = CIBlockElement::GetList(array(),$arFilter,false,false, $arSelect);
                    $arElement = $element->Fetch();              
                    if($arElement) {
                        //получаем название категории товара
                        $section = CIBlockSection::GetList(array(),array('ID'=>$arElement['SECTION_ID']),false,array('NAME'));
                        $arSection = $section->Fetch();

                        //собираем количество товара на складе
                        $warehouses = array();
                        $quantity = CCatalogStoreProduct::GetList(array(),array('PRODUCT_ID'=>$arElement['ID']), false, false, array());
                        while($arQuantity = $quantity->Fetch()){
                            $warehouses[] = array(
                                'id'=>$arQuantity['STORE_ID'],
                                'name'=>$arQuantity['STORE_NAME'],
                                'quantity'=>$arQuantity['AMOUNT'], 
                            );  
                        }    

                        //собираем цены
                        $prices = array();
                        $productPrice = CPrice::GetList(array(),array('PRODUCT_ID'=>$arElement['ID']), false, false, array());
                        while($arProductPrice = $productPrice->Fetch()) {
                            $prices[] = array(
                                'id' => $arProductPrice['CATALOG_GROUP_ID'],
                                'name' => $arProductPrice['CATALOG_GROUP_NAME'],
                                'price' => $arProductPrice['PRICE'],
                                'currency' => $arProductPrice['CURRENCY']
                            ); 
                        }   

                        //проверяем изображение
                        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$arElement['CODE'].'.jpg')) {$image = 'http://'.$_SERVER['SERVER_NAME'].'/upload/images/'.$arElement['CODE'].'.jpg';}
                        else if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$arElement['CODE'].'.JPG')) {$image = 'http://'.$_SERVER['SERVER_NAME'].'/upload/images/'.$arElement['CODE'].'.JPG';}
                            else {$image = '';}

                        //формируем конечный массив данных
                        $DATA = array(
                            'xml_id'=>$arElement['XML_ID'],
                            'name'=>$arElement['NAME'],
                            'code'=>$arElement['CODE'],
                            'section'=>$arSection['NAME'],
                            'image'=> $image,
                            'properties'=> array(
                                'oem' => $arElement['PROPERTY_UNC_VALUE'],
                                'firm' => CAutobodyWS::GetIblockElementName($arElement['PROPERTY_FIRM_VALUE']),
                                'country' => CAutobodyWS::GetIblockElementName($arElement['PROPERTY_COUNTRY_VALUE']),
                                'year' => $arElement['PROPERTY_SIZE_VALUE'],
                                'manufacturer_number' => $arElement['PROPERTY_WARRANTY_VALUE'],
                            ),
                            'amount' => $warehouses,
                            'prices' => $prices,
                            'error' => "",
                        ); 
                    }

                    else {
                        $DATA = array('error' => 'Товар не найден');  
                    }   
                }      
                else {
                    $DATA = array('error' => 'Недостаточно параметров для поиска!');  
                }   
            }       
            else {
                $DATA = array('error' => 'Неверный логин или пароль! Доступ запрещен.'); 

            }
            $DATA = json_encode($DATA);
            return $DATA;
        }     


        //функция для получения информации о заказе
        public function GetOrderInfo($login,$password,$id) {
            if (CAutobodyWS::Authorize($login,$password) == 'Y')  {
                if ($id > 0) {
                    //проверяем ID пользователя                      
                    $user = CUser::GetList("id", "desc",array("LOGIN"=>$login),array());
                    $arUser = $user->Fetch();
                    //получаем инфо о заказе
                    $order = CSaleOrder::GetList(Array(), array("ID"=>$id,/*"USER_ID"=>$arUser["ID"]*/));   
                    $arOrder = $order->Fetch();
                    if ($arOrder["ID"] > 0) {
                        $DATA = array('order'=>$arOrder,'error'=>'');
                    }
                    else {
                        $DATA = array('error'=>'Заказ не найден');
                    }
                }

                else {
                    $DATA = array('error' => 'Недостаточно параметров для поиска!');                             
                } 
            }   
            else {
                $DATA = array('error' => 'Неверный логин или пароль! Доступ запрещен.'); 
            }
            $DATA = json_encode($DATA);
            return $DATA;
        }   


    }   

    //в зависимости от $_REQUEST['method'], вызываем нужную функцию
    if ($_REQUEST['method']) { /*
        switch ($_REQUEST['method']) {
            case 'GetProductInfo': 
                $result = CAutobodyWS::GetProductInfo($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['code'],$_REQUEST['oem'],$_REQUEST['manufacturer_number']);
                break;

            case 'GetOrderInfo': 
                $result = CAutobodyWS::GetOrderInfo($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['id']);
                break;


        }


        echo $result;
           */
    }  










?>