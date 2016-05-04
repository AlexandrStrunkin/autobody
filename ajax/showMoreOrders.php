<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>

<?function plural_type($n) {
                return ($n%10==1 && $n%100!=11 ? 0 : ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 1 : 2));
            }
$arPluralRouble = array("Рубль","Рубля","Рублей");

    $orders=array();
    $arFilter = array();
    if ( checkSite()=="retail" && $USER->IsAuthorized() ) {
        $arFilter=Array("PROPERTY_VAL_BY_CODE_USER_ID"=>$USER->GetId());
    }
    else {
        $arFilter["USER_ID"] = $USER->GetId();    
    }  
    $arFilter["<ID"] = $_POST['last_id'];

    if (!empty($_POST["warehouse_order"])):
        $arFilter["PROPERTY_VAL_BY_CODE_ROOM_NUMBER"]=$_POST["warehouse_order"];
        endif;

    if (!empty($_POST["status_order"])):
        $arFilter["STATUS_ID"]=$_POST["status_order"];
        endif;

    if (!empty($_POST["delivery_order"])):
        $arFilter["DELIVERY_ID"]=$_POST["delivery_order"];
        endif;


    if(!empty($_POST["date_order_from"]) && !empty($_POST["date_order_to"])):
        $date_from =  strtotime($_POST["date_order_from"]);
        $date_to =  strtotime($_POST["date_order_to"]);
        if ($date_from -  $date_to < 0):
            $arFilter["DATE_FROM"] = $_POST["date_order_from"];
            $arFilter["DATE_TO"] = $_POST["date_order_to"];
            endif;
        if ($date_from -  $date_to > 0):
            $arFilter["DATE_FROM"] = $_POST["date_order_to"];
            $arFilter["DATE_TO"] = $_POST["date_order_from"];
            endif; 

        if ($date_from -  $date_to == 0):
            $arFilter["DATE_FROM"] = $_POST["date_order_to"];
            $arFilter["DATE_TO"] = $_POST["date_order_to"];
            endif;             
        endif;  

    if(!empty($_POST["date_order_from"]) && empty($_POST["date_order_to"])):
        $arFilter["DATE_FROM"] = $_POST["date_order_from"];

        endif;  
    if(empty($_POST["date_order_from"]) && !empty($_POST["date_order_to"])):
        $arFilter["DATE_TO"] = $_POST["date_order_to"];

        endif;   


    if(!empty($_POST["order_number_from"]) && !empty($_POST["order_number_to"])):
        $arFilter[">=ID"] = min($_POST["order_number_from"], $_POST["order_number_to"]);
        $arFilter["<=ID"] = max($_POST["order_number_from"], $_POST["order_number_to"]);
        endif;

    if(!empty($_POST["order_number_from"]) && empty($_POST["order_number_to"])):
        $arFilter[">=ID"] = $_POST["order_number_from"];
        endif; 


    if(empty($_POST["order_number_from"]) && !empty($_POST["order_number_to"])):
        $arFilter["<=ID"] = $_POST["order_number_to"];   

        endif;



    $warehouse=array();
    $store_list_res = CCatalogStore::GetList(array(), array(), false, false, array());   
    while($store_list_ob = $store_list_res -> Fetch()):

        $warehouse[$store_list_ob["ID"]]=$store_list_ob["TITLE"];

        endwhile;  
    $orders_res = CSaleOrder::GetList(Array('ID' => 'DESC'), $arFilter, false, array("nTopCount"=>10), array());

    while($arOrders_ob = $orders_res->Fetch()){
        //arshow($arOrders_ob);
        $orders[$arOrders_ob["ID"]]["INFO"]=$arOrders_ob;
        $property_res=CSaleOrderPropsValue::GetList(
            array(),
            array("ORDER_ID"=>$arOrders_ob["ID"]),
            false,
            false,
            array("*")
        );

        while($property_ob=$property_res->Fetch()){
            $orders[$arOrders_ob["ID"]]["PROPERTY"][$property_ob["CODE"]]=$property_ob;
        }

        $basket_res = CSaleBasket::GetList(
            array(),
            array("ORDER_ID"=>$arOrders_ob["ID"]),
            false,
            false,
            array("*")
        );

        while($basket_ob = $basket_res -> Fetch()){
            $orders[$arOrders_ob["ID"]]["BASKET"][] = $basket_ob;
        }

    }

?>

<?foreach($orders as $arItem):
        $status = CSaleStatus::GetByID(
            $arItem["INFO"]["STATUS_ID"]
        );
    ?>

    <div data-itemID=<?=$arItem["INFO"]["ID"]?> class="order-info">
    <div class="title title_order">
        <div class="order_tittle ml">
            № <span><?=$arItem["INFO"]["ID"]?></span> 
            <?$date_insert = explode(" ",$arItem["INFO"]["DATE_INSERT"]);
                $time = explode(":",$date_insert[1]);
                $date=explode(".",$date_insert[0]);
            ?>
            <span>от <?echo $date[0].".".$date[1].".".substr($date[2], 2);?>,<?echo " ".$time[0].":".$time[1]?></span>
        </div> 
        <div class="order_tittle">
            <span id="warehouse"><b>Склад:</b> <?=$warehouse[$arItem["PROPERTY"]["ROOM_NUMBER"]["VALUE"]]?></span>
            <?if($arItem["INFO"]["STATUS_ID"]=="T" && $arItem["INFO"]["PAYED"]=="Y"):
                    $status_name = "Отгружается";                        
                   else:
                   $status_name = $status["NAME"];  
                    endif;
                if($arItem["INFO"]["STATUS_ID"]=="N" || $arItem["INFO"]["STATUS_ID"]=="S" ||
                    ($arItem["INFO"]["STATUS_ID"]=="T" && $arItem["INFO"]["PAYED"]=="N")):
                    $status_class="delivery_red";
                    else:
                    $status_class="delivery_green";
                    endif;
            ?>

            <span id="<?=$status_class?>"><?=$status_name?></span>
        </div> 
        <div class="order_tittle" style="margin-left:35px;">
            <span id="warehouse">Сумма:</span> 
            <?$price_order=0;
                foreach ($arItem["BASKET"] as $arBasket):
                    $date_basket=explode(" ", $arBasket["DATE_INSERT"]);
                    $date_baket_new=explode(".", $date_basket[0]);
                    $price_basket = CCurrencyRates::ConvertCurrency($arBasket["PRICE"], "USD", "RUB", $date_baket_new[2]."-".$date_baket_new[1]."-".                                        $date_baket_new[0]);
                    $arBasket["PRICE"] =  $price_basket;
                    $quantity=explode(".",$arBasket["QUANTITY"]);
                    $price_order=$price_order+($price_basket*$quantity[0]);  
                    endforeach;                           
            ?>            
            <span id="price"><?=ceil($price_order)?> <font class="rouble">i</font></span>
        </div>
        <? $num_ticket=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$arBasket["ORDER_ID"], 'CODE'=>'NUM_INVOICE'), false, false, array());
                     while($num_ticket1=$num_ticket->Fetch()) {
                     $check_id=substr($num_ticket1['VALUE'],0,5);
                        } ?>
                    <div class="order-cabinet-butons" style='display:none;width:265px;display:inline-block;margin-top:0;line-height:20px;position:absolute;right:120px;'>
                        <div class="field" style='font-size:10px;'><a target="_blank" class="url" href="/order-print.php?order_id=<?=$arBasket["ORDER_ID"]?>">Распечатать заказ</a></div> 
                        <?$list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'CREATED_BY'=>$USER->GetID()),false,false,array('ID','NAME'))->Fetch();
                        if ($list) {
                            if (($arItem['INFO']['STATUS_ID']=='T' || $arItem['INFO']['STATUS_ID']=='S') && ($arItem['INFO']['PAY_SYSTEM_ID']==44 || $arItem['INFO']['PAY_SYSTEM_ID']==45) && (checkSite()=="opt")) {?>
                            <div class="field field_1" style="margin-right:40px;cursor:pointer;font-size:10px;"> <a target="_blank" class="url_1">Распечатать счет на оплату</a></div>
                        <?}
                        }?>
                    </div>
                    <form id='entities_form' action="/doc_print/pdf/pdf_order_print.php?check_id=<?=$check_id?>" method="post" target="_blank" style="display:none;font-size:13px;">
                     <span class='entities_title'>ВЫБЕРИТЕ ЮРИДИЧЕСКОЕ ЛИЦО</span><br>
<?$list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'CREATED_BY'=>$USER->GetID()),false,false,array('ID','NAME'));
while($list_fetch=$list->Fetch()) { 
    ?>
<input type="radio" name='entname' value='<?=$list_fetch['NAME']?>'><?=$list_fetch['NAME']?><br>
<?}?>
<input type='hidden' name='order_id' value='<?=$arBasket['ORDER_ID']?>'>
<input type='submit' value='ДАЛЕЕ' class='proceeding_button'>   

<span class='close_ent_form'>X</span>
                    </form> 
        <div class="active-order-tail"></div></div>

    <div class="more">
        <div class="orders_info"> 
            <?if(!empty($arItem["PROPERTY"]["NUM_INVOICE"]["VALUE"])):?>
                <div>
                    <span>Номер резерва:</span> 
                    <span><?=$arItem["PROPERTY"]["NUM_INVOICE"]["VALUE"]?> </span> 
                </div>
                <?endif;
                if(!empty($arItem["PROPERTY"]["INCREMENT_ID"]["VALUE"])):?>
                <div>
                    <span>Зарезервировано до:</span> 
                    <span><?=$arItem["PROPERTY"]["INCREMENT_ID"]["VALUE"]?> </span> 
                </div>
                <?endif;
                if(!empty($arItem["PROPERTY"]["NUM_TICKET"]["VALUE"])):?>
                <div>
                    <span>Номер накладной:</span> 
                    <span><?=$arItem["PROPERTY"]["NUM_TICKET"]["VALUE"]?> </span> 
                </div>
                <?endif;                            

                if(!empty($arItem["INFO"]["DELIVERY_ID"])):
                    $delivery_info=CSaleDelivery::GetByID(
                        $arItem["INFO"]["DELIVERY_ID"]  
                    );?>
                <?if(!empty($arItem["PROPERTY"]["FIO"]["VALUE"])):?>
                    <div>
                        <span>ФИО:</span> 
                        <span><?=$arItem["PROPERTY"]["FIO"]["VALUE"]?> </span> 
                    </div>
                <?endif;?>
                
                <?if(!empty($arItem["PROPERTY"]["EMAIL"]["VALUE"])):?>
                    <div>
                        <span>E-mail:</span> 
                        <span><?=$arItem["PROPERTY"]["EMAIL"]["VALUE"]?> </span> 
                    </div>
                <?endif;?>
                
                <?if(!empty($arItem["PROPERTY"]["PHONE"]["VALUE"])):?>
                    <div>
                        <span>Телефон:</span> 
                        <span><?=$arItem["PROPERTY"]["PHONE"]["VALUE"]?> </span> 
                    </div>
                <?endif;?>
                
                <div>
                    <span>Доставка:</span> 
                    <span><?=$delivery_info["NAME"]?> </span> 
                </div>
                <?endif;
                if(!empty($arItem["INFO"]["PRICE_DELIVERY"])):?>
                <div>
                    <span>Стоимость доставки:</span> 
                    <span><?=$arItem["INFO"]["PRICE_DELIVERY"]?> руб.</span> 
                </div>
                <?endif;
                if(!empty($arItem["INFO"]["PAY_SYSTEM_ID"])):
                    $pay_info = CSalePaySystem::GetByID(
                        $arItem["INFO"]["PAY_SYSTEM_ID"]                                               
                    ); ?>
                <div>
                    <span>Оплата:</span> 
                    <span><?=$pay_info["NAME"]?> </span> 
                </div>
                <?endif;?>
        </div>
        <table class="order-list order-basket-table">
            <tr>
                <td colspan="5">Состав заказа
                    <div class="tail"></div>
                </td>
            </tr>
            <tr>               
                            <th width="55">Фото</th>
                            <th width="230">Наименование <br> <font color="#989898">(артикул, OEM, год)</font></th>
                            <th width="160">Зарезервировано</th>
                            <th width="160">Отгружено со склада</th>
                            <th width="105">Снято с резерва</th>
                            <th width="230">Удалено из накладной и причина</th>
                            <th width="75">Кол-во, <font color="#989898">шт</font></th>
                            <th width="95">Цена, <font class="rouble" color="#989898">i</font></th>
                            <th width="90" >Сумма, <font class="rouble" color="#989898">i</font></th>
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
                    $date_baket_new=explode(".", $date_basket[0]);
                    $price_basket = CCurrencyRates::ConvertCurrency($arBasket["PRICE"], "USD", "RUB", $date_baket_new[2]."-".$date_baket_new[1]."-".$date_baket_new[0]);
                    $quantity=explode(".",$arBasket["QUANTITY"]);
                ?>
                <tr class="basket_tr">
                    <td>
                        <?
                            if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$basket_ob['CODE'].".jpg")) {$img_path = "/upload/images/".$basket_ob['CODE'].".jpg";}
                            else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$basket_ob['CODE'].".JPG")) {$img_path = "/upload/images/".$basket_ob['CODE'].".JPG";}
                                else {$img_path = "";}
                        ?>
                        <?if ($img_path != ""){?>
                            <a href="<?=$img_path?>" class="fancybox" title="<?=$basket_ob["NAME"]?>">
                                <div class="forward_catalog_new_foto" title="Кликните, чтобы посмотреть фото">
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
                    <?$resProp = CSaleBasket::GetPropsList(array("NAME" => "ASC"), array("BASKET_ID" => $arBasket["ID"]));
                                    $resProp = CSaleBasket::GetPropsList(
                                        array(
                                            "NAME" => "ASC"
                                        ),
                                        array("BASKET_ID" => $arBasket["ID"])
                                    );
                                   
                                        $arrayProp = array();
                                        while ($obProp = $resProp->Fetch())
                                        {
                                           
                                          $arrayProp[$obProp["CODE"]] = $obProp["VALUE"];  
                                        }
                                        //arshow($arrayProp);
                                        ?>
                                                                          
                                    <td><?=$arrayProp["Code"]?></td>  
                                    <td><?=$arrayProp["QuantityExecuted"]?></td>  
                                    <td><?=$arrayProp["StatusPosition"]?></td> 
                                    <td><?=$arrayProp["Comments"]?></td>  
                                     
                                <td><?=$quantity[0]?></td>
                                <td><?=ceil($price_basket)?></td>
                                <td style="font-weight: bold;"><?echo ceil($price_basket*$quantity[0])?></td>
                </tr>
                <?endforeach;?> 
        </table>
        <span id="order_prices">Итого: <font style="font-weight: bold;"><?=ceil($price_order)?></font>
         <font style="font-style: italic;"><?=$arPluralRouble[plural_type(ceil($price_order))]?></font></span>   
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
        <div class="order-cabinet-butons">
            <div class="field"><a target="_blank" class="url" href="/order-print.php?order_id=<?=$arBasket["ORDER_ID"]?>">Распечатать заказ</a></div> 


        </div>
    </div>
    </div>



    <?$i++;
        endforeach;?>
    