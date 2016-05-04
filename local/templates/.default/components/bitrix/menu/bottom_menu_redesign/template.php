<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <ul>
        <?
            foreach($arResult as $arItem):    ?>              
            <li <?if ($arItem["SELECTED"] =="Y"){?>class="active-bottom-menu"<?}?>> 
                <a href="<?=$arItem["LINK"]?>" class="url"><?=$arItem["TEXT"]?></a>
            </li> 
            <?endforeach?>
        <li>       
            <?$APPLICATION->IncludeFile(SITE_DIR."include/creator.php", Array(),Array("MODE"=>"html"));?>  
        </li>
    </ul>
    <?endif?>

           