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

<?if (!($_REQUEST['item_id'])):?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<div class="news-page">
    
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <? 
            $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], Array("width" => 365, "height" => 200 ), BX_RESIZE_IMAGE_EXACT, false, false, false, false);
            //$items_on_page_count++;
        ?>
        
        <div class="item-news" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="item-news-left-section" >  
                <div class="mask2">
                    <div class="news-date-side1"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
                    <div class="news-title-side1"><a class="url" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
                    <div class="news-note-side1"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>
            </div>
            <div class="item-news-right-section">  
                <img src="<?=$renderImage["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/> 
                <div class="mask2">
                    <!--<div class="item-news-arrow"></div>-->
                </div>
            </div>
            
        </div> 
           
    <?endforeach;?>    
     
 </div>
 
 <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>
 
<?endif;?>
  

 

