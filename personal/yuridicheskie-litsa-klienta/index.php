<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Юридические лица клиента");
?>
<style>
.breadcrumb, .cabinet-title {
    display:none;
}
</style> 
<?if($USER->IsAuthorized()) {?> 
<script>
function submitForm() {
    $.ajax({
            type: $("#entity_form").attr('method'),
            url:  $("#entity_form").attr('action'),
            data: $("#entity_form").serialize(),
            success: function(result) {
              //  showPopupContainer($("#new_entity_form"));
                $("#new_entity_form .notify").html(result);
            }
        });
location.reload();
}

$(".add-entity").click(function(){
   $(".overlay_entity").show();
   $(".new_entity_form").show(); 
});
$(".form_closing").click(function(){
   $(".overlay_entity").hide();
   $(".new_entity_form").hide();  
});
</script> 
 <div style=''>
 <?$APPLICATION->IncludeComponent("bitrix:iblock.element.add", "template1", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"NAV_ON_PAGE" => "10",	// Количество элементов на странице
		"USE_CAPTCHA" => "N",	// Использовать CAPTCHA
		"USER_MESSAGE_ADD" => "",	// Сообщение об успешном добавлении
		"USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
		"DEFAULT_INPUT_SIZE" => "30",	// Размер полей ввода
		"RESIZE_IMAGES" => "N",	// Использовать настройки инфоблока для обработки изображений
		"IBLOCK_TYPE" => "info",	// Тип инфоблока
		"IBLOCK_ID" => "116",	// Инфоблок
		"PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
			0 => "449",
			1 => "450",
			2 => "451",
			3 => "452",
			4 => "453",
			5 => "454",
			6 => "455",
			7 => "456",
			8 => "457",
			9 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(	// Свойства, обязательные для заполнения
			0 => "449",
			1 => "450",
			2 => "451",
			3 => "452",
			4 => "453",
			5 => "454",
			6 => "455",
			7 => "456",
			8 => "457",
			9 => "NAME",
		),
		"GROUPS" => array(	// Группы пользователей, имеющие право на добавление/редактирование
			0 => "6",
			1 => "7",
		),
		"STATUS" => "ANY",	// Редактирование возможно
		"STATUS_NEW" => "N",	// Деактивировать элемент после сохранения
		"ALLOW_EDIT" => "Y",	// Разрешать редактирование
		"ALLOW_DELETE" => "Y",	// Разрешать удаление
		"ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
		"MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
		"MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
		"LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
		"MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",	// Использовать упрощенный визуальный редактор для редактирования текста анонса
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",	// Использовать упрощенный визуальный редактор для редактирования подробного текста
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"CUSTOM_TITLE_NAME" => "",	// * наименование *
		"CUSTOM_TITLE_TAGS" => "",	// * теги *
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",	// * текст анонса *
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
		"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
	),
	false
);?>
</div><br><?}?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>