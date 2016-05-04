<?
class OrderErrorHandler{

     /*****
     *
     * @param int $itemId
     * @param int $qFromOrder
     * @param int $qAvailable
     * @echo json $errorResponse
     *
     ******/

    public static function warehouseQuantityError($itemId,$qFromOrder,$qAvailable){
        $name = ApiCore::GetIblockElementName($itemId);
        $errorResponse = json_encode(Array('error' => 'Недостаточно товара '.$name.' на выбранном вами складе. (Вами было заказано '.$qFromOrder.' , доступно на данный момент '.$qAvailable.' )'));
        echo $errorResponse;
    }

     /*****
     *
     * @param string $c
     * @echo json $errorResponse
     *
     ******/

    public static function elementDoesNotExist($c){
        $errorResponse = json_encode(Array('error' => 'Элемента с кодом '.$c.' не существует.'));
        echo $errorResponse;
    }

     /*****
     *
     * @param int $w
     * @echo json $errorResponse
     *
     ******/

    public static function warehouseValidateError($i){
        $errorResponse = json_encode(Array('error' => 'Склада с ID='.$i.' не существует.'));
        echo $errorResponse;
    }
}
?>