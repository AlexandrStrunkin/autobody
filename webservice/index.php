<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('osg');


COSGUtils::SaveDataToFile('/webservice/logs/'.date('Y_m_d').'/'.date('H_i_s').'.xml', file_get_contents('php://input'), 'w');

$server = new SoapServer("service.wsdl");
$server->setClass("COSGWebService");
$server->handle();
?> 