<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    //arshow($_GET);
?>
<div style="overflow:hidden; padding: 0 20px;">
    <h1 align="center">Загрузка фото</h1>
    <?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "user_foto_add", array(
                "IBLOCK_TYPE" => "INFO",
                "IBLOCK_ID" => "96",
                "STATUS_NEW" => "2",
                "LIST_URL" => "",
                "USE_CAPTCHA" => "Y",
                "USER_MESSAGE_EDIT" => "",
                "USER_MESSAGE_ADD" => "Фото успешно загружено. После проверки оно будет опубликовано",
                "DEFAULT_INPUT_SIZE" => "30",
                "RESIZE_IMAGES" => "N",
                "PROPERTY_CODES" => array(
                    0 => "NAME",
                    1 => "341",
                ),
                "PROPERTY_CODES_REQUIRED" => array(
                    0 => "NAME",
                    1 => "341",
                ),
                "GROUPS" => array(
                    0 => "2",
                ),
                "STATUS" => array(
                    0 => "3",
                ),
                "ELEMENT_ASSOC" => "CREATED_BY",
                "MAX_USER_ENTRIES" => "100000",
                "MAX_LEVELS" => "100000",
                "LEVEL_LAST" => "Y",
                "MAX_FILE_SIZE" => "0",
                "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                "SEF_MODE" => "N",
                "SEF_FOLDER" => "/",
                "CUSTOM_TITLE_NAME" => "Артикул",
                "CUSTOM_TITLE_TAGS" => "",
                "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                "CUSTOM_TITLE_DETAIL_TEXT" => "",
                "CUSTOM_TITLE_DETAIL_PICTURE" => ""
            ),
            false
        );?>
</div>