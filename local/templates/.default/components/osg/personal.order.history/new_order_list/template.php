<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($_GET[order_detail]){?>



    <?}
    else {?>
    <?if ($arResult):?>
        <?//arshow($arResult)?>
        <?if ($_REQUEST['message'] == 'individual'):?>
            <div class="message">
                <br/>
                Вы сделали заказ, как частное лицо. <br />
                Ваш заказ сформирован и поступил в обработку. <br />
                Спасибо, что воспользовались нашими услугами!
                <br/>
                <br/>
            </div>
            <?endif?>

        <?if ($_REQUEST['message'] == 'new_user'):?>
            <div class="message">
                <br/>
                Поздравляем! Ваш заказ сформирован и поступил в обработку. <br />
                В этом разделе Вы можете просматривать ход выполнения Ваших заказов и производить оплату по безналичному расчету.<br /><br />
                Кроме того, Вы зарегистрированы в нашем интернет-магазине как новый покупатель. <br />
                В дальнейшем процедура оформления заказа будет проще, а Вы сможете получать бонусы и скидки нашего интернет-магазина! <br />
                Спасибо, что воспользовались нашими услугами!
                <br/>
                <br/>
            </div>
            <?endif?>

        <?if ($_REQUEST['message'] == 'new_order'):?>
            <div class="message">
                <br/>
                Поздравляем! Ваш заказ сформирован и поступил в обработку. <br />
                Спасибо, что воспользовались нашими услугами!
                <br/><br/>
            </div>
            <?endif?>

        <?if($USER->IsAuthorized()) {  ?>
            <div class="filterdown"></div>
            <div class="orders">
                <table>
                    <tr>
                        <th class="td1">Номер заказа и дата</th>
                        <th class="td2">Сумма<br/>заказа, руб.</th>
                        <th class="td3">№ Резерва</th>
                        <th class="td8">Резерв до</th>
                        <th class="td4">№ Накладной</th>
                        <th class="td5">Оплата</th>
                        <th class="td6">Доставка</th>
                        <?/*<th class="td7">Статус</th>  */?>
                    </tr>

                    <?foreach ($arResult as $arItem):
                   // arshow($arItem);
                        ?>
                        <tr class="one">
                            <td><a href="/personal/order_detail.php?order_detail=<?=$arItem['ID']?>">№ <?=$arItem['ID']?> от <span><?=ConvertDateTime($arItem['DATE_INSERT'], 'DD.MM.YYYY')?></span></a></td>
                            <td><?=SaleFormatCurrency(CCurrencyRates::ConvertCurrency($arItem['PRICE'], $arItem['CURRENCY'], "RUR"), $arItem['CURRENCY'], true)?></td>
                            <td>
                                <?$rs = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID'=>$arItem['ID'],'CODE'=>'NUM_INVOICE'));
                                    $numinvoice = $rs->GetNext();?>
                                <?if($ni = $numinvoice['VALUE']):?>
                                    <?=$ni?>
                                    <?endif;?>
                            </td>
                            <td>
                             <?$rs = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID'=>$arItem['ID'],'CODE'=>'INCREMENT_ID'));
                                    $numticket = $rs->GetNext();?>
                                <?if($ni = $numticket['VALUE']):?>
                                    <?=$ni?>
                                    <?endif;?></td>
                            <td>
                                <?$rs = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID'=>$arItem['ID'],'CODE'=>'NUM_TICKET'));
                                    $numticket = $rs->GetNext();?>
                                <?if($ni = $numticket['VALUE']):?>
                                    <?=$ni?>
                                    <?endif;?>
                            </td>
                            <td><?=$arItem['PAY_SYSTEM']['NAME']; ?></td>
                            <td><?=$arItem['DELIVERY']['NAME']?></td>
                            <?/*
                            <td>
                                <?if ($arItem['CANCELED'] == 'Y'):?>Отменен
                                    <?elseif ($arItem['STATUS_ID'] == 'N'):?>
                                    Заказ получен и обрабатывается
                                    <?elseif ($arItem['STATUS_ID'] == 'T'):?>
                                    Заказ обработан и ожидает отгрузки
                                    <?elseif ($arItem['STATUS_ID'] == 'S'):?>
                                    Отгружен
                                    <?elseif ($arItem['STATUS_ID'] == 'F'):?>
                                    Исполнен!
                                    <?endif?>
                            </td>
                            */?>
                        </tr>
                        <tr>
                            <td colspan="7" style="border-bottom:1px solid #464646">
                                <?
                                    //получем название склада
                                   // arshow($arItem);
                                    unset($order_info);
                                    $order_info = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$arItem["ID"], "CODE"=>"ROOM_NUMBER"), false, false, array());
                                    $order_ = $order_info->Fetch();
                                  //  arshow($order_);
                                    if ($order_["VALUE"]) {
                                    $WH = GKCommon::GetWarehouseByID($order_["VALUE"]);
                                    }
                                    else{$WH = "не определен";}
                                ?>
                                <b>Склад: </b><?=$WH?>
                            </td>
                        </tr>

                        <!--
                        <tr class="basket_tovar">
                        <td class="tovar">
                        <table cellpadding="0" cellspacing="0" width="210" class="number_zakaz">
                        <tr>
                        <td nowrap><SPAN class="number">№<?=$arItem['ID']?></SPAN> от [<span><?=ConvertDateTime($arItem['DATE_INSERT'], 'DD.MM.YYYY')?></span>]</td>
                        <td align="right" class="summa" nowrap><?=SaleFormatCurrency(CCurrencyRates::ConvertCurrency($arItem['PRICE'], $arItem['CURRENCY'], "RUR"), $arItem['CURRENCY'], true)?></td>
                        </tr>
                        </table>

                        <h5>Состав заказа:</h5>
                        <table cellpadding="0" cellspacing="0" width="100%" align="left">
                        <?foreach ($arItem['BASKET'] as $arBasket): /*echo '<pre>';print_r($arBasket); echo '</pre>';*/?>
                            <tr>
                            <td><span><?=$arBasket['NAME']?></span></td>
                            <td><?=$arBasket['QUANTITY']?> шт.</td>
                            <td class="summa" align="center"><span><?=SaleFormatCurrency(CCurrencyRates::ConvertCurrency($arBasket['PRICE'], "USD", "RUR"), $arItem['CURRENCY'], true)?></span></td>
                            </tr>
                            <?endforeach;?>

                        <?if ($arItem['DELIVERY']['PRICE']>0):?>
                            <tr>
                            <td><span>Доставка</span></td>
                            <td></td>
                            <td class="summa" align="center"><span><?=$arItem['DELIVERY']['PRICE']?></span></td>
                            </tr>
                            <?endif?>

                        <?if ($arItem['DISCOUNT_VALUE']>0):?>
                            <tr>
                            <td><span>Скидка от оптовой цены</span></td>
                            <td></td>
                            <td class="summa" align="center"><span><?=$arItem['DISCOUNT_VALUE']?>%</span></td>
                            </tr>
                            <?endif?>
                        </table>
                        </td>
                        <td class="oplata">
                        <table cellpadding="0" cellspacing="0">
                        <tr>
                        <td width="200">
                        <?if ($arItem['PAYED'] == 'Y'):?>
                            <h5>Заказ оплачен</h5>
                            <?else:?>
                            <h5>Заказ оплачивается:</h5>
                            <?=$arItem['PAY_SYSTEM']['NAME']; ?>
                            <?if (0&&!$arItem['PAY_SYSTEM']['IS_CASH'] && $arItem['CANCELED'] == 'N' && $arItem['STATUS_ID'] != 'N'):?>
                                <a href="/personal/payment.php?ORDER_ID=<?=$arItem['ID']?>" target="_blank">Оплатить</a>
                                <img src="/bitrix/templates/demo/images/new_wind.gif" width="13" height="11" alt="Оплатить" />
                                <?endif?>
                        <?endif?>
                        </td>
                        <td width="200">
                        <h5>Заказ доставляется</h5>
                        <?=$arItem['DELIVERY']['NAME']?>
                        </td>
                        </tr>
                        </table>


                        <?$rs = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID'=>$arItem['ID'],'CODE'=>'NUM_INVOICE'));
                            $numinvoice = $rs->GetNext();?>
                        <?if($ni = $numinvoice['VALUE']):?>
                            <br />Номер резерва: <?=$ni?>
                            <?endif;?>

                        <?$rs = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID'=>$arItem['ID'],'CODE'=>'NUM_TICKET'));
                            $numticket = $rs->GetNext();?>
                        <?if($ni = $numticket['VALUE']):?>
                            <br />Номер расходной накладной: <?=$ni?>
                            <?endif;?>


                        <br /><h5>Статус заказа:</h5>
                        <table cellpadding="0" cellspacing="0">
                        <tr>
                        <?if ($arItem['CANCELED'] == 'Y'):?>
                            <td width="20"><img src="/bitrix/templates/demo/images/cancel.gif" width="15" height="12" alt="" /></td>
                            <td><span>&mdash; Отменен<span></td>
                            <?elseif ($arItem['STATUS_ID'] == 'N'):?>
                            <td width="20"><img src="/bitrix/templates/demo/images/new.gif" width="16" height="12" alt="" /></td>
                            <td>&mdash; Заказ получен и обрабатывается</td>
                            <?elseif ($arItem['STATUS_ID'] == 'T'):?>
                            <td width="20"><img src="/bitrix/templates/demo/images/keypad.gif" width="16" height="12" alt="" /></td>
                            <td>&mdash; Заказ обработан и ожидает отгрузки</td>
                            <?elseif ($arItem['STATUS_ID'] == 'S'):?>
                            <td width="20"><img src="/bitrix/templates/demo/images/otgruj.gif" width="16" height="12" alt="" /></td>
                            <td>&mdash; Отгружен</td>
                            <?elseif ($arItem['STATUS_ID'] == 'F'):?>
                            <td width="20"><img src="/bitrix/templates/demo/images/ispoln.gif" width="14" height="14" alt="" /></td>
                            <td><strong>&mdash; Исполнен!</strong></td>
                            <?endif?>
                        </tr>
                        </table>
                        </td>
                        <td>
                        <?if ($arItem['CANCELED'] == 'Y'):?>
                            <a href="<?=$arItem['RESTORED_URL']?>" title=""><img src="/bitrix/templates/demo/images/ispoln.gif" width="14" height="14" alt="Восстановить заказ" title="Восстановить заказ"/></a>
                            <?elseif ($arItem['STATUS_ID'] == 'N'):?>
                            <a href="" title=""><img src="/bitrix/templates/demo/images/close.gif" width="9" height="9" alt="Для отмены заказа свяжитесь с менеджером" title="Для отмены заказа свяжитесь с менеджером"/></a>
                            <?else:?>
                            <a href="" title=""><img src="/bitrix/templates/demo/images/close.gif" width="9" height="9" alt="Для отмены заказа свяжитесь с менеджером" title="Для отмены заказа свяжитесь с менеджером"/></a>
                            <?endif?>
                        </td>
                        </tr> -->
                        <?endforeach;?>
                    <!--        <tr class="basket_tovar"><td colspan="3">&nbsp;</td></tr>
                    </table>
                    <?}?>

                <?elseif($_REQUEST['message'] != 'individual'):?>
                Список заказов пуст
                <?endif?>
            -->
        </table>
    </div>
    <?}?>