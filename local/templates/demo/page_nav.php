<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$PAGE_LINK = ($arParams['PAGE_LINK']) ? $arParams['PAGE_LINK'] : 'page';
$PAGE = max(1, (int) $_REQUEST[$PAGE_LINK]);
$ON_PAGE = max(1, (int) $arParams['ON_PAGE']);
$TOTAL = (int) $arParams['TOTAL'];
$TOTAL_PAGES = ceil($TOTAL/$ON_PAGE);
$PAGE_START = floor(($PAGE-1)/10)*10+1;
?>
<?if ($TOTAL_PAGES>1):?>
<div class="pages_rec">
    <?if ($PAGE>1):?>
        <a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=1", array($PAGE_LINK))?>" class="start">начало</a>
        <a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=".($PAGE-1), array($PAGE_LINK))?>" class="prev">предыдущая</a>
    <?endif?>
    
    <?for ($p=$PAGE_START; ($p<=$PAGE_START+9) && ($p<=$TOTAL_PAGES); $p++):?>
        <a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=$p", array($PAGE_LINK))?>" <?if ($p==$PAGE) echo 'class="active"'?>><?=$p?></a>
    <?endfor?>
    
    <?if ($PAGE<$TOTAL_PAGES):?>
        <a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=".($PAGE+1), array($PAGE_LINK))?>" class="next">следующая</a>
        <a href="<?=$APPLICATION->GetCurPageParam("$PAGE_LINK=$TOTAL_PAGES", array($PAGE_LINK))?>" class="end">конец</a>  
    <?endif?>     
</div>
<?endif?> 