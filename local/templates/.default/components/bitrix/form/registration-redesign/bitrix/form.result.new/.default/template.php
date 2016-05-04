<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
    {
    ?>
    <?=$arResult["FORM_HEADER"]?>


    <br />
    <?
        /***********************************************************************************
        form questions
        ***********************************************************************************/
    ?>
    <table class="order-other">
        <thead>
            <!--<tr>
            <th colspan="2"><b>Заявка на регистрацию</b></th>
            </tr>-->
        </thead>
        <tbody>
            <?
                //arshow($arResult) ;
                foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
                {
                ?>
                
                <? 
                    $title=explode("\n", $arQuestion["CAPTION"]);
                    if ($arQuestion["STRUCTURE"][0]["ID"]<>67) {
                    ?>
                    <tr>
                    <td>
                        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                            <span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
                            <?endif;?>
                        <?=$title[0]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
                        <?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
                    </td>
                    <td><?=$arQuestion["HTML_CODE"]?></td> 
                    </tr> 
                    <?
                    } else { 
                    ?>
                    <tr colspan="2">
                        <td>
                        <div class="save-data"> 
                        <?=$arQuestion["HTML_CODE"]?>
                        </div>
                        </td>
                    </tr>                

                    <?
                    }
                } //endwhile
            ?>
            <?
                if($arResult["isUseCaptcha"] == "Y")
                {
                ?>
                <tr>
                    <th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
                </tr>
                <tr>
                    <td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
                    <td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
                </tr>
                <?
                } // isUseCaptcha
            ?>
        </tbody>
        <tfoot>  
            <tr>
                <th colspan="2">
                    <div class="field"><font class="red-text"><?=$arResult["REQUIRED_SIGN"];?></font> - <?=GetMessage("FORM_REQUIRED_FIELDS")?></div> 
                    <!--                    <?if ($arResult["F_RIGHT"] >= 15):?>
                        &nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />
                        <?endif;?> -->               
                    <input type="reset" class="button1" value="<?=GetMessage("FORM_RESET");?>" />
                    <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" class="button2" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />

                </th>
            </tr>
        </tfoot>
    </table>
    <!--    <p>
    <?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
    </p>  -->
    <?=$arResult["FORM_FOOTER"]?>
    <?
    } //endif (isFormNote)
?>