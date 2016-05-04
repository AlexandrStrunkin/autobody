<?
    include("../apiCore.php");        

    class AutoBodyProduct{

        static private $allowedParams = Array(  'name'=>'NAME',
            'code'=>'CODE',
            'oem'=>'PROPERTY_UNC_VALUE',
            'firm'=>'PROPERTY_FIRM.NAME',
            'price'=>'catalog_PRICE_1'
        );
        /*********
        *  
        * @param string $p
        * @return void or string if error occured
        * 
        **********/    

        private static function validateOrderParam($p){
            if(!array_key_exists($p,self::$allowedParams)){
                die(ApiErrorHandler::raiseError('unknownFilterFlag'));
            }
        }

        /*********
        *  
        * @param string $d
        * @return void or string if error occured
        * 
        **********/    

        private static function validateDirectionParam($d){
            if(!preg_match("/^(asc|desc)$/i", $d)){
                die(ApiErrorHandler::raiseError('unknownFilterFlag'));
            }
        }

        /*********
        *  
        * @param string $q
        * @return void or string if error occured
        * 
        **********/    

        private static function validateQuantityParam($q){
            if(!preg_match("/^(all|\d+)$/", $q)){
                die(ApiErrorHandler::raiseError('unknownFilterFlag'));
            }
        }

        /*********
        * Extract item from base
        * 
        * @param string $code,$oem,$manufacturer_number
        * @param array $fa
        * @return json $DATA or string if error occured
        * 
        **********/    
        private static function getItem($itemName,$q,$op,$d){

            if($op && $d){
                $arOrder =  array(self::$allowedParams[$op]=>strtoupper($d)); 
            } else {
                $arOrder = array();
            }

            if($q=="all"){
                $q = 30000;
            }

            $patternForNonWord = "/([^a-zA-Z\sа-яА-Я0-9])/u";
            $patternForMultWhitespace = "/(\s{2,})/u";
            $patternForSearch = "/(\s{1,})/u";

            $itemName = preg_replace($patternForNonWord,"",$itemName);
            $itemName = preg_replace($patternForMultWhitespace," ",$itemName);
            $itemName = preg_replace($patternForSearch," && ",$itemName); // --- данная замена всех пробелов на && позволяет сделать поиск независимым от порядка слов

            $arFilter = array('IBLOCK_ID'=>88,'ACTIVE'=>'Y','?NAME'=>$itemName);
            $arSelect = array('NAME','CODE','ID','PROPERTY_COUNTRY','PROPERTY_FIRM','PROPERTY_UNC','PROPERTY_SIZE' ,'SECTION_ID','PROPERTY_WARRANTY','XML_ID');
            $element = CIBlockElement::GetList($arOrder,$arFilter,false,Array("nTopCount"=>$q), $arSelect);

            //add search statistics
            ApiCore::addSearchStat($search_item);

            while($arElement = $element->Fetch()) {
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
                        'price' => CCurrencyRates::ConvertCurrency($arProductPrice['PRICE'], "USD", "RUB"),
                        'currency' => 'RUB'
                    ); 
                }   

                //проверяем изображение
                if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$arElement['CODE'].'.jpg')) {
                    $image = 'http://'.$_SERVER['SERVER_NAME'].'/upload/images/'.$arElement['CODE'].'.jpg';
                } else if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$arElement['CODE'].'.JPG')) {
                    $image = 'http://'.$_SERVER['SERVER_NAME'].'/upload/images/'.$arElement['CODE'].'.JPG';
                } else {
                    $image = '';
                }

                //формируем конечный массив данных
                $DATA[] = array(
                    'xml_id'=>$arElement['XML_ID'],
                    'name'=>$arElement['NAME'],
                    'code'=>$arElement['CODE'],
                    'section'=>$arSection['NAME'],
                    'image'=> $image,
                    'properties'=> array(
                        'oem' => $arElement['PROPERTY_UNC_VALUE'],
                        'firm' => ApiCore::GetIblockElementName($arElement['PROPERTY_FIRM_VALUE']),
                        'country' => ApiCore::GetIblockElementName($arElement['PROPERTY_COUNTRY_VALUE']),
                        'year' => $arElement['PROPERTY_SIZE_VALUE'],
                        'manufacturer_number' => $arElement['PROPERTY_WARRANTY_VALUE'],
                    ),
                    'amount' => $warehouses,
                    'prices' => $prices,
                );

            } 

            if(empty($DATA)){
                die(ApiErrorHandler::raiseError('notFound'));
            }
            return $DATA;
        }

        /*****
        * 
        * @param string $token
        * @param string $code,$oem,$manufacturer_number
        * @return $DATA in JSON 
        * 
        ******/   

        public static function GetProductInfo($token,$itemName,$quantity,$ord_param,$dir){

            //---- if insert data are empty then throw error and exit
            if(empty($itemName)){
                die(ApiErrorHandler::raiseError('insertDataProblem'));  
            }

            // --- check auth, if user with this token doesn't exist then throw error and exit
            $authResult = ApiCore::checkUserByToken($token);

            self::validateQuantityParam($quantity);

            if(!empty($ord_param) && !empty($dir)){
                // --- checking order parameter
                self::validateOrderParam($ord_param);
                // --- checking direction parameter
                self::validateDirectionParam($dir);

                $element = self::getItem($itemName,$quantity,$ord_param,$dir); 

            } else {

                $element = self::getItem($itemName,$quantity); 

            }   

            if(gettype($element)=='array'){
                $element = json_encode($element);
                echo $element;
            } else {
                die(ApiErrorHandler::raiseError('notFound'));  
            }  
        }  
    }
    //---- call API GetProductInfo method
    AutoBodyProduct::GetProductInfo($_REQUEST['token'],$_REQUEST['name'],$_REQUEST['quantity'],$_REQUEST['ord_param'],$_REQUEST['dir']);
?>