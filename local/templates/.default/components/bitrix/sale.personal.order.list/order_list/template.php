<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.overlay_orders {
width:100%;
    height:100%;
    display:block;
    position:fixed;
    top:0;
    left:0;
    opacity:0.5;
    background:#000;
    z-index:1000;
}
.entities_title {
    margin-left:17%;
}
#entities_form input[type='radio'] {
    opacity:1 !important;
}
#entities_form {
    width:300px;
    z-index:1001;
    position:absolute;
    padding:20px;
    left:420px;
    top:562px;
    display:block;
    background:#fff;
    border:1px solid #929292;
}
.proceeding_button {
    background-color: #1AA1C8;
  width: 97px;
  height: 40px;
  border: none;
  color: white;
  font-size: 13px;
  font-family: 'clear_sansbold';
  cursor: pointer;
  margin-left: 95px;
  margin-top:25px;
  display: block;
  float: left;
  line-height: 28px;
  text-align: center;
}
.close_ent_form {
    position:absolute;
    right:8px;
    top:3px;
    cursor:pointer;
}

</style>
<div class="overlay_orders" style="display:none;"></div> 
<div class="order">
    <script type="text/javascript">
        $(function(){
            $(".name").click(function(e){
                if ($(this).siblings(".order-info").css("display") == "none") {
                    $(this).siblings(".order-info").slideDown();
                    $(this).siblings(".showMoreOrders").css('display','block');
                    $(this).addClass('active-name');
                }
                else {
                    $(this).siblings(".order-info").slideUp();
                    $(this).siblings(".showMoreOrders").css('display','none');
                    $(this).removeClass('active-name');
                }  
            });
            $(".logo-button").click(function(e){
                if ($(".lk-small-basket").css("display") == "none") {
                    $(".lk-small-basket").slideDown();
                    $(".logo-button").attr("src", "/images/active-small-basket.png")
                    $(".header-red-button").css("background-color", "#00384D");

                }
                else {
                    $(".lk-small-basket").slideUp();
                    $(".logo-button").attr("src", "/images/red-button.png");
                    $(".header-red-button").css("background-color", "#ED252E");

                }  
            });

            $('.showMoreOrders').click(function(e){
                e.preventDefault();
                <?if(!empty($_GET["warehouse_order"])):?>
                    var warehouse_order = <?=$_GET["warehouse_order"].";";
                    else:?>
                    var warehouse_order = "";
                    <?endif;
                    if(!empty($_GET["status_order"])):?>
                    var status_order = <?=$_GET["status_order"].";";
                    else:?>
                    var status_order = "";
                    <?endif;
                    if(!empty($_GET["delivery_order"])):?>
                    var delivery_order = <?=$_GET["delivery_order"];?>;
                    <? else:?>
                    var delivery_order = "";
                    <?endif;
                    if(!empty($_GET["date_order_from"])):?>
                    var date_order_from = "<?=$_GET["date_order_from"];?>";
                    <?else:?>
                    var date_order_from = "";
                    <?endif;
                    if(!empty($_GET["date_order_to"])):?>
                    var date_order_to = "<?=$_GET["date_order_to"];?>";
                    <? else:?>
                    var date_order_to = "";
                    <?endif;
                    if(!empty($_GET["order_number_from"])):?>
                    var order_number_from = <?=$_GET["order_number_from"].";";
                    else:?>
                    var order_number_from = "";
                    <?endif;
                    if(!empty($_GET["order_number_to"])):?>
                    var order_number_to = <?=$_GET["order_number_to"].";";
                    else:?>
                    var order_number_to = "";
                    <?endif;?>               
                
                target = e.currentTarget;
               // alert($(target).closest(".order-cabinet").find(".order-info:nth-last-child(3)").data("itemid"));
                $.ajax ({     
                    type: "POST",
                    dataType: 'html',
                    url: '/ajax/showMoreOrders.php',
                    data: {last_id:$(target).closest(".order-cabinet").find(".order-info:nth-last-child(3)").data("itemid"), warehouse_order:warehouse_order, status_order:status_order, delivery_order:delivery_order,
                        date_order_from:date_order_from,date_order_to:date_order_to,order_number_from:order_number_from,order_number_to:order_number_to

                    },
                    cache: false,
                    success: function(data) {    
                        $(target).before(data);
                        var newItems = (data.match(/order-info/g) || []).length;
                        if(newItems < 10 || $(".order-info").length==30){
                            $('.showMoreOrders').css('display','none'); 
                        }
                    }
                });  
            })

        });





        $(document).ready(function(){

            // $(".order_select").text($(".order_option > span:first-child").text());  

            // var month = array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь")ж

            /*$(".url-basket").hover(
            function(){
            $(this).parent().prev("td").children(".forward_catalog_new_nofoto").css("background","url(/i/nofoto-active.png) no-repeat center center");
            },
            function(){
            $(this).parent().prev("td").children(".forward_catalog_new_nofoto").css("background","url(/i/nofoto.png) no-repeat center center");
            }    
            )*/

            $(".order-cabinet").on('click','.title',function(e){

                if ($(this).siblings(".more").css("display") == "none") {
                    $(this).parent(".order-info").addClass("active_order_info");
                    $(this).parent(".order-info").prev(".order-info").css("border-bottom","1px solid #e61420");
                    $(this).siblings(".more").slideDown(200);
                    $(this).addClass('active-order');
                    //   $(this).siblings(".active-order-tail").slideDown();

                }
                else {
                    $(this).parent(".order-info").removeClass("active_order_info");
                    $(this).parent(".order-info").prev(".order-info").css("border-bottom","1px solid #e6e6e6");
                    $(this).siblings(".more").slideUp(200);
                    //$(this).siblings(".active-order-tail").slideUp();
                    $(this).removeClass('active-order');
                    $(this).siblings(".active-order-tail").css("display", "none");

                }  
            });



            $(".order_select").click(function(){


                if($(this).siblings(".order_option").css("display")=="none"){
                    $(".order_select").removeClass("select_active");
                    $(".order_option").hide();
                    $(this).siblings(".order_option").css("display","block"); 
                    $(this).addClass("select_active"); 


                }
                else{
                    $(this).siblings(".order_option").css("display","none"); 
                    $(this).removeClass("select_active"); 
                }
            })
                    // выбор типа доставки в зависимости от выбранного склада
            $(".order_option > span").click(function(){
                var text=$(this).text();
                var id=$(this).attr("rel");
                var wh_id = $(this).attr("wh_id");

                $.post('/ajax/get_delivery.php',{wh_id:wh_id},function(data){
                    var wh = data.split(',');
                    $('#delivery_list span').hide();
                    for(var i=0; i<wh.length; i++) {
                       $('#delivery_list span[rel='+wh[i]+']').show(); 
                    }

                })
//--------------------------------

                var default_text =  $(this).parent().siblings(".order_select").text();
                $(this).parent().siblings(".order_select").attr("name", default_text);

                $(this).parent().siblings(".order_select").text(text);

                $(this).parent().siblings(".order_search_hidden").val(id);
                $(this).parent().siblings(".order_select").removeClass("select_active");
                $(this).parent().css("display","none");
                
            })
            
            
            $(".order_option_sklad > span").click(function(){
                $('.delivery_select').css('display', 'block');
                $('.hide_dos').css('display', 'block');
                $('#bottom_search').css('margin-left', '27px');
                
            })    
                
            $(".clear_form").click(function(){
                document.location.href="<?=$APPLICATION->GetCurPage()?>"
            });

            /*   $('.order_date').mask('DD.MM.YYYY',{'translation': {
            D: {pattern: /[0-31]/}, 
            M: {pattern: /[0-12]/},  
            Y: {pattern: /[0-9]/}
            }
            });*/

        });



    </script>




    
    <?if(!empty($arResult['ERRORS']['FATAL'])):?>

        <?foreach($arResult['ERRORS']['FATAL'] as $error):?>
            <?=ShowError($error)?>
            <?endforeach?>

        <?else:?>

        <?if(!empty($arResult['ERRORS']['NONFATAL'])):?>

            <?foreach($arResult['ERRORS']['NONFATAL'] as $error):?>
                <?=ShowError($error)?>
                <?endforeach?>

            <?endif?>

    <? //функция для сортировки массива 

        $warehouses=array();
        $store_list_res = CCatalogStore::GetList(array(), array(), false, false, array());   
        while($store_list_ob = $store_list_res -> Fetch()):

            $warehouses[$store_list_ob["ID"]]=$store_list_ob["TITLE"];

            endwhile;  
            
           // arShow($warehouse);

        //получает статусы

        $orders=array();
        $arFilter = array();
        if ( checkSite()=="retail" && $USER->IsAuthorized() ) {
            $arFilter=Array("PROPERTY_VAL_BY_CODE_USER_ID"=>$USER->GetId());
        }
        else {
            $arFilter["USER_ID"] = $USER->GetId();    
        }

        if (!empty($_GET["warehouse_order"])):
            $arFilter["PROPERTY_VAL_BY_CODE_ROOM_NUMBER"]=$_GET["warehouse_order"];
            endif;

        if (!empty($_GET["status_order"])):
            $arFilter["STATUS_ID"]=$_GET["status_order"];
            endif;

        if (!empty($_GET["delivery_order"])):
            $arFilter["DELIVERY_ID"]=$_GET["delivery_order"];
            endif;




        if(!empty($_GET["date_order_from"]) && !empty($_GET["date_order_to"])):
            $date_from =  strtotime($_GET["date_order_from"]);
            $date_to =  strtotime($_GET["date_order_to"]);
            if ($date_from -  $date_to < 0):
                $arFilter["DATE_FROM"] = $_GET["date_order_from"];
                $arFilter["DATE_TO"] = $_GET["date_order_to"];
                endif;
            if ($date_from -  $date_to > 0):
                $arFilter["DATE_FROM"] = $_GET["date_order_to"];
                $arFilter["DATE_TO"] = $_GET["date_order_from"];
                endif; 

            if ($date_from -  $date_to == 0):
                $arFilter["DATE_FROM"] = $_GET["date_order_to"];
                $arFilter["DATE_TO"] = $_GET["date_order_to"];
                endif;             
            endif;  

        if(!empty($_GET["date_order_from"]) && empty($_GET["date_order_to"])):
            $arFilter["DATE_FROM"] = $_GET["date_order_from"];

            endif;  
        if(empty($_GET["date_order_from"]) && !empty($_GET["date_order_to"])):
            $arFilter["DATE_TO"] = $_GET["date_order_to"];

            endif;   


        if(!empty($_GET["order_number_from"]) && !empty($_GET["order_number_to"])):
            $arFilter[">=ID"] = min($_GET["order_number_from"], $_GET["order_number_to"]);
            $arFilter["<=ID"] = max($_GET["order_number_from"], $_GET["order_number_to"]);
            endif;

        if(!empty($_GET["order_number_from"]) && empty($_GET["order_number_to"])):
            $arFilter[">=ID"] = $_GET["order_number_from"];
            endif; 


        if(empty($_GET["order_number_from"]) && !empty($_GET["order_number_to"])):
            $arFilter["<=ID"] = $_GET["order_number_to"];   

            endif;

        /*arshow($arFilter);
        die();*/
        /* arshow($arFilter);
        die();  */

        $orders_res = CSaleOrder::GetList(Array('ID' => 'DESC'), $arFilter, false, array("nTopCount"=>10), array());
        while($arOrders_ob = $orders_res->Fetch()): 
            $orders[$arOrders_ob["ID"]]["INFO"]=$arOrders_ob;
            $property_res=CSaleOrderPropsValue::GetList(
                array(),
                array("ORDER_ID"=>$arOrders_ob["ID"]),
                false,
                false,
                array("*")
            );
            while($property_ob=$property_res->Fetch()):
                $orders[$arOrders_ob["ID"]]["PROPERTY"][$property_ob["CODE"]]=$property_ob;
                endwhile;

            $basket_res = CSaleBasket::GetList(
                array(),
                array("ORDER_ID"=>$arOrders_ob["ID"]),
                false,
                false,
                array("*")
            );
            while( $basket_ob  = $basket_res -> Fetch()):

                $orders[$arOrders_ob["ID"]]["BASKET"][] = $basket_ob;

                endwhile;


            endwhile; 


        //arshow($orders); 
    ?>
    <div id="order_filter">
        <div>Вы можете воспользоваться <b>фильтром</b> по:</div>

        <div class="filter_new">

            <form id="order_search_form" method="get" action="/personal/cabinet/index.php" class="jquerymask">

                <div class="sklad">
                    <span>Складам:</span>
                    <?if(!empty($_GET["warehouse_order"])):
                        $val=$warehouses[$_GET["warehouse_order"]];
                        $id="value='".$_GET["warehouse_order"]."'";
                        else:
                        $val="Выберите склад";
                        $id="";
                        endif;
                    ?>

                    <script type="">
                        $(document).ready(function(){ 
                            if($('#warehouse_select').text='Выберите склад'){
                                $('.delivery_select').css('display', 'none');
                                $('.hide_dos').css('display', 'none');
                                $('#bottom_search').css('margin-left', '0px');   
                            }
                        });


                    </script>

                    <div class="order_select" id="warehouse_select"><?=$val?></div>

                    <div class="order_option order_option_sklad">
                        <?foreach ($warehouses as $key =>$value) {

                                $query = "select * from `_warehouses` where `id`=".$key;
                                $res = $DB->Query($query);
                                if($row = $res->Fetch()){
                                    //  arshow($row);
                                    $row["name"] = str_replace("]","",$row["name"]);
                                    $row["name"] = trim($row["name"]);
                                    $nameArr = explode("[", $row["name"]);

                                    // arshow($nameArr);

                                    $warehouse_params = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>95 ,"NAME"=>$nameArr[1]), false, false, array("NAME","PROPERTY_347"));
                                    if ($warehouse = $warehouse_params->Fetch()){
                                        //arshow($warehouse);
                                        $W_DELIV = $warehouse["PROPERTY_347_VALUE"];
                                    }
                                }



                            ?>
                            <span rel="<?=$key?>" wh_id="<?=$warehouse["NAME"];?>"><?=$value?></span>
                            <?}?>


                    </div>


                    <input <?=$id?> type="hidden" name="warehouse_order" class="order_search_hidden">   
                </div>



                <div class="status">
                    <span>Статусам:</span>
                    <?if(!empty($_GET["status_order"])):
                        $status_val = CSaleStatus::GetByID(
                            $_GET["status_order"]
                        );                                                     
                        $id="value='".$_GET["status_order"]."'";
                        else:
                        $status_val["NAME"]="Выберите статус";
                        $id="";
                        endif;
                    ?>

                    <div class="order_select" id="filter_select"><?=$status_val["NAME"]?></div>

                    <div class="order_option scroll_search">

                        <?$status_list_res = CSaleStatus::GetList(array(), array("LID"=>"ru"), false,false,array());

                            while ($status_list_ob = $status_list_res -> Fetch()):

                            ?>

                            <span rel=<?=$status_list_ob["ID"]?>><?=$status_list_ob["NAME"]?></span>

                            <?                               
                                endwhile;?> 


                    </div>
                    <input <?=$id?> type="hidden" name="status_order" class="order_search_hidden">   
                </div>

                <div class="datam"> 
                    <span>Датам:</span>
                    <div class="date_container">

                        <?$APPLICATION->IncludeComponent(
                                "bitrix:main.calendar", 
                                "order_search_calendar", 
                                array(
                                    "SHOW_INPUT" => "Y",
                                    "FORM_NAME" => "",
                                    "INPUT_NAME" => "date_order_from",
                                    "INPUT_NAME_FINISH" => "date_order_to",
                                    "INPUT_VALUE" => "",
                                    "INPUT_VALUE_FINISH" => "",
                                    "SHOW_TIME" => "Y",
                                    "HIDE_TIMEBAR" => "Y"
                                ),
                                false
                            );?>


                    </div>

                </div>

                <span>Номерам:</span>
                <div class="nomera">


                    <? if(!empty($_GET["order_number_from"])):
                            $val1 = "value='".$_GET["order_number_from"]."'";
                            else:
                            $val1= "";
                            endif;
                        if(!empty($_GET["order_number_to"])):
                            $val2 = "value='".$_GET["order_number_to"]."'";
                            else:
                            $val2 = "";
                            endif;?>



                    <div class="date_container">
                        <input type="text" <?=$val1?> class="order_date" placeholder="Не фильтровать" name="order_number_from">
                        <span>-</span>
                        <input type="text" <?=$val2?> class="order_date"  name="order_number_to">


                    </div>

                </div>




                <span class="hide_dos">Типу доставки:</span>
                <?if(!empty($_GET["delivery_order"])):
                    $delivery_val = CSaleDelivery::GetByID(
                        $_GET["delivery_order"]
                    );                                                     
                    $id="value='".$_GET["delivery_order"]."'";
                    else:
                    $delivery_val["NAME"]="Выберите тип доставки";
                    $id="";
                    endif;
                ?>

                <div class="order_select delivery_select" id="filter_select"><?=$delivery_val["NAME"]?></div>

                <div id="delivery_list" class="order_option order_option2 scroll_search">
                    <?$delivery_list_res = CSaleDelivery::GetList(array(), array(), false,false,array());

                        while ($delivery_list_ob = $delivery_list_res -> Fetch()):?>  
                        <span rel="<?=$delivery_list_ob["ID"]?>"><?=$delivery_list_ob["NAME"]?></span>
                        <?endwhile;?>


                </div>
                <input <?=$id?> type="hidden" name="delivery_order" class="order_search_hidden">   


                <input type="hidden" name="order_search" value="Y" class="order_search_hidden">

                <div id="bottom_search">
                    <div class="clear_form">Сбросить</div>
                    <input type="submit" value="Применить">

                </div>
            </form>
        </div>

    </div> 



    <?  //arshow($orders);
        if(!empty($orders)):
            function plural_type($n) {
                return ($n%10==1 && $n%100!=11 ? 0 : ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 1 : 2));
            }
            $arPluralRouble = array("Рубль","Рубля","Рублей");
        ?>
        <div class="order-cabinet"> 
            <? foreach($orders as $arItem):
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
                    <?// arShow($arItem["PROPERTY"]);?>
                        <span id="warehouse"><b>Склад: </b><?=$warehouses[$arItem["PROPERTY"]["ROOM_NUMBER"]["VALUE"]]?></span>
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
                                );
                            ?>
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
                        <tr class="tbasket_header">
                            <th width="55">Фото</th>
                            <th width="380">Наименование <font color="#989898">(артикул, OEM, год)</font></th>
                            <th width="65" title="Зарезервировано">Резерв</th>
                            <th width="65" title="Отгружено со склада">Отг-но</th>
                            <th width="65" title="Снято с резерва">Снято</th>
                            <th width="65" title="Удалено из накладной и причина">Отказ</th>
                            <th width="75">Кол-во, <font color="#989898">шт</font></th>
                            <th width="95">Цена, <font class="rouble" color="#989898">i</font></th>
                            <th width="90" >Сумма, <font class="rouble" color="#989898">i</font></th>
                        </tr>
                        <?foreach($arItem['BASKET'] as $arBasket): ?>
                              
                              <?
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

                                <?$resProp = CSaleBasket::GetPropsList(
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
                    <?//arshow($arItem);?>
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
                        <? $num_ticket=CSaleOrderPropsValue::GetList(array(), array("ORDER_ID"=>$arBasket["ORDER_ID"], 'CODE'=>'NUM_INVOICE'), false, false, array());
                     while($num_ticket1=$num_ticket->Fetch()) {
                     $check_id=substr($num_ticket1['VALUE'],0,5);
                        } ?>
                    <div class="order-cabinet-butons">
                        <div class="field"><a target="_blank" class="url" href="/order-print.php?order_id=<?=$arBasket["ORDER_ID"]?>">Распечатать заказ</a></div> 
                        <?$list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'CREATED_BY'=>$USER->GetID()),false,false,array('ID','NAME'))->Fetch();
                        if ($list) {
                            if (($arItem['INFO']['STATUS_ID']=='T' || $arItem['INFO']['STATUS_ID']=='S') && ($arItem['INFO']['PAY_SYSTEM_ID']==44 || $arItem['INFO']['PAY_SYSTEM_ID']==45) && (checkSite()=="opt")) {?>
                            <div class="field field_1" style="margin-right:40px;cursor:pointer;"> <a target="_blank" class="url_1">Распечатать счет на оплату</a></div>
                        <?}
                        }?>
                    </div>
                     <form id='entities_form' action="/doc_print/pdf/pdf_order_print.php?check_id=<?=$check_id?>" target="_blank" method="post" style="display:none;">
                     <span class='entities_title'>ВЫБЕРИТЕ ЮРИДИЧЕСКОЕ ЛИЦО</span><br><br>
<?$list=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>116, 'CREATED_BY'=>$USER->GetID()),false,false,array('ID','NAME'));
while($list_fetch=$list->Fetch()) { 
    ?>
<input type="radio" name='entname' value='<?=$list_fetch['NAME']?>'><?=$list_fetch['NAME']?><br>
<?}?>
<input type='hidden' name='order_id' value='<?=$arBasket['ORDER_ID']?>'>
<input type='submit' value='ДАЛЕЕ' class='proceeding_button'>   

<span class='close_ent_form'>X</span>
</form>
                </div>
                </div>
                  <script>
                  $(".url_1").click(function(){
                      $('.overlay_orders').css("display", 'block');
                      $(this).parent('.field_1').parent('.order-cabinet-butons').next('#entities_form').css("display", "block");
                      $(this).parent('.field_1').parent('.order-cabinet-butons').next('#entities_form').css("top", window.pageYOffset);
                       $(this).parent('.field_1').parent('.order-cabinet-butons').next('#entities_form').find("input[type=radio]:first").attr('checked', true);
                  });
                  $(".close_ent_form").click(function(){
                      $('.overlay_orders').css("display", 'none');
                      $(this).closest('#entities_form').css("display", "none");
                  
                  });
                  </script>

                <?$i++;
                    endforeach;?>
            <?if(count($orders)==10){?> 
                <a class="showMoreOrders" href="">Показать еще</a>
                <?}?>

        </div>

        <?else:?>
        <?=GetMessage('SPOL_NO_ORDERS')?>
        <?endif?>

    <?endif?>

</div>