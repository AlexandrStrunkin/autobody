<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
?>
<div class="news-list" vocab="http://schema.org/" typeof="Organization">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><br />
        <?endif;
        //arshow($arResult["ITEMS"]["DISPLAY_PROPERTIES"]);?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                    class="preview_picture"
                    border="0"
                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                    width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                    height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                    alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                    title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    style="float:left"
                    /></a>
                <?else:?>
                <img
                    class="preview_picture"
                    border="0"
                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                    width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                    height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                    alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                    title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    style="float:left"
                    />
                <?endif;?>
            <?endif?>
        <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
            <span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
            <?endif?>
        <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <span property="name"><b><?=$arItem["NAME"]?></b></span><br />
                <?else:?>
                <b><?echo $arItem["NAME"]?></b><br />
                <?endif;?>
            <?endif;?>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
            <?echo $arItem["PREVIEW_TEXT"];?>
            <?endif;?>
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <div style="clear:both"></div>
            <?endif?>
        <?foreach($arItem["FIELDS"] as $code=>$value):  
            ?>        
            <small>
                <?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
            </small><br />
            <?endforeach;
        ?>
        <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
            //arshow($arProperty);
            if ($arProperty["CODE"]=="CONTACT_EMAIL"){
                foreach ($arProperty["VALUE"] as $arEmail):
                    echo "<span property='email'>".$arEmail."</span>" ;
                    endforeach;
            }
            if($arProperty["CODE"]=="CONTACT_ADRESS"){
                echo '<div property="address"  typeof="PostalAddress"><span property="streetAddress">'.$arProperty["VALUE"].'</span></div>';  
            }
            if($arProperty["CODE"]=="CONTACT_PHONE"){
                foreach ($arProperty["VALUE"] as $arPhone):
                    echo '<span property="telephone">'.$arPhone.'</span>';
                    endforeach;   
            }
          
        ?>
       
        <?endforeach;?>
    </p>
    <br><br><hr> <br><br>

    <?endforeach;?>


</div>
 