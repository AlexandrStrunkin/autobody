<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($_SESSION);?>
<? //echo '<div style="color:black"><pre>'; print_r($arResult); echo '</pre></div>';?>
<? $arItem['ID'] = $arResult['ITEM']['ID'];?>
<link href="/css/shadowbox.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/shadowbox.js"></script>
<script>
    $(document).ready(function(){
            Shadowbox.init({
                    displayCounter: false,
                    fadeDuration: 0.1,
                    resizeDuration: 0.1,
                    viewportPadding: 0
            });





    })

    function get_cur_q(item) {
        var cur_q = $("#qw").attr("value");
        //alert("<?=$APPLICATION->GetCurPage()?>?action=add_basket_item&id=<?=$arItem['ID']?>&item_id=<?=$arItem['ID']?>&quantity=" + cur_q);

        document.location.href = "<?=$APPLICATION->GetCurPage()?>?action=add_basket_item&id=<?=$arItem['ID']?>&item_id=<?=$arItem['ID']?>&quantity=" + cur_q;
    }
</script>

<?//arshow($arResult)?>
<div class="name"><?=$arResult['ITEM']["NAME"]?></div>
<div class="warring">ВНИМАНИЕ! Цена в каталоге указана — ОПТОВАЯ. Розничные цены на 50 % выше.<br/>
    Оптовые цены только для ОПТОВЫХ покупателей, зарегистрированных и имеющих клиентский номер. Зарегистрироваться
    можно <a href="/personal/">здесь</a>.
</div>
<div class="printt"><a onclick="item_print();" href="#">Распечатать карточку товара</a></div>


<form id="main_form" method="POST" action="?item_id=<?=$arResult['ITEM']['ID']?>">
    <input type="hidden" name="basket_action" value="add">
    <input type="hidden" name="price_id">
    <table>
        <tr>

            <td class="bt1">
                <?
                    // echo $_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arItem['CODE'].".jpg<br>";
                    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arResult['ITEM']['CODE'].".jpg")) {$img_path = "/upload/images/".$arResult['ITEM']['CODE'].".jpg";}
                    else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/images/".$arResult['ITEM']['CODE'].".JPG")) {$img_path = "/upload/images/".$arResult['ITEM']['CODE'].".JPG";}
                    else {$img_path = $arResult["ITEM"]["DETAIL_PICTURE"]; }
                ?>
                <img class="detimg" src="<?=$img_path;?>" />
                <div class="ownfoto"><a href="/ajax/new_foto.php?art=<?=$arResult['ITEM']['CODE']?>" rel="shadowbox;height=300;width=500">Предложить свое фото</a></div>
                <div class="noteadd"><a href="<?=$APPLICATION->GetCurPage()?>?action=delay_item&id=<?=$arItem['ID']?>&item_id=<?=$arItem['ID']?>">Добавить в блокнот</a></div>

                <div><?=$arResult["PREVIEW_TEXT"];?><div>
            </td>
            <td>
                <table>
                    <tr class="tr1">
                        <td>Артикул</td>
                        <td><?=$arResult['ITEM']['CODE']?></td>
                    </tr>
                    <?if ($val = $arResult['ITEM']['PROPS']['UNC']['VALUE']):?>
                        <tr class="tr2">
                            <td>ОЕМ#</td>
                            <td><?=$val?></td>
                        </tr>
                        <?endif?>
                    <?if ($val = $arResult['ITEM']['PROPS']['COUNTRY']['VALUE']):?>
                        <tr class="tr1">
                            <td>№ производителя</td>
                            <td><?=$val?></td>
                        </tr>
                        <?endif?>

                    <?if ($val = $arResult['ITEM']['PROPS']['SIZE']['VALUE']):?>
                        <tr class="tr2">
                            <td>Год</td>
                            <td><?=$val;?></td>
                        </tr>
                        <?endif?>

                    <tr class="tr1">
                        <td>Группа</td>
                        <td><a href="<?=$arResult['SECTION']['URL']?>"> <?=$arResult['SECTION']['NAME']?></td>
                    </tr>

                </table>

                <?
                    //arShow($arResult["PRICE_VARIANTS"][0]["VALUES"][0]);
                ?>


                <div class="priceall">
                    <div class="yourpr">Ваша цена</div>
                    <div class="price" id="price_item"><?=CCurrencyRates::ConvertCurrency($arResult["PRICE_VARIANTS"][0]["VALUES"][0]["PRICE"], $arResult["PRICE_VARIANTS"][0]["VALUES"][0]["CURRENCY"], "RUR");?> руб.</div>

                </div>
                <div class="ratingg">
                    <?if(!GetMaxMark($arItem['ID'])) $valr=0; else $valr=GetMaxMark($arItem['ID']);?>
                    <div id="star1" class="rating"></div>
                    <?
                        if($USER->IsAuthorized()){
                            $Out='';
                            $star_red1='<a href="/catalog/item.php?action=add_mark&mark=1&item_id='.$arItem['ID'].'"><img src="/i/starsbigy.png" width="16" height="16" border="0" /></a>';

                            $star_red2='<a href="/catalog/item.php?action=add_mark&mark=2&item_id='.$arItem['ID'].'"><img src="/i/starsbigy.png" width="16" height="16" border="0" /></a>';

                            $star_red3='<a href="/catalog/item.php?action=add_mark&mark=3&item_id='.$arItem['ID'].'"><img src="/i/starsbigy.png" width="16" height="16" border="0" /></a>';

                            $star_red4='<a href="/catalog/item.php?action=add_mark&mark=4&item_id='.$arItem['ID'].'"><img src="/i/starsbigy.png" width="16" height="16" border="0" /></a>';

                            $star_red5='<a href="/catalog/item.php?action=add_mark&mark=5&item_id='.$arItem['ID'].'"><img src="/i/starsbigy.png" width="16" height="16" border="0" /></a>';


                            $star_gray1='<a href="/catalog/item.php?action=add_mark&mark=1&item_id='.$arItem['ID'].'"><img src="/i/starsbigg.png" width="16" height="16" border="0" /></a>';

                            $star_gray2='<a href="/catalog/item.php?action=add_mark&mark=2&item_id='.$arItem['ID'].'"><img src="/i/starsbigg.png" width="16" height="16" border="0" /></a>';

                            $star_gray3='<a href="/catalog/item.php?action=add_mark&mark=3&item_id='.$arItem['ID'].'"><img src="/i/starsbigg.png" width="16" height="16" border="0" /></a>';

                            $star_gray4='<a href="/catalog/item.php?action=add_mark&mark=4&item_id='.$arItem['ID'].'"><img src="/i/starsbigg.png" width="16" height="16" border="0" /></a>';

                            $star_gray5='<a href="/catalog/item.php?action=add_mark&mark=5&item_id='.$arItem['ID'].'"><img src="/i/starsbigg.png" width="16" height="16" border="0" /></a>';


                            switch(GetMaxMark($arItem['ID'])){
                                case "1":
                                    $Out.=$star_red1.$star_gray2.$star_gray3.$star_gray4.$star_gray5;
                                    break;
                                case "2":
                                    $Out.=$star_red1.$star_red2.$star_gray3.$star_gray4.$star_gray5;
                                    break;
                                case "3":
                                    $Out.=$star_red1.$star_red2.$star_red3.$star_gray4.$star_gray5;
                                    break;
                                case "4":
                                    $Out.=$star_red1.$star_red2.$star_red3.$star_red4.$star_gray5;
                                    break;
                                case "5":
                                    $Out.=$star_red1.$star_red2.$star_red3.$star_red4.$star_red5;
                                    break;
                                default:
                                    $Out.=$star_gray1.$star_gray2.$star_gray3.$star_gray4.$star_gray5;
                                    break;
                            }

                        }else{

                            $Out='';
                            $star_red='<img src="/i/starsbigy.png" width="16" height="16" border="0" />';

                            $star_gray='<img src="/i/starsbigg.png" width="16" height="16" border="0" />';

                            switch(GetMaxMark($arItem['ID'])){
                                case "1":
                                    $Out.=$star_red.$star_gray.$star_gray.$star_gray.$star_gray;
                                    break;
                                case "2":
                                    $Out.=$star_red.$star_red.$star_gray.$star_gray.$star_gray;
                                    break;
                                case "3":
                                    $Out.=$star_red.$star_red.$star_red.$star_gray.$star_gray;
                                    break;
                                case "4":
                                    $Out.=$star_red.$star_red.$star_red.$star_red.$star_gray;
                                    break;
                                case "5":
                                    $Out.=$star_red.$star_red.$star_red.$star_red.$star_red;
                                    break;
                                default:
                                    $Out.=$star_gray.$star_gray.$star_gray.$star_gray.$star_gray;
                                    break;
                            }
                        }

                        echo $Out;?></script>

                    <div class="endprice">Рейтинг: <?=GetMaxMark($arItem['ID']);?></div>
                </div>

                 <?//получаем количество на текущем складе
                 $item_quantity = GKCommon::GetItemsCountForWarehouse(GKCommon::GetSavedWarehouse(),$arResult['ITEM']['CODE']);
                 ?>

                <div class="tovcall">
                <input type="hidden" id="catqwm" value="<?=$item_quantity["COUNT"]?>">
                    Количество товара, шт.
                    <img src="/i/minus.png" onClick="if (Number($('#qw').val())>1){$('#qw').val(Number($('#qw').val())-1);}set_prices();" />
                    <input type="text" name="quantity" id="qw" disabled value="<?=($_REQUEST['quantity']) ? $_REQUEST['quantity'] : 1?>" onkeyup="set_prices(); if($(this).attr('value')<=0) this.value=1; else if($(this).attr('value')>Number($('#catqwm').val())) { this.value=Number($('#catqwm').html()); } set_prices();"/>
                    <img src="/i/plus.png" onClick="if (Number($('#qw').val())<Number($('#catqwm').val()))$('#qw').val(Number($('#qw').val())+1);set_prices(); " />
                </div>



                <div class="error">
                    Введенное значение превышает количество товара имеющееся на складе.
                </div>

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

                <div class="buts">
                    <?
                        //проверяем наличие детали по всем складам, если есть на текущем складе - выводим кнопку в корзину
                        $counter = 0;
                        $whss = GKCommon::GetWarehouses();
                        $final_count = "no";
                        foreach($whss as $whs){
                            //arshow($_SESSION);
                            $counter++;
                            $icount = GKCommon::GetItemsCountForWarehouse($whs["ID"], $arResult['ITEM']['CODE']);
                            if($icount["COUNT"] && ($whs["ID"] == $_SESSION["OSG"]["GKWH"] or $whs["ID"] == $_SESSION["GKWH"])){
                                $final_count = "yes"; break;
                            }else{}
                        }


                        if ($final_count == "yes") {
                            if (in_array($arResult['ITEM']["ID"], $arBasketItemsIDs)) {?>
                            <div class="active" style="color:red; float:left; height:30px; padding-top:5px; margin:0 5px 0 0">Уже в корзине</div>
                            <?} else {?>
                            <a class="inbasket active" href="javascript:get_cur_q()" >В корзину</a>
                            <?}?>
                        <?}?>

                    <a class="addtocompare" href="<?=$arResult["ITEM"]['COMPARE_URL']?>">Добавить к сравнению</a>
                </div>

                <div class="sclad">
                    <div class="name">Наличие на складах</div>
                    <table>
                        <?
                            $counter = 0;
                            $whss = GKCommon::GetWarehouses();
                            foreach($whss as $whs){
                                $counter++;
                                $icount = GKCommon::GetItemsCountForWarehouse($whs["ID"], $arResult['ITEM']['CODE']);
                            ?>
                            <tr class="tr1">
                                <td><?=$whs["TITLE"]?></td>
                                <td>
                                    <?
                                        if($icount["COUNT"]){

                                            echo "В наличии";
                                        }else{
                                            echo "Нет в наличии";
                                        }
                                ?></td>
                            </tr>
                            <?
                            }
                        ?>
                    </table>
                </div>
            </td>
        </tr>
    </table>

</form>

<div class="reviews">
    <div class="name">Отзывы</div>
    <?if ($USER->isAuthorized()) {?>
        <?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "review_add", array(
                    "IBLOCK_TYPE" => "info",
                    "IBLOCK_ID" => "97",
                    "STATUS_NEW" => "2",
                    "LIST_URL" => "",
                    "USE_CAPTCHA" => "N",
                    "USER_MESSAGE_EDIT" => "",
                    "USER_MESSAGE_ADD" => "Ваш отзыв добавлен, спасибо! После проверки он будет опубликован.",
                    "DEFAULT_INPUT_SIZE" => "30",
                    "RESIZE_IMAGES" => "N",
                    "PROPERTY_CODES" => array(
                        0 => "NAME",
                        1 => "344",
                        2 => "342",
                        3 => "343",
                    ),
                    "PROPERTY_CODES_REQUIRED" => array(
                        0 => "NAME",
                        1 => "344",
                    ),
                    "GROUPS" => array(
                        0 => "2",
                    ),
                    "STATUS" => array(
                    ),
                    "ELEMENT_ASSOC" => "CREATED_BY",
                    "MAX_USER_ENTRIES" => "100000",
                    "MAX_LEVELS" => "100000",
                    "LEVEL_LAST" => "Y",
                    "MAX_FILE_SIZE" => "0",
                    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                    "SEF_MODE" => "N",
                    "SEF_FOLDER" => "/",
                    "CUSTOM_TITLE_NAME" => "Ваше имя",
                    "CUSTOM_TITLE_TAGS" => "",
                    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                    "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                    "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                    "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                    "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                    "CUSTOM_TITLE_DETAIL_TEXT" => "",
                    "CUSTOM_TITLE_DETAIL_PICTURE" => ""
                ),
                false
            );?>
        <hr>
        <?}?>
</div>



<?
    $review_list = CIBlockElement::GetList(Array(),array("IBLOCK_ID"=>97,"PROPERTY_PRODUCT"=>$_GET["item_id"],"ACTIVE"=>"Y"),false,false,Array("IBLOCK_ID","NAME","PROPERTY_TEXT","PROPERTY_TEMPER","PROPERTY_PRODUCT"));
    while ($review = $review_list->Fetch()) {?>
    <?//arshow($review)?>
    <h3 style="font-size:16px; font-weight: bold;"><?=$review["NAME"]?></h3>
    <p>Характер: <b><?=$review["PROPERTY_TEMPER_VALUE"]?></b><br>
        <i> - <?=$review["PROPERTY_TEXT_VALUE"]?></i>
    </p>
    <hr>
    <?}?>


<? /*
    <div class="reviews">
    <div class="name">Отзывы</div>
    <form action="<?=$APPLICATION->GetCurPageParam('action=get_comment', array('action'))?>" method="POST" name="addrew" id="review_form">
    <div class="write">
    <div class="wrreviewstitle">Оставить отзыв о товаре</div>
    <table>
    <tr>
    <td class="rev1td">Ваше имя</td>
    <td>Характер мнения</td>
    </tr>
    <tr>
    <td class="rev1td"><input type="text" class="revname" name="usname"/></td>
    <td>
    <input type="radio" name="my_mark" value="1" class="har" id="har1"/> <label for="har1" class="lhar1">Положительный</label>
    <input type="radio" name="my_mark" value="2" class="har" id="har2"/> <label for="har2" class="lhar2">Нейтральный</label>
    <input type="radio" name="my_mark" value="3" class="har" id="har3"/> <label for="har3" class="lhar3">Отрицательный</label>
    </td>
    </tr>
    <tr>
    <td class="rev1td" id="revr">Текст отзыва</td>
    <td></td>
    </tr>
    <tr>
    <td colspan="2">
    <textarea class="revtext" name="my_comment">
    </textarea>
    </td>
    </tr>
    <tr>
    <td  colspan="2">
    <a href="javascript:document.addrew.submit();" class="sendweva jqModal"><div class="sendwev"><span>Отправить</span></div></a>
    <a href="javascript:document.addrew.resert();" class="sendweva"><div class="sendwev"><span>Отменить</span></div></a>
    </td>
    </tr>
    </table>

    </div>
    </form>
    <?
    $arFilter = Array(
    "IBLOCK_CODE"=>"COMMENT",
    "PROPERTY_PRODUCT"=>$arResult['ITEM']['ID'],
    "ACTIVE"=>"Y"
    );
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter,false);
    $count_answ=0;
    $count_one=0;
    $count_two=0;
    $count_three=0;
    while($ar_fields = $res->GetNext())
    {

    $db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc",Array("CODE"=>"MARK","PRODUCT"=>$arResult['ITEM']['ID']));
    if($ar_props = $db_props->Fetch()){
    $mark=$ar_props['VALUE'];
    switch($mark){
    case "1": $count_one++;
    break;
    case "2": $count_two++;
    break;
    case "3": $count_three++;
    break;
    }
    }

    $count_answ++;
    }
    ?>
    <?

    function GetMonthName($id){
    $text=array("январь","февраль","март","апрель","май","июнь","июль","август","сентябрь","октябрь","ноябрь","декабрь");
    return $text[($id-1)];
    }?>
    <div class="all">
    <?
    $arFilter = Array(
    "IBLOCK_CODE"=>"COMMENT",
    "PROPERTY_PRODUCT"=>$arResult['ITEM']['ID'],
    "ACTIVE"=>"Y"
    );
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter,false);
    while($ar_fields = $res->GetNext())
    {

    $date=explode(' ',$ar_fields['DATE_CREATE']);
    $mydate=explode('.',$date[0]);
    $month=GetMonthName($mydate[1]);


    $db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc",Array("CODE"=>"MARK","PRODUCT"=>$arResult['ITEM']['ID']));
    if($ar_props = $db_props->Fetch()){

    $mark=$ar_props['VALUE'];
    }

    $db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc",Array("CODE"=>"USER","PRODUCT"=>$arResult['ITEM']['ID']));
    while($ar_props = $db_props->GetNext()){

    $user_com=$ar_props['VALUE'];
    }

    $rsUser = CUser::GetByID($user_com);
    $arUser = $rsUser->Fetch();

    $city=$arUser['PERSONAL_CITY'];

    switch($mark){
    case "1": $mark_str='<div class="har1">Положительный</div>';
    break;
    case "2": $mark_str='<div class="har2">Нейтральный</div>';
    break;
    case "3": $mark_str='<div class="har3">Отрицательный</div>';
    break;
    }

    echo '
    <div class="revel">
    <div class="nameel">'.$ar_fields['NAME'].'</div>
    <div class="text">'.$ar_fields['PREVIEW_TEXT'].'</div>
    <div class="har1">'.$mark_str.'</div>
    </div>
    ';
    }
    ?>
    </div>
    </div>

*/?>
<script>
    function show_tab(tab_name){

        tabs_arr = new Array('reviews', 'all_reviews', 'add_review');

        for (var i in tabs_arr){

            var name = tabs_arr[i];

            if (tab_name == name){

                //    document.getElementById(name).style.display = '';
                //    document.getElementById(name).className = 'active';
                $('#'+name).css('display','');
                $('#'+name).attr('class','active');


            }else{

                //    document.getElementById(name).style.display = 'none';
                //    document.getElementById(name).className = '';
                $('#'+name).css('display','none');
                $('#'+name).attr('class','');

            }

        }

    }

    //show_tab('reviews');


    function item_print(){
        window.open("item_print.php?item_id=<?=$arResult['ITEM']['ID']?>","","status=no, scrollbars=no, resizable=yes, location=no, width=800, height=600");
    }

    PHOTOGALLERY = new Array;
    <?foreach ($arResult['PHOTOGALLERY'] as $N=>$PATH):?>
        PHOTOGALLERY[<?=$N?>] = '<?=$PATH?>';
        <?endforeach;?>

    function set_main_image(number){
        document.getElementById('main_image').src = PHOTOGALLERY[number];
        <?if (count($arResult['PHOTOGALLERY']) > 1):?>
            for (N in PHOTOGALLERY){
                if (N==number){
                    document.getElementById('photo_nav_'+N).style.color = 'red';
                }else{
                    document.getElementById('photo_nav_'+N).style.color = 'black';
                }
            }
            <?endif?>
    }
    //set_main_image(1);

    PRICE_VARIANTS = new Array;
    PRICE_VARIANTS['PRICING_PROPS'] = new Array;
    PRICE_VARIANTS['VALUES'] = new Array;
    PRICE_VARIANTS['MAX_QUANTITY'] = new Array;

    <?foreach ($arResult['PRICE_VARIANTS'] as $arPrices):?>
        PRICE_VARIANTS['MAX_QUANTITY'][<?=$arPrices['PRODUCT_ID']?>] = <?=$arPrices['MAX_QUANTITY']?>;
        PRICE_VARIANTS['PRICING_PROPS'][<?=$arPrices['PRODUCT_ID']?>] = new Array;
        <?foreach ($arPrices['PRICING_PROPS'] as $CODE=>$VAL):?>
            PRICE_VARIANTS['PRICING_PROPS'][<?=$arPrices['PRODUCT_ID']?>]['<?=$CODE?>'] = <?=$VAL?>;
            <?endforeach;?>

        PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>] = new Array;
        <?foreach ($arPrices['VALUES'] as $N=>$arr):?>
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>] = new Array;
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>]['MIN_QUANTITY'] = <?=$arr['MIN_QUANTITY']?>;
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>]['PRICE'] = <?=CCurrencyRates::ConvertCurrency($arr['PRICE'], "USD", "RUR")?>;
            PRICE_VARIANTS['VALUES'][<?=$arPrices['PRODUCT_ID']?>][<?=$N?>]['PRICE_ID'] = <?=$arr['PRICE_ID']?>;
            <?endforeach;?>
        <?endforeach;?>



    function set_prices(){
        $(".error").css("display", "none");
        PROPS = new Array;
        if($('#osg_pricing_prop').attr('name'))
            PROPS[$('#osg_pricing_prop').attr('name')] = $('#osg_pricing_prop').attr('value');

        var WANTED_PRODUCT_ID = 0;

        for (var PRODUCT_ID in PRICE_VARIANTS['PRICING_PROPS']){
            var flag = true;
            for (var PROP_CODE in PRICE_VARIANTS['PRICING_PROPS'][PRODUCT_ID]){
                if (PRICE_VARIANTS['PRICING_PROPS'][PRODUCT_ID][PROP_CODE] != PROPS[PROP_CODE]){
                    flag = false;
                }
            }
            //alert('flag = '+flag);
            if (flag){
                WANTED_PRODUCT_ID = PRODUCT_ID;
                //alert('* '+PRODUCT_ID);
                if(PRODUCT_ID>0) break;
            }
        }

        //alert('select = '+WANTED_PRODUCT_ID);
        //WANTED_PRODUCT_ID = 13;

        var QUANTITY =  Number(document.forms['main_form'].elements['quantity'].value);

        if (!QUANTITY) QUANTITY = 1;

        var MAX_QUANTITY = Number(PRICE_VARIANTS['MAX_QUANTITY'][WANTED_PRODUCT_ID]);

        for (var PRICE_NUMBER in PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID]){
            if (QUANTITY >= PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID][PRICE_NUMBER]['MIN_QUANTITY']){
                var PRICE_ITEM = PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID][PRICE_NUMBER]['PRICE'];
                var PRICE_ID = PRICE_VARIANTS['VALUES'][WANTED_PRODUCT_ID][PRICE_NUMBER]['PRICE_ID'];
            }
        }

        var PRICE_TOTAL = PRICE_ITEM*QUANTITY;
        //alert(PRICE_TOTAL);

        //document.forms['main_form'].elements['quantity'].value = QUANTITY;

        /*document.getElementById('price_item').innerHTML = PRICE_ITEM.toFixed(2);
        document.getElementById('price_total').innerHTML = PRICE_TOTAL.toFixed(2);
        document.forms['main_form'].elements['price_id'].value = PRICE_ID;*/
        //alert("<?=$arParams['NO_LIMIT']?>");
        <?if ($arParams['NO_LIMIT'] != 'Y'):?>
            if (QUANTITY>MAX_QUANTITY){
                if(MAX_QUANTITY>0) $(".error").css("display", "block");
                //  document.forms['main_form'].elements['submit'].disabled = true;
            }else{
                //alert(123);
                //    document.forms['main_form'].elements['submit'].disabled = '';
            }
            <?endif?>

        <?if (!$arResult['ITEM']['PROPS']['STATUS']['VALUE']):?>
            //  document.forms['main_form'].elements['submit'].disabled = true;
            <?endif?>
    }

    set_prices();
</script>