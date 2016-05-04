<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($_REQUEST)?>
<div class="smallname">Проверьте правильность введенной Вами информации. </div>


<h3>
    <?if ($USER->IsAuthorized()):?>
        Если что-то не соответствует действительности, напишите об этом в поле дополнительной информации.<br>
        Вы также можете сначала внести изменения в разделе &laquo;<a href="/personal/">Мои данные</a>&raquo; и потом вернуться к оформлению заказа.
        <?else:?>
        Если что-то не соответствует действительности, вернитесь на несколько шагов назад и исправьте информацию, все остальные поля останутся при этом без изменения.
        <?endif?>
</h3>





<div class="smallname">Информация о покупателе</div>
<?/*
    <div class="persinf">
    Тип плательщика:<br/>
    <b><?=$GLOBALS['OSG_STRUCTURE']['SALE']['PERSON_TYPE'][$arResult['DATA']['UF_USER_TYPE']]['NAME']?></b>
    </div>
*/?>

<?if ($arResult['DATA']['UF_USER_TYPE'] == 'LEGAL'):?>
    <div class="persinf">
        Название организации:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['WORK_COMPANY'])?></b>
    </div>
    <?/*
        <div class="persinf">
        ИНН:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['UF_USER_INN'])?></b>
        </div>
        <div class="persinf">
        Корреспондентский счет:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['UF_USER_KS'])?></b>
        </div>
        <div class="persinf">
        Расчетный счет:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['UF_USER_RS'])?></b>
        </div>
        <div class="persinf">
        Название банка:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['UF_USER_BANK'])?></b>
        </div>
        <div class="persinf">
        БИК банка:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['UF_USER_BIK'])?></b>
        </div>
    */?>
    <div class="persinf">
        Юридический адрес:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['UF_USER_ADDRESS_U'])?></b>
    </div>

    <?if ($arResult['DATA']['UF_USER_OKPO']):?>
        <div class="persinf">
            ОКПО:<br/>
            <b><?=htmlspecialchars($arResult['DATA']['UF_USER_OKPO'])?></b>
        </div>
        <?endif?>

    <?if ($arResult['DATA']['UF_USER_OKNH']):?>
        <div class="persinf">
            ОКНХ:<br/>
            <b><?=htmlspecialchars($arResult['DATA']['UF_USER_OKNH'])?></b>
        </div>
        <?endif?>

    <?/*
        <?if ($arResult['DATA']['WORK_PHONE']):?>
        <div class="persinf">
        Рабочий телефон:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['WORK_PHONE'])?></b>
        </div>
        <?endif?>
    */?>

    <?endif;?>
<div class="persinf">
    Ф.И.О.<br/>
    <b><?if($USER->IsAuthorized()):?>
            <?=htmlspecialchars($arResult['DATA']['LAST_NAME'])?> <?=htmlspecialchars($arResult['DATA']['NAME'])?> <?=htmlspecialchars($arResult['DATA']['SECOND_NAME'])?>
            <?else:?>
            <?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])?>
        <?endif;?></b>
</div>

<div class="persinf">
    E-mail<br/>
    <b> <?if($USER->IsAuthorized()):?>
            <?=htmlspecialchars($arResult['DATA']['EMAIL'])?>
            <?else:?>
            <?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])?>
        <?endif;?></b>
</div>

<div class="persinf">
    Контактный телефон:<br/>
    <b><?if($USER->IsAuthorized()):?>
            <?if ($arResult['DATA']['PERSONAL_PHONE']):?>
                <?=htmlspecialchars($arResult['DATA']['PERSONAL_PHONE'])?>
                <?else:?>
                не указан
                <?endif?>
            <?else:?>
            <?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])?>
        <?endif;?></b>
</div>

<?/*
    <div class="persinf">
    Рабочий телефон:<br/>
    <b><?=htmlspecialchars($arResult['DATA']['WORK_PHONE'])?></b>
    </div>
*/?>

<div class="smallname">Оплата и доставка</div>

<div class="persinf">
    Тип оплаты:<br/>
    <b><?=$GLOBALS['OSG_STRUCTURE']['SALE']['PAY_SYSTEM'][$arResult['DATA']['PAY_SYSTEM_ID']]['NAME']?></b>
    <input type="hidden" id="data_paysystem" value="<?=$arResult['DATA']['PAY_SYSTEM_ID']?>">
</div>

<div class="persinf">
    Тип доставки:<br/>
    <b><?=$GLOBALS['OSG_STRUCTURE']['SALE']['DELIVERY'][$arResult['DATA']['DELIVERY_ID']]['NAME']?></b>
    <input type="hidden" id="data_delivery" value="<?=$arResult['DATA']['DELIVERY_ID']?>">
</div>

<? if($arResult['DATA']['PERSONAL_COUNTRY']):?>
    <div class="persinf">
        Страна:<br/>
        <b><?=GetCountryByID($arResult['DATA']['PERSONAL_COUNTRY'])?></b>
    </div>
    <?endif?>

<? if($arResult['DATA']['PERSONAL_STATE']):?>
    <div class="persinf">
        Область:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['PERSONAL_STATE'])?></b>
    </div>
    <?endif?>

<? if($arResult['DATA']['PERSONAL_CITY']):?>
    <div class="persinf">
        Город:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['PERSONAL_CITY'])?></b>
        <input type="hidden" id="data_city" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_CITY'])?>">
    </div>
    <?endif?>

<? if($arResult['DATA']['PERSONAL_STREET']):?>
    <div class="persinf">
        Адрес:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['PERSONAL_STREET'])?></b>
        <input type="hidden" id="data_adress" value="<?=htmlspecialchars($arResult['DATA']['PERSONAL_STREET'])?>">
    </div>
    <?endif?>

<? if($arResult['DATA']['PERSONAL_ZIP']):?>

    <div class="persinf">
        Индекс:<br/>
        <b><?=htmlspecialchars($arResult['DATA']['PERSONAL_ZIP'])?></b>
    </div>
    <?endif?>

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


    //arshow($arData);
    /*
    [PROPERTY_DELIVERY_VALUE] => 
    [PROPERTY_PAYMENT_VALUE] => 
    [PROPERTY_CITY_VALUE] => 
    [PROPERTY_ADRESS_VALUE] => 
    [PROPERTY_PACK_VALUE] => Да
    [PROPERTY_MAIN_MAN_VALUE] => 
    [PROPERTY_MAIN_MAN_PHONE_VALUE] => 
    [PROPERTY_INFO_VALUE] => 
    [PROPERTY_REGIME_VALUE] => 
    */

?>

<?if($USER->IsAuthorized()):?>
    <div class="smallname">Прочие пожелания</div>

    <div class="persinf">
        <input type="checkbox" name="DATA[PACK]" id="pack" onchange="$('#ud_regular').trigger('keyup');" <?if ($user_data_pack == "Y"){?>checked="checked" <?}?>><label for="pack">Требуется жесткая упаковка</label><br/>
    </div>

    <div class="persinf">
        Ответственное лицо:<br/>
        <input class="intext text" name="DATA[name5]" id="name5" onchange="$('#ud_regular').trigger('keyup');" value="<?=$user_data_main_man?>"/>
    </div>

    <div class="persinf">
        Телефон ответственного лица:<br/>
        <input class="intext text" name="DATA[phone5]" id="phone5" onchange="$('#ud_regular').trigger('keyup');" value="<?=$user_data_main_man_phone?>"/>
    </div>

    <div class="persinf">
        Режим работы заказчика:<br/>
        <input class="intext text" name="DATA[regime]" id="regime" onchange="$('#ud_regular').trigger('keyup');" value="<?=$user_data_regime?>"/>
    </div>


    <div class="persinf">


        <script type="text/javascript" src="/bitrix/js/main/utils.js"></script>
        <script type="text/javascript" src="/bitrix/js/main/admin_tools.js"></script>
        <script type="text/javascript" src="/bitrix/js/main/popup_menu.js"></script>
        <script type="text/javascript" src="/bitrix/js/main/admin_search.js"></script>
        Желаемая дата доставки (мин. +1 день): <br>
        <span style="white-space:nowrap;"><input type="text" name="DATE_ITEM" size="" value=""><script type="text/javascript" src="/bitrix/js/main/calendar.js"></script><script>
                var mess = {
                    'css_ver': '1301579390',
                    'title': 'Календарь',
                    'date': 'Вставить дату',
                    'jan': 'Январь',
                    'feb': 'Февраль',
                    'mar': 'Март',
                    'apr': 'Апрель',
                    'may': 'Май',
                    'jun': 'Июнь',
                    'jul': 'Июль',
                    'aug': 'Август',
                    'sep': 'Сентябрь',
                    'okt': 'Октябрь',
                    'nov': 'Ноябрь',
                    'des': 'Декабрь',
                    'prev_mon': 'Предыдущий месяц',
                    'next_mon': 'Следующий месяц',
                    'curr': 'Перейти на текущий месяц',
                    'curr_day': 'Вставить текущую дату',
                    'mo': 'Пн',
                    'tu': 'Вт',
                    'we': 'Ср',
                    'th': 'Чт',
                    'fr': 'Пт',
                    'sa': 'Сб',
                    'su': 'Вс',
                    'per_week': 'Период: неделя',
                    'per_mon': 'Период: месяц',
                    'per_year': 'Период: год',
                    'close': 'Закрыть',
                    'month': 'Выбрать месяц',
                    'year': 'Выбрать год',
                    'time': 'Показать время',
                    'time_hide': 'Скрыть время',
                    'hour': 'ч:',
                    'minute': 'м:',
                    'second': 'с:',
                    'hour_title': 'Часы (00 - 23)',
                    'minute_title': 'Минуты (00 - 59)',
                    'second_title': 'Секунды (00 - 59)',
                    'set_time': 'Установить текущее время',
                    'clear_time': 'Сбросить время'
                };

                if (top.jsAdminCalendar)
                    top.jsAdminCalendar.mess = mess;
                else
                    window.jsAdminCalendar.mess = mess;
            </script><a href="javascript:void(0);" title="Календарь"><img src="/bitrix/themes/.default/images/calendar/icon.gif" alt="Календарь" class="calendar-icon" onclick="jsAdminCalendar.Show(this, 'DATE_ITEM', '', '', false, '<?=date("U")?>');" onmouseover="this.className+=' calendar-icon-hover';" onmouseout="this.className = this.className.replace(/\s*calendar-icon-hover/ig, '');"></a></span><script>
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
    Дополнительная информация<br/>

    <script>
        $(function(){
            //очищаем данное поле от пробелов
            $("#ud_regular").val("");
            $('#ud_regular').trigger('keyup');
        })
    </script>

    <textarea id="ud_regular" <?if(!$USER->IsAuthorized()):?> onkeyup="
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
        if($('input[name=DATE_ITEM]').attr('value')!='') glue = 'Желаемая дата доставки: '+$('input[name=DATE_ITEM]').attr('value')+'\n\n'+glue;
        if($('#name5').attr('value')!='') glue = 'Ответственное лицо: '+$('#name5').attr('value')+'\n\n'+glue;
        if($('#phone5').attr('value')!='') glue = 'Телефон ответственного лица: '+$('#phone5').attr('value')+'\n\n'+glue;
        if($('#regime').attr('value')!='') glue = 'Режим работы заказчика: '+$('#regime').attr('value')+'\n\n'+glue;
        if($('#pack').attr('checked')=='checked') glue = 'Требуется жесткая упаковка!'+'\n\n'+glue;
        $('#ud_repeat').attr('value',glue);
        "
        <?endif;?> rows="3" name="DATA[USER_DESCRIPTION]"><?=$user_data_info?>
    </textarea>
    <br><br> 
    <input type="checkbox" name="save_data" value="yes" id="save_data" >
    <label for="save_data" >Сохранить мои данные*</label>
    <br>
    <span class="delivery_description" style="display: block;">* Если сохранить данные, то при следующем оформлении заказа все поля заполнятся автоматически</span>
</div>
<?//arshow($_REQUEST)?>
<?if(!$USER->IsAuthorized()):?>
    <textarea rows="3" name="DATA[USER_DESCRIPTION]" id="ud_repeat" style="display:none">
        Ф.И.О.:<br/>
        <b><?=htmlspecialcharsbx($_REQUEST['DATA']['FIRSTNAME4'])."\r\n"?></b>
        E-mail.:<br/>
        <b><?=htmlspecialcharsbx($_REQUEST['DATA']['EMAIL4'])."\r\n"?></b>
        Phone:<br/>
        <b><?=htmlspecialcharsbx($_REQUEST['DATA']['PHONE4'])."\r\n"?></b>
        <?if ($_REQUEST['DATA']['PERSONAL_CITY'] != "" ) { echo strlen($_REQUEST['DATA']['PERSONAL_CITY']);?>
            Город:<br/>
            <b><?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_CITY'])."\r\n"?></b>
            <?}?>
        <?if ($_REQUEST['DATA']['PERSONAL_STREET'] != "" ){?>
            Адрес:<br/>
            <b><?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_STREET'])."\r\n"?></b>
            <?}?>
    </textarea>
    <?else:?>
    <textarea rows="3" name="DATA[USER_DESCRIPTION]" id="ud_repeat" style="display:none"></textarea>
    <?endif;?>

<script>
    $(function(){ 
        cur_val = $('#ud_repeat').val();       
        
        var val = "";
        <?if ($_REQUEST['DATA']['PERSONAL_CITY'] != "") {?>
            var val = '\nГород: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_CITY'])?>]; ';
            <?}?>
        <?if ($_REQUEST['DATA']['PERSONAL_STREET'] != "") {?>
            val = val + '\nАдрес: [<?=htmlspecialcharsbx($_REQUEST['DATA']['PERSONAL_STREET'])?>]';
            <?}?>     
       
                
        $('#ud_repeat').attr('value',val + " " +  cur_val);     
       
    })
    </script>