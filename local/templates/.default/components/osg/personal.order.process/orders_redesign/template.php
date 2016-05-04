<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!($USER->IsAuthorized()) && checkSite()=="opt"){header("location: http://retail.autobody.ru/personal/order/");}?>
<div class="order">
    <?
    //arshow($arResult["DATA"]);
    //arshow($_POST)?>
    <table class="order-point " style="margin: 20px 0 0;">
        <?if($arResult['STEP']==1){?>
            <tr>
                <td class="active-order-point"><div>1. ИНФОРМАЦИЯ О ЗАКАЗЕ</div></td>
                <td><div>2. ПОДТВЕРЖДЕНИЕ ЗАКАЗА</div></td>
                <td><div>3. ЗАКАЗ УСПЕШНО ОФОРМЛЕН</div></td>
            </tr>
            <?}else if ($arResult['STEP']==2)  {
            ?>
            <tr>
                <td ><div>1. ИНФОРМАЦИЯ О ЗАКАЗЕ</div></td>
                <td class="active-order-point"><div>2. ПОДТВЕРЖДЕНИЕ ЗАКАЗА</div></td>
                <td><div>3. ЗАКАЗ УСПЕШНО ОФОРМЛЕН</div></td>
            </tr>
            <?} else {?>
            <tr>
                <td ><div>1. ИНФОРМАЦИЯ О ЗАКАЗЕ</div></td>
                <td><div>2. ПОДТВЕРЖДЕНИЕ ЗАКАЗА</div></td>
                <td class="active-order-point"><div>3. ЗАКАЗ УСПЕШНО ОФОРМЛЕН</div></td>
            </tr>
            <?}?>
    </table>

                                                      

    <?if ($arResult['MESSAGE']):?> <div class="message"><?=$arResult['MESSAGE']?></div> <?endif?>

    <form id="main_form" action="<?=$APPLICATION->GetCurDir()?>" method="POST">
        <input type="hidden" name="STEP" value="<?=$arResult['STEP']?>">
        <input type="hidden" name="ACTION">
        <?foreach ($arResult['DATA'] as $key=>$val):?>
            <input type="hidden" name="DATA[<?=$key?>]" value="<?=htmlspecialchars($val)?>">
            <?endforeach;?>

        <?include('step_'.strtolower($arResult['STEP_CODE']).'.php')?>

        <table class="payment">
            <tr>
                <td colspan="2" style="width:100% !important">
                    <div class="field"><font class="red-text">*</font> -поля, обязательные для заполнения</div> 
                    <?if ($arResult['STEP']==1) {?>
                     <button class="button_none" type="submit"></button>
                    <button class="button2" type="submit" onclick="submit_order_form('NEXT')">ДАЛЕЕ</button>
                <?} else {?>
                    <button class="button1" type="submit" onclick="submit_order_form('PREV')">НАЗАД</button>
                    <button class="button2" type="submit" onclick="submit_order_form('NEXT')">ДАЛЕЕ</button>
                    <?}?>
                </td>
            </tr> 
        </table>

          
    </form>

    <SCRIPT>    
        function save_data()
        {
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
                        return true;
                    }
                );
                return false;            
        }
    
        function submit_order_form(action)
        {
            var form = $( "#main_form" );
            form.validate();
            
            if (form.valid()) 
            {
                // --- засовываем в куки поля DATA[PERSONAL_STREET] и DATA[PERSONAL_CITY],чтобы потом юзнуть их в init при оформлениии заказа
                //$.cookie('comment_city', $('input.text[name="DATA[PERSONAL_CITY]"]').val());
                //$.cookie('comment_street', $('input.text[name="DATA[PERSONAL_STREET]"]').val());
            
                //перед отправкой формы, проверяем, не поствил ли пользователь галочку "сохранить данные"
                if ($("#save_data").attr("checked") == "checked") {
                    if ( save_data() )
                    {
                        $("#DATEPSID").val($(":radio[name=PAYS_ID]").filter(":checked").val());
                        $("#DATADEL").val($(":radio[name=DELID]").filter(":checked").val());

                        document.forms['main_form'].elements['ACTION'].value = action;
                        document.forms['main_form'].submit();    
                    }  
                }    
                else 
                {
                    $("#DATEPSID").val($(":radio[name=PAYS_ID]").filter(":checked").val());
                    $("#DATADEL").val($(":radio[name=DELID]").filter(":checked").val());

                    document.forms['main_form'].elements['ACTION'].value = action;
                    document.forms['main_form'].submit();
       
                }
            }
        }
        
        
        
        /*$(document).ready(function(){
            $('#main_form').submit(function(){
               $.cookie('comment_city', $('input.text[name="DATA[PERSONAL_CITY]"]').val());
               $.cookie('comment_street', $('input.text[name="DATA[PERSONAL_STREET]"]').val());
            })
        })*/
        
        /*$(function() {  
            $('#main_form').validate({
                submitHandler: function(form) {
                    console.log("test");
                    // some other code
                    // maybe disabling submit button
                    // then:
                    // --- засовываем в куки поля DATA[PERSONAL_STREET] и DATA[PERSONAL_CITY],чтобы потом юзнуть их в init при оформлениии заказа
                    $.cookie('comment_city', $('input.text[name="DATA[PERSONAL_CITY]"]').val());
                    $.cookie('comment_street', $('input.text[name="DATA[PERSONAL_STREET]"]').val());
                    submit_order_form('NEXT');
                }
            });  
        })*/  
        
    </SCRIPT>

    <?//echo '<pre>'.print_r($_REQUEST, true).'</pre>';?>
    <?//echo '<pre>'.print_r($arResult, true).'</pre>';?>

</div>

<?
//arshow($_SESSION);
if ($_SESSION["SESS_AUTH"]["LOGIN"] == '1188') {
  //  arshow($_POST);
}
?>
