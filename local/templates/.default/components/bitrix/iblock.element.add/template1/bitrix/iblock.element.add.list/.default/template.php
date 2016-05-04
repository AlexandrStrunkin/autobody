<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
/** @var CBitrixComponent $component */?>
<style>
<?include('styles.css');?>
</style>
<?
$this->setFrameMode(false);

$colspan = 2;
if ($arResult["CAN_EDIT"] == "Y") $colspan++;
if ($arResult["CAN_DELETE"] == "Y") $colspan++;
?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
    <?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<div class="store-info">Укажите реквизиты своей организации для печати счета на оплату.</div>
<span class="add-entity-plus">+</span> <a class="url add-entity" href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a><br>
<!--<table class="data-table"> -->
<?if($arResult["NO_USER"] == "N"):?>
 
<?endif?>
    <!-- <tfoot>
        <tr>
            <td<?=$colspan > 1 ? " colspan=\"".$colspan."\"" : ""?>><?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a><?else:?><?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?><?endif?></td>
        </tr>
    </tfoot> -->
<!-- </table>  -->
<?if (count($arResult["ELEMENTS"]) > 0):?>
        <?foreach ($arResult["ELEMENTS"] as $arElement):?>
        <?$entities_getlist=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'ID'=>$arElement['ID']),false,false,array('ID', 'PROPERTY_ENTITY_ADDR', 'PROPERTY_ENTITY_INN', 'PROPERTY_ENTITY_BIK', 'PROPERTY_ENTITY_KOR_BILL', 'PROPERTY_ENTITY_KPP', 'PROPERTY_ENTITY_OKVED', 'PROPERTY_ENTITY_OKPO', 'PROPERTY_ENTITY_BILL', 'PROPERTY_ENTITY_PHONE'))->Fetch();?>
        <div class='entity_block'>
            <table>
                <tr>
                    <td>
                        <?=$arElement['NAME']?>
                    </td>
                </tr>
                <tr>
                    <td class="more" style="display:none;">
                    <br><br>
                        <div class="ent_prop"><div class="table_field">Адрес: </div><?=$entities_getlist['PROPERTY_ENTITY_ADDR_VALUE']?></div>
                        <div class="ent_prop"><div class="table_field">ИНН: </div><?=$entities_getlist['PROPERTY_ENTITY_INN_VALUE']?></div> 
                        <div class="ent_prop"><div class="table_field">БИК: </div><?=$entities_getlist['PROPERTY_ENTITY_BIK_VALUE']?></div>
                        <div class="ent_prop"><div class="table_field">Кор.счёт: </div><?=$entities_getlist['PROPERTY_ENTITY_KOR_BILL_VALUE']?></div> 
                        <div class="ent_prop"><div class="table_field">КПП: </div><?=$entities_getlist['PROPERTY_ENTITY_KPP_VALUE']?></div> 
                        <div class="ent_prop"><div class="table_field">ОКВЭД: </div><?=$entities_getlist['PROPERTY_ENTITY_OKVED_VALUE']?></div> 
                        <div class="ent_prop"><div class="table_field">ОКПО: </div><?=$entities_getlist['PROPERTY_ENTITY_OKPO_VALUE']?></div>
                        <div class="ent_prop"><div class="table_field">Расчётный счёт: </div><?=$entities_getlist['PROPERTY_ENTITY_BILL_VALUE']?></div> 
                        <div class="ent_prop"><div class="table_field">Телефон: </div><?=$entities_getlist['PROPERTY_ENTITY_PHONE_VALUE']?></div>
                    </td>
                </tr>
            </table>
        <a class="entity_deleting" href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')">X</a><a class="element_edit" href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>"><img src="/images/edit_icon.png" width="20"></a><br></div>
        <?endforeach?>
    <?else:?>

    <?endif?>
    
<?if (strlen($arResult["NAV_STRING"]) > 0):?><?=$arResult["NAV_STRING"]?><?endif?>
<script>
 $(document).ready(function(){
     
            $(".entity_block").click(function(){

                if ($(this).find(".more").css("display") == "none") {
                    $(this).css("border-bottom", "none");
                    $(this).find(".more").slideDown(200);
                    $(this).css("border-bottom", "1px solid black");
                     $(this).addClass("active_entity_block");
                    //   $(this).siblings(".active-order-tail").slideDown();

                }
                else {
                    $(this).find(".more").slideUp(200);
                    $(this).removeClass("active_entity_block");
                }  
            });
 });
</script>