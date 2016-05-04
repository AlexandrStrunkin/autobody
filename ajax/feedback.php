<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
        if (CEvent::Send("FEEDBACK", array(SITE_ID), $_POST)){
        echo"ok";
        }else{
            echo"error";
        }