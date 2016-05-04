<?
include_once($_SERVER['DOCUMENT_ROOT']. '/bitrix/modules/main/include/urlrewrite.php' );
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?//header("location: /")?>
<meta name="robots" content="noindex, nofollow"/>
<?CHTTP::SetStatus("404 Not Found");?>
<div style="font-size: 20px; font-weight: bold;">Такая страница не найдена, попробуйте перейти на <a href="/">главную</a></div>
<div align="center"><IMG src="/404.jpg"></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>