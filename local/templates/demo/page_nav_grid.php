<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$PAGE_LINK = ($arParams['PAGE_LINK']) ? $arParams['PAGE_LINK'] : 'page';
$PAGE = max(1, (int) $_REQUEST[$PAGE_LINK]);
$ON_PAGE = max(10, (int) $arParams['ON_PAGE']);
$TOTAL = (int) $arParams['TOTAL'];
$TOTAL_PAGES = ceil($TOTAL/$ON_PAGE);
$PAGE_START = floor(($PAGE-1)/10)*10+1;
?>


<?if ($TOTAL_PAGES>1):?>
<div class="pages_rec">
    <?if ($PAGE>1):?>
        <!--a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=1", array($PAGE_LINK))?>" class="start">начало</a-->
        <!--a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=".($PAGE-1), array($PAGE_LINK))?>" class="prev">назад</a-->
    <?endif?>
    
    <?for ($p=1; $p<=$TOTAL_PAGES; $p++):?>
        <?if(abs($p-1)<=2||abs($p-$TOTAL_PAGES)<=2||abs($p-$PAGE)<=3):?>
        <a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=$p", array($PAGE_LINK))?>" <?if ($p==$PAGE) echo 'class="active"'?>><?if(abs($p-1)>2&&abs($p-$TOTAL_PAGES)>2&&abs($p-$PAGE)==3) echo '..'; else echo $p;?></a>
         <?endif;?>
    <?endfor?>
    
    <?if ($PAGE<$TOTAL_PAGES):?>
        <!--a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=".($PAGE+1), array($PAGE_LINK))?>" class="next">вперед</a-->
        <!--a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=$TOTAL_PAGES", array($PAGE_LINK))?>" class="end">конец</a-->  
    <?endif?>     
</div>
<?endif?> 