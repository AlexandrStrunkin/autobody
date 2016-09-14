<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
if ($_POST["compare_id"]){
    if (!in_array($_POST["compare_id"],$_SESSION["COMPARE"])) {
       $_SESSION["COMPARE"][] = $_POST["compare_id"];
    }
    else {
      foreach ($_SESSION["COMPARE"] as $k=>$v) {
         if ($v == $_POST["compare_id"]) {
             unset($_SESSION["COMPARE"][$k]);
         }
      }
    }
}
//arshow($_SESSION["COMPARE"]);
BXClearCache(true, "/catalog/");
echo count($_SESSION["COMPARE"]);

?>
