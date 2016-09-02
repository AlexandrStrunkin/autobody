<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;
global $APPLICATION;
$user_id = CSaleBasket::GetBasketUserID(); // íóæåí èìåííî ID þçåðà â êîðçèíå !
if($user_id  > 0) {
    $product_id = $arResult['ID'];
    CatalogViewedProductTable::refresh($product_id, $user_id);
}
?>