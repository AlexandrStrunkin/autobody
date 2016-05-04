<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    global $SUBSCRIBE_TEMPLATE_RESULT;
    $SUBSCRIBE_TEMPLATE_RESULT=true;
    global $SUBSCRIBE_TEMPLATE_RUBRIC;
    $SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
    global $APPLICATION;
?>
<style type="text/css">
    .text {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; color: #1C1C1C; font-weight: normal;}
    .newsdata{font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color: #346BA0; text-decoration:none;}
    h1 {font-family: Verdana, Arial, Helvetica, sans-serif; color:#346BA0; font-size:15px; font-weight:bold; line-height: 16px; margin-bottom: 1mm;}
</style>

<P>Добрый день! </P>
<P>Вы подписались на рассылку прайс-листа "Москва и Омск" . </P>

<a href="http://www.autobody.ru/files/price_forward_csv.zip">Оптовый CSV Прайс лист с остатками в Москве и Омске (формат ".CSV") ".zip" архив</a><br>

<P>Так же Вы можете скачать и другие прайс-листы по этим ссылкам:</P>

<a href="http://forwardsp.ru/files/price_forward.zip">Оптовый Прайс лист с остатками в Санкт-Петербурге (формат ".xls") ".zip" архив</a><br>
<a href="http://autobody.ru/files/price_forward_ekat.zip">Оптовый XLS Прайс лист с остатками в Екатеринбурге (формат ".xls") ".zip" архив</a><br>

<P>www.autobody.ru<P>

<P>Всего хорошего! С Уважением, Форвард.</P>
<a href="/personal/settings/?unsubscription=Y&unsubscribeId=4">Отписаться от рассылки</a><br><br>

<?
    //Получаем дату и время в правильном формате.
    $new_date = $DB->FormatDate(date("d.m.Y H:i:s"), "DD.MM.YYYY HH:MI:SS", CSite::GetDateFormat("FULL", "ru"));
    if($SUBSCRIBE_TEMPLATE_RESULT)
        return array(
            "SUBJECT"=>$SUBSCRIBE_TEMPLATE_RUBRIC["NAME"],
            "BODY_TYPE"=>"html",
            "CHARSET"=>"Windows-1251",
            "DIRECT_SEND"=>"Y",
            "FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
            "AUTO_SEND_FLAG"=>"Y",
            "AUTO_SEND_TIME"=>$new_date,
            "FILES"=>Array("0"=>CFile::MakeFileArray("/files/price_forward.zip")),
        );
    else
        return false;
?>
