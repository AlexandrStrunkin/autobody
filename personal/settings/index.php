<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Настройки");?>
<meta name="robots" content="noindex">

<?
    if (!$USER->IsAuthorized()) {
        header ("location: /");  
    }
    else if (checkSite() == 'retail') {?>

    <div class="cabinet-detail-title">ЛИЧНЫЕ ДАНННЫЕ</div>
    <?$APPLICATION->IncludeComponent(
            "bitrix:main.profile", 
            "retail_profile", 
            array(
                "USER_PROPERTY_NAME" => "",
                "SET_TITLE" => "N",
                "AJAX_MODE" => "N",
                "USER_PROPERTY" => array(
                ),
                "SEND_INFO" => "Y",
                "CHECK_RIGHTS" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            ),
            false
        );?>

    <?        
    }
    else {        
        global $USER;
        //Get list of active subscribe's
        $userInfo = CUser::GetById($USER->GetId());
        $arUser = $userInfo->Fetch(); 

        $res=CSubscription::GetList(Array(),Array("USER_ID" => $arUser["ID"]));
        $arSubscribe=$res->GetNext(); 
        $arRubrics=CSubscription::GetRubricList($arSubscribe['ID']);
        while($arRubricsList=$arRubrics->GetNext()) 
        {   
            $arListRubrics[$arRubricsList["ID"]]=$arRubricsList;
            /*if ($arRubricsList['ID']==2)    
            {
            $new_items_sub=$arRubricsList['ACTIVE'];
            } */
        }

        //Request for unsubscribe
        if (($_REQUEST["unsubscription"]=="Y") && !empty($_REQUEST["unsubscribeId"]))
        {
            
            unset($arListRubrics[$_REQUEST["unsubscribeId"]]);
            $arKeysRubrics=array_keys($arListRubrics);
            $res=CSubscription::GetList(Array(),Array("RUBRIC" => $_REQUEST["unsubscribeId"], "USER_ID" => $USER->GetID()));
            $arSubscribe=$res->Fetch();
            if ($arSubscribe)
            {
                $subscr = new CSubscription; 
                $subscr->Update($arSubscribe["ID"], Array("RUB_ID" => $arKeysRubrics));
            }
        }   

    // arshow($arListRubrics);
    ?>
    <script type="text/javascript">
        $(function(){

            $("#change-data").click(function(e){
                $(".popup-overlay").show();
                $(".popup-form").slideDown();
            });

            $(".popup-overlay").click(function(e){
                $(".popup-overlay").hide();
                $(".popup-form").hide();
                $(".popup-done").hide();
                //Очищение всех input в всплывающем окне при закрытии окна
                $("input").val(
                    function(x){
                        x="";
                        return x;
                    }
                )
                //Очищение textarea в всплывающем окне при закрытии окна
                $("textarea").val(
                    function(x){
                        x="";
                        return x;
                    }
                )
                $(".form_alert").css("display","none");
            });

            $("#save-settings").click(function(e){
                //собираем нужные поля
                var delivery = $("#DELID").val(); 
                var paysystem = $("#PAYS_ID").val();  
                /*////////////////////////////////////*/
                var city = $("#city").val();  if (!city) {city = "no";}              
                var country = $("#city").val();  if (!city) {city = "no";}              
                var adress = $("#adress").val();  if (!adress) {adress = "no";}
                var pack; //требуетя жесткая упаковка
                if ($("#pack").attr("checked") == "checked") {pack = "yes";} else {pack = "no";}
                var subscribe; //подписка на рассылку
                var new_subscribe;
                var subscribe_price_list;
                if ($("#SUBSCRIBE").attr("checked") == "checked") {subscribe = "yes";} else {subscribe = "no";}
                if ($("#NEW_SUBSCRIBE").attr("checked") == "checked") {new_subscribe = "yes";} else {new_subscribe = "no";}
                if ($("#SUBSCRIBE_PRICE_LIST").attr("checked") == "checked") {subscribe_price_list = "yes";} else {subscribe_price_list = "no";}
                var main_man_phone = $("#phone-man").val(); /*телефон ответственного лица*/ if (!main_man_phone) {main_man_phone = "no";} 
                var regime = $("#time").val(); /*режим работы заказчика*/ if (!regime) {regime = "no";}
                var info = $("#info").val(); /*информация*/  if (!info) {info = "no";}
                var user_login = "<?=$USER->GetLogin()?>";
                var user_id = <?=$arUser["ID"]?>;
                var email = "<?=$arUser["EMAIL"]?>";
                ///

                //отправляем данные в скрипт, который будет сохранять данные пользователя
                //console.log(info);
                $.post("/ajax/user_data_save.php", { 
                    delivery: delivery,
                    paysystem: paysystem,
                    city: city,
                    adress: adress,
                    pack: pack,
                    main_man_phone: main_man_phone,
                    regime: regime,
                    info: info,
                    user_login: user_login,
                    subscribe: subscribe,
                    subscribe_price_list: subscribe_price_list,
                    new_subscribe: new_subscribe,
                    user_id: user_id,
                    email: email            
                    },
                    function(data){
                        console.log(data);
                        $("#DATEPSID").val($(":radio[name=PAYS_ID]").filter(":checked").val());
                        $("#DATADEL").val($(":radio[name=DELID]").filter(":checked").val());

                        //document.forms['main_form'].elements['ACTION'].value = action;
                        //                    document.forms['main_form'].submit();
                        $('.detail').submit();

                });
            });



        });
    </script>


    <br>
    <!--<p><b>Токен для доступа к <a href="/api/docs/">веб-сервису</a>:</b> <?=$arUser["UF_RESTTOKEN"]?></p> -->  

    <div class="detail"> 
        <table>
            <tr>
                <td>
                    <div>
                        <div class="cabinet-detail-title">ЛИЧНЫЕ ДАНННЫЕ</div>
                        <table class="cabinet-detail">

                            <?if (checkSite()=="retail"):?>
                                <tr>
                                    <td>ФИО</td>
                                    <td><?=$arUser["NAME"]?></td>
                                </tr> 
                                <?endif;?>

                            <?if (checkSite()=="opt"):?>
                                <tr>
                                    <td>Логин</td>
                                    <td><?=$arUser["LOGIN"]?></td>
                                </tr>
                                <?endif;?>
                            <tr>
                                <td>Почта</td>
                                <td><?=$arUser["EMAIL"]?></td>
                            </tr>

                            <?if (checkSite()=="opt"):?>
                                <tr>
                                    <td>Токен для доступа к <a href="/api/docs/">веб-сервису</a>:</td>
                                    <td><?=$arUser["UF_RESTTOKEN"]?></td>
                                </tr>
                                <?endif;?>

                            <? if (!$arUser["PERSONAL_PHONE"]=='') { ?>
                                <tr>
                                    <td>Телефон</td>
                                    <td><?=$arUser["PERSONAL_PHONE"]?></td>
                                </tr>
                                <? } ?>

                            <tr>
                                <td colspan="2">
                                    <a class="url" id="change-data"><button class="button" type="submit">ПОДАТЬ ЗАПРОС НА СМЕНУ ДАННЫХ</button></a>
                                    <input id="LOGIN" type="hidden" value="<?=htmlspecialchars($arUser["LOGIN"])?>">
                                    <input id="EMAIL" type="hidden" value="<?=htmlspecialchars($arUser["EMAIL"])?>">
                                </td>
                            </tr>
                        </table>
                    </div>    
                </td>
            </tr>
            <!-- <tr>
            <td>
            <div class="cabinet-password">
            <div class="cabinet-password-title">ПАРОЛЬ</div>
            <button class="button" type="submit">ПОДАТЬ ЗАПРОС НА СМЕНУ ПАРОЛЯ</button>
            </div>
            </td>
            </tr> -->
            <tr>
                <td>
                    <div>
                        <?

                            $arSelect = array(
                                "PROPERTY_DELIVERY",
                                "PROPERTY_PAYMENT",
                                "PROPERTY_CITY",
                                "PROPERTY_ADRESS",
                                "PROPERTY_PACK",
                                "PROPERTY_MAIN_MAN",
                                "PROPERTY_MAIN_MAN_PHONE",
                                "PROPERTY_INFO",
                                "PROPERTY_REGIME"
                            );       

                            $user_data = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>99, "NAME"=>$USER->GetLogin()), false, false, $arSelect);
                            $arData = $user_data->Fetch();

                            $user_data_delivery_id = $arData["PROPERTY_DELIVERY_VALUE"];
                            $user_data_payment_id = $arData["PROPERTY_PAYMENT_VALUE"];

                            //arshow($arData);
                            //                            print_r($arData['PROPERTY_DELIVERY_VALUE']);   
                            //                            arshow($GLOBALS['OSG_STRUCTURE']);                         
                            //                            arshow($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'][$arData['PROPERTY_DELIVERY_VALUE']]);
                            //если запись есть, то выводим ее
                            //$data_payment = ($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'][$arData['PROPERTY_DELIVERY_VALUE']]);
                            if ($user_data->SelectedRowsCount() > 0) {

                            ?>
                            <?//arshow($arListRubrics);?>
                            <div class="cabinet-detail-title">СОХРАНЕННЫЕ НАСТРОЙКИ</div>
                            <table class="cabinet-saved">
                                <tr>
                                    <td>Подписаться на рассылку новостей:</td>
                                    <td><input type="checkbox" name="DATA[SUBSCRIBE]" id="SUBSCRIBE" <?if ($arListRubrics[1]["ACTIVE"] == "Y"){?>checked="checked" <?}?>><label for="SUBSCRIBE">Да</label></td>
                                </tr>
                                <tr>
                                    <td>Подписаться на новые товары:</td>
                                    <td><input type="checkbox" name="DATA[NEW_SUBSCRIBE]" id="NEW_SUBSCRIBE" <?if ($arListRubrics[2]["ACTIVE"] == "Y"){?>checked="checked" <?}?>><label for="NEW_SUBSCRIBE">Да</label></td>
                                </tr>
                                <tr>
                                    <td>Подписаться на рассылку прайс-листов:</td>
                                    <td><input type="checkbox" name="DATA[SUBSCRIBE_PRICE_LIST]" id="SUBSCRIBE_PRICE_LIST" <?if ($arListRubrics[4]["ACTIVE"] == "Y"){?>checked="checked" <?}?>><label for="SUBSCRIBE_PRICE_LIST">Да</label></td>
                                </tr>
                                <tr>
                                    <td>Тип оплаты:</td>
                                    <td>
                                        <input type="hidden" name="DATA[PAY_SYSTEM_ID]" id="DATEPSID" value=""/>
                                        <select name="PAYS_ID" id="PAYS_ID">
                                            <?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'] as $PAY_SYSTEM_ID => $arPayment):?>
                                                <?//arshow($PAY_SYSTEM_ID)?>
                                                <?//if ($arPayment['ACTION'][$arResult['DATA']['UF_USER_TYPE']]):?>
                                                <?if($USER->IsAuthorized() || $arPayment['NAME']=='Наличные'):?>
                                                    <option value="<?=$PAY_SYSTEM_ID?>" id="psi_<?=$PAY_SYSTEM_ID?>" <?if (($user_data_payment_id==$PAY_SYSTEM_ID)||(!$USER->IsAuthorized()&&$arPayment['NAME']=='Наличные')) echo 'selected="selected"'?>><?=$arPayment['NAME']?></option>
                                                    <?endif;?>
                                                <?//endif?>
                                                <?endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Тип доставки:</td>
                                    <td>
                                        <input type="hidden" name="DATA[DELIVERY_ID]" id="DATADEL" value=""/>  
                                        <select class="" name="DELID" id="DELID">
                                            <?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'] as $DELIVERY_ID => $arDelivery):?>
                                                <?//echo $DELIVERY_ID.arshow($arDelivery)?>
                                                <?if($USER->IsAuthorized()||$arDelivery['NAME']=='Самовывоз'):?>
                                                    <?if (in_array($DELIVERY_ID,$W_DELIV_ARR) or $W_DELIV == "") {?> 
                                                        <option value="<?=$DELIVERY_ID?>" <?if(($user_data_delivery_id==$DELIVERY_ID)||(!$USER->IsAuthorized()&&$arDelivery['NAME']=='Самовывоз')) echo 'selected="selected"'?> id="deliv_<?=$DELIVERY_ID?>" rel="<?=$arDelivery["DESCRIPTION"]?>"><?=$arDelivery['NAME']?></option>
                                                        <?}?>  
                                                    <?endif;?> 
                                                <?endforeach;?>

                                        </select>

                                        <!--<?=$arData["PROPERTY_DELIVERY_VALUE"]?>  -->
                                    </td>
                                </tr>

                                <tr>
                                    <td>Страна:</td>
                                    <td><input type="text" id="country" class="inputtext text" name="" value="Российская Федерация"></td>
                                </tr>

                                <tr>
                                    <td>Город:</td>

                                    <td><input type="text" id="city" class="inputtext text" name="" value="<?=$arData["PROPERTY_CITY_VALUE"]?>"></td>
                                </tr>

                                <tr>
                                    <td>Адрес:</td>
                                    <td><input type="text" id="adress" class="inputtext text" name="" value="<?=$arData["PROPERTY_ADRESS_VALUE"]?>"></td>
                                </tr>
                                <tr>
                                    <td>Телефон ответственного лица:</td>
                                    <td><input type="text" id="phone-man" class="inputtext text" name="" value="<?=$arData["PROPERTY_MAIN_MAN_PHONE_VALUE"]?>"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>Тип упаковки:</div>    
                                    </td>
                                    <td>
                                    <input type="checkbox" name="DATA[PACK]" id="pack" onchange="$('#ud_regular').trigger('keyup');" <?if ($arData["PROPERTY_PACK_VALUE"] == "Да"){?>checked="checked" <?}?>><label for="pack">Требуется жесткая упаковка</label>            </td>
                                </tr>

                                <tr>
                                    <td>Дополнительная информация:</td>

                                    <td><input type="text" id="info" class="inputtext text" name="" value="<?=$arData["PROPERTY_INFO_VALUE"]?>"></td>
                                </tr>

                                <tr>
                                    <td>Режим работы заказчика:</td>

                                    <td><input type="text" id="time" class="inputtext text" name="" value="<?=$arData["PROPERTY_REGIME_VALUE"]?>"></td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <a class="url" id="save-settings"><button class="button" type="submit">СОХРАНИТЬ НАСТРОЙКИ</button></a>
                                    </td>
                                </tr>
                            </table>
                            <?
                            } else {

                            }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div>
        <div class="popup-overlay" style="display: none;"></div>
        <div class="popup-form" style="display: none;">
            <?$APPLICATION->IncludeComponent("osg:feedback", "data-change", Array(
                ));?>
        </div>
        <div class="popup-done" style="display: none;">
            <div class="change-done" >
                <div class="done-title">НОВЫЕ ДАННЫЕ УСПЕШНО ОТПРАВЛЕНЫ</div>


                <div class="done-info">В ближайшее время ваша заявка будет <br>
                    рассмотрена.   </div>

                <img class="change-data-done" src="/images/change-data-done.png" alt=""/>
            </div>

        </div>

    </div>

    <?}?>
     
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>