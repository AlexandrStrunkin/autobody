<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<?


    if ($arParams['SILENT'] == 'Y') return;

    $cnt = strlen($arParams['INPUT_NAME_FINISH']) > 0 ? 2 : 1;?>

<?for ($i = 0; $i < $cnt; $i++):
        if ($arParams['SHOW_INPUT'] == 'Y'):
        if ($i==0):
        $val=$_GET["date_order_from"];
        else:
        $val=$_GET["date_order_to"];
        endif;
        ?>
        <input type="text" onclick="BX.calendar({node:this, field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['INPUT_NAME'.($i == 1 ? '_FINISH' : '')]))?>', form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});" class="order_date"  placeholder="__  .  __  .  _____" id="<?=$arParams['INPUT_NAME'.($i == 1 ? '_FINISH' : '')]?>" name="<?=$arParams['INPUT_NAME'.($i == 1 ? '_FINISH' : '')]?>" value="<?=$val?>" <?=(Array_Key_Exists("~INPUT_ADDITIONAL_ATTR", $arParams)) ? $arParams["~INPUT_ADDITIONAL_ATTR"] : ""?>/><?
            endif;
    ?><?if ($cnt == 2 && $i == 0):?><span>-</span><?endif;?><?
        endfor;
?>