<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$year = (int) $_REQUEST['year']; //print_r($arResult);?>

<?$show_news_block_number = ($APPLICATION->GetCurPage() == $arResult['NEWS_PAGE_URL']) ?  2 : 1?>

<?if ($arResult['ITEMS']):?>
<div class="news_block" id="news_block_1">

	<div class="news_head">
    	<strong>НОВОСТИ</strong>
        <span>|</span>
        <a href="#" onclick="show_news_block(2);">АРХИВ</a>
    </div>

    <?foreach ($arResult['ITEMS'] as $arr):?>
    <div class="news_date">
    	<span><?=$arr['DATE_ACTIVE_FROM']['DD']?>.<?=$arr['DATE_ACTIVE_FROM']['MM']?></span><?=$arr['DATE_ACTIVE_FROM']['YYYY']?>
    </div>
<!--p><? echo CFile::ShowImage($arr['PREVIEW_PICTURE'],200,200); ?></p-->    
<p>	
        <a href="<?=$arr['DETAIL_PAGE_URL']?>"><?=$arr['PREVIEW_TEXT']?></a>
    </p>
    <?endforeach;?>
    
</div>

<div class="news_block" id="news_block_2">
	<div class="news_head">
    	<a href="#" onclick="show_news_block(1);">НОВОСТИ</a>
        <span>|</span>
        <strong>АРХИВ</strong>
    </div>

	<div class="news_year">
		<?if ($APPLICATION->GetCurPageParam() == $arResult['NEWS_PAGE_URL']):?>
    		<strong>За все время</strong>
    	<?else:?>
    		<a href="<?=$arResult['NEWS_PAGE_URL']?>">За все время</a>
    	<?endif?>
    	
    	<br /><br />
    	<?for ($y = (int) $arResult['LAST_NEWS_DATE']['YYYY']; $y >= (int) $arResult['FIRST_NEWS_DATE']['YYYY']; $y--):?>
	  		<?if ($year==$y):?>
	  			<strong><?=$y?></strong>
	  		<?else:?>
	  			<a href="<?=$arResult['NEWS_PAGE_URL']?>?year=<?=$y?>"><?=$y?></a>
	  		<?endif?>
	  		 <br /><br />
	  	<?endfor?>
    </div>
</div>


<SCRIPT>
function show_news_block(number){
	document.getElementById('news_block_'+number).style.display = '';
	hide_number = (number == 1) ? 2 : 1;
	document.getElementById('news_block_'+hide_number).style.display = 'none';
}
show_news_block(<?=$show_news_block_number?>);
</SCRIPT>

<?endif?>