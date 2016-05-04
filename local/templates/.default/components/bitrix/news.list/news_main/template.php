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

<?
//arshow($arResult["ITEMS"]);
?>

<div class="news-list">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <?if ($arItem["PROPERTIES"]["NEWS_MAIN"]["VALUE"]=='Y') {
            
            $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], Array("width" => 480, "height" => 360 ), BX_RESIZE_IMAGE_EXACT, false, false, false, false);
        
         ?>
            <div class="news-section-main" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <img title="<?=htmlspecialchars($arItem["NAME"])?>" alt="Форвард - <?=htmlspecialchars($arItem["NAME"])?>" src="<?=$renderImage["src"]?>"/>
                <div class="mask"> </div> 
                <div class="mask2">
                    <div class="main-news-date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
                    <div class="main-news-title"><?=$arItem["NAME"]?></div>
                    <div class="main-news-note"><?=$arItem["PREVIEW_TEXT"]?></div>
                    <a class="url" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><button class="detail-news-button" type="submit">ПОДРОБНЕЕ</button></a>
                </div> 
            </div>       
            <? 
        $main_news_id=$arItem["ID"];
        break;
        } ?>

        <?endforeach;?>

    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <?if (($news_item_count < 2)&&!($main_news_id==$arItem["ID"])) { 
           
           $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], Array("width" => 240, "height" => 200 ), BX_RESIZE_IMAGE_EXACT, false, false, false, false);

            ?>
            <div class="item-news">
                <div class="item-news-left-section">  
                    <div class="mask2">
                        <div class="news-date-side1"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
                        <div class="news-title-side1"><a class="url" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
                        <div class="news-note-side1"><?=$arItem["PREVIEW_TEXT"]?></div>
                    </div>
                </div>
                <div class="item-news-right-section">  
                    <img title="<?=htmlspecialchars($arItem["NAME"])?>" alt="Форвард - <?=htmlspecialchars($arItem["NAME"])?>" src="<?=$renderImage["src"]?>" /> 
                    <div class="mask2">
                        <!--<div class="item-news-arrow"></div>-->
                    </div>
                </div>
            </div>    
            <? $news_item_count++;
        } ?>

        <?endforeach;?>




    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
</div>

<?
    //   arshow($arResult)
    
    
?>
