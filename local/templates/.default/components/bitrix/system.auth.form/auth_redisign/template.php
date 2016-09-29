<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $frame = $this->createFrame("login_composite", false)->begin() ?>
<? if ($arResult['USER_LOGIN']) { ?>
<div class="header-url first_auth_block">
    <div class="lk-header">
	    <img class="lk-logo" src="/images/lk.png" alt=""/ style="cursor: default;">  
	
	    <div class="login_wrap">
	    	<div style="cursor: default;">
	    		<?= $arResult['USER_LOGIN'] ?>
	    	</div>
	    </div> 
	
	    <div class="exit-user"></div>
    </div>
</div>
<div class="lk-header second_auth_block" style="text-align: center; margin: 0;"> 
	<a class="header-url" href="/personal/cabinet/" style="color: #1aa1c8; font-weight: normal;">Личный кабинет</a>
</div>
<a class="url third_auth_block" href="?logout=yes&amp;clear_cache=Y" style="color: #cc2a31">Выйти</a>
<? } else { ?>
<div id="unathorized_user_block" class="lk-header">
    <img class="lk-logo" src="/images/lk.png" alt=""/>  
    <div style="display: inline;">Войти</div>

    <div class="top_auth_form">
        <div class="auth_tail">&#9650;</div>
        <div class="auth_fields"><input type="text" name="login" id="auth_login"></div>
        <div class="auth_fields"><input type="password" name="password" id="auth_password"></div>                       
        <div class="auth_buttons">
            <a class="auth_button_register" href="/personal/" href="javascript:void(0)">регистрация</a>
            <a class="auth_button_enter" href="javascript:void(0)" onclick="getAuth()">войти</a>
        </div>
        <div class="error_text"></div>
    </div>
</div>
<? } ?>
<? $frame->beginStub() ?>
<div id="loadFacebookG">
	<div id="blockG_1" class="facebook_blockG"></div>
	<div id="blockG_2" class="facebook_blockG"></div>
	<div id="blockG_3" class="facebook_blockG"></div>
</div>
<? $frame->end() ?>
