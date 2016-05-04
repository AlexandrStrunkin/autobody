<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($arResult['ITEMS'])
    //echo count($arResult['ITEMS']);
    // arshow($_SESSION['OSG']['USER'])

?>
<div class="findcat">
    <table class="findtable">
        <tr>
            <th class="th0"></th>
            <th class="th1">Артикул</th>
            <th class="th2">OEM#</th>
            <th class="th4">Год</th>
            <th class="th3">Наименование</th>
            <th class="th5">Цена руб.</th>
            <th class="th6"></th>
            <th>Ожидаемое поступление</th>
        </tr>

        <?


            //сортируем массив элементов раздела используя вышеописанную функцию
            //  usort($arResult['ITEMS'], "cmpMyArray");

            foreach ($arResult['ITEMS'] as $key=>$arItem):

                $ar_res=CCatalogProduct::GetByID($arItem['ID']);
                $wh = GKCommon::GetItemsCount($arItem["CODE"]);
            ?>
            <tr class="tr1">
                <td class="td0">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="/img/find-small.png"/>
                        <?if(!strstr($arItem['PREVIEW_PICTURE'],'no_preview_picture.gif')||0):?>
                            <?=$arItem['CODE']?><br/>
                            <img src="<?=$arItem['PREVIEW_PICTURE']?>" class="showh" />
                            <?else:?>
                            <?
                                // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                                if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg")) {$img_path = "/upload/images/".$arItem['CODE'].".jpg";}
                                else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".JPG")) {$img_path = "/upload/images/".$arItem['CODE'].".JPG";}
                                else {$img_path = "/i/ico_noimg.gif"; }
                            ?>
                            <img src="<?=$img_path?>" class="showh" />
                            <?endif;?>
                    </a>
                </td>

                <td class="td1"><?=$arItem['CODE']?></td>
                <td class="td2"><?=$arItem['PROPS']['UNC']['VALUE']?></td>
                <td class="td4"><?=$arItem['PROPS']['SIZE']['VALUE']?></td>
                <td class="td3"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></td>
                <td class="td5"><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?></td>
                <td class="td6"><?if($wh["COUNT"]){?>
                        <?
                            //проверяем корзину пользователя.
                            //если текущий товар уже есть в корзине, то вместо кнопки добавления выводим соответствующее сообщение
                            $arBasketItemsIDs = array();  //массив ID товаров, которые в корзине на данный момент

                            $dbBasketItems = CSaleBasket::GetList(
                                array(
                                    "NAME" => "ASC",
                                    "ID" => "ASC"
                                ),
                                array(
                                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                                    "LID" => SITE_ID,
                                    "ORDER_ID" => "NULL"
                                ),
                                false, false,
                                array(
                                    "PRODUCT_ID"
                                )
                            );

                            while ($arItems = $dbBasketItems->Fetch())
                            {
                                //  arshow($arItems);
                                $arBasketItemsIDs[] = $arItems["PRODUCT_ID"];
                            }


                        ?>
                        <?
                            // Выведем актуальную корзину для текущего пользователя

                            $arBasketItems = array();
                            $dbBasketItems = CSaleBasket::GetList(
                                array(
                                    "NAME" => "ASC",
                                    "ID" => "ASC"
                                ),
                                array(
                                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                                    "LID" => SITE_ID,
                                    "ORDER_ID" => "NULL"
                                ),
                                false,
                                false,
                                array("ID",
                                    "CALLBACK_FUNC",
                                    "MODULE",
                                    "PRODUCT_ID",
                                    "QUANTITY",
                                    "DELAY",
                                    "CAN_BUY",
                                    "PRICE",
                                    "WEIGHT")
                            );

                            while ($arItems = $dbBasketItems->Fetch())
                            {
                                if (strlen($arItems["CALLBACK_FUNC"]) > 0)
                                {
                                    CSaleBasket::UpdatePrice($arItems["ID"],
                                        $arItems["CALLBACK_FUNC"],
                                        $arItems["MODULE"],
                                        $arItems["PRODUCT_ID"],
                                        $arItems["QUANTITY"]);
                                    $arItems = CSaleBasket::GetByID($arItems["ID"]);
                                }

                                $arBasketItems[] = $arItems;
                            }

                            $in_basket = "N";
                            foreach ($arBasketItems as $item) {
                                if ($item["PRODUCT_ID"] == $arItem["ID"]){
                                    $in_basket = "Y";
                                }
                            }

                            if ($in_basket == "N") {
                            ?>
                            <a onclick="showcatdet('<?=$arItem["ID"]?>')" href="javascript:void(0)"><span style="color:Green;">КУПИТЬ</span></a>
                            <?} else {?>
                            <span style="color:Mediumseagreen; ">Уже в корзине</span>
                            <?}?>


                        <?} else {?> <span style="color:Red; ">Нет в наличии</span><?}?>
                    <br><a href="<?=$arItem['COMPARE_URL']?>" target="_self"><span style="color:LightSkyBlue; ">Сравнить</span></a>

                    <?
                        $item_quantity = GKCommon::GetItemsCountForWarehouse(GKCommon::GetSavedWarehouse(),$arItem['CODE']);
                        // arshow ($item_quantity);
                        //в инпут выше нужно вывести количество товара на текущем складе
                    ?>

                    <input type="hidden" id="name<?=$arItem["ID"]?>" value="<?=$arItem['NAME']?>">
                    <input type="hidden" id="price<?=$arItem["ID"]?>" value="<?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], $arItem['PRICE']['CURRENCY'], "RUR");?>">
                    <input type="hidden" id="atricul<?=$arItem["ID"]?>" value="<?=$arItem['CODE']?>">
                    <input type="hidden" id="year<?=$arItem["ID"]?>" value="<?=$arItem['PROPS']['SIZE']['VALUE']?>">
                    <input type="hidden" id="quantity<?=$arItem["ID"]?>" value="<?=$item_quantity["COUNT"]?>">

                </td>
                <td class="td7">
                    <?
                        //получаем дату доставки
                        $item_info = "";
                        $item_info = GKCommon::GetItemInfo($arItem['CODE']);
                    ?>
                    <?=$item_info["supply_date"]?>
                    <? if (strpos($APPLICATION->GetCurPage(),"notebook.php")) {?><br>
                        <a href="?action=del_from_notebook&id=<?=$arItem['ID']?>" title="удалить товар из блокнота"><img src="/i/close.gif"></a>
                        <?}?>
                </td>
            </tr>




            <?endforeach;?>




    </table>

    <? if (strpos($APPLICATION->GetCurPage(),"notebook.php")) {?><br>
        <a href="?action=clear_notebook" title="удалить товар из блокнота">Очистить блокнот</a>
        <?}?>

    <?//arshow($arParams)?>

    <?$APPLICATION->IncludeFile("page_nav_grid.php", Array('ON_PAGE'=>$arParams['ON_PAGE'], 'TOTAL'=>$arResult['TOTAL']));?>

    <div class="count" style="display: none;">

        <div class="pagesall">Количество товаров на странице</div>
        <div class="allpages">
            <a href="/catalog/index.php?pgsize=25" <?if($_GET["pgsize"]==25) {?> class="active" <?}?>><span>25</span></a>
            <a href="/catalog/index.php?pgsize=50" <?if($_GET["pgsize"]==50) {?> class="active" <?}?>><span>50</span></a>
            <a href="/catalog/index.php?pgsize=100" <?if($_GET["pgsize"]==100) {?> class="active" <?}?>><span>100</span></a>
        </div>
    </div>



    <?/* <div class="nalich">Выводить товары, которые <a href="/index.php?status=1">есть в наличии</a></div>   */?>
</div>


<script>
    function showcatdet(ID)
    {
        $("#qw").attr("value","1");
        $("#idm").val(ID);
        $("#catnamem").html($("#name"+ID).val());
        $("#catpricem").html($("#price"+ID).val());
        $("#catartm").html($("#atricul"+ID).val());
        $("#catyearm").html($("#year"+ID).val());
        $("#catqwm").html($("#quantity"+ID).val());
        $('#dialog').jqmShow();
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

        <input type="hidden" name="action" value="add_basket_item"/>
        <input type="hidden" name="id" id="idm" value=""/>
        <input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>"/>
        <input type="hidden" name="page" value="<?=htmlspecialcharsbx($_REQUEST['page'])?>"/>

        <div class="modtitle">Добавление товара в корзину</div>
        <table>
            <tr class="begin white">
                <td>Вы выбрали:</td>
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
                <?
                    $whss = GKCommon::GetWarehouses();
                    //arshow($_SESSION);
                    //получаем имя текущего склада
                    foreach($whss as $whs){

                        if ($whs["ID"] == $_SESSION["OSG"]["GKWH"] or $whs["ID"] == $_SESSION["GKWH"]) {
                            //  arshow($whs);
                            $WH_NAME = $whs["TITLE"];
                        }
                    }
                ?>
                <td><?=$WH_NAME?></td>
            </tr>
            <tr>
                <td>Количество, шт.</td>
                <td>
                    <span style="display: none;" id="catqwm"></span>
                    <input type="button" class="minus" value="-" onClick="if (Number($('#qw').val())>1){$('#qw').val(Number($('#qw').val())-1);}" />
                    <input type="text" name="quantity" class="small" id="qw" value="1" onkeyup="if($(this).attr('value')<=0) this.value=1 return false; if($(this).attr('value')>Number($('#catqwm').val())) {alert('Такого кол-ва товара нет на складе'); this.value=Number($('#catqwm').html()); }" />
                    <input type="button" class="plus" value="+" onClick="if (Number($('#qw').val())<Number($('#catqwm').html()))$('#qw').val(Number($('#qw').val())+1);"/>
                </td>
            </tr>
            <tr>
                <td class="tdul">В наличии на складе<br/>
                    <?/*
                        <ul>
                        <li>Дмитровка</li>
                        <li>Печатники </li>
                        <li>Санкт-Петербург</li>
                        </ul>      */
                    ?>
                </td>
                <td style="text-align:center;">
                    <a href="javascript:document.addbaskmod.submit();" class="modalsave">Добавить</a>
                </td>

            </tr>

        </table>

    </form>
</div>




