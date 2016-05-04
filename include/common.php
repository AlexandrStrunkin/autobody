<?

    class GKCommon{

        public static function GetSavedWarehouse(){
            if($_SESSION["GKWH"]) return intval($_SESSION["GKWH"]);
            else{     /*
                $wh = GKCommon::GetWarehouses();
                $whitem = array_pop($wh);
                $_SESSION["GKWH"] = $whitem["ID"];
                return $whitem["ID"];    */
             //  $_SESSION["GKWH"] = 1; return intval($_SESSION["GKWH"]);
             header("location: /");
            }
        }

        public static function SaveWarehouse(){
            if(intval($_GET["mywarehouse"])){
                $_SESSION["GKWH"] = intval($_GET["mywarehouse"]);
                $url = substr($_SERVER["REQUEST_URI"],0,strlen($_SERVER["REQUEST_URI"])-14);

                //убираем из урла добавление в корзину
                $new_url = explode("&",$url);
                foreach ($new_url as $id=>$elem) {
                    if (strpos($elem,"add_basket_item")) {
                        $new_url[$id] = str_replace("action=add_basket_item","",$elem);
                    }
                    /*
                    if (strpos($elem,"quantity")) {
                    unset($new_url[$id]);
                    }
                    if (strpos($elem,"id")) {
                    unset($new_url[$id]);
                    }

                    if (strpos($elem,"page")) {
                    unset($new_url[$id]);
                    }    */  
                }
                if (!strpos($url,"clear_cache")) {
                    $url = implode("&",$new_url);
                    if (strpos($url,"?")) {
                        $s = "&";
                    }
                    else {$s = "?";}
                    $url = $url.$s."clear_cache=Y";
                }
                //  echo $url;
                //  die();

                //обнуляем корзину пользователя
                $_SESSION['OSG']['USER']['BASKET'] = array();
                $_SESSION['OSG']['USER']['BASKET']['TOTAL_QUANTITY'] = 0;
                $_SESSION['OSG']['USER']['BASKET']['TOTAL_PRICE'] = 0;
                CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());

                //редирект на страницу, с которой пришли, но в урле не таскаем за собой склад
                header("Location:".$url);
            }

        }

        public static function GetWarehouses(){
            global $DB;
            $return = Array();
            $query = "select * from _warehouses order by id asc";
            $res = $DB->Query($query);
            while($row = $res->Fetch()){
                $nameArr = explode("[", $row["name"]);
                $return[] = Array(
                    "ID" => $row["id"],
                    "TITLE" => $nameArr[0],
                    "ADDRESS" => $row["name"]
                );
            }
            return $return;
        }


        public static function GetWarehouseByID($ID){
            global $DB;
            $query = "select * from `_warehouses` where `id`=".$ID;
            $res = $DB->Query($query);
            if($row = $res->Fetch()){
                $nameArr = explode("[", $row["name"]);
                return $nameArr[0];
            }
            else return "-";
        }
        
         public static function GetWarehouseDataByID(){
            global $DB;
            $return = Array();
            $query = "select * from _warehouses order by id asc";
            $res = $DB->Query($query);
            while($row = $res->Fetch()){
                $nameArr = explode("[", $row["name"]);
                $return[] = Array(
                    "name" =>  $row
                );
            }
            return $return;
        }
        
        public static function GetItemsCountForWarehouse($id_warehouse, $vendor){
            global $DB;
            $query = "select `count` from `_items` where `vendor`='".trim($vendor)."' and `id_warehouse`=".$id_warehouse." order by `id` desc limit 1";
            $res = $DB->Query($query);
            if($row = $res->Fetch()){
                $return = Array(
                    "WH" => 1,
                    "COUNT" => $row["count"]
                );
            }else{
                $return = Array(
                    "WH" => 1,
                    "COUNT" => 0
                );

            }
            return $return;
        }

        public static function GetItemsCount($vendor){
            global $DB;
            $return = Array();
            $myWH = GKCommon::GetSavedWarehouse();
            if($myWH){
                $query = "select `count` from `_items` where `vendor`='".trim($vendor)."' and `id_warehouse`=".$myWH;
                $res = $DB->Query($query);
                if($row = $res->Fetch()){
                    $return = Array(
                        "WH" => 1,
                        "COUNT" => $row["count"]
                    );
                }else{
                    $query = "select * from `_items` where `vendor`='".trim($vendor)."'";
                    $res = $DB->Query($query);
                    $count = 0;
                    while($row = $res->Fetch()){
                        $count += $row["count"];
                    }

                    if($count){
                        $return = Array(
                            "WH" => 2,
                            "COUNT" => $count
                        );
                    }else{
                        $return = Array(
                            "WH" => 0,
                            "COUNT" => 0
                        );
                    }
                }
            }else{
                $query = "select * from `_items` where `vendor`='".trim($vendor)."'";
                $res = $DB->Query($query);
                $count = 0;
                while($row = $res->Fetch()){
                    $count += $row["count"];
                }

                if($count){
                    $return = Array(
                        "WH" => 2,
                        "COUNT" => $count
                    );
                }else{
                    $return = Array(
                        "WH" => 0,
                        "COUNT" => 0
                    );
                }
            }

            return $return;
        }


        public static function GetItemInfo($vendor){
            global $DB;
            $query = "select * from `_items` where `vendor`='".trim($vendor)."' and `id_warehouse`='".$_SESSION["GKWH"]."' ";
            $res = $DB->Query($query);
            if($row = $res->Fetch()){
                $return = $row;
            }
            else {
                $return = "";
            }

            return $return;
        }
        
        
          public static function GetItemInfoByWh($vendor,$WH){
            global $DB;
            $query = "select * from `_items` where `vendor`='".trim($vendor)."' and `id_warehouse`='".$WH."' ";
            $res = $DB->Query($query);
            if($row = $res->Fetch()){
                $return = $row;
            }
            else {
                $return = "";
            }

            return $return;
        }

        public static function GetLastUpdateDate(){
            global $DB;
            $query = "select `last_update` from `_items` order by `id` desc limit 0,1";
            $res = $DB->Query($query);
            if($row = $res->Fetch()){
                $return = $row["last_update"];
            }
            else {
                $return = "";
            }

            return $return;
        }




    }
?>