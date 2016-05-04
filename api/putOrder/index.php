<?

include ("../apiCore.php");
include ("orderErrorHandler.php");

class AutoBodyOrder {

    private static $requiredFields = Array('items','warehouse','comments');

    /*****
     *
     * @param json $o
     * @return array or die with error
     *
     ******/

    private static function decodeOrder($o){
        if(empty($o) || !is_array(json_decode($o,true))){
            die(ApiErrorHandler::raiseError('unknownFilterFlag'));
        } else {
            return(json_decode($o,true));
        }
    }

    /*****
     *
     * @param array $i
     * @return int $totalSum
     *
     ******/

    private static function getTotalOrderPrice($i){
        $totalSum = 0;
        foreach ($i as $k=>$v) {
            $ar_res = GetCatalogProductPriceList(self::getItemIDByCode($k),array(),array());
            $rubValue = CCurrencyRates::ConvertCurrency($ar_res[0]['PRICE'], "USD", "RUB");
            $totalSum+= $rubValue*$v;
        }
        return $totalSum;
    }

    /*****
     *
     * @param string $c
     * @return int $rubValue
     *
     ******/

    private static function getPriceInRUBbyItemCode($c){
        $ar_res = GetCatalogProductPriceList(self::getItemIDByCode($c),array(),array());
        $rubValue = CCurrencyRates::ConvertCurrency($ar_res[0]['PRICE'], "USD", "RUB");
        return $rubValue;
    }

    /*****
     * Check $requiredFields are setted and items & warehouse filled
     *
     * @param array $o
     * @return void or error
     *
     ******/

    private static function orderKeys($o){
        foreach(self::$requiredFields as $k){ // cycle thru required keys
            if(array_key_exists($k, $o)){ // if key exists but it's value can be empty go to next step else ->
                if($k=='items' || $k=='warehouse'){
                    if(empty($o[$k])){ // -> check value for empty, if required value empty throw error
                        die(ApiErrorHandler::raiseError('insertDataProblem')); 
                    }
                }
            } else {
                die(ApiErrorHandler::raiseError('insertDataProblem'));
            }
        }
    }

    /*****
     *
     * @param string $c
     * @return int $fields['ID']
     *
     ******/

    private static function getItemIDByCode($c){
        $res = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>88,"=CODE"=>$c),false,false,array("ID"));
        if($ar_res = $res->GetNextElement()){
            $fields = $ar_res->getFields();
        }        
        return $fields['ID'];
    }

     /*****
     *
     * @param array $i
     * @return void or error
     *
     ******/

    private static function itemsValidate($i){
        foreach($i as $k=>$v){
            $res = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>88,"=CODE"=>$k),false,false,array('ID'));
            if(!($ar_res = $res->GetNextElement())){
                die(OrderErrorHandler::elementDoesNotExist($k));
            }
        }   
    }

     /*****
     *
     * @param array $i
     * @param int $w
     * @return void or error
     *
     ******/

    private static function itemsAvailability($i,$w){
        foreach($i as $k=>$v){       
            $quantity = CCatalogStoreProduct::GetList(array(),array('PRODUCT_ID'=>self::getItemIDByCode($k),'STORE_ID'=>$w), false, false, array());
            if($arQuantity = $quantity->Fetch()){
                if($v > $arQuantity['AMOUNT']){
                    die(OrderErrorHandler::warehouseQuantityError(self::getItemIDByCode($k),$v,$arQuantity['AMOUNT']));
                }      
            }
        }
    }

    /*****
     *
     * @param int $w
     * @return void or error
     *
     ******/

    private static function warehouseValidate($w){
        $res = CCatalogStore::GetList(Array(),Array('ACTIVE' => 'Y','=ID'=>$w),false,false,Array());
        if (!($arRes = $res->GetNext())){
            die(OrderErrorHandler::warehouseValidateError($w));
        }
    }

    /*****
     *
     * @param int $check
     * @param int $default
     * @return int 
     *
     ******/

    private static function validateOptionsValue($check,$default){
        if (preg_match('/\D/', $check) || empty($check)) {
            return $default;      
        } else {
            return $check;
        }
    }

     /*****
     *
     * @param string $l
     * @return array $defaultProperties
     *
     ******/

    private static function getOptions($l){
        $res = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>99,"=NAME"=>$l),false,false,array());
        if($ar_res = $res->GetNextElement()){
            $props = $ar_res->getProperties();
            $defaultProperties['Delivery'] = self::validateOptionsValue($props['DELIVERY']['VALUE'],489);
            $defaultProperties['PaySystem'] = self::validateOptionsValue($props['PAYMENT']['VALUE'],43);
        } else {
            $defaultProperties = Array('Delivery'=>489,'PaySystem'=>43);
        }
        return $defaultProperties;
    }

    /*****
     *
     * @param int $oid
     * @param array $i
     * @return void
     *
     ******/

    private static function makeBasket($oid,$i){
        $FUSER_ID = CSaleBasket::GetBasketUserID();
        foreach ($i as $k=>$v) {
            CSaleBasket::Add(
            array(
                'PRODUCT_ID' => self::getItemIDByCode($k),
                'PRICE' => self::getPriceInRUBbyItemCode($k),
                "DELAY" => "N",
                "CAN_BUY" => "Y",
                "QUANTITY" => $v,
                'LID' => 's1',
                "ORDER_ID" => $oid,
                "CURRENCY" => "RUR",
                'NAME' => ApiCore::GetIblockElementName(self::getItemIDByCode($k)),
                )
            );            
        }
        CSaleBasket::OrderBasket($oid,$FUSER_ID);
    }

    /*****
     *
     * @param float $s
     * @param int $uid
     * @param int $d
     * @param int $p
     * @return int $ORDER_ID
     *
     ******/

    private static function makeOrder($s,$uid,$d,$p,$w,$desc){
        $arFields = array(
            "LID" =>  's1',
            "PERSON_TYPE_ID" => 22,
            "PAYED" => "N",
            "CANCELED" => "N",
            "STATUS_ID" => "N",
            "PRICE" => $s,
            "CURRENCY" => "RUR",
            "USER_ID" => $uid,
            "PAY_SYSTEM_ID" => $p,
            "DELIVERY_ID" => $d,
            "ROOM_NUMBER" => $w,
            "USER_DESCRIPTION" => $desc,
        );
        $ORDER_ID = CSaleOrder::Add($arFields);

        $arFields = array(
            "ORDER_ID" => $ORDER_ID,
            "ORDER_PROPS_ID" => 149,
            "NAME" => "Количество мест",
            "CODE" => "ROOM_NUMBER",
            "VALUE" => $w
        );

        CSaleOrderPropsValue::Add($arFields);

        return $ORDER_ID;
    }

     /*****
     *
     * @param string $token
     * @param json $orderData
     * @return json $response
     *
     ******/

     public static function PutOrder($token,$orderData){
        $authResult = ApiCore::checkUserByToken($token);
        $orderArray = self::decodeOrder($orderData);
        self::orderKeys($orderArray);
        self::itemsValidate($orderArray['items']);
        self::warehouseValidate($orderArray['warehouse']);
        self::itemsAvailability($orderArray['items'],$orderArray['warehouse']);
        $defaultOptions = self::getOptions($authResult['LOGIN']);
        // -- this session var must be setted due to changes in /include/common.php GetSavedWarehouse
        $_SESSION["GKWH"] = $orderArray['warehouse']; 
        $orderID = self::makeOrder(self::getTotalOrderPrice($orderArray['items']),$authResult['ID'],$defaultOptions['Delivery'],$defaultOptions['PaySystem'],$orderArray['warehouse'],$orderArray['comments']);
        self::makeBasket($orderID,$orderArray['items']);
        $response = array("OrderID" => $orderID);
        $response = json_encode($response);
        echo $response;
    }

    
}

AutoBodyOrder::PutOrder($_REQUEST['token'],$_REQUEST['order']);
?>  