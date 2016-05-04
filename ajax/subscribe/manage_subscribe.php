<?
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

    include("class.php");
    include("sendMailToWH.php");
    
    use Autobody\Subscribe;
    
    $subObj = new Autobody\Subscribe();
    $WHNotification = new Autobody\SubscriptionMailerWH($_POST['item_id'], $_POST['quantity'], $_POST['warehouse'], $_POST['user_id']);    
     
    $subObj -> addNewSubscription($_POST['item_id'], $_POST['user_id'], $_POST['quantity'], $_POST['warehouse']);
    $WHNotification->send();
?>