<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    //функция для сортировки складов по ID
    function sortWh($a, $b){
        $aa = intval($a["ID"]);
        $bb = intval($b["ID"]);

        //$a < $b
        if ($aa < $bb) {
            return -1;
        }
        //$a > $b
        else if ($aa > $bb) {
            return 1;
        }
        //$a = $b
        else {
            return 0;
        }

    }

    usort($arResult['STORES'], "sortWh");
?>
<?//arshow($arResult["STORES"])?>
<?if(count($arResult["STORES"]) > 0):?>
    <div class="sclad">
        <div class="name">Наличие на складах</div>
        <table>
            <?foreach($arResult["STORES"] as $pid=>$arProperty):?>
                <?//arshow($arProperty)?>
                <tr class="tr1">
                    <?$title = explode("(",$arProperty["TITLE"]);?>
                    <td><?=trim($title[0]);?></td>
                    <td>
                        <?
                            if($arProperty["NUM_AMOUNT"] > 0){

                                echo "В наличии";
                            }else{
                                echo "Нет в наличии";
                            }
                    ?></td>
                </tr>

                <?endforeach;?>
        </table>
    </div>
    <?endif;?>