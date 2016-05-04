<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($GLOBALS["OSG_STRUCTURE"]);?>


<div class="title">Проверьте правильность введенной вами информации</div>

<div class="under-title-note">Если что-то не соответствует действительности, напишите об этом в поле дополнительной <br> информации. Вы также можете сначала внести изменения в разделе <a>"Мои данные"</a> и потом вернуться <br> к оформлению заказа.</div>

<div class="title">Оплата и доставка</div>

<table class="delivery-order">

    <?if ($arResult['DATA']['UF_USER_TYPE'] == 'LEGAL'){?>
        <tr>
            <td><div>Название организации:</div></td>
            <td><div><?=htmlspecialchars($arResult['DATA']['WORK_COMPANY'])?></div></td>
        </tr>

        <tr>
            <td><div>Юридический адрес:</div></td>
            <td><div><?=htmlspecialchars($arResult['DATA']['UF_USER_ADDRESS_U'])?></div></td>
        </tr>     

        <?if ($arResult['DATA']['UF_USER_OKPO']):?>
            <tr>
                <td><div>ОКПО:</div></td>
                <td><div><?=htmlspecialchars($arResult['DATA']['UF_USER_OKPO'])?></div></td>
            </tr>  
            <?endif?>

        <?if ($arResult['DATA']['UF_USER_OKNH']):?>
            <tr>
                <td><div>ОКНХ:</div></td>
                <td>
                    <div><?=htmlspecialchars($arResult['DATA']['UF_USER_OKNH'])?></div>
                </td>
            </tr>  
            <?endif?>
        <?}?>   


    <tr>
        <td><div>Ф.И.О.</div></td>
        <td>
            <div>
                <?if($USER->IsAuthorized()):?>
                    <?if (checkSite() == "retail"): ?>
                        <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_FIO'])?></div>
                        <input type="hidden" id="data_fio" value="<?=$arResult['DATA']['PERSONAL_FIO']?>">    
                    <?else:?>
                        <?=htmlspecialchars($arResult['DATA']['LAST_NAME'])?> <?=htmlspecialchars($arResult['DATA']['NAME'])?> <?=htmlspecialchars($arResult['DATA']['SECOND_NAME'])?>
                    <?endif;?>       
                <?else:?>
                    <?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])?>
                <?endif;?>
                
                
                <?/*if (checkSite() == "retail"): ?>
                    <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_FIO'])?></div>
                    <input type="hidden" id="data_fio" value="<?=$arResult['DATA']['PERSONAL_FIO']?>">    
                <?else:?>
                    <?if($USER->IsAuthorized()):?>
                        <?=htmlspecialchars($arResult['DATA']['LAST_NAME'])?> <?=htmlspecialchars($arResult['DATA']['NAME'])?> <?=htmlspecialchars($arResult['DATA']['SECOND_NAME'])?>
                    <?else:?>
                        <?=$_REQUEST['DATA']['FIRSTNAME4']?>    
                    <?endif;?>
                <?endif;*/?>
            </div>
        </td>
    </tr>


    <tr>
        <td><div>E-mail</div></td>
        <td>
            <div>
               <?if($USER->IsAuthorized()):?>
                    <?if (checkSite() == "retail"):?>
                        <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_EMAIL'])?></div>
                        <input type="hidden" id="data_email" value="<?=$arResult['DATA']['PERSONAL_EMAIL']?>">
                    <?else:?>
                        <?=htmlspecialchars($arResult['DATA']['EMAIL'])?>
                    <?endif;?>     
               <?else:?>
                    <?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])?>
               <?endif;?>
            
            
            
               <?/*if (checkSite() == "retail"): ?>
                    <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_EMAIL'])?></div>
                    <input type="hidden" id="data_email" value="<?=$arResult['DATA']['PERSONAL_EMAIL']?>">    
                <?else:?>
                    <?if($USER->IsAuthorized()):?>
                        <?=htmlspecialchars($arResult['DATA']['EMAIL'])?>
                    <?else:?>
                        <?=$_REQUEST['DATA']['EMAIL4']?>
                    <?endif;?>
                <?endif;*/?> 
            </div>
        </td>
    </tr>

    <tr>
        <td><div>Контактный телефон:</div></td>
        <td>
            <div>
                <?if($USER->IsAuthorized()):?>
                    <?if (checkSite() == "retail"): ?>
                        <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?></div>
                        <input type="hidden" id="data_phone" value="<?=$arResult['DATA']['PERSONAL_PHONE']?>">
                    <?else:?>
                        <?if ($arResult['DATA']['PERSONAL_PHONE']):?>
                            <?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?>
                        <?else:?>
                            не указан
                        <?endif?>
                    <?endif;?>
                <?else:?>
                    <?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])?>
                <?endif;?>
            
            
                <?/*if (checkSite() == "retail"): ?>
                    <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?></div>
                    <input type="hidden" id="data_phone" value="<?=$arResult['DATA']['PERSONAL_PHONE']?>">    
                <?else:?>
                    <?if($USER->IsAuthorized()):?>
                        <?if ($arResult['DATA']['PERSONAL_PHONE']):?>
                            <?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?>
                        <?else:?>
                            не указан
                        <?endif?>
                    <?else:?>
                        <?=$_REQUEST['DATA']['PHONE4']?>
                    <?endif;?>
                <?endif;*/?>
            
                
            </div>
        </td>
    </tr>


    <tr>
        <td><div>Тип оплаты:</div></td>
        <td>
            <div><?=$GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'][$arResult['DATA']['PAY_SYSTEM_ID']]['NAME']?></div>
            <input type="hidden" id="data_paysystem" value="<?=$arResult['DATA']['PAY_SYSTEM_ID']?>">
        </td>
    </tr>


    <tr>
        <td><div>Тип доставки:</div></td>
        <td>
            <div><?=$GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'][$arResult['DATA']['DELIVERY_ID']]['NAME']?></div>
            <input type="hidden" id="data_delivery" value="<?=$arResult['DATA']['DELIVERY_ID']?>">
        </td>
    </tr>  

    <? if($arResult['DATA']['PERSONAL_COUNTRY']):?>         
        <tr>
            <td><div>Страна:</div></td>
            <td>
                <div><?=GetCountryByID($arResult['DATA']['PERSONAL_COUNTRY'])?></div>
            </td>
        </tr> 
        <?endif?>

    <? if($arResult['DATA']['PERSONAL_STATE']):?>
        <tr>
            <td><div>Область:</div></td>
            <td>
                <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_STATE'])?></div>
            </td>
        </tr> 
        <?endif?>

    <? if($arResult['DATA']['PERSONAL_CITY']):?>  
        <tr>
            <td><div>Город:</div></td>
            <td>
                <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_CITY'])?></div>
                <input type="hidden" id="data_city" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_CITY'])?>">
            </td>
        </tr>        
        <?endif?>

    <? if($arResult['DATA']['PERSONAL_STREET']):?>
        <tr>
            <td><div>Адрес:</div></td>
            <td>
                <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_STREET'])?></div>
            <input type="hidden" id="data_adress" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_STREET'])?>">            </td>
        </tr>  
        <?endif?>

    <? if($arResult['DATA']['PERSONAL_ZIP']):?>    
        <tr>
            <td><div>Индекс:</div></td>
            <td>
            <div><?=htmlspecialchars($arResult['DATA']['PERSONAL_ZIP'])?></div>
        </tr>
        <?endif?>  
</table>



<?
    //получаем пользовательские данные из соответствующего инфоблока
    $arSelect = array("PROPERTY_DELIVERY","PROPERTY_PAYMENT","PROPERTY_CITY","PROPERTY_ADRESS","PROPERTY_PACK","PROPERTY_MAIN_MAN","PROPERTY_MAIN_MAN_PHONE","PROPERTY_INFO","PROPERTY_REGIME");       

    $user_data = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>99, "NAME"=>$USER->GetLogin()), false, false, $arSelect);
    $arData = $user_data->Fetch();    

    if ($arData["PROPERTY_PACK_ENUM_ID"] == 19) {
        $user_data_pack = "Y";  
    } 
    else {
        $user_data_pack = "N";
    }
    $user_data_main_man = $arData["PROPERTY_MAIN_MAN_VALUE"];
    $user_data_main_man_phone = $arData["PROPERTY_MAIN_MAN_PHONE_VALUE"]; 
    $user_data_info = $arData["PROPERTY_INFO_VALUE"];
    $user_data_regime = $arData["PROPERTY_REGIME_VALUE"];


?>

<?if($USER->IsAuthorized()):?>
    <div class="title">Прочие пожелания</div>

    <table class="order-other">
        <?if (checkSite()=="opt"):?>
            <tr>
                <td>
                    <div>Ответственное лицо</div>          



                </td>
                <td>
                    <input class=" text" name="DATA[name5]" id="name5" onchange="$('#ud_regular').trigger('keyup');" value="<?=$user_data_main_man?>"/> 

                </td>
            </tr>


            <tr>
                <td>
                    <div>Телефон ответственного лица</div>



                </td>
                <td>
                    <input class=" text" name="DATA[phone5]" id="phone5" onchange="$('#ud_regular').trigger('keyup');" value="<?=$user_data_main_man_phone?>"/>

                </td>
            </tr>


            <tr>
                <td>
                    <div>Режим работы заказчика</div>



                </td>
                <td>
                    <input class=" text" name="DATA[regime]" id="regime" onchange="$('#ud_regular').trigger('keyup');" value="<?=$user_data_regime?>"/>




                </td>
            </tr>   
            <tr>
                <td>
                    <div>Желаемая дата доставки</div>



                </td>
                <td>
                    <input type="text" name="DATE_ITEM" size="" value="">    

                </td>
            </tr>
        <?endif;?>
        <tr>
            <td>
                <div>Дополнительная информация</div>

            </td>
            <td>
                <input type="text" placeholder="" id="ud_regular" <?if(!$USER->IsAuthorized()):?> onkeyup="
                    glue = $(this).attr('value') + '\nФ.И.О.: <?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])?>
                    \nE-mail.: <?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])?>
                    \nPhone: <?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])?>
                    <?if ($_REQUEST['DATA']['PERSONAL_CITY'] != "") {?>\nГород: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_CITY'])?>] <?}?>
                    <?if ($_REQUEST['DATA']['PERSONAL_STREET'] != "") {?>\nАдрес: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_STREET'])?>] <?}?>
                    \n';
                    $('#ud_repeat').attr('value',glue);
                    "
                    <?else:?>
                    onkeyup="
                    if($('input[name=DATE_ITEM]').attr('value')=='<?=date('d.m.Y')?>')
                    {
                        alert('Доставка возможна только на следующий день после заказа');
                        $('input[name=DATE_ITEM]').attr('value','');
                    }

                    glue = $(this).attr('value');
                    <?if (checkSite()=="opt"):?>
                        if($('input[name=DATE_ITEM]').attr('value')!='') glue = 'Желаемая дата доставки: '+$('input[name=DATE_ITEM]').attr('value')+'\n\n'+glue;
                        if($('#name5').attr('value')!='') glue = 'Ответственное лицо: '+$('#name5').attr('value')+'\n\n'+glue;
                        if($('#phone5').attr('value')!='') glue = 'Телефон ответственного лица: '+$('#phone5').attr('value')+'\n\n'+glue;
                        if($('#regime').attr('value')!='') glue = 'Режим работы заказчика: '+$('#regime').attr('value')+'\n\n'+glue;
                        if($('#pack').attr('checked')=='checked') glue = 'Требуется жесткая упаковка!'+'\n\n'+glue;
                    <?endif;?>
                    $('#ud_repeat').attr('value',glue);
                    addInfo();
                    "
                    <?endif;?> value="<?=$user_data_info?>"> 
            </td>
        </tr> 
        <?if (checkSite()=="opt"):?>
            <tr>
                <td>
                    <div>Тип упаковки</div>    


                </td>
                <td>
                <input type="checkbox" name="DATA[PACK]" id="pack" onchange="$('#ud_regular').trigger('keyup');" <?if ($user_data_pack == "Y"){?>checked="checked" <?}?>><label for="pack">Требуется жесткая упаковка</label>            </td>

            </tr>      


            <tr class="last">
                <td colspan="2" style="width: 100% !important;" >
                    <div class="save-data">
                        <input class="check-save-data" type="checkbox" name="save_data" value="yes" id="save_data" >
                        <label class="text-save-data" for="save_data"><span></span></label>
                        <div class="save-data-text">Сохранить мои данные. Если сохранить, то при следующем оформлении заказа все подряд <br> заполнятся автоматически</div>


                    </div>       
                </td>
            </tr>
        <?endif;?>
        
    </table>  



    <div class="persinf">  

        <script>
            $('input[name=DATE_ITEM]').attr('onChange','$(\'#ud_regular\').trigger(\'keyup\')');
            $('input[name=DATE_ITEM]').attr('onKeyUp','$(\'#ud_regular\').trigger(\'keyup\')');
            $('input[name=DATE_ITEM]').attr('onClick','$(\'#ud_regular\').trigger(\'keyup\')');
            $('input[name=DATE_ITEM]').attr('onBlur','$(\'#ud_regular\').trigger(\'keyup\')');

            //$('td').attr('onClick','$(\'#ud_regular\').trigger(\'keyup\')');
        </script>
    </div>
    <script>
        $('input[name=DATE_ITEM]').attr('onChange','$(\'#ud_regular\').trigger(\'keyup\')');
        $('input[name=DATE_ITEM]').attr('onKeyUp','$(\'#ud_regular\').trigger(\'keyup\')');
        $('input[name=DATE_ITEM]').attr('onClick','$(\'#ud_regular\').trigger(\'keyup\')');
        $('input[name=DATE_ITEM]').attr('onBlur','$(\'#ud_regular\').trigger(\'keyup\')');

        //$('td').attr('onClick','$(\'#ud_regular\').trigger(\'keyup\')');
    </script>
    <?endif;?>

<div class="persinf">
    <script>
        $(function(){
            //очищаем данное поле от пробелов
            $("#ud_regular").val("");
            $('#ud_regular').trigger('keyup');
        })
    </script>                     

    <br>
</div>
<?//arshow($_REQUEST)?>
<?if(!$USER->IsAuthorized()):?>
    <textarea rows="3" name="DATA[USER_DESCRIPTION]" id="ud_repeat" style="display:none">
        Ф.И.О.: [<?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])?>]
        E-mail: [<?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])?>]
        Телефон: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])?>]
        <?if ($_REQUEST['DATA']['PERSONAL_CITY'] != "" ) {?> 
            Город: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_CITY'])?>]   
        <?}?>
        <?if ($_REQUEST['DATA']['PERSONAL_STREET'] != "" ){?>
            Адрес: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_STREET'])?>]
        <?}?>
    </textarea>
    <?else:?>
    <textarea rows="3" name="DATA[USER_DESCRIPTION]" id="ud_repeat" style="display:none"></textarea>
    <?endif;?>

<script>
$(function(){ 
        //addInfo();          
    })
    
    function addInfo() {
        cur_val = $('#ud_repeat').val();       

        var val = "";
        <?if ($_REQUEST['DATA']['PERSONAL_FIO'] != "") {?>
            val = val + '\nФИО: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_FIO'])?>]';
            <?}?>
        <?if ($_REQUEST['DATA']['PERSONAL_EMAIL'] != "") {?>
            val = val + '\nEMAIL: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_EMAIL'])?>]';
            <?}?>
        <?if ($_REQUEST['DATA']['PERSONAL_PHONE'] != "") {?>
            val = val + '\nТелефон: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_PHONE'])?>]';
            <?}?>  
        <?if ($_REQUEST['DATA']['PERSONAL_CITY'] != "") {?>
            val = val + '\nГород: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_CITY'])?>]; ';
            <?}?>
        <?if ($_REQUEST['DATA']['PERSONAL_STREET'] != "") {?>
            val = val + '\nАдрес: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_STREET'])?>]';
            <?}?>   
        $('#ud_repeat').attr('value',val + " " +  cur_val);
    }
    </script>