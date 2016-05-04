<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Регистрация");

?>
<meta name="robots" content="noindex">

<?if (checkSite() == "retail"){?>
     <?
     if ($USER->IsAuthorized()) 
        LocalRedirect("/personal/cabinet/");
     $APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"retail_reg", 
	array(
		"SHOW_FIELDS" => array(
			0 => "NAME",
		),
		"REQUIRED_FIELDS" => array(
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/personal/settings/",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => ""
	),
	false
);
     ?>
    <?} else {?>

    <?if ($_GET["formresult"] == "addok"){?>
        <p style="color:#1AB512">
            <b>
                Спасибо за проявленный интерес к нашей компании. 
                Ваша анкета заполнена, пожалуйста проверьте вашу почту для окончания процедуры регистрации. 
                Если вы не получили письмо, то просьба проверить его в папке спам
            </b>
        </p>
        <?}?>
    <?$APPLICATION->IncludeComponent(
            "bitrix:form", 
            "registration-redesign", 
            array(
                "START_PAGE" => "new",
                "SHOW_LIST_PAGE" => "N",
                "SHOW_EDIT_PAGE" => "N",
                "SHOW_VIEW_PAGE" => "Y",
                "SUCCESS_URL" => "/personal/",
                "WEB_FORM_ID" => "1",
                "RESULT_ID" => $_REQUEST[RESULT_ID],
                "SHOW_ANSWER_VALUE" => "N",
                "SHOW_ADDITIONAL" => "N",
                "SHOW_STATUS" => "Y",
                "EDIT_ADDITIONAL" => "N",
                "EDIT_STATUS" => "Y",
                "NOT_SHOW_FILTER" => array(
                    0 => "",
                    1 => "",
                ),
                "NOT_SHOW_TABLE" => array(
                    0 => "",
                    1 => "",
                ),
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "Y",
                "SEF_MODE" => "Y",
                "SEF_FOLDER" => "/personal/",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CHAIN_ITEM_TEXT" => "",
                "CHAIN_ITEM_LINK" => "",
                "AJAX_OPTION_ADDITIONAL" => "",
                "SEF_URL_TEMPLATES" => array(
                    "new" => "#WEB_FORM_ID#/",
                    "list" => "#WEB_FORM_ID#/list/",
                    "edit" => "#WEB_FORM_ID#/edit/#RESULT_ID#/",
                    "view" => "#WEB_FORM_ID#/view/#RESULT_ID#/",
                )
            ),
            false
        );?>

    <?}?>          
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>