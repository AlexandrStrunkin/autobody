<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult['MESSAGE']):?> <div class="message"><?=$arResult['MESSAGE']?></div> <?endif?>

<form id="main_form" action="<?=$APPLICATION->GetCurPage()?>" method="POST">

<?if ($USER->IsAuthorized()):?>
	<table width="100%" cellpadding="0" cellspacing="4" class="main_form">
	    <tr>
	        <td colspan="2">
	            <h3>
	            Избегайте букв кириллицы и спецсимволов при составлении логина и пароля.
	            </h3>
	        </td>
	    </tr>
	    <tr>
	        <td align="right" width="40%"<?if (isset($arResult['ERRORS']['LOGIN'])) echo 'class="error"'?>>Логин (мин 3 символа): <span>*</span></td>
	        <td><input type="text" class="textbox" name="LOGIN" value="<?=htmlspecialchars($arResult['LOGIN'])?>"/></td>
	    </tr>
	    
	    <tr>
	        <td align="right" <?if (isset($arResult['ERRORS']['PASSWORD'])) echo 'class="error"'?>>Новый пароль (мин 6 символов): <span>*</span></td>
	        <td><input type="password" class="textbox" name="PASSWORD" value="<?=htmlspecialchars($arResult['PASSWORD'])?>"></td>
	    </tr>
	    
	    <tr>
	        <td align="right" <?if (isset($arResult['ERRORS']['CONFIRM_PASSWORD'])) echo 'class="error"'?>>Подтверждение пароля: <span>*</span></td>
	        <td><input type="password" class="textbox" name="CONFIRM_PASSWORD" value="<?=htmlspecialchars($arResult['CONFIRM_PASSWORD'])?>"></td>
	    </tr>
	</table>
	<br>
	<div align="right"><input type="submit" name="SAVE" value="Готово" /></div>
<?else:?>
	<table width="100%" cellpadding="0" cellspacing="4" class="main_form">
	    <tr>
	        <td align="right" width="40%">E-mail:</td>
	        <td><input type="text" class="textbox" name="EMAIL" value="<?=htmlspecialchars($_POST['EMAIL'])?>"/></td>
	    </tr>
	    <tr>
	        <td align="right" width="40%">Логин:</td>
	        <td><input type="text" class="textbox" name="LOGIN" value="<?=htmlspecialchars($_POST['LOGIN'])?>"/></td>
	    </tr>
	</table>
	<br>
	<div align="center"><input type="submit" name="SEND" value="Отправить" /></div>
<?endif?>
</form>