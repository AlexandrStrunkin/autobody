<!--Favorite Popup-->
<div id="favorite_overlay">
    <?
		$frame = new \Bitrix\Main\Page\FrameHelper("favorite_overlay");
		$frame->begin();
	?>
    <div id="favorite_block_wrapper">
        <table id="header_and_close">
            <colspan>
                <col width="170" />
                <col width="22"/>
                <col width="670"/>
                <col width="16"/>
            </colspan>
            <tr>
                <td>Избранное</td>
                <td><img src="/images/fav_icon.png" alt="" /></td>
                <td></td>
                <td class="close_favorite"><img src="/images/close_fav.png" alt="" /></td>
            </tr>
        </table>
        <div>
            <ul id="favorite_slide_headers">
                <li>
                    Товары
                    <div class="favorite_headers_bg">Товары</div>
                </li>
                <li>
                    Группы
                    <div class="favorite_headers_bg slided_header">Группы</div>
                </li>
            </ul>
        </div>
        <div class="favoritePopupSlide">
            <div data-scroll-block="items" class="favorite_scroll_block closed_scroll_block">
                <table class="favorite_items_table_header">
                    <colspan>
                        <col width="75" />
                        <col width="440"/>
                        <col width="130"/>
                        <col width="90"/>
                        <col width="135"/>
                    </colspan>
                    <tr>
                        <td>Фото</td>
                        <td>Наименование (артикул, OEM, год)</td>
                        <td>Стоимость,Р</td>
                        <td>По складам</td>
                        <td></td>
                    </tr>
                </table>
                <table class="favorite_items_table">
                    <colspan>
                        <col width="75" />
                        <col width="440"/>
                        <col width="130"/>
                        <col width="90"/>
                        <col width="135"/>
                    </colspan>
                   <?if ($USER->IsAuthorized()){?> 
                     <?
                    $el_list=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>117, 'PROPERTY_USER_ID'=>$USER->GetID(),'PROPERTY_TYPE_ID_VALUE'=>'Элемент'),false,false,array('ID','IBLOCK_ID',"NAME",'PROPERTY_ELEM_HREF','PROPERTY_ELEMENT_ID'));
                    if (intval($el_list->SelectedRowsCount())>0){
                        while($ob = $el_list->GetNextElement()){
                            $arFields = $ob->GetFields();
                            $favoriteItemSelect = Array('ID','CODE','NAME','DATE_CREATE','DETAIL_PAGE_URL','PROPERTY_UNC_VALUE','PROPERTY_SIZE_VALUE','PROPERTY_FIRM_VALUE','PROPERTY_WARRANTY_VALUE');
                            $favRes = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>88,"ID"=>$arFields['PROPERTY_ELEMENT_ID_VALUE']), false, Array("nPageSize"=>1), $favoriteItemSelect);
                            if($temp = $favRes->GetNextElement())
                            {
                                $arAddedFields = $temp->GetFields();
                                $arAddedProps = $temp->GetProperties();
                            }
                            ?>
                           <tr>
                            <td>
                                <?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arAddedFields['CODE'].".jpg")) {
                                        $img_path = "/upload/images/".$arAddedFields['CODE'].".jpg";
                                    } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arAddedFields['CODE'].".JPG")) {
                                        $img_path = "/upload/images/".$arAddedFields['CODE'].".JPG";
                                    } else {
                                        $img_path = "";
                                    }
                
                                    if ($img_path != ""){?>
                                    <a property="url" href="<?=$img_path?>" class="fancybox" title="<?=$arAddedFields["NAME"]?>">
                                        <div property="image" class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото"></div>
                                    </a>
                                    <? } else { ?>
                                    <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                                <? } ?>
                            </td>
                            <td>
                                <div class="favorite_item_name"><a href="<?=$arFields["PROPERTY_ELEM_HREF_VALUE"]?>"><?=$arFields['NAME']?></a></div>
                                <div class="favorite_item_oem">(<?=$arAddedFields["CODE"]?>/<?=$arAddedProps["UNC"]['VALUE']?>/<?=$arAddedProps["SIZE"]['VALUE']?>)</div>
                            </td>
                            <td><?=ceil(getPriceForId($arFields['PROPERTY_ELEMENT_ID_VALUE']))?></td>
                            <td class="catalog_item_info_cell favorite_popup_wh" id="item_info_<?=$arAddedFields['ID']?>" title="Нажмите, чтобы посмотреть количество на складах">
                                <div class="catalog_info_container">
                                    <div class="warehouses_popup whp_<?=$arAddedFields['ID']?>"></div>
                                </div>
                            </td>
                            <td><div class="delete_fav manage_favotite" data-delete-el="Y" data-action-from="popup" data-related-element="<?=$arFields['ID']?>" data-elem-type="82"></div></td>
                        </tr>
                            
                        <? } ?>
                    <? } else { ?>
                        <tr>
                            <td colspan="4">
                                <h2>У вас еще нет элементов в избранном. Перейдите в каталог, чтобы добавить товары или группы.</h2>
                            </td>
                        </tr>
                     <? } ?>
                 <? } else { ?>
                        <tr>
                            <td colspan="5">
                                <h2>Пожалуйста, авторизуйтесь для доступа к функционалу избранного.</h2>
                            </td>
                        </tr>
                 <? } ?>   
                </table>
            </div>
            
             <div data-scroll-block="groups" class="favorite_scroll_block closed_scroll_block">
                <table class="favorite_items_table_header favorite_groups_table_header">
                    <colspan>
                        <col width="440" />
                        <col width="440"/>
                    </colspan>
                    <tr>
                        <td>Наименование</td>
                        <td></td>
                    </tr>
                </table>
                <table class="favorite_items_table">
                    <colspan>
                        <col width="440" />
                        <col width="440"/>
                    </colspan>
                   <?if ($USER->IsAuthorized()){?>  
                    <?
                    $el_list=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>117, 'PROPERTY_USER_ID'=>$USER->GetID(),'PROPERTY_TYPE_ID_VALUE'=>'Раздел'),false,false,array('ID','IBLOCK_ID',"NAME",'PROPERTY_ELEM_HREF'));
                    if (intval($el_list->SelectedRowsCount())>0){
                        while($ob = $el_list->GetNextElement()){
                            $arFields = $ob->GetFields();?>
                        <tr>
                            <td>
                                <div class="favorite_item_name"><a href="<?=$arFields['PROPERTY_ELEM_HREF_VALUE']?>"><?=$arFields['NAME']?></a></div>
                            </td>
                            <td><div class="delete_fav manage_favotite" data-action-from="popup" data-delete-el="Y" data-related-element="<?=$arFields['ID']?>" data-elem-type="81"></div></td>
                        </tr>
                            
                        <? } ?>
                    <? } else { ?>
                        <tr>
                            <td colspan="2">
                                <h2>У вас еще нет элементов в избранном. Перейдите в каталог, чтобы добавить товары или группы.</h2>
                            </td>
                        </tr>  
                    <? } ?>
                    <? } else { ?>
                        <tr>
                            <td colspan="5">
                                <h2>Пожалуйста, авторизуйтесь для доступа к функционалу избранного.</h2>
                            </td>
                        </tr>
                    <?} ?>
                </table>
            </div>
        </div>
        <div id="favorite_popup_bottom">
            <table>
                <colspan>
                   <col width="720"/>
                   <col width="160"/>
                </colspan>
                <tr>
                    <td>&nbsp;</td>
                    <td><button class="clear_all_favorite">Очистить все</button></td>
                </tr>
            </table>
        </div>
    </div>
    <? $frame->beginStub() ?>
    	<div id="loadFacebookG">
			<div id="blockG_1" class="facebook_blockG"></div>
			<div id="blockG_2" class="facebook_blockG"></div>
			<div id="blockG_3" class="facebook_blockG"></div>
		</div>
	<? $frame->end() ?>
</div>
<!--Favorite Popup-->