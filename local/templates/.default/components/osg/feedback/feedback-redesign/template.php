<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$APPLICATION->GetCurDir()?>" method="POST" class="contact_form">

    <!--    <!--<p>Вполне возможно, что антиспамерские программы
        мешают попасть вашему письму нам на электропочту!
        Мы не хотим терять ваши письма! Чтобы наше 
        желание исполнилось, у вас есть возможность
        написать нам через форму обратной связи!</p> -->
<!--
    Представтесь пожалуйста  <br />
    <input tupe="text" name="NAME" value="<?=htmlspecialchars($arResult['NAME'])?>"/><br />
    Как мы сможем вам ответить? <small>(тел., факс, е-мейл)</small><br />
    <input tupe="text" name="CONTACT" value="<?=htmlspecialchars($arResult['CONTACT'])?>"/><br />
    Ваш вопрос <small>(Суть проблемы)</small><br />
    <textarea name="QUESTION" rows="10" cols="37"><?=htmlspecialchars($arResult['QUESTION'])?></textarea><br />
    <br><br />
    <input type="submit" name="SEND" class="button" value="отправить" />       -->
    <div class="feedback"> 
        <div class="name">ОБРАТНАЯ СВЯЗЬ</div>

            <?if ($arResult['MESSAGE']):?> <div class="message"><?=htmlspecialcharsbx($arResult['MESSAGE'])?></div> <?endif?> 
        
        <div class="input"><input type="text" placeholder="Представьтесь пожалуйста" name="NAME" value="<?=htmlspecialchars($arResult['NAME'])?>"/></div>
        <div class="input"><input type="text" placeholder="Как мы сможем вам ответить? (тел., факс, е-мейл)" name="CONTACT" value="<?=htmlspecialchars($arResult['CONTACT'])?>"/></div>

                <select multiple name="wh_mail[]" id="wh_mail">
                    <?$arFilter = Array("IBLOCK_ID"=>119,"ACTIVE"=>"Y");
                    $res = CIBlockElement::GetList(Array("SORT"=>"asc"), $arFilter, false,Array("nPageSize"=>20), array("NAME","PROPERTY_MAIL_ADDR"));
                    while($ob = $res->GetNextElement()){
                        $arf = $ob->GetFields();?>
                      <option value="<?=$arf['PROPERTY_MAIL_ADDR_VALUE']?>"><?=$arf['NAME']?></option>  
                    <?}?>
                </select>


        <div class="input"><textarea type="text" name="QUESTION" rows="10" cols="37" placeholder="Дополнительная информация"><?=htmlspecialchars($arResult['QUESTION'])?></textarea></div>
        
        <div class="field"><font class="red-text">Все </font>поля, обязательные для заполнения</div> 
        <button class="button1" type="reset">СБРОСИТЬ</button>
        <button class="button2" type="submit" name="SEND" value="отправить">ОТПРАВИТЬ</button>
    </div>




</form>