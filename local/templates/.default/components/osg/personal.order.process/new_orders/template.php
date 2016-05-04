<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//arshow($_POST)?>
<table class="tabord">
    <?if($arResult['STEP']==1){?>
        <tr>
            <td> <div class="activesquare1">Способ доставки, оплаты и адрес доставки</div></td>
            <td> <div class="square2">Подтверждение заказа</div></td>
        </tr>
        <?}else {
        ?>
        <tr>
            <td> <div class="square1">Способ доставки, оплаты и адрес доставки</div></td>
            <td> <div class="activesquare2">Подтверждение заказа</div></td>
        </tr>
        <?}?>
</table>

<?if ($arResult['MESSAGE']):?> <div class="message"><?=$arResult['MESSAGE']?></div> <?endif?>

<form id="main_form" action="<?=$APPLICATION->GetCurPage()?>" method="POST">
    <input type="hidden" name="STEP" value="<?=$arResult['STEP']?>">
    <INPUT type="hidden" name="ACTION">
    <?foreach ($arResult['DATA'] as $key=>$val):?>
        <input type="hidden" name="DATA[<?=$key?>]" value="<?=htmlspecialchars($val)?>">
        <?endforeach;?>

    <?include('step_'.strtolower($arResult['STEP_CODE']).'.php')?>

    <div class="btns" <?if ($arResult['STEP']!=1){?> style="height: 70px;" <?}?>>
        <a href="#" onclick="submit_order_form('NEXT')" class="orda"><div class="greennext">Далее</div></a>
        <a href="#" onclick="submit_order_form('PREV')" class="orda"><div class="greenret">Вернуться назад</div></a>
        <div class="right">На следующей странице Вам необходимо подтвердить заказ</div>
    </div>



</form>

<SCRIPT>
    function submit_order_form(action){

        //перед отправкой формы, проверяем, не поствил ли пользователь галочку "сохранить данные"
        if ($("#save_data").attr("checked") == "checked") {
            //собираем нужные поля
            var delivery = $("#data_delivery").val();
            var paysystem = $("#data_paysystem").val();
            /*////////////////////////////////////*/
            var city = $("#data_city").val();  if (!city) {city = "no";}              
            var adress = $("#data_adress").val();  if (!adress) {adress = "no";}
            var pack; //требуетя жесткая упаковка
            if ($("#pack").attr("checked") == "checked") {pack = "yes";} else {pack = "no";}
            var main_man = $("#name5").val(); /*ответственное лицо*/  if (!main_man) {main_man = "no";} 
            var main_man_phone = $("#phone5").val(); /*телефон ответственного лица*/ if (!main_man_phone) {main_man_phone = "no";} 
            var regime = $("#regime").val(); /*режим работы заказчика*/ if (!regime) {regime = "no";}
            var info = $("#ud_regular").val(); /*информация*/  if (!info) {info = "no";}
            var user_login = "<?=$USER->GetLogin()?>";
            ///

            //отправляем данные в скрипт, который будет сохранять данные пользователя

            $.post("/ajax/user_data_save.php", { 
                delivery: delivery,
                paysystem: paysystem,
                city: city,
                adress: adress,
                pack: pack,
                main_man: main_man,
                main_man_phone: main_man_phone,
                regime: regime,
                info: info,
                user_login: user_login            
                },
                function(data){

                    $("#DATEPSID").val($(":radio[name=PAYS_ID]").filter(":checked").val());
                    $("#DATADEL").val($(":radio[name=DELID]").filter(":checked").val());

                    document.forms['main_form'].elements['ACTION'].value = action;
                    document.forms['main_form'].submit();
            });


            /*
            alert(
            "Доставка: " + delivery + 
            "; Оплата: " + paysystem + 
            "; Город: " + city + 
            "; Адрес: " + adress + 
            "; Упаковка: " + pack + 
            "; Ответственное лицо: " + main_man + 
            "; Телефон ответственного лица: " + main_man_phone + 
            "; Режим работы: " + regime + 
            "; Информация: " + info 
            )  */

        }    

        else {

            $("#DATEPSID").val($(":radio[name=PAYS_ID]").filter(":checked").val());
            $("#DATADEL").val($(":radio[name=DELID]").filter(":checked").val());

            document.forms['main_form'].elements['ACTION'].value = action;
            document.forms['main_form'].submit();   

        }




    }
</SCRIPT>

<?//echo '<pre>'.print_r($_REQUEST, true).'</pre>';?>
<?//echo '<pre>'.print_r($arResult, true).'</pre>';?>
