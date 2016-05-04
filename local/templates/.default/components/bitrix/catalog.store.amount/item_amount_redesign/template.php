<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>     

<?
global $USER;
include($_SERVER['DOCUMENT_ROOT']."/ajax/subscribe/class.php");
use Autobody\Subscribe as Subscription;  

if(count($arResult["STORES"]) > 0){?>
    <?//arshow($arResult)?>
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
    <?
        $curWH = GKCommon::GetSavedWarehouse(); //id текущего склада
    ?>
    <table valign="" class="store">
        <tr>
            <?foreach ($arResult["STORES"] as $store){?>
                <?$title = explode("(",$store["TITLE"]);?>
                <td <?if ($store["ID"]==$curWH){?>class="out-store"<?}?>>
                    <?=$title[0]?>
                </td>
                <?}?>             
        </tr>
        <tr>

            <?foreach($arResult["STORES"] as $pid => $arProperty):?>
            <?if (!$arProperty["NUM_AMOUNT"]) {$arProperty["NUM_AMOUNT"] = $arProperty["AMOUNT"];}?>
                <td <?if ($store["ID"]==$curWH){?>class="out-store"<?}?>>
                    <?//if ($arProperty["NUM_AMOUNT"] > 10){$arProperty["NUM_AMOUNT"] = "> 10";}?> 
                    <?=$arProperty["NUM_AMOUNT"] > 10 ? "> 10" : $arProperty["NUM_AMOUNT"]?>
                    <?if($USER->IsAuthorized() && intVal($arProperty["NUM_AMOUNT"])<=0){
                        $subObject = new Subscription();
                        ?>
                       <div class="item_sub_wrapper">                                
                            <?if(!$subObject->isAlreadySubscribed($arParams["ELEMENT_ID"], $USER->GetID(), $arProperty["ID"])){?>
                                <div class="item_sub_form_container">
                                    <label for="">
                                        Уведомить, если больше : <br>
                                        <input name="quantity" required type="number" min="1"/>
                                    </label><br>
                                    <input type="hidden" name="item_id" value="<?=$arParams["ELEMENT_ID"]?>" />
                                    <input type="hidden" name="user_id" value="<?=$USER->GetID()?>" />
                                    <input type="hidden" name="warehouse" value="<?=$arProperty["ID"]?>" />
                                    <input class="subscribe_notification_form submit_subscribe_form" type="submit" value="Отправить" />
                                </div>
                            <?} else {?>
                                <div class="already_cubscribed item_sub_form_container">
                                    <?$subObject->renderSubscribedPhrase()?>
                                </div>
                            <?}?>
                                       
                           <div class="item_sub_button" title="Уведомить о поступлении"></div>
                       </div>
                    <?}
                    ?>          
                    <? 
                        $item = CIBlockElement::GetById($arParams["ELEMENT_ID"]);
                        $arElement = $item->Fetch();
                        //получаем дату доставки
                        $item_info = "";
                        $item_info = GKCommon::GetItemInfoByWh($arElement["CODE"],$arProperty["ID"]);
                    ?>
                    <?if (strlen($item_info["supply_date"])> 3){
                            echo "<br>поступление ".$item_info["supply_date"];
                        }
                        else {}
                    ?>
                </td>               

                <?endforeach;?>             

        </tr>
    </table>
    <?}?>

  

      