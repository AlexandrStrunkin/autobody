<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div id="menu">

<?
foreach($arResult as $arItem):	?>
	<a href="<?=$arItem["LINK"]?>" class="menu_link"><?=$arItem["TEXT"]?></a>	
<?endforeach?>
</div>
<?endif?>

