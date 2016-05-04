<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($_SESSION['OSG']['USER']['CAN_BUY'] == 'N'):?>
<div class="message">
К сожалению, зарегистрированные пользователи интернет-магазина, не входящие в группу покупателей, не могут оформлять заказы на нашем сайте.
</div>
<?endif?>

<?if ($arResult):?>
<form action="<?=$APPLICATION->GetCurPage()?>" method="POST" id="main_form">

<INPUT type="hidden" name="action" value="continue">
<?foreach ($arResult as $arItem):?>
<input type="hidden" name="price_id[<?=$arItem['PRODUCT_ID']?>]">
<?endforeach;?>

<table cellpadding="0" cellspacing="0" width="100%" class="main_table">
<tr class="head text">
    <td >&nbsp&nbsp  Артикул &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp     Наименование</td>
    <td width="70" align="center">Кол-во</td>
    <td width="70" align="center">Цена</td>
    <td width="70" align="right">Сумма</td>
    <td width="37"><img src="/bitrix/templates/demo/images/close_gray.gif" width="9" height="9" alt="Удалить!" title="Удалить!"/></td>
</tr>

<?foreach ($arResult as $arItem):?>     

<tr class="basket_tovar">
    <td class="tovar">
        <table cellpadding="0" cellspacing="0" width="100%" align="left" border="0">
         
 
                <td width="30%" align="left">
                <?=$arItem['CODE']?> <td width="50%" align="left"><span>  </span>
                <a href="<?=$arItem['URL']?>"><?=$arItem['NAME']?></a></td>
 <tr>         
            <?if ($arItem['PROPS']):?> 
            
            <?foreach ($arItem['PROPS'] as $PROP_CODE=>$arProp):?>
           
                <td width="50%" align="left"><span><?=$arProp['NAME']?></span>
                <?=$arProp['VALUE']?></td>
 </tr>

            <?endforeach;?> 
  
            <?endif?>

            </table>
        

    </td>
    
     <td align="center"><input type="text" class="textbox" name="quantity[<?=$arItem['PRODUCT_ID']?>]" value="<?=(int) $arItem['QUANTITY']?>" onkeyup="set_prices();"/> шт.</td>
    <td class="price"><div id="price_item[<?=$arItem['PRODUCT_ID']?>]"></div></td>
    <td class="summa" align="right"><span id="price_total[<?=$arItem['PRODUCT_ID']?>]"></span></td>
    <td><a href="<?=$arItem['URL_DEL_ITEM']?>"  title="Удалить!"><img src="/bitrix/templates/demo/images/close.gif" width="9" height="9" alt="Удалить!" /></a></td>


</tr>
<?endforeach;?>

<tr class="head">
    <td colspan="3" class="text">Сумма заказа:</td>
    <td class="summa" align="right" id="basket_summ"></td>
    <td class="summa"> руб.</td>
</tr>

<tr>
    <td class="text">Скидка на сумму заказа:</td>
    <td class="text" align="center" id="discount_value"></td>
    <td></td>
    <td class="summa" align="right" id="discount_summ"></td>
    <td class="summa"> руб.</td>
</tr>

<tr class="head">
    <td class="text"><strong>Итого:</strong></td>
    <td class="text" align="center"><strong id="basket_quantity"></strong> шт.</td>
    <td align="left">&nbsp;</td>
    <td class="summa strong" align="right" id="final_basket_summ"></td>
    <td class="summa"> руб.</td>
</tr>
</table><!-- end basket table -->
<table width="100%" cellpadding="0" cellspacing="0" id="basket_submit">
<tr class="oformlenie">
    <td><a href="#" onclick="basket_refresh();">Сохранить изменения в корзине</a></td>
    <td class="summa" colspan="2">
    <?if ($_SESSION['OSG']['USER']['CAN_BUY'] == 'Y'):?>
   <div class="message">
Оформление заказа подтверждает согласие с условиями продажи и возврата.
</div>
 <input type="submit" value="Оформить заказ">
 
    <?endif?></td>
</tr>
</table>


</form>

   <?if ($_SESSION['OSG']['USER']['CAN_BUY'] == 'Y'):?>  

   <?if(!$USER->IsAuthorized()):?>
    
    <?if($_REQUEST['trans_s']!='Y'):
    $_SESSION['OSG']['USER']['oldbasket'] = $_SESSION['OSG']['USER']['BASKET'];
    endif;?>
    
    <div>
    <span style="font-size:14px;color:#EF135B;">
    Внимание! Вы не авторизованы на сайте, заказ будет оформлен на Частное лицо. Цены будут заменены на розничные ( оптовые + 50%).</span></br>
    <br><span style="font-size:14px;color:#EF135B;">Для оформления на пользователя, пожалуйста, авторизуйтесь:
    </span></br>
        <form action="<?=$APPLICATION->GetCurPageParam('auth=login&clear_cache=Y', array('auth'))?>"  method="POST">
        <input type="hidden" name="trans_s" value="Y">
    <table cellpadding="0" cellspacing="0" width="100%" class="left_table" align="left">
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <input name="LOGIN" class="input" type="text" />
            
                <input name="PASSWORD" class="input" type="password"/>
            
                <input type="submit" value="войти" class="button" />
                <STRONG class="reg"><IMG src="/bitrix/templates/demo/images/li3.gif"> <a href="/personal/">Регистрация</a></STRONG>
            </td>
        </tr>
        <tr>
            <td class="remind"><IMG src="/bitrix/templates/demo/images/li4.gif"> <a href="/personal/password.php">вспомнить пароль</a></td>
        </tr>
    </table>
    </form>
    </div>
    <?else:?>     
    <?endif;?>
    
     <!--pre>
    <?print_r($_SESSION['OSG']['USER'])?>
    </pre--> 
    
    <?endif;?>


<script>
PRICE_VARIANTS = new Array;
PRICE_VARIANTS['VALUES'] = new Array;
PRICE_VARIANTS['MAX_QUANTITY'] = new Array;
<?foreach ($arResult as $arItem):?>
    PRICE_VARIANTS['MAX_QUANTITY'][<?=$arItem['PRODUCT_ID']?>] = <?=$arItem['MAX_QUANTITY']?>;
    PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>] = new Array;
    <?foreach ($arItem['PRICE_VARIANTS'] as $N=>$arr):?>
        PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>] = new Array;
        PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>]['MIN_QUANTITY'] = <?=$arr['MIN_QUANTITY']?>;
        PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>]['PRICE'] = <?=CCurrencyRates::ConvertCurrency($arr['PRICE'], $arr['CURRENCY'], "RUR");?>;
        PRICE_VARIANTS['VALUES'][<?=$arItem['PRODUCT_ID']?>][<?=$N?>]['PRICE_ID'] = <?=$arr['PRICE_ID']?>;
        
    <?endforeach;?>
<?endforeach;?>

DISCOUNTS = new Array;
<?foreach ($GLOBALS['OSG_STRUCTURE']['SALE']['DISCOUNT'] as $ID=>$arDiscount):?>
    DISCOUNTS[<?=$ID?>] = new Array;
    DISCOUNTS[<?=$ID?>]['PRICE_FROM'] = <?=$arDiscount['PRICE_FROM']?>;
    DISCOUNTS[<?=$ID?>]['DISCOUNT_VALUE'] = <?=$arDiscount['DISCOUNT_VALUE']?>;
<?endforeach;?>


function set_prices(){
    var BASKET_SUMM = 0;
    var BASKET_QUANTITY = 0;
    var ERROR_QUANTITY = 0;
    <?foreach ($arResult as $arItem):?>
        var PRODUCT_ID = <?=$arItem['PRODUCT_ID']?>;
    
        var QUANTITY =  Number(document.forms['main_form'].elements['quantity['+PRODUCT_ID+']'].value);
        if (!QUANTITY) QUANTITY = 0;
        for (var PRICE_NUMBER in PRICE_VARIANTS['VALUES'][PRODUCT_ID]){
            if (QUANTITY >= PRICE_VARIANTS['VALUES'][PRODUCT_ID][PRICE_NUMBER]['MIN_QUANTITY']){
                var PRICE_ITEM = PRICE_VARIANTS['VALUES'][PRODUCT_ID][PRICE_NUMBER]['PRICE'];
                var PRICE_ID = PRICE_VARIANTS['VALUES'][PRODUCT_ID][PRICE_NUMBER]['PRICE_ID'];
            }
        }
        
        var MAX_QUANTITY = Number(PRICE_VARIANTS['MAX_QUANTITY'][PRODUCT_ID]);
        if (QUANTITY>MAX_QUANTITY){
            ERROR_QUANTITY = 1;
        }
        var PRICE_TOTAL = PRICE_ITEM*QUANTITY;
        BASKET_SUMM += PRICE_TOTAL;
        BASKET_QUANTITY += QUANTITY;
        
        //document.forms['main_form'].elements['quantity['+PRODUCT_ID+']'].value = QUANTITY;
        document.getElementById('price_item['+PRODUCT_ID+']').innerHTML = PRICE_ITEM.toFixed(2);
        document.getElementById('price_total['+PRODUCT_ID+']').innerHTML = PRICE_TOTAL.toFixed(2);
        document.forms['main_form'].elements['price_id['+PRODUCT_ID+']'].value = PRICE_ID;
    <?endforeach;?>
    

    var DISCOUNT_VALUE = 0;
    for (var ID in DISCOUNTS){
        if (BASKET_SUMM > DISCOUNTS[ID]['PRICE_FROM']){
            DISCOUNT_VALUE = DISCOUNTS[ID]['DISCOUNT_VALUE'];
        }
    }
    DISCOUNT_VALUE += <?=$_SESSION['OSG']['USER']['BASKET']['DISCOUNT']['VALUE']?>;
    
    var DISCOUNT_SUMM = BASKET_SUMM*DISCOUNT_VALUE/100;
    var FINAL_BASKET_SUMM = BASKET_SUMM - DISCOUNT_SUMM; 
    
    
    document.getElementById('basket_summ').innerHTML = BASKET_SUMM.toFixed(2);
    document.getElementById('basket_quantity').innerHTML = BASKET_QUANTITY;
    document.getElementById('discount_value').innerHTML = DISCOUNT_VALUE ? DISCOUNT_VALUE+'%' : '';
    document.getElementById('discount_summ').innerHTML = DISCOUNT_SUMM.toFixed(2);
    document.getElementById('final_basket_summ').innerHTML = FINAL_BASKET_SUMM.toFixed(2);
    
    <?if ($arParams['NO_LIMIT'] != 'Y'):?>
        if (ERROR_QUANTITY){
            alert("К сожалению, такого количества товара нет на складе");
            document.getElementById('basket_submit').style.display = 'none';
        }else{
            document.getElementById('basket_submit').style.display = '';
        }
    <?endif?>
}

function basket_refresh(){
    document.forms['main_form'].elements['action'].value = 'refresh';
    document.forms['main_form'].submit();
}

set_prices();
</script>

<?if($_REQUEST['trans_s']=='Y'):?>
<script>
location.reload(true);
</script>
<?endif;?>

<?else:?>
    Ваша корзина пуста.<br>
    Чтобы отложить товар в корзину, зайдите на страницу детального описания этого товара.
<?endif?>