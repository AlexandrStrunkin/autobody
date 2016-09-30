<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode(true) ?>
<? if (!empty($arResult)) { ?>
<ul>
    <? foreach($arResult as $arItem) { ?>              
        <li <? if ($arItem["SELECTED"] =="Y") { ?>class="active-bottom-menu"<? } ?>> 
            <a href="<?= $arItem["LINK"] ?>" class="url"><?= $arItem["TEXT"] ?></a>
        </li> 
	<? } ?>
    <li></li>
</ul>
<? } ?>

           