<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?if ($_GET["order_id"]):?>
    <?$arItem=array();

        $orders_res = CSaleOrder::GetList(Array(), Array("USER_ID"=>$USER->GetId(), "ORDER_ID"=>$_GET["order_id"]), false, false, array());
        $arOrders_ob = $orders_res->Fetch();
        $orders_list= CSaleOrder::GetList(Array(), Array("USER_ID"=>$USER->GetId(), "ID"=>$_GET["order_id"]), false, false, array());
        if ($orders_list->SelectedRowsCount()==0 && !$USER->IsAdmin()) {
            echo 'Access denied.';
            die();
        }
       //  arshow($arOrders_ob);
        $arItem["INFO"]=$arOrders_ob;
        $property_res=CSaleOrderPropsValue::GetList(
            array(),
            array("ORDER_ID"=>$_GET["order_id"]),
            false,
            false,
            array("*")
        );
        while($property_ob=$property_res->Fetch()):
            $arItem["PROPERTY"][$property_ob["CODE"]]=$property_ob;
            endwhile;

        $basket_res = CSaleBasket::GetList(
            array(),
            array("ORDER_ID"=>$_GET["order_id"]),
            false,
            false,
            array("*")
        );
        while( $basket_ob  = $basket_res -> Fetch()):

            $arItem["BASKET"][] = $basket_ob;

            endwhile;
        $warehouse=array();
        $store_list_res = CCatalogStore::GetList(array(), array(), false, false, array());   
        while($store_list_ob = $store_list_res -> Fetch()):

            $warehouse[$store_list_ob["ID"]]=$store_list_ob["TITLE"];

            endwhile;    
        //arshow($arItem);

        //функция для сортировки массива 
    ?>


    <table class="info" width="100%">
    <?//arshow($arItem);?>
        <tr width="200px">
            <td colspan="3">Информация о заказе
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <td rowspan="6">
                <div class="sum">Сумма: <?=ceil($arItem['BASKET'][0]['ORDER_PRICE'])?> <font class="rouble">i</font></div>

                <?$delivery_info=CSaleDelivery::GetByID(
                        $arItem["INFO"]["DELIVERY_ID"]
                    );
                    $pay_info = CSalePaySystem::GetByID(
                        $arItem["INFO"]["PAY_SYSTEM_ID"]                                               
                    );
                    // arshow($pay_info);
                    $status = CSaleStatus::GetByID(
                        $arItem["INFO"]["STATUS_ID"]

                    );

                ?>

                <div class="pay"><font color="#717171">Оплата:</font> <?=$pay_info["NAME"]?> </div>

                <div class="warning"><?=$status["NAME"]?></div>
            </td>
        </tr>

        <tr width="200px">
            <td><font color="#717171">Cклад:</font></td>
            <td><?=$warehouse[$arItem["PROPERTY"]["ROOM_NUMBER"]["VALUE"]]?></td>
        </tr>
        <?if(!empty($arItem["PROPERTY"]["NUM_INVOICE"]["VALUE"])):?>
            <tr>
                <td><font color="#717171">Номер резерва:</font></td>
                <td><?=$arItem["PROPERTY"]["NUM_INVOICE"]["VALUE"]?></td>
            </tr>
            <?endif;?>
        <?if(!empty($arItem["PROPERTY"]["INCREMENT_ID"]["VALUE"])):?>
            <tr>
                <td><font color="#717171">Зарезервировано до:</font></td>
                <td><?=$arItem["PROPERTY"]["INCREMENT_ID"]["VALUE"]?></td>
            </tr>
            <?endif;?>
        <?if(!empty($arItem["PROPERTY"]["NUM_TICKET"]["VALUE"])):?>
            <tr>
                <td><font color="#717171">Номер накладной:</font></td>
                <td><?=$arItem["PROPERTY"]["NUM_TICKET"]["VALUE"]?></td>
            </tr>
            <?endif;?>
        <tr>
            <td><font color="#717171">Доставка:</font></td>
            <td><?=$delivery_info["NAME"]?></td>
        </tr>
    </table>

    <table class="order-list order-basket-table">
        <tr>
            <td colspan="5">Состав заказа
                <div class="tail"></div>
            </td>
        </tr>
        <tr>
            <th>Фото</td>
            <th>Наименование (артикул, OEM, год)</th>
            <th>Цена, <font class="rouble">i</font></th>
            <th>Кол-во, шт</th>
            <th>Сумма, <font class="rouble">i</font></th>
        </tr>
        <?foreach($arItem['BASKET'] as $arBasket):

                $basket_res = CIBlockElement::GetList(
                    Array("SORT"=>"ASC"),
                    Array("ID" => $arBasket["PRODUCT_ID"]),
                    false,
                    false,
                    Array("NAME","CODE","IBLOCK_SECTION_ID", "ID", "PROPERTY_UNC","PREVIEW_PICTURE","PROPERTY_SIZE")
                );
                $basket_ob=$basket_res->fetch();
                $date_basket=explode(" ", $arBasket["DATE_INSERT"]);
                // arshow($date_basket);
                $date_baket_new=explode(".", $date_basket[0]);
                // arshow($date_baket_new);
                // echo  $date_baket_new[2]."-".$date_baket_new[1]."-".$date_baket_new[0];  
                $price_basket = CCurrencyRates::ConvertCurrency($arBasket["PRICE"], "USD", "RUB", $date_baket_new[2]."-".$date_baket_new[1]."-".$date_baket_new[0]);
                //echo $price_basket;
                $quantity=explode(".",$arBasket["QUANTITY"]);


                //arshow($quantity);

            ?>
            <tr>
                <td>
                    <?
                        // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".jpg")) {$img_path = "/upload/images/".$arElement['CODE'].".jpg";}
                        else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arElement['CODE'].".JPG")) {$img_path = "/upload/images/".$arElement['CODE'].".JPG";}
                            else {$img_path = "";}
                    ?>
                    <?if ($img_path != ""){?>
                        <a href="<?=$img_path?>" class="fancybox" title="<?=$arElement["NAME"]?>">
                            <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
                                <?/*
                                    <div class="forward_catalog_new_foto_container">
                                    <div class="forward_catalog_new_foto_container_arr_tail"></div>
                                    <div class="forward_catalog_new_item_img"><img src="<?=$img_path?>"></div>
                                    </div>
                                */?>
                            </div>
                        </a>
                        <?} else {?>
                        <div class="forward_catalog_new_nofoto" title="изображение отсутствует"></div>
                        <?}?>   
                </td>
                <td>
                    <a class="url-basket" href="/catalog/<?=$basket_ob["IBLOCK_SECTION_ID"]?>/<?=$basket_ob["ID"]?>/"> <?=$arBasket["NAME"]?><br></a>
                    <span class="oem-basket">(<?if(!empty($basket_ob["CODE"])){echo $basket_ob["CODE"]?>,<?};  
                        if(!empty($basket_ob["PROPERTY_UNC_VALUE"])){echo $basket_ob["PROPERTY_UNC_VALUE"]?>,<?};
                        if(!empty($basket_ob["PROPERTY_SIZE_VALUE"])){echo $basket_ob["PROPERTY_SIZE_VALUE"]?><?};?>)</span>
                </td>
                <td><span><?=ceil($price_basket)?></span></td>
                <td><?=$quantity[0]?></td>
                <td><?echo ceil($price_basket*$quantity[0])?></td>
            </tr>
            <?endforeach;?> 
    </table>

    <?if(!empty($arItem["INFO"]["USER_DESCRIPTION"])):?>
        <table class="order-comment">
            <tr>
                <td>
                    Комментарий к заказу
                    <div class="tail"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <?=$arItem["INFO"]["USER_DESCRIPTION"]?>
                </td>
            </tr>
        </table>
        <?endif;?>




    <?else:

        header("location: /personal/cabinet/");

        endif;?>


 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>