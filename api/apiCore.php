<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?

    CModule::IncludeModule("iblock");
    CModule::IncludeModule("main");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("search");


    class ApiCore {

        /*****
        * Verify the existence of user with this token
        * 
        * @param string $token
        * @return array $rsUser if success
        * 
        ******/

        public function checkUserByToken($token){
            if (!empty($token)){
                $filter = Array("UF_RESTTOKEN" => $token);
                $rsUsers = CUser::GetList(($by=""), ($order=""), $filter); // выбираем пользователей      
                $rsUser=$rsUsers->NavNext(true, "f_");   
                if (gettype($rsUser)=='array'){  
                    //update authorize date        
                    ApiCore::setAuthorizeDate($token);  
                    return $rsUser;        
                } else {
                    die(ApiErrorHandler::raiseError('accessProblem'));
            }} else {
                die(ApiErrorHandler::raiseError('accessProblem'));
            }
        }

        /*****
        * Check opportunity to log in with this login and password
        * 
        * @param string $login
        * @param string $password
        * @return string $result
        * 
        ******/

        public function Authorize($login,$password) {
            if (!is_object($USER)) $USER = new CUser;
            $res = $USER->Login($login,$password,'N','Y');
            if (!is_array($res)) {
                $result = 'Y';                     
            } else {
                $result = 'N';
            }        
            return  $result;
        }

        /*****
        *  
        * @param string $id
        * @return string $res
        * 
        ******/

        public function GetIblockElementName($id){
            if (intval($id > 0)) {
                $element = CIBlockElement::GetList(array(),array('ID'=>$id),false,false, array('NAME'));
                $arElement = $element->Fetch(); 
            }    
            if ($arElement['NAME']) {              
                $res = $arElement['NAME'];
            } else {
                $res = '';
            }      
            return $res;
        }


        /***
        * set last ws using date 
        * 
        * @param integer $userID
        */
        public function setAuthorizeDate($token) {
            $filter = Array("UF_RESTTOKEN" => $token);
            $rsUser = CUser::GetList(($by=""), ($order=""), $filter)->Fetch(); 
            $user = new CUser;
            $fields = Array(
                "UF_LAST_WS_USING"=> date("d.m.Y h:i:s"), 
                "UF_USER_MODIFIED_BY" => "USER_1C",
                "UF_USER_SITE_ID" => "s1"       
            );
            $user->Update($rsUser["ID"], $fields);

            //  $strError .= $user->LAST_ERROR;

            return true;
        }    



        /***
        * add search statistics
        * 
        * @param string $query
        */
        public function addSearchStat($query) {
            $obSearch = new CSearch;
            $obSearch->Search(array(
                'QUERY' => $query,
                'SITE_ID' => LANG,
                'MODULE_ID' => 'iblock',
                'TAGS' => 'вебсервис'
            ));
            
            $obSearch->NavStart();
            
            return true;
        }

    }   

    /*******
    * Return error message on errorFlag
    * @return string
    ****/

    class ApiErrorHandler {

        private static $errors = array(
            'notFound'=>'Элемент не найден',
            'insertDataProblem' => 'Недостаточно параметров для поиска!',
            'accessProblem' => 'Неверный ключ доступа к сервису.',
            'unknownFilterFlag' => 'Передан неверный параметр для функции.',
        );

        public static function raiseError($errorFlag){
            $errorResponse = json_encode(Array('error' => self::$errors[$errorFlag]));
            echo $errorResponse;
        }   
    }

?>