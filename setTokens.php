<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
$user = new CUser;
$filter = Array();
$rsUsers = CUser::GetList(($by="ID"), ($order=""), $filter); // выбираем пользователей
while($rsUsers->NavNext(true, "f_")){   
    $fields = Array("UF_RESTTOKEN" => md5(uniqid(rand(), true)));
    //$user->Update($f_ID,$fields); 
}
?>