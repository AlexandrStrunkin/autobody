<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $section = array(
        1=>83,
        2=>82,
        3=>85,
        4=>86,
        5=>87,
        6=>88,
        7=>89
    );
    
    
   $arrUpdate = array(
       "TUN" => array(),
       "FLU" => array(),
       "OPT" => array(),
       "COOL" => array(),
       "MIRR" => array(),
       "MECH" => array(),
       "BODY" => array()
   );

    $arData = array();
    $handle = fopen($_SERVER["DOCUMENT_ROOT"]."/test/part.csv", "r");
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {   
        strlen($data[0]) == 1 ? $data[0] = "0".$data[0] : ""; 
        //$arData[$data[0]] = $data[2];
        switch($data[2]){
            case 1:
                array_push($arrUpdate['BODY'],$data[0]);
                break;
            case 2:
                array_push($arrUpdate['MECH'],$data[0]);
                break;
            case 3:
                array_push($arrUpdate['MIRR'],$data[0]);
                break;
            case 4:
                array_push($arrUpdate['COOL'],$data[0]);
                break;
            case 5:
                array_push($arrUpdate['OPT'],$data[0]);
                break;
            case 6:
                array_push($arrUpdate['FLU'],$data[0]);
                break;
            case 7:
                array_push($arrUpdate['TUN'],$data[0]);
                break;
        }     
    }            
    fclose($handle);
    
    //arshow($section);
    //arshow($arrUpdate);
    
    CIBlockElement::SetPropertyValuesEx(2363984, 118, array("RELATED_SECTIONS" => $arrUpdate['BODY']));
    
    /*$element=CIBlockElement::GetList(array("ID"=>"ASC"),array("IBLOCK_ID"=>88,"ACTIVE"=>"Y"),false,false,array("CODE","ID"));
    while($arEl = $element->Fetch()) {
        //arshow($arEl);
       $code = explode("-",$arEl["CODE"]);          
       $subCode = substr($code[1],0,2); 
    }*/
    
    
?>