<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$URL = $APPLICATION->GetCurPage()?>
<?if ($USER->IsAuthorized()):?>
    <table cellpadding="0" cellspacing="0" width="100%" class="left_table" align="left" border="0">
    	<tr valign="top" height="33">
        	<td colspan="4">
            	<div>
                	Добро пожаловать,  <strong><?=$USER->GetFullName()?></strong> [<?=$USER->GetLogin()?>] на сайт Форвард - Дмитровка.

<?        $uid = $USER->GetList(($by="ID"), ($order="desc"), array("ID"=>$USER->GetID()),array('SELECT'=>array('UF_DISCOUNT'))); $uid = $uid->GetNext();  ?>
<? if($mydiscount = $uid['UF_DISCOUNT']) echo ' Ваша скидка - '.$mydiscount.'%.'; ?>
                </div>
            </td>
    		<td align="right" colspan="2" class="exit"><img src="/bitrix/templates/demo/images/li5.gif" width="12" height="11" /><a href="<?=$APPLICATION->GetCurPageParam('auth=logout', array('auth'))?>">Выйти</a></td>
    	</tr>
    	<tr>
            <?
            $arMenu = array();
            $arMenu[] = array('TITLE'=>'Учетные данные', 'URL'=>'/personal/index.php', 'IMG'=>'/bitrix/templates/demo/images/li3.gif');
            
            $arMenu[] = array('TITLE'=>'Заказы', 'URL'=>'/personal/cabinet.php', 'IMG'=>'/bitrix/templates/demo/images/li2.gif');
            $arMenu[] = array('TITLE'=>'Смена пароля', 'URL'=>'/personal/password.php', 'IMG'=>'/bitrix/templates/demo/images/li4.gif');
            ?>
            
            <?foreach ($arMenu as $arr):?>
                <td>
                <IMG src="<?=$arr['IMG']?>">
                <a href="<?=$arr['URL']?>">
                <?if ($URL == $arr['URL']):?>
                    <STRONG><?=$arr['TITLE']?></STRONG>
                <?else:?>
                    <?=$arr['TITLE']?>
                <?endif?>
                </a>
                </td>
            <?endforeach;?>
            <td>&nbsp;</td>
        </tr>
    </table>
    
<?else:?> 
    <?if ($arResult['LOGIN_ERROR']):?>     
    <div class="hidden_block" id="hidden_block">
    	<div class="text">
        	Вы указали неверный <span>логин</span> или <span>пароль</span>, повторите попытку снова! Или перейдите
            на <a href="/personal/password.php">форму запроса пароля</a>.
        </div>
        <div>
        	<img src="/bitrix/templates/demo/images/close_black.gif" width="9" height="9" onClick="document.getElementById('hidden_block').style.display='none';" />
        </div>
    </div>
    <?endif?>
	<form action="<?=$APPLICATION->GetCurPageParam('auth=login', array('auth'))?>"  method="POST">
	<table cellpadding="0" cellspacing="0" width="100%" class="left_table" align="left">
    	<tr><td>&nbsp;</td></tr>
    	<tr>
            <td>
            	<input name="LOGIN" class="input" type="text" />
            
            	<input name="PASSWORD" class="input" type="password"/>
            
            	<input type="submit" value="войти" class="button" />
                <STRONG class="reg"><IMG src="/bitrix/templates/demo/images/li3.gif"> <a href="/personal/">Регистрация</a></STRONG>
        	</td>
        </tr>
        <tr>
			<td class="remind"><IMG src="/bitrix/templates/demo/images/li4.gif"> <a href="/personal/password.php">вспомнить пароль</a></td>
        </tr>
    </table>
    </form>
<?endif?>