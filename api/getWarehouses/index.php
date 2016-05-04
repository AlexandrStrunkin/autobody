<?

include ("../apiCore.php");

class AutoBodyWarehouses {

    static private $warehouses = Array();

     /*****
     *
     * @param string $token
     * @return json $response
     *
     ******/
     public static function GetWarehouses($token){
        $authResult = ApiCore::checkUserByToken($token);
        $arFilter = Array("ACTIVE"=>'Y');
        $arSelectFields = Array("ID","TITLE");
        $res = CCatalogStore::GetList(Array(),$arFilter,false,false,$arSelectFields);
        while ($arRes = $res->GetNext()){
            self::$warehouses[] = $arRes ;
        } 
        $response = array('warehouses' => self::$warehouses);
        $response = json_encode($response);
        echo $response;
    }
  
}

AutoBodyWarehouses::GetWarehouses($_REQUEST['token']);
?>  