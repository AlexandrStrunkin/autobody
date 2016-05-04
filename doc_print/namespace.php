<?
require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>

<?
global $USER;
include ($_SERVER['DOCUMENT_ROOT'] . "/ajax/subscribe/class.php");
use Autobody\Subscribe;

$subObject = new Autobody\Subscribe();
$subObject -> getUserMailList($USER -> GetID());
?>