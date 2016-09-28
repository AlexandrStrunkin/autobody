<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode(true); ?>
<? if (!empty($arResult)) { ?>
<table class="top-menu-items" vertical-align="center" align="center">
	<tr>
	    <? foreach($arResult as $arItem) { ?>        
	        <td <? if ($arItem["SELECTED"] == "Y") { ?>class="active-top-menu"<? } ?>>
	        	<a href="<?= $arItem["LINK"] ?>" class="url"><?= $arItem["TEXT"] ?></a>
	        </td>
		<? } ?>
	        
		<? if (checkSite() == 'retail') { ?>
			<td>
				<a href="http://autobody.ru/" class="url url_retail">Оптовый магазин</a>
			</td>
		<? } ?>
	</tr>
</table>
<? } ?>


