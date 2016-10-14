<?

include ("../apiCore.php");

class AutoBodyCatalog {

	const CACHE_TIME_LIMIT = 18000;
	const CACHE_PREFIX = "getSections";
    
    public static $currentSection;
    public static $sectionXML;
   
     /*****
     *
     * @param string $token
     * @return json $DATA
     *
     ******/
     
     public static function GetSections($token){
        $authResult = ApiCore::checkUserByToken($token);
		$cache = new CPHPCache();
		// проверяем кеш на наличие сохраненного результата 
		if ($cache->InitCache(self::CACHE_TIME_LIMIT, self::CACHE_PREFIX, ApiCore::$api_cache_path)) {
		    $data = $cache->GetVars();
			echo $data['result'];
		    return false;
		} elseif ($cache->StartDataCache()) {
	        $arSelect = Array('NAME','ID','IBLOCK_SECTION_ID','EXTERNAL_ID');
	        $arFilter = array("IBLOCK_ID"=>88);
	        $res = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter, false, $arSelect);
	        while($ob = $res->GetNextElement()){
	            $arFields = $ob->GetFields();              
	                                  
	             $DATA[] = array(
	                'name'=>$arFields['NAME'],
	                'sectionCode'=>$arFields['ID'],
	                'parentCode'=>$arFields['IBLOCK_SECTION_ID'],
	                'section_XML_ID'=>$arFields['EXTERNAL_ID']                 
	            );
	        }
            $statusResponse = array('sections' => $DATA);
            $statusResponse = json_encode($statusResponse);
			
			$cache->EndDataCache(array("result" => $statusResponse)); // записываем в кеш
			
            echo $statusResponse;
		}
     }
}

AutoBodyCatalog::GetSections($_REQUEST['token']);
?>  