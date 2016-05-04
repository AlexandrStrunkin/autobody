<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//arshow($arResult); arshow($_REQUEST);?>
<div class="fastfindar">
    <form action="" method="post" name="fastfindar">
        <input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>">
        <input type="hidden" name="my_action" value="getfast">
        <div class="name">Быстрое добавление в корзину</div>
        <table class="fastfindatable">
            <tr>
                <th class="one">Артикул</th>
                <th class="two">Количество</th>
                <th class="tree"></th>
            </tr>


            <?for($i=0;$i<max($arResult['ON_PAGE'],$arResult['ARR_SIZE']);$i++):?>
                <tr>
                    <td class="one"><input name="query[<?=$i?>][CODE]" value="<?=htmlspecialcharsbx($_REQUEST['query'][$i]['CODE'])?>" /></td>
                    <td class="two"><input name="query[<?=$i?>][QUANTITY]" value="<?=htmlspecialcharsbx($_REQUEST['query'][$i]['QUANTITY'])?>" /></td>
                    <td class="three">

                        <?if($_REQUEST['my_action']=='getfast'){?>
                            <?if($arResult['FOUNDS'][$i]['ID']) {?>
                                <? if(!$arResult['FOUNDS'][$i]['OVERFLOW']){?>
                                    <span style="color:green"><span style="display:none">Есть в наличии!</span>
                                        <?if($arResult['FOUNDS'][$i]['WAS_ADD']) {?>Добавлено в корзину!<?}?>
                                    </span><? } else {?><div class="errorr">Такого кол-ва нет на сладе!</div><?}?>
                                <?} elseif($_REQUEST['query'][$i]['CODE']) {?><div class="errorr">Не найден!</div><?}?>
                            <?} else {?><?}?>

                    </td>
                </tr>
                <?endfor;?>

        </table>

        <table>
            <tr>
                <td colspan="2">

                    <?/*<a href="javascript:document.fastfindar.resert();" class="find" >
                        <div id="small">
                        <span>Отмена</span>
                        </div>
                    </a>*/?>
                    <a href="javascript:document.fastfindar.submit();" class="find">
                        <div>
                            <span>Добавить в корзину</span>
                        </div>
                    </a>

                     <a href="javascript:document.fastfindar.reset();" class="find">
                        <div>
                            <span>Очистить</span>
                        </div>
                    </a>
                </td>
                <td>

                    <div>
                        <span>
                            <script>
                                i=5;
                            </script>
                            <a onClick="for(j=0;j<5;j++) {$('.fastfindatable').append('<tr><td class=one><input name=query['+i+'][CODE]></td><td align=center class=two><input name=query['+i+'][QUANTITY] /></td><td class=three></td></tr>');i++;} return false;" href="#">Добавить поля</a>
                        </span>
                    </div>

                </td>
            </tr>
        </table>
    </form>
</div>