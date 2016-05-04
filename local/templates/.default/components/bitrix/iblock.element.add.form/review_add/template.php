<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div class="write">
    <div class="wrreviewstitle">Оставить отзыв о товаре</div>

    <form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">

        <?=bitrix_sessid_post()?>

        <table>

            <?if (count($arResult["ERRORS"])):?>
                <tr>
                    <td class="rev1td" colspan="2">
                    <?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
                    </td>
                </tr>
                <?endif?>
            <?if (strlen($arResult["MESSAGE"]) > 0):?>
                <tr>
                    <td class="rev1td" colspan="2">
                    <?=ShowNote($arResult["MESSAGE"])?>
                    </td>
                </tr>
                <?endif?>

            <tr>
                <td class="rev1td">Ваше имя</td>
                <td>Характер мнения</td>
            </tr>
            <tr>
                <td class="rev1td"><input type="text" class="revname" name="PROPERTY[NAME][0]"/></td>
                <td>

                    <input type="radio" name="PROPERTY[343]" value="14" class="har" id="property_14" checked="checked" /><label for="property_14" class="lhar1">Положительный</label>
                    <input type="radio" name="PROPERTY[343]" value="15" class="har" id="property_15" /><label for="property_15" class="lhar2">Нейтральный</label>
                    <input type="radio" name="PROPERTY[343]" value="16" class="har" id="property_16" /><label for="property_16" class="lhar3">Отрицательный</label>
                </td>
            </tr>
            <tr>
                <td class="rev1td" id="revr">Текст отзыва</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea class="revtext" name="PROPERTY[344][0]" rows="5" cols="30"></textarea>
                    <?
                    //получаем ID изображения
                    $url = explode("/",$APPLICATION->GetCurPage());
                    ?>
                    <input class="text" type="hidden" value="<?=$url[3]?>" size="25" name="PROPERTY[342][0]">
                </td>
            </tr>
            <tr>
                <td  colspan="2">
                    <div class="sendwev">
                        <input type="submit" name="iblock_submit" value="Отправить" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
<br><br>