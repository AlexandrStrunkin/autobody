<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<?
    $PRICE_CODE = $arParams["PRICE_CODE"][0];       
?>

<div class="section_header">
    <h1 class="name"><?if ($ar_result['UF_H1']) {echo $ar_result['UF_H1'].$page;} else echo $arResult["NAME"].$page?></h1>
    <?
        global $USER;
        if($USER->IsAuthorized()){
            $fav_list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>117, 'PROPERTY_ELEMENT_ID'=>$arResult["ID"], 'PROPERTY_USER_ID'=>$USER->GetID()),false,false,array('ID','PROPERTY_ELEMENT_ID', 'PROPERTY_USER_ID'));?>
        <div <?if($relElem = $fav_list->Fetch()){?> style="background-position:100% 0" data-related-element="<?=$relElem['ID']?>" data-delete-el="Y" title="Удалить из избранного" <?} else {?>title="Добавить в избранное"<?}?> class="header_star_favorite manage_favotite" data-action-from="public"  id="<?=$arResult["ID"]?>" data-elem-type="81">
        </div>  
        <?}
    ?>
</div>


<div class="catalog-sectionclickon">


    <table class="forward_catalog_new catalog_table">
        <tr>
            <th width="43">Фото</th>
            <th width="108">Артикул</th>
            <th width="98">OEM#</th>
            <th width="58">Год</th>
            <th width="245">Наименование</th>
            <th width="40">Срав.</th>
            <th width="69">Цена, руб</th>
            <th width="75">Купить</th>
            <th width="37" class="info_popup_relative">
                <div class="forward_catalog_new_info_popup">
                    <div class="forward_catalog_new_popup_text">
                        <div class="forward_catalog_new_popup_warning"><?=GetMessage("POPUP_WARNING")?></div>
                        <?=GetMessage("POPUP_MESSAGE")?><div class="forward_catalog_new_popup_img"><img src="/i/info_bg.png"></div>
                    </div>
                    <div class="forward_catalog_new_popup_close_button"><?=GetMessage("POPUP_BUTTON_MESSAGE")?></div>
                    <div class="forward_catalog_new_popup_triangle">
                    </div>
                </div>
                Инфо
            </th>
        </tr>        
        <?
            //проверяем корзину пользователя.
            //если текущий товар уже есть в корзине, то вместо кнопки добавления выводим соответствующее сообщение
            $arBasketItemsIDs = getCurrentBasket();  //массив ID товаров, которые в корзине на данный момент        

        ?>
        <?foreach($arResult["ITEMS"] as $cell=>$arElement):
                $ar_res=CCatalogProduct::GetByID($arElement['ID']);
            ?>
            <?
                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));


                //проверяем дату создания
                $dateCreate = explode(".", substr($arElement["DATE_CREATE"],0,10));
                $curDate = date("U"); //текущая дата
                $dif = 86400 * 30; //30 дней
                $dateCreateLabel = mktime(0,0,0,$dateCreate[1],$dateCreate[0],$dateCreate[2]);  //метка времени даты создания
            ?>

            <tr>
                <td>
                    <?
                        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".jpg")) {$img_path = "/upload/images/".$arElement['CODE'].".jpg";}
                        else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".JPG")) {$img_path = "/upload/images/".$arElement['CODE'].".JPG";}
                            else {$img_path = "";}
                    ?>
                    <?if ($img_path != ""){?>
                        <a property="url" href="<?=$img_path?>" class="fancybox" title="<?=$arElement["NAME"]?>">
                            <div property="image" class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                            </div>
                        </a>
                        <?} else {?>
                        <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                        <?}?>
                </td>

                <td  <?if (($curDate - $dateCreateLabel) < $dif) {?> class="catalog_section_item_new_label"<?}?>><?=$arElement['CODE']?></td>
                <td><?
                        $oem = str_replace("/","<br>",$arElement['PROPERTIES']['UNC']['VALUE']);
                        $oem = str_replace("+","<br>+",$oem);
                    ?>
                    <?=trim($oem)?>
                </td>
                <td><?=$arElement['PROPERTIES']['SIZE']['VALUE']?></td>
                <td>

                    <div class="forward_catalog_new_link_container" vocab="http://schema.org/" typeof="Product">
                        <a property="url" href="<?='/catalog/'.$arElement['~IBLOCK_SECTION_ID'].'/'.$arElement['ID'].'/'/*$arElement["DETAIL_PAGE_URL"]*/?>" title="<?=$arElement['NAME']?>"><?echo $arElement['NAME'];?></a>
                    </div>
                    <?if ($arElement['PROPERTIES']['FIRM']['VALUE'] || $arElement['PROPERTIES']['WARRANTY']['VALUE']){?>
                        <div class="forward_catalog_new_firm">    
                            <?//получаем название производителя   
                                if ($USER->IsAuthorized()) {
                                    $firm = CIBlockElement::GetById($arElement['PROPERTIES']['FIRM']['VALUE']);
                                    $arFirm = $firm->Fetch();
                                ?>
                                <?=$arFirm["NAME"]?><?if ($arElement['PROPERTIES']['WARRANTY']['VALUE']){?>, <?=$arElement['PROPERTIES']['WARRANTY']['VALUE']?><?}?>
                                <?}?>
                        </div>
                        <?}?>
                </td>
                <td>
                	<?
                		$frame_compare = new \Bitrix\Main\Page\FrameHelper("compare_boxes_" . $arElement['ID']);
						$frame_compare->begin();
                	?>
                	<div class="cbox <?if (in_array($arElement["ID"],$_SESSION["COMPARE"])){echo "cbox_c";}?>" onclick="check_compare(<?=$arElement["ID"]?>)"></div>
                	<? $frame_compare->beginStub() ?>
					<div class="cssload-container">
						<div class="cssload-speeding-wheel"></div>
					</div>
                    <? $frame_compare->end() ?>
                </td>
                <td><span property="highPrice"><?=ceil($arElement["PRICES"][$PRICE_CODE]["VALUE"])?></span></td>
                <td id="last_cell_<?=$arElement["ID"]?>">
                	<?
                		$frame = new \Bitrix\Main\Page\FrameHelper("table_stores_" . $arElement['ID']);
						$frame->begin();
                	?>
                    <?global $this_count; $this_count = 0;?>
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "cat_q_list", 
                            array(
                                "PER_PAGE" => "10",
                                "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
                                "SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
                                "USE_MIN_AMOUNT" => "N",
                                "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                                "ELEMENT_ID" => $arElement["ID"],
                                "STORE_PATH" => $arParams["STORE_PATH"],
                                "MAIN_TITLE" => $arParams["MAIN_TITLE"],
                                "STORES" => array(
                                    0 => "1",
                                    1 => "2",
                                    2 => "3",
                                    3 => "4",
                                ),
                                "ELEMENT_CODE" => "",
                                "CACHE_TYPE" => "N",
                                "CACHE_TIME" => "36000",
                                "USER_FIELDS" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "FIELDS" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "SHOW_EMPTY_STORE" => "Y",
                                "SHOW_GENERAL_STORE_INFORMATION" => "N"
                            ),
                            $component
                        );?>

                    <? if ($this_count > 0) { //если товар в наличии на текущем складе?>
                        <input type="hidden" id="item_name_<?=$arElement["ID"]?>" value="<?=$arElement['NAME']?>">
                        <input type="hidden" id="item_price_<?=$arElement["ID"]?>" value="<?=ceil($arElement["PRICES"][$PRICE_CODE]["VALUE"])?>">
                        <input type="hidden" id="item_code_<?=$arElement["ID"]?>" value="<?=$arElement['CODE']?>">
                        <input type="hidden" id="item_year_<?=$arElement["ID"]?>" value="<?=$arElement['PROPERTIES']['SIZE']['VALUE']?>">
                        <input type="hidden" id="item_count_<?=$arElement["ID"]?>" value="<?=$this_count?>">
                        <?
                            if (in_array($arElement["ID"],$arBasketItemsIDs)) {
                                $in_basket = "Y";
                            }
                            else {$in_basket = "N";}

                            if ($in_basket == "N") {
                            ?>
                            <a onclick="showcatdet('<?=$arElement["ID"]?>',<?=$this_count?>)" href="javascript:void(0)" title="добавить в корзину"><div class="forward_catalog_new_buy"></div></a>
                            <?} else {?>
                            <span class="forward_catalog_new_in_b" ><a href='/personal/basket/' title="корзина">В корзине</a></span>
                            <?}?>

                        <?} else { // если нет в наличии?>

                        <div class="catalog_basket_na" title="товара нет в наличии"></div> 
                        <?}?>
                    <? $frame->beginStub() ?>
					<div class="cssload-container">
						<div class="cssload-speeding-wheel"></div>
					</div>
                    <? $frame->end() ?>
                </td>

                <td class="catalog_item_info_cell" id="item_info_<?=$arElement["ID"]?>" title="Нажмите, чтобы посмотреть количество на складах">
                    <div class="catalog_info_container">
                        <div title="" class="warehouses_popup whp_<?=$arElement["ID"]?>">  </div>
                    </div>
                </td>
            </tr>
            <?endforeach;?>
    </table>

    <script>
        function showcatdet(ID,quantity)
        {
            $('#dialog').jqmShow();
            $("#catnamem").html($("#item_name_"+ID).val());
            $("#catpricem").html($("#item_price_"+ID).val());
            $("#catartm").html($("#item_code_"+ID).val());
            $("#catyearm").html($("#item_year_"+ID).val());
            $("#catqwm").html($("#item_count_"+ID).val())
            $("#qw").val(1);
            $("#idm").val(ID);
        }
    </script>

    <script>
        $().ready(function() {
            $('#dialog').jqm();
        });
    </script>
    <div class="jqmWindow" id="dialog">

        <a href="#" id="closemodal" class="jqmClose"></a>
        <form method="get" name="addbaskmod">

            <input type="hidden" name="id" id="idm" value=""/>

            <div class="modtitle">Добавление товара в корзину</div>
            <table>
                <tr class="begin white">
                    <td width="100">Вы выбрали:</td>
                    <td id="catnamem"></td>
                </tr>
                <tr class="nowhite">
                    <td>Цена:</td>
                    <td id="catpricem"></td>
                </tr>
                <tr class="white">
                    <td>Артикул:</td>
                    <td id="catartm"></td>
                </tr>
                <tr class="nowhite">
                    <td>Год:</td>
                    <td id="catyearm"></td>
                </tr>
                <tr class="white end">
                    <td>Текущий склад:</td>
                    <td>
                        <?
                        	$frame = $this->createFrame()->begin();
                            	$wh = GKCommon::GetWarehouseByID(GKCommon::GetSavedWarehouse());
                            	echo $wh;
							$frame->beginStub();
								echo "Ajax";
							$frame->end();
                        ?>
                    </td>
                </tr>

            </table>
            <div class="add-basket">
                <span style="display: none;" id="catqwm"></span>
                <input type="button" class="minus" value="-" onClick="if (Number($('#qw').val())>1){$('#qw').val(Number($('#qw').val())-1);}" />
                <input type="text" name="quantity" class="small" id="qw" value="1" onkeyup="if($(this).attr('value')<=0) this.value=1 return false; if($(this).attr('value')>Number($('#catqwm').val())) {alert('Такого кол-ва товара нет на складе'); this.value=Number($('#catqwm').html()); }" />
                <input type="button" class="plus" value="+" onClick="if (Number($('#qw').val())<Number($('#catqwm').html()))$('#qw').val(Number($('#qw').val())+1);"/>
                <a href="javascript:add2basket();" class="modalsave">Добавить</a>
            </div>
        </form>
    </div>

    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    <br/><br/><br/><br/><br/><br/>
    <?echo $arResult['DESCRIPTION']?>
</div>


