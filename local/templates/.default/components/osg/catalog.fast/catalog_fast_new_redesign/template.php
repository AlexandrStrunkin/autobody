<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="basket">
    <form action="" method="post" name="fastfindar">
        <input type="hidden" name="section_id" value="<?=htmlspecialcharsbx($_REQUEST['section_id'])?>">
        <input type="hidden" name="my_action" value="getfast">
        <div class="cabinet-detail-title">БЫСТРОЕ ДОБАВЛЕНИЕ В КОРЗИНУ</div>
        <div class="fastfindar">
            <table class="fastfindatable">
                <tr>
                    <td>
                        Артикул
                    </td>
                    <td>
                        Кол-вол, шт
                    </td>
                    <td>

                    </td>
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

            <div>
                <a class="button1" onclick="document.fastfindar.reset();">ОЧИСТИТЬ</a>
                <a class="button2" onclick="document.fastfindar.submit();">ДОБАВИТЬ</a> 
                <script>
                    i=5;
                </script>
                <span class="add-field-plus">+ </span> <a class="url add-field" href="javascript:void(0)" onclick="for(j=0;j<5;j++) {$('.fastfindatable').append('<tr><td class=one><input name=query['+i+'][CODE]></td><td align=center class=two><input name=query['+i+'][QUANTITY] /></td><td class=three></td></tr>');i++;} return false;">ДОБАВИТЬ ПОЛЯ</a>
            </div>


           

        </div>
    </form>

</div>


  