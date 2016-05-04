<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div>
	<a href="/personal/basket.php?clear_cache=Y"><img src="/bitrix/templates/demo/images/shoping_cart.png" width="48" height="60" alt="" align="left" /></a>

	<div>В <a href="/personal/basket.php?clear_cache=Y">корзине </a><strong><?=$_SESSION['OSG']['USER']['BASKET']['TOTAL_QUANTITY']?></strong> шт. товаров<br /> на сумму <strong><?=$_SESSION['OSG']['USER']['BASKET']['TOTAL_PRICE']?></strong> руб.</div>
         
	
	<div>В <a href="/catalog/notebook.php">блокноте</a> <strong><?=count($_SESSION['OSG']['USER']['DELAY_GOODS'])?></strong> товаров<a href="/catalog/notebook.php"><img src="/bitrix/templates/demo/images/Paste.png" width="32" height="34" alt="блокнот" /></a></div>


</div>