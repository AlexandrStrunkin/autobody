<?
namespace Autobody {
    use Bitrix;

    class Subscribe {

        // ---- Iblock for user's mails used in sub form
        // @deprecated
        private $userMailsIB = 120;
        // ---- Iblock for user's subscriptions
        private $userSubIB = 121;
        // ---- subcribed phrase
        private $subPhrase = "Вы уже подписаны на данный товар";

        /**
         *
         * Explode stored emails list to array by ; as delimiter
         *
         * @param string $mailListWithGlue
         * @return array
         * @deprecated
         *
         * */

        private function getMailArrayFromString($mailListWithGlue) {
            return explode(";", $mailListWithGlue);
        }

        /**
         *
         * @param int $userID
         * @return array $userData or void
         * @deprecated
         *
         * */

        private function isUserHasSavedMails($userID) {
            $arFilter = array('IBLOCK_ID' => $this -> userMailsIB, 'ACTIVE' => 'Y', "NAME" => $userID);
            $arSelect = array('ID', 'NAME', "PROPERTY_MAIL_LIST");
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($userData = $res -> Fetch()) {
                return $userData;
            }
        }

        /**
         *
         * @param int $userID
         * @param string $newMail
         * @return string
         * @deprecated
         * */

        private function createNewMailList($userID, $newMail) {
            $newMailList = new \CIBlockElement;

            $PROP = array();
            $PROP[467] = $newMail;

            $arLoadArray = Array("IBLOCK_SECTION_ID" => false, "IBLOCK_ID" => $this -> userMailsIB, "PROPERTY_VALUES" => $PROP, "NAME" => $userID);

            if ($newMailList -> Add($arLoadArray)) {
                echo "New mail list created";
            }
        }

        /**
         *
         * @param int $relationID
         * @param int $userID
         * @param string $gluedString
         * @param string $newMail
         * @return void
         * @deprecated
         * */

        private function updateUserMailList($relationID, $userID, $gluedString, $newMail) {
            $userMailList = $this -> getMailArrayFromString($gluedString);
            array_push($userMailList, $newMail);
            \CIBlockElement::SetPropertyValuesEx($relationID, false, array("MAIL_LIST" => implode(";", $userMailList)));
        }

        /**
         *
         * Check is user subscribed already
         *
         * @param int $itemID
         * @param int $userID
         * @param int $warehouseID
         * @return bool
         *
         * */

        public function isAlreadySubscribed($itemID, $userID, $warehouseID) {
            $arFilter = array('IBLOCK_ID' => $this -> userSubIB, 'ACTIVE' => 'Y', "NAME" => $itemID, "PROPERTY_USER_ID" => $userID, "PROPERTY_WH_ID" => $warehouseID);
            $arSelect = array('NAME');
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($res -> Fetch()) {
                return true;
            }
        }

        /**
         *
         * Collect all user's mails for datalist
         *
         * @param int $userID
         * @return array $userMailList
         * @deprecated
         * */

        public function getUserMailList($userID) {
            $userMailList = array();
            // --- by default mail will be taken from users settings
            $rsUser = \CUser::GetByID($userID);
            $arUser = $rsUser -> Fetch();
            $mailByDefault = $arUser['EMAIL'];
            // --- check for previously saved mails
            if ($userData = $this -> isUserHasSavedMails($userID)) {
                $userMailList = $this -> getMailArrayFromString($userData['PROPERTY_MAIL_LIST_VALUE']);
                // --- if default mail don't saved to mail list add it to avaliable variants
                !in_array($mailByDefault, $userMailList) ? array_push($userMailList, $mailByDefault) : false;
            } else {
                array_push($userMailList, $mailByDefault);
            }
            return $userMailList;
        }

        /**
         *
         * @return string
         *
         * */

        public function renderSubscribedPhrase() {
            echo $this -> subPhrase;
        }

        /**
         *
         * Add new email to saved emails
         *
         * @param string $mail
         * @param int $userID
         * @deprecated
         * */

        private function manageStoredMail($mail, $userID) {
            $currentMailList = $this -> getUserMailList($userID);
            if (!in_array($mail, $currentMailList)) {
                if ($userData = $this -> isUserHasSavedMails($userID)) {
                    // --- update
                    $this -> updateUserMailList($userData['ID'], $userID, $userData['PROPERTY_MAIL_LIST_VALUE'], $mail);
                } else {
                    // --- create
                    $this -> createNewMailList($userID, $mail);
                }
            }
        }

        /**
         *
         * Add new subscription
         *
         * @param int $itemID
         * @param int $userID
         * @param string $mail
         * @param int $quantity
         * @param int $warehouse
         * @return bool
         *
         * */

        public function addNewSubscription($itemID, $userID, $quantity, $warehouse) {

            $newSub = new \CIBlockElement;

            $PROP = array();
            $PROP[469] = $quantity;
            $PROP[470] = $warehouse;
            $PROP[471] = $userID;

            $arLoadArray = Array("IBLOCK_SECTION_ID" => false, "IBLOCK_ID" => $this -> userSubIB, "PROPERTY_VALUES" => $PROP, "NAME" => $itemID);

            if ($newSub -> Add($arLoadArray)) {
                $this -> renderSubscribedPhrase();
            }
        }

    }

}
?>