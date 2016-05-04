<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?

    if (!($arOrder = CSaleOrder::GetByID($_GET["order_detail"])))
    {
        echo "Заказ с кодом ".$ORDER_ID." не найден";
    }
    else
    {
        $res = CSaleBasket::GetList(array(), array("ORDER_ID" => $arOrder[ID])); // ID заказа
        // arshow($arOrder);

        while ($arItem = $res->Fetch()) {}
    ?>

    <?//arshow($arOrder)?>
    <?
        //получем название склада
        $order_info = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$arOrder["ID"], "CODE"=>"ROOM_NUMBER"), false, false, array());
        $order_ = $order_info->Fetch();
        $WH = GKCommon::GetWarehouseByID($order_["VALUE"]);

    ?>
    <div class="smallall">
        <div class="blankorder ">
            <div class="name">Просмотр заказа № <?=$arOrder["ID"]?> от <?=$arOrder["DATE_INSERT_FORMAT"]?></div>
            <table class="order">
                <tr>
                    <th>Дата</th>
                    <th>Заказа, №</th>
                    <th>Резерв, №</th>
                    <th>Накладная, №</th>
                    <th>Оплата</th>
                    <th>Доставка</th>
                    <th>Статус</th>
                </tr>
                <tr>
                    <td><?=$arOrder["DATE_INSERT_FORMAT"]?></td>
                    <td><?=$arOrder["ID"]?></td>
                    <td>
                        <?$rs = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID'=>$arOrder["ID"],'CODE'=>'NUM_INVOICE'));
                            $numinvoice = $rs->GetNext();?>
                        <?if($ni = $numinvoice['VALUE']):?>    <?=$ni?><?endif;?>

                    </td>
                    <td>
                        <?$rs = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID'=>$arOrder["ID"],'CODE'=>'NUM_TICKET'));
                            $numticket = $rs->GetNext();?>
                        <?if($ni = $numticket['VALUE']):?><?=$ni?><?endif;?>
                    </td>
                    <td><?if ($arPaySys = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"])){?><?=$arPaySys["NAME"];?><?}?></td>
                    <td><?$arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
                            if ($arDeliv)
                            {?><?=$arDeliv["NAME"];?><?}?>
                    </td>
                    <td><?
                            if ($arStatus = CSaleStatus::GetByID($arOrder["STATUS_ID"]))
                        {?><?=$arStatus["NAME"];?><?}?></td>
                </tr>
            </table>
            <hr>
            <p><b>Склад: </b><?=$WH?></p>
            <br>
            <hr>
            <p><b>Пользовательские комментарии:</b><br>
                <?=$arOrder["USER_DESCRIPTION"];?>
            </p>
            <hr>

            <div class="name">Состав заказа</div>
            <div class="spiszaktov">
                <table class="findtable">
                    <tr>
                        <th class="th1"></th>
                        <th class="th2">Наименование</th>
                        <th class="th3">Цена, руб./шт.</th>
                        <th class="th4">Количество, шт.</th>
                        <th class="th5">Сумма, руб.</th>
                    </tr>

                    <?$res = CSaleBasket::GetList(array(), array("ORDER_ID" => $arOrder[ID]));
                        while ($arItem = $res->Fetch()) {
                            $ress = CIBlockElement::GetByID($arItem["PRODUCT_ID"]);
                            if($ar_ress = $ress->GetNextElement())
                            {
                                $fields=$ar_ress->GetFields();
                                $props = $ar_ress->GetProperties();
                                //  arshow($props);
                                //arshow($fields);
                            ?>

                            <tr class="tr1">
                                <td class="td1">
                                    <?
                                        // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                                        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$fields['CODE'].".jpg")) {$img_path = "/upload/images/".$fields['CODE'].".jpg";}
                                        else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$fields['CODE'].".JPG")) {$img_path = "/upload/images/".$fields['CODE'].".JPG";}
                                        else {$img_path = "/i/ico_noimg.gif"; }
                                    ?>
                                    <a href="<?=$fields["DETAIL_PAGE_URL"];?>"><img src="/i/find-small.png"/><img src="<?=$img_path?>"  class="showh"/></a>
                                    <table>
                                        <tr>
                                            <td><span>Артикул:</span></td>
                                            <td><?=$fields["CODE"];?></td>
                                        </tr>
                                        <tr>
                                            <td><span>Год:</span></td>
                                            <td><?=$props["SIZE"]["VALUE"];?></td>
                                        </tr>
                                        <tr>
                                            <td><span>OEM#:</span></td>
                                            <td><?=$props["UNC"]["VALUE"];?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="td2"><a href="<?=$fields[DETAIL_PAGE_URL];?>"><?=$fields["NAME"];?></a></td>
                                <td class="td3"><?$newval = CCurrencyRates::ConvertCurrency($arItem["PRICE"], $arItem["CURRENCY"], "RUR");
                                ?><?=$newval?></td>
                                <td class="td4"><?=$arItem["QUANTITY"];?></td>
                                <td class="td5"><?=$newval*$arItem["QUANTITY"];?></td>
                            </tr>
                            <?}
                        }
                    ?>
                </table>

                <div class="result">
                    <table>
                        <tr>
                            <td>Стоимость доставки, руб.:</td>
                            <td class="td2"><?=$arDeliv["PRICE"];?></td>
                        </tr>
                        <tr>
                            <td>Общая сумма, руб.:</td>
                            <td class="td2"><?=$arOrder["PRICE"];?></td>
                        </tr>
                        <tr>
                            <td>Скидка, руб.:</td>
                            <td class="td2"><?=$arOrder["DISCOUNT_VALUE"];?></td>
                        </tr>
                        <tr>
                            <td>Сумма со скидкой, руб.:&nbsp;</td>
                            <td class="td2"><?=($arOrder["PRICE"] - $arOrder["DISCOUNT_VALUE"]);?></td>
                        </tr>
                    </table>
                </div>
                <div class="widthall">
                    <a href="/print_order.php?order_detail=<?=htmlspecialcharsbx($_GET["order_detail"])?>" target="_blank"> <div class="print">Напечатать</div></a>
                    <?/*  <a href="/"><div class="sendprint">Отправить себе на почту</div></a>   */?>
                </div>
            </div>
        </div>
    </div>


    <?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>