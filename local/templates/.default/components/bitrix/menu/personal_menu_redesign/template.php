<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="cabinet-menu"> 
        <table class="cabinet-menu-items" vertical-align="center" align="center">
            <tr>

                <?
                    foreach($arResult as $arItem):
                        if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
                            continue;
                        ?>
                        <?//не показывать пункт новости или баланс, если находимся в retail
                        if ( ($arItem["LINK"] == "/personal/news/" || $arItem["LINK"] == "/personal/balance/" || $arItem["LINK"]=="/personal/yuridicheskie-litsa-klienta/")  && checkSite() != 'opt') { ?><style>
                            .cabinet-menu-items tr td:last-child {
                            width:100px !important;
                            }</style><?continue;}?> 
                            <?if ($arItem["SELECTED"]):?>   
                                <td class="active-cabinet-menu">
                                    <a class="url"  href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                                </td>
                                <?else:?>
                                <td>
                                    <a class="url"  href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                                </td>
                            <?endif;?>

                    <?endforeach?>

            </tr>
        </table>
    </div>
    <?endif?>