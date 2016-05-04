<?

include ("../apiCore.php");

class AutoBodyCatalog {
    
    public static $currentSection;
    public static $currentSectionName;
    public static $sectionXML;

    /*****
     *
     * @param string $s
     * @return json error or void
     *
     ******/
     
     private static function sectionCodeCheck($s){
        if (preg_match('/\D/', $s) && !empty($s)) {
            die(ApiErrorHandler::raiseError('unknownFilterFlag'));
        } else if(!empty($s)){
            return Array('IBLOCK_ID'=>88,"SECTION_ID"=>$s,"ACTIVE"=>"Y");
        } else{
             return Array('IBLOCK_ID'=>88,"ACTIVE"=>"Y");
        }
     }
     
     /*****
     *
     * @param string $token
     * @param string $section_code - optional
     * @return json $DATA
     *
     ******/
     
     public static function GetCatalog($token,$section_code){
        $authResult = ApiCore::checkUserByToken($token); 
        $arSelect = Array('NAME','CODE','ID','IBLOCK_SECTION_ID','PROPERTY_COUNTRY','PROPERTY_FIRM','PROPERTY_UNC','PROPERTY_SIZE' ,'SECTION_ID','PROPERTY_WARRANTY','XML_ID');
        $arFilter = self::sectionCodeCheck($section_code);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=>30000), $arSelect);
        while($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            
            if(self::$currentSection!=$arFields['IBLOCK_SECTION_ID']){
                self::$currentSection = $arFields['IBLOCK_SECTION_ID'];
                $sectID = CIBlockSection::GetByID(self::$currentSection);
                if($ar_res = $sectID->GetNext()){
                    self::$sectionXML = $ar_res['EXTERNAL_ID'];
                    self::$currentSectionName = $ar_res['NAME'];
                }
            }
            
            //собираем количество товара на складе
            $warehouses = array();
            $quantity = CCatalogStoreProduct::GetList(array(),array('PRODUCT_ID'=>$arFields['ID']), false, false, array());
            while($arQuantity = $quantity->Fetch()){
                $warehouses[] = array(
                    'id'=>$arQuantity['STORE_ID'],
                    'name'=>$arQuantity['STORE_NAME'],
                    'quantity'=>$arQuantity['AMOUNT'], 
                );  
            }
            
            //собираем цены
            $prices = array();
            $productPrice = CPrice::GetList(array(),array('PRODUCT_ID'=>$arFields['ID']), false, false, array());
            while($arProductPrice = $productPrice->Fetch()) {
                $prices[] = array(
                    'id' => $arProductPrice['CATALOG_GROUP_ID'],
                    'name' => $arProductPrice['CATALOG_GROUP_NAME'],
                    'price' => CCurrencyRates::ConvertCurrency($arProductPrice['PRICE'], "USD", "RUB"),
                    'currency' => 'RUB',
                ); 
            }     
            
            //проверяем изображение
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$arFields['CODE'].'.jpg')) {
                $image = 'http://'.$_SERVER['SERVER_NAME'].'/upload/images/'.$arFields['CODE'].'.jpg';
            } else if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$arFields['CODE'].'.JPG')) {
                $image = 'http://'.$_SERVER['SERVER_NAME'].'/upload/images/'.$arFields['CODE'].'.JPG';
            } else {
                $image = '';
            }
            
             $DATA[] = array(
                'xml_id'=>$arFields['XML_ID'],
                'name'=>$arFields['NAME'],
                'code'=>$arFields['CODE'],
                'section'=>self::$currentSectionName,
                'section_XML_ID'=>self::$sectionXML,
                'image'=> $image,
                'properties'=> array(
                    'oem' => $arFields['PROPERTY_UNC_VALUE'],
                    'firm' => ApiCore::GetIblockElementName($arFields['PROPERTY_FIRM_VALUE']),
                    'country' => ApiCore::GetIblockElementName($arFields['PROPERTY_COUNTRY_VALUE']),
                    'year' => $arFields['PROPERTY_SIZE_VALUE'],
                    'manufacturer_number' => $arFields['PROPERTY_WARRANTY_VALUE'],
                 ),
                 'amount' => $warehouses,
                 'prices' => $prices,
            );
        }
            $statusResponse = array('elements' => $DATA);
            $statusResponse = json_encode($statusResponse);
            echo $statusResponse;
     }

    
}

AutoBodyCatalog::GetCatalog($_REQUEST['token'], $_REQUEST['section_code']);
?>  