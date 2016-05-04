<?
namespace Autobody {
    use Bitrix;

    class SubscriptionMailer {

        private $userSubIB = 121;
        
        /**
         * 
         * Get unique users for this subscription round
         * 
         * @return array $result
         * 
         * */
        
        private function getUniqueUsers() {
            $result = Array();
            $db_list = \CIBlockElement::GetList(Array("PROPERTY_USER_ID" => "ASC"), Array("IBLOCK_ID" => $this -> userSubIB, "ACTIVE" => "Y"), Array("PROPERTY_USER_ID"));
            while($ar_result = $db_list->GetNext()) {
                array_push($result,$ar_result['PROPERTY_USER_ID_VALUE']);
            }
            return $result;
        }
        
        /**
         * 
         * Get human readable firm value
         * 
         * @param int $firm_id
         * @return string $arFirm['NAME']
         * 
         * */
        
        private function getFirmName($firm_id) {
            $dbFirm = \CIBlockElement::GetList(array(), array('ID' => $firm_id), false, false, array('NAME'));
            $arFirm = $dbFirm->Fetch();
            return $arFirm['NAME'];
        }
        
        /**
         * 
         * Get quntity for WH
         * 
         * @param int $product_id
         * @param int $wh_id
         * @return int $arStore['AMOUNT']
         * 
         * */
        
        private function getWareHouseQuantity($product_id, $wh_id) {
            $rsStore = \CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $product_id, 'STORE_ID' => $wh_id), false, false, array('AMOUNT')); 
            $arStore = $rsStore->Fetch();
            return $arStore['AMOUNT'];
        }
        
        /**
         * 
         * Get title for WH
         * 
         * @param int $wh_id
         * @return int $arWH['TITLE']
         * 
         * */
        
        private function getWareHouseTitle($wh_id) {
            $obWH = \CCatalogStore::GetList(array(), array("ID" => $wh_id), false, false, array());
            $arWH = $obWH -> Fetch();
            return $arWH['TITLE'];
        }
        
        /**
         * 
         * Get price for item
         * 
         * @param int $product_id
         * @return float|int $price
         * 
         * */
        
        private function getPrice($product_id) {
            $price = 0;
            $productPrice = \CPrice::GetList(array(),array('PRODUCT_ID' => $product_id, 'CATALOG_GROUP_ID' => 1), false, false, array());
            if ($arProductPrice = $productPrice->Fetch()) {
                $price = \CCurrencyRates::ConvertCurrency($arProductPrice['PRICE'], "USD", "RUB");
                $price = number_format($price, 2, '.', '');
            }   
            
            return $price;
        }
        
        /**
         * 
         * @param int $user_id
         * @return string $arUser['EMAIL']
         * 
         * */
        
        private function getUserMail($user_id){
            $rsUser = \CUser::GetByID($user_id);
            $arUser = $rsUser->Fetch();
            return $arUser['EMAIL'];
        }
        
        /**
         * 
         * If subscription for this el was successfully sended, then deactivate it 
         * 
         * @param int $itemID
         * @return void
         * 
         * */
        
        private function deactivateSubscriptionItem($itemID) {
            $el = new \CIBlockElement;
            $propArr = Array("ACTIVE" => "N");
            $el->Update($itemID, $propArr);
        }
        
        /**
         * 
         * Insert subscription data to mail template
         * 
         * @param array $subscriptionData
         * @return string $mailBody
         * 
         * */
        
        private function renderMailTemplate($subscriptionData){
            $mailBody = "";
            $mailBody = "<tbody>";
            foreach ($subscriptionData as $section => $data) {
                $mailBody .= <<<EOF
                    <tr>
                        <td colspan="6" style="font-weight:700;border-top:1px solid #00a3cb;border-left:1px solid #00a3cb;border-right:1px solid #00a3cb;border-bottom:1px solid #00a3cb;padding:15px;font-size:16px;cursor:pointer;">
                            {$section}
                        </td>
                    </tr>            
EOF;
                foreach ($data as $item) {
                    $mailBody .= <<<EOF
                        <tr>
                            <td style="border-top:1px solid #E6E6E6;border-left:1px solid #E6E6E6;font-size:11px;color:#808080;text-align:center;">
                                {$item["CODE"]}
                            </td>
                            <td style="border-top:1px solid #E6E6E6;border-left:1px solid #E6E6E6;font-size:11px;color:#808080;text-align:center;">
                                {$item["PROPERTY_UNC_VALUE"]}
                            </td>
                            <td style="border-top:1px solid #E6E6E6;border-left:1px solid #E6E6E6;font-size:11px;color:#808080;text-align:center;">
                                {$item["PROPERTY_SIZE_VALUE"]}
                            </td>
                            <td style="border-top:1px solid #E6E6E6;border-left:1px solid #E6E6E6;font-size:11px;color:#808080;padding-left:20px;">
                                <div>
                                    <a rel="nofollow" href="http://www.autobody.ru{$item["DETAIL_PAGE_URL"]}" title="{$item["NAME"]}" target="_blank">
                                        {$item["NAME"]}
                                    </a>
                                </div>
                                <div>
                                    {$item["WH_TITLE"]}, {$item["PROPERTY_WARRANTY_VALUE"]}
                                </div>
                            </td>
                            <td style="border-top:1px solid #E6E6E6;border-left:1px solid #E6E6E6;font-size:11px;color:#808080;text-align:center;">
                                {$item["WH_AMOUNT"]}
                            </td>
                            <td style="border-top:1px solid #E6E6E6;border-left:1px solid #E6E6E6;border-right:1px solid #E6E6E6;font-size:11px;color:#808080;text-align:center;">
                                {$item["PRICE"]}
                            </td>
                        </tr>            
EOF;
    }
}

            $mailBody .= "</tbody>";
            
            return $mailBody;
        }
        
        /**
         * Collect mail data for user
         * 
         * @param int $user_id
         * @return array $result
         * 
         * */
        
        private function collectDataForMail($user_id) {
            $prev_section_id = 0;
            $section_name = "";
            $result = Array();
            $nowAvaible = 0;
            $dbSubItems = \CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $this->userSubIB, "PROPERTY_USER_ID" => $user_id, "ACTIVE"=>"Y"), false, Array("nPageSize"=>9999), Array("NAME", "ID", "PROPERTY_QUANTITY_FOR_NOTIFICATION", "PROPERTY_WH_ID", "PROPERTY_USER_ID"));
            while($obSubItem = $dbSubItems->GetNextElement()) {
                $arSubItem = $obSubItem->GetFields();
                $dbItem = \CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => IntVal(88), "ACTIVE"=>"Y", "ID" => $arSubItem['NAME']), false, Array("nPageSize" => 1), Array('NAME', 'IBLOCK_SECTION_ID', 'CODE', 'ID', 'DETAIL_PAGE_URL', 'PROPERTY_WARRANTY', 'PROPERTY_COUNTRY', 'PROPERTY_FIRM', 'PROPERTY_UNC', 'PROPERTY_SIZE', 'SECTION_ID', 'PROPERTY_WARRANTY'));
                if($obItem = $dbItem->GetNextElement()) {
                    $arItem = $obItem->GetFields();
                    $nowAvaible = $this->getWareHouseQuantity($arItem['ID'], $arSubItem['PROPERTY_WH_ID_VALUE']);
                    // --- item extraction
                    if($nowAvaible > $arSubItem['PROPERTY_QUANTITY_FOR_NOTIFICATION_VALUE']) {
                        $arItem['PROPERTY_FIRM_VALUE'] = $this->getFirmName($arItem['PROPERTY_FIRM_VALUE']);
                        $arItem['WH_AMOUNT'] = $nowAvaible;
                        $arItem['WH_TITLE'] = $this->getWareHouseTitle($arSubItem['PROPERTY_WH_ID_VALUE']);
                        $arItem['PRICE'] = $this->getPrice($arItem['ID']); 
                        // --- result array construct
                        if($prev_section != $arItem['IBLOCK_SECTION_ID']){
                            $prev_section = $arItem['IBLOCK_SECTION_ID'];
                            $section = \CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->GetNext();
                            $section_name = $section['NAME'];
                            $result[$section_name] = Array();
                        }
                        array_push($result[$section_name],$arItem);
                        $this->deactivateSubscriptionItem($arSubItem['ID']);
                    }
                }
            }

            ksort($result);
            
            return $result;
        }

        /**
         * 
         * Sending
         * @return void
         * 
         * */

        public function send() {
            $uniqueUsers = Array();
            $subscriptionData = Array();
            $template = "";
            $uniqueUsers = $this -> getUniqueUsers();
            foreach ($uniqueUsers as $user) {
                if($subscriptionData = $this->collectDataForMail($user)){
                    $template = $this -> renderMailTemplate($subscriptionData);
                    
                    $arEventFields['MAIL_BODY'] = $template;
                    $arEventFields['SUB_EMAIL'] = $this->getUserMail($user);
                    \CEvent::Send("GOODS_SUB_NOTIFICATION", "s1", $arEventFields);
                }
            }
        }

    }
}
?>