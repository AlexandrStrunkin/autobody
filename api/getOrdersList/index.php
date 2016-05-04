<?
include ("../apiCore.php");

class AutoBodyOrderList{
    
    private static $responseOrderList = Array();
    
    /*******
     * 
     * @param string $c
     * @return string $c or die if error occured
     * 
     *********/
    
    private static function checkCountParam($c){
        if(!empty($c)){                
            if (preg_match('/\D/', $c)) {
                die(ApiErrorHandler::raiseError('unknownFilterFlag'));
            } else {
                return $c;
            }
        } else {
            return;
        } 
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
    
    /*******
     * 
     * @param string $token
     * @param string $count - optional
     * @return json $DATA
     * 
     *********/
    
    public static function GetOrdersList($token,$count){
        
        $authResult = ApiCore::checkUserByToken($token);   
        $arFilter = Array(
            "USER_ID" => $authResult['ID'],
        );          
        $arNavStartParams = Array('nTopCount'=>self::checkCountParam($count));
        
        $rsSales = CSaleOrder::GetList(array(), $arFilter,false,$arNavStartParams);
        while ($arSales = $rsSales->Fetch()){
            self::$responseOrderList[] = array(
                'order_id' => $arSales['ID'],
                'payed' => $arSales['PAYED'],
                'canceled' => $arSales['CANCELED'],
                'price' => $arSales['PRICE'],
                'currency' => $arSales['CURRENCY'],
                'price_delivery' => $arSales['PRICE_DELIVERY'],
                'create_date' => $arSales['DATE_INSERT'],
                'user_comment' => $arSales['USER_DESCRIPTION'],
                'tracking_number' => $arSales['TRACKING_NUMBER'],
                'delivery_type' => self::getDeliverySystems($arSales['DELIVERY_ID']),
                'payment_system' => self::getPaymentSystems($arSales['PAY_SYSTEM_ID']),
                'items_in_order' => self::getItemsInOrder($arSales['ID']),
            );;
        }
        
        $DATA = self::$responseOrderList;
        $DATA = json_encode($DATA);
        echo $DATA;
        
    }
}

    AutoBodyOrderList::GetOrdersList($_REQUEST['token'], $_REQUEST['count']);

?>