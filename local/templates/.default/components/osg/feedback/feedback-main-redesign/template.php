<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript">
    $(function(){

        $(".button2").click(function(e){ 
            var name = $("#NAME").val();
            var contact = $("#CONTACT").val();
            var question = $("#QUESTION").val();

            if (name && contact && question) {
                $.post("/ajax/feedback.php",{
                    NAME: name,
                    CONTACT: contact,
                    QUESTION: question,
                    },
                    function(data){ 
                        if (data=="ok") {
                            ///alert(ok);  
                    }}
                )
//                $(".popup-overlay").hide();
                $(".popup-form").hide();
                $(".popup-done").show();

            }
            else {
                $(".form_alert").css("display","block");
            }
        });  

    });
</script>


<form action="<?=$APPLICATION->GetCurPage()?>" method="POST" class="contact_form">

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
    <div class="feedback-main"> 
        <div class="name">ОБРАТНАЯ СВЯЗЬ</div>

        <?if ($arResult['MESSAGE']):?> <div class="message"><?=htmlspecialcharsbx($arResult['MESSAGE'])?></div> <?endif?> 

        <div class="input"><input type="text" placeholder="Представьтесь пожалуйста" id="NAME" name="NAME" value="<?=htmlspecialchars($arResult['NAME'])?>"/></div>
        <div class="input"><input type="text" placeholder="Как мы сможем вам ответить? (тел., факс, е-мейл)" id="CONTACT" name="CONTACT" value="<?=htmlspecialchars($arResult['CONTACT'])?>"/></div>

        <div class="input"><textarea type="text" id="QUESTION" name="QUESTION" rows="10" cols="37" placeholder="Дополнительная информация"><?=htmlspecialchars($arResult['QUESTION'])?></textarea></div>

        <div class="form_alert"><font class="red-text">Ошибка! Не все поля заполнены.</font></div>

        <div class="field"><font class="red-text">Все </font>поля, обязательные для заполнения</div> 
        <button class="button1" type="reset">СБРОСИТЬ</button>
        <button class="button2" type="button">ОТПРАВИТЬ</button>

    </div>




</form>