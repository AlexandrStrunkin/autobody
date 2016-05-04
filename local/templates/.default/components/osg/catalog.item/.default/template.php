<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? //echo '<div style="color:black"><pre>'; print_r($arResult); echo '</pre></div>';?>
<form id="main_form" method="POST" action="?item_id=<?=$arResult['ITEM']['ID']?>">
    <input type="hidden" name="basket_action" value="add">
    <input type="hidden" name="price_id">
<table cellpadding="0" cellspacing="0" width="100%" class="item_table">
<tr valign="top">
	<td width="243">
    	<div id="imgBlock">
  			<div class="middleImgWrapper">
  				<!--<img src="/bitrix/templates/demo/images/item.jpg" width="235" height="343" alt="" />-->
  				<img alt="<?=$arResult['ITEM']['NAME']?>" id="main_image" width="235"/>
  			</div>
			<?if (count($arResult['PHOTOGALLERY']) > 1):?>
			<div class="item_photo">
            	Фотографии:
			  	<?foreach ($arResult['PHOTOGALLERY'] as $N=>$PATH):?>
			  	   <a href="#" onclick="set_main_image(<?=$N?>); return false;" id="photo_nav_<?=$N?>">
			  	      <?=$N?>
			  	   </a>
			  	<?endforeach;?>
			</div>
			<?endif?>
            
            
            <div class="left_bottom_href">
            	<span><img src="/bitrix/templates/demo/images/otloj.gif" width="17" height="18" alt="" /><a href="<?=$arResult['ITEM']['DELAY_URL']?>">В блокнот</a></span><br />
            	<span><img src="/bitrix/templates/demo/images/add.gif" width="16" height="18" alt="" /><a href="<?=$arResult['ITEM']['COMPARE_URL']?>">Добавить к сравнению</a></span><br />
            	
			</div>
  		</div>
    </td>
    <td class="item_right">
    	<table cellpadding="0" cellspacing="0" width="100%">
        <tr>
        	<td>
            	<div class="about_tovar">   
	            	<?if ($arResult['ITEM']['PROPS']['STATUS']['VALUE']):?>
	            		<span><img src="/bitrix/templates/demo/images/yes.gif" width="17" height="17" /> Есть в наличии</span>
	            	<?else:?>
	            		<span><img src="/bitrix/templates/demo/images/no.gif" width="17" height="17" /> Нет в наличии</span>
	            	<?endif?><br /><br />
					<span>Артикул:</span> <?=$arResult['ITEM']['CODE']?><br />
					<?if ($val = $arResult['ITEM']['PROPS']['FIRM']['VALUE']):?>
					   <span>Бренд: </span><?=$val?><br />
				    <?endif?>
				    <?if ($val = $arResult['ITEM']['PROPS']['COUNTRY']['VALUE']):?>
					   <span>Страна производитель: </span><?=$val?><br />
				    <?endif?>
                    
                    <?if ($val = $arResult['ITEM']['PROPS']['SIZE']['VALUE']):?>
                       <span>Год: </span><?=$val?><br />
                    <?endif?>
                   <?if ($val = $arResult['ITEM']['PROPS']['UNC']['VALUE']):?>
                       <span>OEM#: </span><?=$val?><br />
                    <?endif?>
                    <?if ($val = $arResult['ITEM']['PROPS']['WARRANTY']['VALUE']):?>
                       <span>Ожид. дата поступления: </span><?=$val?><br />
                    <?endif?>

                    
					<span>Группа:</span> <a href="<?=$arResult['SECTION']['URL']?>"> <?=$arResult['SECTION']['NAME']?></a>
				</div>
            </td>
            <td width="75">
            	<div class="print">
                	<a href="#" onclick="item_print();"><img src="/bitrix/templates/demo/images/biger.gif" width="13" height="12" /></a>
                	<div>Страница для печати</div>
                </div>
            </td>
        </tr>
        </table>
		<div class="tovar_text">	<?=$arResult['ITEM']['DETAIL_TEXT']?> </div>
        
                            <div class="rate">
  <?    $arItem['ID'] = $arResult['ITEM']['ID'];
  
 if($USER->IsAuthorized()){  
 
   $Out='';
   $star_red1='<a href="/catalog/item.php?action=add_mark&mark=1&item_id='.$arItem['ID'].'"><img src="/i/rate_red.gif" width="12" height="11" border="0" /></a>';
   
   $star_red2='<a href="/catalog/item.php?action=add_mark&mark=2&item_id='.$arItem['ID'].'"><img src="/i/rate_red.gif" width="12" height="11" border="0" /></a>';

   $star_red3='<a href="/catalog/item.php?action=add_mark&mark=3&item_id='.$arItem['ID'].'"><img src="/i/rate_red.gif" width="12" height="11" border="0" /></a>';

   $star_red4='<a href="/catalog/item.php?action=add_mark&mark=4&item_id='.$arItem['ID'].'"><img src="/i/rate_red.gif" width="12" height="11" border="0" /></a>';

   $star_red5='<a href="/catalog/item.php?action=add_mark&mark=5&item_id='.$arItem['ID'].'"><img src="/i/rate_red.gif" width="12" height="11" border="0" /></a>';
   
   
   $star_gray1='<a href="/catalog/item.php?action=add_mark&mark=1&item_id='.$arItem['ID'].'"><img src="/i/rate_gray.gif" width="12" height="11" border="0" /></a>';
   
   $star_gray2='<a href="/catalog/item.php?action=add_mark&mark=2&item_id='.$arItem['ID'].'"><img src="/i/rate_gray.gif" width="12" height="11" border="0" /></a>';

   $star_gray3='<a href="/catalog/item.php?action=add_mark&mark=3&item_id='.$arItem['ID'].'"><img src="/i/rate_gray.gif" width="12" height="11" border="0" /></a>';

   $star_gray4='<a href="/catalog/item.php?action=add_mark&mark=4&item_id='.$arItem['ID'].'"><img src="/i/rate_gray.gif" width="12" height="11" border="0" /></a>';

   $star_gray5='<a href="/catalog/item.php?action=add_mark&mark=5&item_id='.$arItem['ID'].'"><img src="/i/rate_gray.gif" width="12" height="11" border="0" /></a>';
   
   
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
   $star_red='<img src="/i/rate_red.gif" width="12" height="11" border="0" />';
   
   $star_gray='<img src="/i/rate_gray.gif" width="12" height="11" border="0" />';
   
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
 
 echo $Out;
?>                           </div>
        
        <table cellpadding="0" cellspacing="0" width="100%" class="feature">
        <?foreach ($arResult['ITEM']['OSG_PROPS'] as $PROP_CODE=>$arProp):?>
	       <?if (is_array($arProp['VALUES']) && $arProp['VALUES']):?>
                <tr>
                    <td><span><?=$arProp['NAME']?>:</span> </td>
                    <td><select name="<?=$PROP_CODE?>" <?if ($arProp['IS_PRICING']):?>id="osg_pricing_prop" onchange="set_prices()"<?else:?>id="osg_prop"<?endif?>>
                        <?foreach ($arProp['VALUES'] as $VALUE_ID => $VALUE):?>
                            <option value="<?=$VALUE_ID?>" <?if ($_REQUEST[$PROP_CODE]==$VALUE_ID):?>selected<?endif?>><?=$VALUE?></option>
                        <?endforeach;?>
                    </select></td>
                </tr>	           
	       <?else:?>                
             <?if ($arProp['IS_PRICING']):?><input type="hidden" name="<?=$PROP_CODE?>" id="osg_pricing_prop" value="0"><?endif?>
	       <?endif?>
	   <?endforeach;?>
       </table>
        
        
        
        <div class="price">
        	Цена: <span id="price_item"></span> руб.
        </div>
        
        <table cellpadding="0" cellspacing="0" width="100%" class="table_rezult">
        <tr>
        	<td class="price_rezult">
            	<div class="price">
                	<input type="text" class="textbox" name="quantity" value="<?=($_REQUEST['quantity']) ? $_REQUEST['quantity'] : 1?>" onkeyup="set_prices();"/>шт. 
        			Итого: <span id="price_total"></span> руб.
        		</div>
            </td>
            <td width="170" align="center" class="item_submit">
		  		<input name="submit" type="submit" value="Добавить в корзину" />
            </td>
        </tr>
        </table>
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
// echo '<pre>'.print_r($ar_props,true).'</pre>';
// echo $ar_props['VALUE']."qq";
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
                <!-- white block -->
                <div class="white">
                	<div class="top">&nbsp;</div>
                	<div class="middle">
<table cellpadding="0" cellspacing="0" border="0" width="80%">
<tr>
<td>                    

                        	<a href="#" onclick="show_tab('reviews'); return false;" style="text-decoration:none"><h4>Отзывы о товаре</h4></a>
</td>
<td>                            
                                <span><a href="#" onclick="show_tab('all_reviews'); return false;">Посмотреть все отзывы о товаре</a> (<strong><? echo $count_answ; ?></strong>)</span>
</td>
<td>                                
                                <span><a href="#" onclick="show_tab('add_review'); return false;">Добавить отзыв</a></span>
</td>
<td>
                            <div class="rat">
                            	<span class="green">:) <? echo $count_three; ?></span> <span class="gray">:| <? echo $count_two; ?></span> <span class="pink">:( <? echo $count_one;?></span>
                            </div>
</td>                            
</tr>
</table>

<br><br>
                        
<div id="reviews">    
                    
<?

function GetMonthName($id){
 $text=array("январь","февраль","март","апрель","май","июнь","июль","август","сентябрь","октябрь","ноябрь","декабрь");
 return $text[($id-1)];
}

$arFilter = Array(
   "IBLOCK_CODE"=>"COMMENT",
   "PROPERTY_PRODUCT"=>$arResult['ITEM']['ID'],
   "ACTIVE"=>"Y"
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter,false, Array("nTopCount"=>2));
while($ar_fields = $res->GetNext())
{
//  echo '<pre>'.print_r($ar_fields,true).'</pre>';
 $date=explode(' ',$ar_fields['DATE_CREATE']);
 $mydate=explode('.',$date[0]);
 $month=GetMonthName($mydate[1]);
 
// echo $ar_fields['IBLOCK_ID']."ww<br>";
// echo $arResult['ITEM']['ID']."qq<br>";
$db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc",Array("CODE"=>"MARK","PRODUCT"=>$arResult['ITEM']['ID']));
if($ar_props = $db_props->Fetch()){
// echo '<pre>'.print_r($ar_props,true).'</pre>';
// echo $ar_props['VALUE']."qq";
 $mark=$ar_props['VALUE'];
}

$db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc",Array("CODE"=>"USER","PRODUCT"=>$arResult['ITEM']['ID']));
while($ar_props = $db_props->GetNext()){
// echo '<pre>'.print_r($ar_props,true).'</pre>';
// echo $ar_props['VALUE']."qq";
 $user_com=$ar_props['VALUE'];
}
//echo $user_com."ww";
$rsUser = CUser::GetByID($user_com);
$arUser = $rsUser->Fetch();
//echo "<pre>"; print_r($arUser); echo "</pre>";
$city=$arUser['PERSONAL_CITY'];

switch($mark){
 case "1": $mark_str='<div class="smile pink">
                      	отрицательно<br /><span>:(</span>
                       </div>';
 break;
 case "2": $mark_str='<div class="smile gray">
                      	нейтрально<br /><span>:|</span>
                       </div>';
 break;
 case "3": $mark_str='<div class="smile green">
                      	положительно<br /><span>:)</span>
                       </div>';
 break;
}

 echo '
                       <div class="response">                        
                            <div class="date">
                            	<span>'.$mydate[0].'</span><br />'.$month.' '.$mydate[2].'
                            </div>
                            <div class="block">
                            	<div class="user"><strong>'.$ar_fields['NAME'].'</strong>, '.$city.'</div>
                                <div class="resp_top">&nbsp;</div>
                                <div class="resp_middle">
                                	<p>'.$ar_fields['PREVIEW_TEXT'].'</p>
                                </div>
                                <div class="resp_bottom">&nbsp;</div>
                            </div><!-- /block -->
							'.$mark_str.'
                        </div> 
 ';
}

?>

</div>   

<div id="all_reviews">                        
<?
$arFilter = Array(
   "IBLOCK_CODE"=>"COMMENT",
   "PROPERTY_PRODUCT"=>$arResult['ITEM']['ID'],
   "ACTIVE"=>"Y"
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter,false);
while($ar_fields = $res->GetNext())
{
//  echo '<pre>'.print_r($ar_fields,true).'</pre>';
 $date=explode(' ',$ar_fields['DATE_CREATE']);
 $mydate=explode('.',$date[0]);
 $month=GetMonthName($mydate[1]);
 
// echo $ar_fields['IBLOCK_ID']."ww<br>";
// echo $arResult['ITEM']['ID']."qq<br>";
$db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc",Array("CODE"=>"MARK","PRODUCT"=>$arResult['ITEM']['ID']));
if($ar_props = $db_props->Fetch()){
// echo '<pre>'.print_r($ar_props,true).'</pre>';
// echo $ar_props['VALUE']."qq";
 $mark=$ar_props['VALUE'];
}

$db_props = CIBlockElement::GetProperty($ar_fields['IBLOCK_ID'], $ar_fields['ID'], "sort", "asc",Array("CODE"=>"USER","PRODUCT"=>$arResult['ITEM']['ID']));
while($ar_props = $db_props->GetNext()){
// echo '<pre>'.print_r($ar_props,true).'</pre>';
// echo $ar_props['VALUE']."qq";
 $user_com=$ar_props['VALUE'];
}
//echo $user_com."ww";
$rsUser = CUser::GetByID($user_com);
$arUser = $rsUser->Fetch();
//echo "<pre>"; print_r($arUser); echo "</pre>";
$city=$arUser['PERSONAL_CITY'];

switch($mark){
 case "1": $mark_str='<div class="smile pink">
                      	отрицательно<br /><span>:(</span>
                       </div>';
 break;
 case "2": $mark_str='<div class="smile gray">
                      	нейтрально<br /><span>:|</span>
                       </div>';
 break;
 case "3": $mark_str='<div class="smile green">
                      	положительно<br /><span>:)</span>
                       </div>';
 break;
}

 echo '
                       <div class="response">                        
                            <div class="date">
                            	<span>'.$mydate[0].'</span><br />'.$month.' '.$mydate[2].'
                            </div>
                            <div class="block">
                            	<div class="user"><strong>'.$ar_fields['NAME'].'</strong>, '.$city.'</div>
                                <div class="resp_top">&nbsp;</div>
                                <div class="resp_middle">
                                	<p>'.$ar_fields['PREVIEW_TEXT'].'</p>
                                </div>
                                <div class="resp_bottom">&nbsp;</div>
                            </div><!-- /block -->
							'.$mark_str.'
                        </div> 
 ';
}
?>
</div>
                                             
<div id="add_review">
<div class="response">
		   <form action="<?=$APPLICATION->GetCurPageParam('action=get_comment', array('action'))?>" method="POST" id="review_form">
            Оценка
                    <input type="radio" name="my_mark" value="1"><span class="pink">:( отрицательно</span>
                    <input type="radio" name="my_mark" value="2"><span class="gray">:| нейтрально</span>                    
                    <input type="radio" name="my_mark" value="3"><span class="green">:) положительно</span>
                    
                    <br>
		    Отзыв
				<textarea width="100%" name="my_comment"></textarea><br><br>
			    <input type="submit" name="my_submit" value="Оставить свой отзыв" style="width:200px; height:20px; background-color:#CCCCCC">
		   </form>
</div>
</div>

        
        <?if (is_array($arResult['ADD_GOODS'])):?>
        <!--  -----------------  close  ----------------- -->
        <div class="accompanying" id="accompanying">
        	<table cellpadding="0" cellspacing="0" width="100%">
            <tr>
            	<td><h5>Сопутствующие товары</h5></td>
                <td width="10"><img src="/bitrix/templates/demo/images/close_div.gif" width="10" height="10" alt="Закрыть" onClick="getElementById('accompanying').style.display='none'"  /></td>
            </tr>
            </table>
            
            <table cellpadding="0" cellspacing="0" width="100%" class="accompanying_tovar">
            <?foreach ($arResult['ADD_GOODS'] as $ID=>$arItem):?>
            <tr valign="top">
            	<td width="120" align="left">
                	<div class="middleImgWrapper">
  						<img src="<?=$arItem['PREVIEW_PICTURE']?>" width="100" height="100" alt="<?=$arItem['NAME']?>" />
  					</div>
            	</td>
                <td class="accompanying_right">
                	<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="tovar_name"><?=$arItem['NAME']?> </a>
                    <p>
                    	<?=$arItem['PREVIEW_TEXT']?>
                    </p>
                    <div class="biger">
            			<span><?=CCurrencyRates::ConvertCurrency($arItem['PRICE']['PRICE'], "USD", "RUR")?> руб.</span>
                        <img src="/bitrix/templates/demo/images/linza.gif" width="14" height="13" /><a href="<?=$arItem['DETAIL_PAGE_URL']?>">Детальный просмотр</a>
                		<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="/bitrix/templates/demo/images/biger.gif" width="13" height="12" /></a>
            		</div>
                </td>
            </tr>
            <?endforeach;?>
            </table>
        </div>
        <?endif?>
        
    </td>
</tr>
</table>




  
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

show_tab('reviews');


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
set_main_image(1);

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
    document.getElementById('price_item').innerHTML = PRICE_ITEM.toFixed(2);
    document.getElementById('price_total').innerHTML = PRICE_TOTAL.toFixed(2);
    document.forms['main_form'].elements['price_id'].value = PRICE_ID;
    
    <?if ($arParams['NO_LIMIT'] != 'Y'):?>
        if (QUANTITY>MAX_QUANTITY){
            if(MAX_QUANTITY>0) alert("К сожалению, такого количества товара нет на складе");
            document.forms['main_form'].elements['submit'].disabled = true;
        }else{
            document.forms['main_form'].elements['submit'].disabled = '';
        }
    <?endif?>
    
    <?if (!$arResult['ITEM']['PROPS']['STATUS']['VALUE']):?>
        document.forms['main_form'].elements['submit'].disabled = true;
    <?endif?>
}

set_prices();





</script>
<?//echo '<pre>'.print_r($arResult, true).'</pre>';?>