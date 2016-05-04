<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($arResult)
?>
<div class="mainnews">
    <div class="newstitle">Новости</div>
    <div class="newswork">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?//arshow($arItem)?>
            <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                //print_r($arItem);
                $item = CIBLockElement::GetById($arItem["ID"]);
                $item_data = $item->Fetch();
                // arshow($item_data);
            ?>

            <div class="newsel">
                <div class="newsdate"><?=substr($item_data["DATE_CREATE"],0,10)?></div>
                <div class="newstext"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
                <p>
                    <?=$arItem["PREVIEW_TEXT"]?>
                </p>
            </div>


            <?endforeach;?>
        <br>
    </div>
</div>




