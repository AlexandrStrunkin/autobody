<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$i=0; //счетчик?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?//arshow($arItem)?>
    <?if ($arItem["PROPERTIES"]["CATEGORY"]["VALUE_ENUM_ID"] == 17) {?>
        <div style="overflow:hidden; float:left; width:276px; height:130px; margin:0 12px 50px 12px">
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                    <?$file2 = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>276, 'height'=>130), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>"><img class="preview_picture" border="0" src="<?=$file2['src']?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
                    <?else:?>
                    <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
                    <?endif;?>
                <?endif?>
        </div>
        <?
            $i++;
            //если вывели 4 банера, прерываем цикл
            if ($i == 4) {break;}
        } else {continue;}?>
    <?endforeach;?>
