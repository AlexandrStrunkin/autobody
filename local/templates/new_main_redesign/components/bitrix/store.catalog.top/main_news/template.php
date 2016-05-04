<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="h2"><table><tr><td><h2 class="bot_block_title">Новости</h2></td><td><div class="borderleft"><a href="http://www.imenapro.ru/news/">все новости</a></div></td></tr></table>

</div>
<div class="mnnewsuot">
    <div class="mnnews">

        <?
           arshow($arResult["ROWS"]); 
        ?>

        <?if ($arResult["ROWS"][0][0]["DETAIL_PICTURE"]["SRC"]) {?>
            <a href="http://www.imenapro.ru<?=$arResult["ROWS"][0][0]["DETAIL_PAGE_URL"]?>"><img src="<?=$arResult["ROWS"][0][0]["DETAIL_PICTURE"]["SRC"]?>" width="253"alt="<?=$arResult["ROWS"][0][0]["NAME"]?>"/></a>
            <?} else {}?>
        <div class="mnnewsdate"><?=$arResult["ROWS"][0][0]["ACTIVE_FROM"]?></div>
        <div class="mnnewshd"><a href="http://www.imenapro.ru<?=$arResult["ROWS"][0][0]["DETAIL_PAGE_URL"]?>"><?=$arResult["ROWS"][0][0]["NAME"]?></a></div>
        <div class="mnnewsannt_main"><?=$arResult["ROWS"][0][0]["PREVIEW_TEXT"]?></div>
    </div>
</div>


