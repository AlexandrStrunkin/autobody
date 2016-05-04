<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//arshow($arResult)?>
<?if ($_REQUEST['item_id']):?>
    <table cellpadding="0" cellpadding="0" width="100%" class="news_list">
        <tr valign="top">
            <td align="center" width="55">

                <div class="news_date">
                    <span><?=$arResult['DATE_ACTIVE_FROM']['DD']?>.<?=$arResult['DATE_ACTIVE_FROM']['MM']?></span><br /><?=$arResult['DATE_ACTIVE_FROM']['YYYY']?>
                </div>
            </td>
            <td>
                <h2><b><?=$arResult['NAME']?></b></h2>

                <p><? echo CFile::ShowImage($arResult['DETAIL_PICTURE'],400,400); ?></p>

                <p>
                    <?=$arResult['DETAIL_TEXT']?>
                </p>

            </td>
        </tr>
    </table>
    <?else:?>

    <table cellpadding="0" cellpadding="0" width="100%" class="news_list">
        <?foreach ($arResult['ITEMS'] as $arr):?>
            <tr valign="top">
                <td align="center" width="55">

                    <div class="news_date">
                        <span><?=$arr['DATE_ACTIVE_FROM']['DD']?>.<?=$arr['DATE_ACTIVE_FROM']['MM']?></span><br /><?=$arr['DATE_ACTIVE_FROM']['YYYY']?>
                    </div>
                </td>
                <td>
                    <a href="<?=$arr['DETAIL_PAGE_URL']?>"><strong><?=$arr['NAME']?></strong></a>

                    <p><? echo CFile::ShowImage($arr['PREVIEW_PICTURE'],200,200); ?></p>
                    <p>
                        <?=$arr['PREVIEW_TEXT']?>
                    </p>

                </td>
            </tr>
            <?endforeach;?>
    </table>
    <?$APPLICATION->IncludeFile("page_nav.php", Array('ON_PAGE'=>$arParams['ON_PAGE'], 'TOTAL'=>$arResult['TOTAL']))?>
    <?endif?>