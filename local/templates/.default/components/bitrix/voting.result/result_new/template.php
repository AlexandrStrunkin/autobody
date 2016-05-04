<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="viewswork">
    <?
$iCount = 0;
foreach ($arResult["QUESTIONS"] as $arQuestion):
    $iCount++;
?>
            <div class="question"><?=$arQuestion["QUESTION"]?></div>
            <?
            $num=1;
            foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
            
                <table class="answers">
                    <tr>
                        <td class="percents" ><?=$arAnswer["PERCENT"]?></td>
                        <td class="text" style="width: 240px;">
                            <div class="color<?=$num;?>" style="width: <?=str_replace(",", ".",$arAnswer["PERCENT"])?>%;" id="c1"></div>
                            <div class="textt"><?=$arAnswer["MESSAGE"]?></div>
                        </td>
                    </tr>
                </table>
                <?$num++;?>
            <?endforeach?>
<?endforeach?>
<div class="allvote">Голосов: <b><?=$arResult["VOTE"]["COUNTER"];?></b></div>
</div>
