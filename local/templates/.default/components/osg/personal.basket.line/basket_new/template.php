<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<a href="/personal/basket.php?clear_cache=Y" id="korz1">В корзине <?=$_SESSION['OSG']['USER']['BASKET']['TOTAL_QUANTITY']?> товаров</a>
<span id="korz2">На сумму <?=$_SESSION['OSG']['USER']['BASKET']['TOTAL_PRICE']?> руб.</span>
<a href="/catalog/notebook.php" id="korz3">В блокноте <?=count($_SESSION['OSG']['USER']['DELAY_GOODS'])?> товаров</a>






