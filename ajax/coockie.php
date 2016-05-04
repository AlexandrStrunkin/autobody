<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
if ($_POST["cookie"]) {
   // setcookie("mbanners",$_POST["cookie"]);
   $_SESSION["OSG"]["USER"]["mbanners"] = $_POST["cookie"];
}
?>