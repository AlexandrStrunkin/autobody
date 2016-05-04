<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>    

<?if(count($arResult["STORES"]) > 0):?>
    <?//arshow($arParams,true)?>
    <?
        //функция сортировки складов по ID
        function whSort($a, $b){
            $aa = intval($a["ID"]);
            $bb = intval($b["ID"]);

            //$a < $b
            if ($aa < $bb) {
                return -1;
            }
            //$a > $b
            else if ($aa > $bb) {
                return 1;
            }
            //$a = $b
            else {
                return 0; 
            }

        }

        usort($arResult["STORES"], whSort);
    ?>   
<?//echo strripos($_SERVER['HTTP_REFERER'], '/');?>
<?if($USER->IsAuthorized()){?>
    <div class="add_subs_block">
        
        <?$el_list=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>117, 'PROPERTY_ELEMENT_ID'=>$arParams['ELEMENT_ID'],'PROPERTY_USER_ID'=>$USER->GetID()),false,false,array('ID', 'PROPERTY_ELEMENT_ID'));?>       
        <?$relElem = $el_list->Fetch();?>
        <span class='sub_adding'><?if($relElem){?>Удалить из избранного<?} else {?>Добавить в избранное<?}?></span> 
        <span <?if($relElem){?> style="background-position:100% 0" data-related-element="<?=$relElem['ID']?>" data-delete-el="Y" <?}?> class="section_list_star manage_favotite" id="<?=$arParams['ELEMENT_ID']?>" data-action-from="public" data-elem-type="82"></span>
    </div>
<?}?> 
    <table class="wh_popup_table">
        <colgroup>
            <col width="120">
            <col width="60">
            <col width="120">
        </colgroup>
        <thead>
            <tr>
                <td>Склад</td>
                <td>Кол-во</td>  
                <td>Дата поступления</td> 
            </tr>
        </thead>

        <?foreach($arResult["STORES"] as $pid => $arProperty):?>
            <?$title = explode("(",$arProperty["TITLE"]);?>
            <?if (!$arProperty["NUM_AMOUNT"]) {$arProperty["NUM_AMOUNT"] = $arProperty["AMOUNT"];}?>
            <tr >
                <td <?if ($arProperty["ID"] == GKCommon::GetSavedWarehouse()){?> class="cur_wh"<?}?>><span ><?=$title[0]?></span></td>
                <td <?if ($arProperty["ID"] == GKCommon::GetSavedWarehouse()){?> class="cur_wh"<?}?>>
                    <?if ($arProperty["NUM_AMOUNT"] > 10){$arProperty["NUM_AMOUNT"] = "> 10";}?> 
                    <?=$arProperty["NUM_AMOUNT"]?>
                </td>
                <td <?if ($arProperty["ID"] == GKCommon::GetSavedWarehouse()){?> class="cur_wh"<?}?>>
                    <? 
                        $item = CIBlockElement::GetById($arParams["ELEMENT_ID"]);
                        $arElement = $item->Fetch();
                        //получаем дату доставки
                        $item_info = "";
                        $item_info = GKCommon::GetItemInfoByWh($arElement["CODE"],$arProperty["ID"]);
                    ?>
                    <?if (strlen($item_info["supply_date"])> 3){
                            echo $item_info["supply_date"];
                        }
                        else {echo "-";}
                    ?> 
                </td>               

            </tr> 
            <?endforeach;?>

        <?endif;?>
        
</table> 
<div class="relevance_residues"><p>Актуальность остатков на <span><?=$date_ubdate = GKCommon::GetLastUpdateDate();?> </span></p></div>