<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"])):?>
	<table class="title-search-result">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<tr>
				<th class="title-search-separator">&nbsp;</th>
				<td class="title-search-separator">&nbsp;</td>
			</tr>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<tr>
				<?if($i == 0):?>
					<th>&nbsp;<?echo $arCategory["TITLE"]?></th>
				<?else:?>
					<th>&nbsp;</th>
				<?endif?>

				<?if($category_id === "all"): ?>
					<td class="title-search-all" onclick="document.location.href = '<?= $arItem["URL"] ?>'"><?echo $arItem["NAME"]?></td>
				<?elseif(isset($arItem["ICON"])):?>
					<td class="title-search-item" onclick="document.location.href = '<?= $arItem["DETAIL_PAGE_URL"] ?>'"><img src="<?echo $arItem["ICON"]?>"><?echo $arItem["NAME"]?></td>
				<?else:
                    $element_info = "";
                    if (strlen($arItem['CODE']) > 0) {
                        $element_info .= $arItem["CODE"] . ", ";
                    }
                    if (strlen($arItem["PROPERTY_SIZE_VALUE"]) > 0) {
                        $element_info .= $arItem['PROPERTY_SIZE_VALUE'] . ", ";
                    }
                    $element_info .= $arItem["NAME"];
                    ?>
					<td class="title-search-more" onclick="document.location.href = '<?= $arItem["DETAIL_PAGE_URL"] ?>'"><?echo $element_info?></td>
				<?endif;?>
			</tr>
			<?endforeach;?>
		<?endforeach;?>
		<tr>
			<th class="title-search-separator">&nbsp;</th>
			<td class="title-search-separator">&nbsp;</td>
		</tr>
	</table><div class="title-search-fader"></div>
<?endif;
?>