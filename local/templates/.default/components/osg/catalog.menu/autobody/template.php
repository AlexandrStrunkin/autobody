<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (is_array($arResult['SECTIONS'][1])):?>
<?foreach ($arResult['SECTIONS'][1] as $arSection):

//if($arSection['DEPTH_LEVEL']==1) $arSection['NAME'] = substr($arSection['NAME'],3);

?>
<?if ($arSection['IS_SELECTED']):?>
	<div class="catalog">
		<dl>
			<dt class="to_whom minus"><a href="<?=$arSection['URL']?>" <?=$arSection['TARGET']?>><img src="/bitrix/templates/demo/images/minus.gif" /><?=$arSection['NAME']?></a></dt>
			<dt class="catalog_dt"><strong>Категории</strong></dt>
		  	<?recursiveMenu(2, $arResult)?>
	  	</dl>
	  	
	  	<?if ($arResult['FIRMS']):?>
	  	<dl>
	  		<dt class="catalog_dt"><strong>Бренды</strong></dt>
	  		<?foreach ($arResult['FIRMS'] as $FIRM_ID=>$arFirm):?>
				<dd><a href="/catalog/brand.php?section_id=<?=$arSection['ID']?>&brand_id=<?=$FIRM_ID?>" target="_self"><?=$arFirm['NAME']?></a> (<?=$arFirm['COUNT']?>)</dd>
			<?endforeach;?>
		</dl>
		<?endif?>
	</div>
<?else:?>
	<div class="catalog">
		<dl>
			<dt class="to_whom plus"><a href="<?=$arSection['URL']?>" <?=$arSection['TARGET']?>><img src="/bitrix/templates/demo/images/plus.gif"/><STRONG><?=$arSection['NAME']?></STRONG></a></dt>
	  	</dl>
	</div>
<?endif?>
<?endforeach;?>
<?endif?>

<?
function recursiveMenu($DEPTH_LEVEL, $arResult){
	if ($DEPTH_LEVEL <= count($arResult['SECTIONS'])){
		if ($DEPTH_LEVEL > 2){
			echo '<dl class="catalog_small">';
		}
		
		foreach ($arResult['SECTIONS'][$DEPTH_LEVEL] as $arSection){
			echo '<dd>';
			if ($arSection['IS_SELECTED']){
				echo '<a href="'.$arSection['URL'].'" class="strong" '.$arSection['TARGET'].'>'.$arSection['NAME'].'</a>';	
				recursiveMenu($DEPTH_LEVEL+1, $arResult);
			}else{
				echo '<a href="'.$arSection['URL'].'" '.$arSection['TARGET'].'>'.$arSection['NAME'].'</a>';	
			}
			
			echo '</dd>';
		}
		if ($DEPTH_LEVEL > 2){
			echo '</dl>';
		}
	}
}
?>