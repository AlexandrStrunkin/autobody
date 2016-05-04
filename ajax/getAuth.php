<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
if ($_POST["login"] && $_POST["pass"]) {
   if (!is_object($USER)) $USER = new CUser;
            $res = $USER->Login($_POST["login"],$_POST["pass"],'Y','Y');
            if (!is_array($res)) {
                echo "OK";
            } 
}
else {}
?>