<?

include ("../apiCore.php");

class AutoBodyOrder {

    /*****
     *
     * @param string $st
     * @return void or die with error
     *
     ******/

    private static function checkStatus($st) {
        if ($st != "Y") {
            die(ApiErrorHandler::raiseError('unknownFilterFlag'));
        }
    }

    /*****
     *
     * @param string $i
     * @return void or die with error
     *
     ******/

    private static function checkID($i) {
        if (preg_match('/\D/', $i) || empty($i)) {
            die(ApiErrorHandler::raiseError('unknownFilterFlag'));
        }
    }
    
    /*****
     *
     * @param string $id
     * @return array $arOrder or die with error
     *
     ******/

    private static function getOrder($id) {
        $order = CSaleOrder::GetList(Array(), array("ID" => $id));
        $arOrder = $order -> Fetch();
        if (gettype($arOrder) == 'array') {
            return $arOrder;
        } else {
            die(ApiErrorHandler::raiseError('notFound'));
        }
    }
    
    /*****
     *
     * @return array
     *
     ******/

    private static function getOrderStatuses() {
        $statuses = CSaleStatus::GetList(array(), array("LID" => 'ru'), false, false, array());
        $a = array();
        while ($arStatus = $statuses -> Fetch()) {
            $a[$arStatus['ID']] = $arStatus['DESCRIPTION'];
        }

        return $a;
    }
    
    /*****
     *
     * @param string $i
     * @return string $ar_dtype['NAME'] or string if error occured
     *
     ******/
    
    private static function getDeliverySystems($i){
        $db_dtype = CSaleDelivery::GetList(array(),array(),false,false,array());
        while ($ar_dtype = $db_dtype->Fetch()){
            if($ar_dtype['ID']==$i){
                return $ar_dtype['NAME'];
            }
        }
        
        return 'Служба доставки не установлена.';
    }
    
    /*****
     *
     * @param string $i
     * @return string $ptype['NAME'] or string if error occured
     *
     ******/
    
    private static function getPaymentSystems($i){
        $db_ptype = CSalePaySystem::GetList($arOrder = Array(), Array());
        while ($ptype = $db_ptype->Fetch()){
            if($ptype['ID']==$i){
                return $ptype['NAME'];
            }
        }      
        return 'Система оплаты не установлена.';
    }
    
    /*****
     *
     * @param string $id
     * @return array $items
     *
     ******/
    
    private static function getItemsInOrder($id){
        $items = array();
        $dbItemsInOrder = CSaleBasket::GetList(array(), array("ORDER_ID" => $id),false,false,array());
        while ($arItems = $dbItemsInOrder->Fetch()){
            $items[]=array(
                'item_id' => $arItems['PRODUCT_ID'],
                'item_name' => $arItems['NAME'],
                'price' => CCurrencyRates::ConvertCurrency($arItems['PRICE'], "USD", "RUB"),
                'currency' => "RUB",
                'quantity' => $arItems['QUANTITY'],
            );
        } 
        
        return $items;     
    }

    /*****
     *
     * @param string $token
     * @param string $id
     * @param string $onlyStatus - optional
     * @return json $DATA
     *
     ******/

    public function GetOrderInfo($token, $id, $onlyStatus) {
        self::checkID($id);
        $authResult = ApiCore::checkUserByToken($token);
        $order = self::getOrder($id);
        if (empty($onlyStatus)) {
            $DATA = array(
                'order_id' => $order['ID'],
                'payed' => $order['PAYED'],
                'canceled' => $order['CANCELED'],
                'price' => $order['PRICE'],
                'currency' => $order['CURRENCY'],
                'price_delivery' => $order['PRICE_DELIVERY'],
                'create_date' => $order['DATE_INSERT'],
                'user_comment' => $order['USER_DESCRIPTION'],
                'tracking_number' => $order['TRACKING_NUMBER'],
                'delivery_type' => self::getDeliverySystems($order['DELIVERY_ID']),
                'payment_system' => self::getPaymentSystems($order['PAY_SYSTEM_ID']),
                'items_in_order' => self::getItemsInOrder($id),
            );
            
            $DATA = json_encode($DATA);
            echo $DATA; 
        } else {
            self::checkStatus($onlyStatus);
            $statuses = self::getOrderStatuses();
            $statusResponse = array('orderStatus' => $statuses[$order['STATUS_ID']]);
            $statusResponse = json_encode($statusResponse);
            echo $statusResponse;
        }
    }

}

AutoBodyOrder::GetOrderInfo($_REQUEST['token'], $_REQUEST['id'], $_REQUEST['onlyStatus']);
?>  