<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <?//arshow($arResult)
// arshow($_SESSION['OSG']['USER']['CATALOG_COMPARE']);
 ?>
<?if (is_array($arResult) && count($arResult)):?>
    <div class="comparison">
        <div class="names">Сравнение</div>
           <form action="/catalog/compare.php" method="GET" id="compare_form_<?=htmlspecialcharsbx($_GET["section_id"])?>">
        <?foreach ($arResult as $SECTION_ID=>$arSection):?>


                    <?foreach ($arSection['ITEMS'] as $ID=>$arr):?>
                        <?
                            $ginfo = COSGPublic::GetIBlockElementByID($ID);
                        ?>
                        <div class="compel">
                            <div class="top">
                              <?/*  <input type="checkbox" />*/?> <a href="<?=$ginfo["DETAIL_PAGE_URL"]?>" target="_blank"><?=$arr['NAME']?></a>
                            </div>
                            <div class="down">
                                <div class="one">Арт.: <?=$ginfo['CODE']?></div>
                                <div class="one">OEM: <?=$ginfo['PROPS']['UNC']['VALUE']?></div>
                                <div class="one">Год: <?=$ginfo['PROPS']['SIZE']['VALUE']?></div>
                            </div>
                        </div>
                        <input type="input" name="compare_items[]" value="<?=$ID?>" checked style="display: none !important;">
                        <?endforeach;?>

                    <a href="<?=$arSection['URL_CLEAR_LIST']?>" class="find">
                        <div>
                            <span>Очистить список</span>
                        </div>
                    </a>



            <?endforeach;?>

            <a href="javascript:submitForm('compare_form_<?=htmlspecialcharsbx($_GET["section_id"])?>');" class="find"  >
                        <div id="compar">
                            <span>Сравнить товары</span>
                        </div>
                    </a>
             </form>
        <SCRIPT>
            function check_all_items(form, checked){
                for (var i=0;i < document.forms[form].elements.length;i++) {
                    if (document.forms[form].elements[i].type=='checkbox') {
                        document.forms[form].elements[i].checked = checked;
                    }
                }
            }
        </SCRIPT>
        <?endif?>
</div>




