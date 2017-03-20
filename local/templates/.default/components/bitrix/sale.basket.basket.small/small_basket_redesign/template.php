<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $frame = $this->createFrame()->begin() ?>
<?
    $total_price = 0;
    $total_quantity = 0;
    $delay_quantity = 0;
?>
<?if ($arResult["READY"]=="Y" || $arResult["DELAY"]=="Y" || $arResult["NOTAVAIL"]=="Y" || $arResult["SUBSCRIBE"]=="Y"):?>

    <?
        foreach ($arResult["ITEMS"] as $v)
        {
            if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
            {
                //если пользоваткль не авторизован и сайт оптовый, то все равно показываем оптовые цены
                if (!$USER->IsAuthorized() && checkSite() != "retail"){
                    $productPrice = CPrice::GetList( array(),array("PRODUCT_ID" => $v["PRODUCT_ID"], "CATALOG_GROUP_ID"=>1), false, false, array())->Fetch();
                    $v["PRICE"] = $productPrice["PRICE"];
                }

                $total_price += $v["PRICE"]*$v["QUANTITY"];
                $total_quantity++;
            }
        }
    ?>

    <?if ($arResult["DELAY"]=="Y"):?>

        <?
            foreach ($arResult["ITEMS"] as $v)
            {
                if ($v["DELAY"]=="Y" && $v["CAN_BUY"]=="Y")
                {
                    $delay_quantity++;
                }
            }
        ?>

        <?endif;?>
    <?endif;?>
<a class="header-url" href="/personal/basket/" title="Корзина">
    <?if ($total_quantity > 0) {?>
        <div class="items_count" title="товаров в корзине: <?=$total_quantity?>"><?=$total_quantity?></div>
        <?}?>
    <img class="lk-logo" src="/images/basket-header.png" alt=""/> 
    <div class="lk-header" style="display: inline;">                                           
        <?if ($total_price > 0) {?>
            <?=ceil(CCurrencyRates::ConvertCurrency($total_price, "USD", "RUR"));?> Р
            <?} else {?>
            Корзина пуста
            <?}?>
    </div>
</a>
<style>
.jqmbasket_error {
    position: fixed;
    top: 27%;
    left: 50%;
    margin-left: -200px;
    width: 400px;
    height: 200px;
    background-color: white;
    border: 1px solid black;
    z-index: 3000;
    font: 16px "clear_sansbold";
    color: black;
    padding-bottom: 20px;
    margin-bottom: 20px;              
}         
.jqmOverlay_basket{
    background: #000;
}              
.jqmClose_basket{
    background: url(/images/close-modal.png) no-repeat;
    width: 19px;
    height: 19px;
    display: block;
    float: right;
    border: none;
    margin: 20px;
    cursor: pointer;
}
.basket_error_title{
    margin: 20px; 
    border-bottom: 2px solid black;
    padding-bottom: 20px;   
    text-transform: uppercase;  
}                        
.basket_error_message{
    padding: 0px 20px 20px;
    font: 13px "clear_sansregular";
    color: #333;  
}
.basket_error_message b{            
    color: #e31f1f;   
}
.basket_link_button{          
    font: 13px "clear_sansregular";
    width: 300px;
    height: 35px;
    border: none;
    background-color: #1AA1C8;
    color: white;
    text-transform: uppercase;
    text-align: center;
    line-height: 35px;
    margin: auto;
}                  
</style>
<div class="jqmOverlay_basket" style="height: 100%; width: 100%; position: fixed; left: 0px; top: 0px; z-index: 2999; opacity: 0.7; display: none;"></div>
<div class="jqmbasket_error" style="display:none">
    <div id="closebasketerror" class="jqmClose_basket"></div>

    <div class="basket_error_title"><?=GetMessage('TSBS_ERROR_TITLE')?></div>
    <div class="basket_error_message"><b><?=GetMessage('TSBS_ERROR_MSG1')?></b><br><?=GetMessage('TSBS_ERROR_MSG2')?></div>
    <a href="/personal/basket/" class="basket_link_button"><?=GetMessage('TSBS_ERROR_2BASKET')?></a>
</div>    
<? $frame->beginStub() ?>
<div class="cssload-container">
    <div class="cssload-speeding-wheel"></div>
</div>
<? $frame->end() ?>