<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
error_reporting(E_ALL);
// получаем нужную информацию
    $postdata = http_build_query(
	    array(
	       'token' => '11fdb14cdd8e77200bdade5841703560'
	   )
	);
	
	$opts = array('http' =>
	   array(
	       'method'  => 'POST',
	       'header'  => 'Content-type: application/x-www-form-urlencoded',
	       'content' => $postdata
	  )
	);
	
	$context  = stream_context_create($opts);
	$result = file_get_contents('http://www.autobody.ru/api/getCatalog/', false, $context);
	arshow($result);
?>