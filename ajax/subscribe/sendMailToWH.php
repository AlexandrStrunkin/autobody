<?
namespace Autobody {
    use Bitrix;

    class SubscriptionMailerWH {

        private $whID;
        private $userID;
        private $itemID;
        private $mailFields = Array();

        public function __construct($itemID, $quantity, $whID, $userID) {
            $this -> mailFields['ITEM_QUANTITY'] = $quantity;
            $this -> whID = $whID;
            $this -> itemID = $itemID;
            $this -> userID = $userID;
        }

        /**
         * Get item data
         *
         * @return void
         *
         * */

        private function getItemData() {
            $dbItem = \CIBlockElement::GetByID($this -> itemID);
            $arItem = $dbItem -> GetNext();
            $this -> mailFields['ITEM_NAME'] = $arItem['NAME'];
            $this -> mailFields['ITEM_CODE'] = $arItem['CODE'];
        }

        /**
         *
         * Get warehouse data
         * @return void
         *
         * */

        private function getWHData() {
            $obWH = \CCatalogStore::GetList(array(), array("ID" => $this -> whID), false, false, array());
            $arWH = $obWH -> Fetch();
            $this->mailFields['SUB_EMAIL'] = $arWH['EMAIL'];
            $this -> mailFields['WAREHOUSE'] = $arWH['TITLE'];
        }

        /**
         * Get user data
         * @return void
         * */

        private function getUserData() {
            $rsUser = \CUser::GetByID($this -> userID);
            $arUser = $rsUser -> Fetch();
            $this -> mailFields['USER_LOGIN'] = $arUser['LOGIN'];
            $this -> mailFields['USER_NAME'] = $arUser['LAST_NAME'] . " " . $arUser['NAME'];
        }

        /**
         * Sending
         *
         * @return void
         *
         * */

        public function send() {
            $this -> getWHData();
            $this -> getUserData();
            $this -> getItemData();
            \CEvent::Send("GOODS_SUB_NOTIFICATION_FOR_WH", "s1", $this -> mailFields);
        }

    }

}
?>