<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<?foreach($arResult as $arItem):?>
	<?if($arItem["SELECTED"]):?>
	    <?//$APPLICATION->AddChainItem($arItem["TEXT"], $arItem["LINK"])?>
		<dd><strong><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></strong></dd>
	<?else:?>
		<dd><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></dd>
	<?endif?>
<?endforeach?>
<?endif?>