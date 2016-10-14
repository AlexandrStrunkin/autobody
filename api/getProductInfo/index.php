<?
include("../apiCore.php");        

class AutoBodyProduct{
    
    const CACHE_TIME_LIMIT = 18000;
	const CACHE_PREFIX = "getProduct_";
	
    /*********
     * 
     *@param string $s
     *@return string
     * 
     **********/
    
    private static function stripSymbols($s){
        $pattern = "/(\W)/";
        return preg_replace($pattern,"",$s);
    }
    
    /*********
     * 
     *@param string $s
     *@return void or string if error occured
     * 
     **********/
    
    private static function cyrillicSymbolsValidator($s){
        $pattern = "/[а-яА-Я]/u";
        if(preg_match($pattern,$s)){
            die(ApiErrorHandler::raiseError('notFound'));  
        }
    }
    
       
    /*********
     * Extract item from base
     * 
     *@param string $code,$oem,$manufacturer_number
     *@return json $DATA or string if error occured
     * 
     **********/    
    private static function getItem($item){
        $search_item = self::stripSymbols($item);
        $arFilter = array('IBLOCK_ID'=>88,'ACTIVE'=>'Y',
            array(
                "LOGIC" => "OR",
                array("PROPERTY_SEARCH_CODE" => $search_item),
                array("%PROPERTY_SEARCH_UNC" => $search_item),
                array("PROPERTY_CROSS_NUM" => "%".$item."%"),
                array("PROPERTY_SEARCH_WARRANTY" => $search_item),
            ),
        );
        //add search statistics
        ApiCore::addSearchStat($search_item);

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
            $DATA = array(
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
            
            return $DATA; 
        } else {        
            die(ApiErrorHandler::raiseError('notFound'));  
               }
    }

    /*****
    * 
    * @param string $token
    * @param string $code,$oem,$manufacturer_number
    * @return $DATA in JSON 
    * 
    ******/   
          
    public static function GetProductInfo($token,$item){
        //---- if insert data are empty then throw error and exit
        if(empty($item)){
            die(ApiErrorHandler::raiseError('insertDataProblem'));  
        }

        self::cyrillicSymbolsValidator($item);

        // --- check auth, if user with this token doesn't exist then throw error and exit
        $authResult = ApiCore::checkUserByToken($token);
		$cache = new CPHPCache();
		// проверяем кеш на наличие сохраненного результата 
		if ($cache->InitCache(self::CACHE_TIME_LIMIT, self::CACHE_PREFIX . $item, ApiCore::$api_cache_path)) {
		    $data = $cache->GetVars();
			echo $data['result'];
		    return false;
		} elseif ($cache->StartDataCache()) {
	        $element = self::getItem($item); 
	        if(gettype($element)=='array'){
	            $element = json_encode($element);
				
				$cache->EndDataCache(array("result" => $element)); // записываем в кеш
				
	            echo $element;
	        } else {
	            die(ApiErrorHandler::raiseError('notFound'));  
	        }
		}
    }  
}
    //---- call API GetProductInfo method
    AutoBodyProduct::GetProductInfo($_REQUEST['token'],$_REQUEST['item']);
 ?>