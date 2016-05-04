<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$URL = $APPLICATION->GetCurPage()?>
<?if ($USER->IsAuthorized()):?>
                   Добро пожаловать,  <strong><a href="/personal/"><?=$USER->GetFullName()?></a></strong> .

<?        $uid = $USER->GetList(($by="ID"), ($order="desc"), array("ID"=>$USER->GetID()),array('SELECT'=>array('UF_DISCOUNT'))); $uid = $uid->GetNext();  ?>
<? if($mydiscount = $uid['UF_DISCOUNT']) echo ' Ваша скидка - '.$mydiscount.'%.'; ?>

                <? /*<a href="/personal/" id="topbar2"><img src="/i/topbar1.png" class="topbarimg"> Мой профиль</a>*/?>
                <a href="/personal/cabinet.php" id="topbar1"><img src="/i/topbar3.png" class="topbarimg"> Мои заказы</a>
                <? /*<a href="/personal/settings.php" id="topbar3"><img src="/i/topbar2.png" class="topbarimg"> Настройки</a> */?>
                <a href="/personal/password.php" id="topbar4"><img src="/i/topbar4.png" class="topbarimg"> Сменить пароль</a>
                <a href="<?=$APPLICATION->GetCurPageParam('auth=logout', array('auth'))?>"id="topbar3"><img src="/i/exit_2017.png" class="topbarimg"> Выйти </a>


<?else:?>
    <?if ($arResult['LOGIN_ERROR']):?>
    <div class="hidden_block" id="hidden_block">
        <a href="/personal/password.php" id="topbar1"><img src="/i/topbar4.png" class="topbarimg">Не удается войти в аккаунт?</a></STRONG>



    </div>
    <?endif?>

    <form action="<?=$APPLICATION->GetCurPageParam('auth=login', array('auth'))?>"  method="POST">

    <input name="LOGIN" class="input" placeholder="Логин" type="text" />
        <input name="PASSWORD" class="input" placeholder="Пароль" type="password"/>
        <input type="submit" value="Вход" class="button" /><br/>
         <a href="/personal/" id="topbar2"><img src="/i/topbar1.png" class="topbarimg"> Регистрация</a>
        <? /*<STRONG class="reg"><IMG src="/bitrix/templates/demo/images/li3.gif"> <a style="text-decoration:underline;" href="/personal/">Регистрация</a></STRONG>*/?>


    </form>
<?endif?>