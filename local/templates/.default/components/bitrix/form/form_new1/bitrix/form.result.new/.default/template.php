<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<?
/***********************************************************************************
                        form questions
***********************************************************************************/
?>
<div class="reg">
    <?
    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
    {?>
    <div class="regel">
            <div class="regel">
                <div class="regelname"><?=$arQuestion["CAPTION"]?></div>
                <?=$arQuestion["HTML_CODE"]?>
            </div>
    </div>
    <?
    }?>




<?
if($arResult["isUseCaptcha"] == "Y")
{
?>

                    <div class="regel">
                        <div class="capcha">
                            <div class="capchname"><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?><span class="reddote">*</span></div>
                            <input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" />
                            <br/>
                            <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
                        </div>
                    </div>

<?
} // isUseCaptcha
?>
    <table>
    <tfoot>
        <tr>
            <th colspan="2">
               <?/* <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];?>" />
                <?if ($arResult["F_RIGHT"] >= 15):?>
                &nbsp;<input type="hidden" name="web_form_apply" value="Y" />

                <input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />

                <?endif;?>

                &nbsp;<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />    */?>
            </th>
        </tr>
    </tfoot>
</table>

<?
} //endif (isFormNote)
?>


                    <div class="buttons">
                        <a href="javascript:document.SIMPLE_FORM_1.submit();"><div class="regist">Зарегистрироваться</div></a>
                        <a href="javascript:document.SIMPLE_FORM_1.resert();"><div class="clearforms">Очистить форму</div></a>
                    </div>
</div>
</div>
<?=$arResult["FORM_FOOTER"]?>