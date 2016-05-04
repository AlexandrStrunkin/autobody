<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//if ($USER->IsAuthorized()) {
$APPLICATION->SetTitle("Новая страница");
require_once("/news/dompdf_config.inc.php");
$html=<<<'ENDHTML'
<html>
 <body>
  <h1>Hello Dompdf</h1>
 </body>
</html>
ENDHTML;
$document = new Imagick();
$document->readImage('<html>
 <body>
  <h1>Hello Dompdf</h1>
 </body>
</html>');
$document->writeImage('12345.jpg');
//}
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");//}?>