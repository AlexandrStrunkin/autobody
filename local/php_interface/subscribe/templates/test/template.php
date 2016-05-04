<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    global $SUBSCRIBE_TEMPLATE_RESULT;
    $SUBSCRIBE_TEMPLATE_RESULT=false;
    global $SUBSCRIBE_TEMPLATE_RUBRIC;
    $SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
    global $APPLICATION;
?>
<style type="text/css">
    .text {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; color: #1C1C1C; font-weight: normal;}
    .newsdata{font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color: #346BA0; text-decoration:none;}
    h1 {font-family: Verdana, Arial, Helvetica, sans-serif; color:#346BA0; font-size:15px; font-weight:bold; line-height: 16px; margin-bottom: 1mm;}
    .open_close_arrow {
        width: 26px;
        height: 16px;
        background-image: url('/i/new_items_arrow.png');
        background-repeat: no-repeat no-repeat;
        background-position: 0 100%;
        display: inline-block;
        position: relative;
        top: 3px;
        margin-right: 20px;
        cursor: pointer;
    }
    .new_item_header {
        padding: 15px;
        box-sizing: border-box;
        font-size: 16px;
        /*cursor: pointer;*/
    }
    .new_items_block_wrapper {
        box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.25);
        margin-top: 20px;
    }
    .new_item_list {
        transition: all 400ms cubic-bezier(0.265, -0.175, 0.615, 1.165);
        /*overflow: hidden;
        height: 0;*/ 
    }
    .catalog_table  {
        width:100%;
    }
    .forward_catalog_new td {
        border-left: 1px solid #E6E6E6;
        border-bottom: 1px solid #E6E6E6;
        font-size: 14px;
        color: #808080;
        text-align: center;
        padding: 5px 0;
    }
    .forward_catalog_new td a {
        margin: 0 15px;
        color: #000 !important;
        text-align: left;
        font-weight: bold;
        height: 20px;  
    }
</style>
<script type="text/javascript" src="/js/jquery-1.7.1.js"></script>
<script>
    /*  $(function(){
    var allNewItemsHeaders = document.querySelectorAll(".open_close_arrow");
    Array.prototype.forEach.call(allNewItemsHeaders, function(el, i){
    el.addEventListener("click",function(e){
    var blockHeader;
    // e.target.classList.contains("open_close_arrow") ? blockHeader = e.target.parentElement : blockHeader = e.target;
    blockHeader = e.target.parentElement;
    var relatedList = blockHeader.nextElementSibling;
    if(parseInt(relatedList.style.height)){
    relatedList.style.height = "0";
    relatedList.parentElement.style.boxShadow = "0px 0px 3px 0px rgba(0,0,0,0.25)";
    relatedList.style.overflow = "hidden";
    blockHeader.children[0].style.backgroundPosition = "0 100%";
    } else {
    var listHeight = blockHeader.nextElementSibling.scrollHeight + "px";
    blockHeader.nextElementSibling.style.height = listHeight;
    relatedList.parentElement.style.boxShadow = "0px 0px 3px 0px rgba(0,163,203,0.25)";
    blockHeader.children[0].style.backgroundPosition = "0 0";
    setTimeout(function(){
    relatedList.style.overflow = "visible";
    },400)
    }
    },false);
    });

    document.querySelector("#close_show_all").addEventListener("click",function(e){ 
    $(".new_item_header").click();
    if(e.target.classList.contains("all_open")){
    e.target.classList.remove("all_open");
    e.target.style.background = "";
    e.target.innerHTML = "Раскрыть все";
    } else {
    e.target.classList.add("all_open");
    e.target.style.background = "#ff2a36";
    e.target.innerHTML = "Свернуть все";
    }
    },false)
    }) */
</script>
<?/*$SUBSCRIBE_TEMPLATE_RESULT = $APPLICATION->IncludeComponent(
    "bitrix:subscribe.news",
    "",
    Array(
    "SITE_ID" => "s1",
    "IBLOCK_TYPE" => "LENTA",
    "ID" => $IBLOCK,
    "SECTION_ID" => $arRubric,
    "SORT_BY" => "ACTIVE_FROM",
    "SORT_ORDER" => "DESC"
    )
    );*/
    echo '<div class="mail-logo" style="height:135px;float:left;clear:both;margin-left:50px;">
    <a href="http://www.autobody.ru/"><img src="http://www.autobody.ru/images/logo-image.png" style=""></a>
    </div>
    <div class="mail-info" style="height:61px;width:400px;float: left;margin-left: 15px;font-size:15px;padding-left:50px;border-left:1px solid #dddddd;line-height:25px;">
    <span style="color:#585858;">Информационное сообщение сайта "ФОРВАРД"</br>
    Оптовые склады автозапчастей</span>
    </div>
    <div style="mi-width:600px; width:100%; clear: both; margin-top:120px;">
    <p >Добрый день!<br>
    Предлагаем Вашему вниманию подборку новых товаров за последние 7 дней. </p>';
    $sectList = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>88, '>DATE_CREATE'=>date("d.m.Y 00:00:00", time()-604800)), false, false, array("ID", "CODE", "NAME", "PROPERTY_UNC", "PROPERTY_SIZE", "IBLOCK_SECTION_ID"));
    while ($sectListFetch = $sectList -> Fetch()) {
        $sect_new_list[]=$sectListFetch['IBLOCK_SECTION_ID'];
    }
    $sect_new_list=array_unique($sect_new_list);

    echo '<div class="new_item_list">
    <table class="forward_catalog_new catalog_table" style=" width: 100%; text-align: center; ">';
    echo '<tr style="height:25px;">
    <th style=" width: 10%;">Артикул</th>
    <th style=" width: 10%;">ОЕМ</th>
    <th style=" width: 5%;">Год</th>
    <th style=" width: 50%;">Наименование</th>
    <th style=" width: 10%;">Цена,руб</th>
    </tr>';
    echo '</table></div>';
    foreach($sect_new_list as $key_sect=>$val_sect) {
        $sect_name=CIBlockSection::GetByID($val_sect)->Fetch();
        echo '<div class="new_items_block_wrapper" style="clear: both; border: 1px solid rgba(0,0,0,0.25); margin-top: 20px;">
        <div class="new_item_header" style="padding: 15px; box-sizing: border-box; font-size: 16px;">
        <span class="open_close_arrow" style="width: 26px; height: 16px; background-image: url(\'http://www.autobody.ru/i/new_items_arrow.png\'); background-repeat: no-repeat no-repeat; background-position: 0 100%; display: inline-block; position: relative; top: 3px; margin-right: 20px; cursor: pointer;" ></span>
        <a href="/catalog/'.$val_sect.'/">'.$sect_name['NAME'].'</a>
        </div>';
        echo '<div class="new_item_list" style=" padding: 15px 10px; ">
        <table class="forward_catalog_new catalog_table" style=" width: 100%; text-align: center; ">';
        // echo '<tr><td>'.$sect_name['NAME'].'</td></tr>';
        $elList = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>88, '>DATE_CREATE'=>date("d.m.Y 00:00:00", time()-604800), "SECTION_ID"=>$val_sect), false, false, array("ID", "CODE", "NAME", "PROPERTY_UNC", "PROPERTY_SIZE", "IBLOCK_SECTION_ID", "DATE_CREATE"));
        while ($elListFetch = $elList -> Fetch()) {
            $base_price=CPrice::GetBasePrice($elListFetch['ID']);
            // echo '<tr style="height:88px;text-align:center;border-bottom:1px solid #dddddd;"><td style="width:40%;"><a style="color:#0094c8;line-height:25px;border-bottom:1px solid #0094c8;padding-bottom:2px;text-decoration:none;" href="http://www.autobody.ru/catalog/'.$elListFetch['IBLOCK_SECTION_ID'].'/'.$elListFetch['ID'].'/">'.$elListFetch['NAME'].'</a><br> <span class="item_descr" style="font-size:11px;color:#808080;line-height:25px;">('.$elListFetch["CODE"].', '.$elListFetch['PROPERTY_UNC_VALUE'].', '.$elListFetch['PROPERTY_SIZE_VALUE'].')</span></td><td><span style="float:right;clear:both;margin-right:50px;">'.ceil(CCurrencyRates::ConvertCurrency($base_price['PRICE'], "USD", "RUR")).' руб. </span></td>';
            echo '<tr>
            <td style=" width: 10%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: left; padding: 5px 10px;">'.$elListFetch['CODE'].'</td>
            <td style=" width: 10%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: center; padding: 5px 0;">'.str_replace("/","<br>",$elListFetch['PROPERTY_UNC_VALUE']).'</td>
            <td style=" width: 4%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: center; padding: 5px 0;">'.$elListFetch['PROPERTY_SIZE_VALUE'].'</td>
            <td style="width:50%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: left; padding: 5px 0;">
            <a style="margin: 0 15px; color: #000 !important; text-align: left; font-weight: bold; height: 20px;" href="http://www.autobody.ru/catalog/'.$elListFetch['IBLOCK_SECTION_ID'].'/'.$elListFetch['ID'].'/">'.$elListFetch['NAME'].'</a></td>
            <td style=" width: 10%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: center; padding: 5px 0;">'.ceil(CCurrencyRates::ConvertCurrency($base_price['PRICE'], "USD", "RUR")).'</td></tr>';

        }

        echo '</table></div></div>';
    }
    echo "</div>";
?>

<a href="http://www.autobody.ru/new_products/">Полный список новинок за 30 дней</a>

<P>www.autobody.ru</P>

<p>"Всего хорошего!<br> 
    С Уважением, Forward Auto Parts" <br></p>
<a href="/personal/settings/?unsubscription=Y&unsubscribeId=2">Отписаться от рассылки</a><br><br>

<? //Generate pdf-file 
    $block_wrapper=''; 
    $date_pdf_start = date("d.m.Y", time()-604800);
    $date_pdf_end = date("d.m.Y");
    $badge='/images/forward-image.jpg';
    $sectList = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>88, '>DATE_CREATE'=>date("d.m.Y 00:00:00", time()-604800)), false, false, array("ID", "CODE", "NAME", "PROPERTY_UNC", "PROPERTY_SIZE", "IBLOCK_SECTION_ID"));
    while ($sectListFetch = $sectList -> Fetch()) {
        $sect_new_list[]=$sectListFetch['IBLOCK_SECTION_ID'];
    }
    $sect_new_list=array_unique($sect_new_list);

    $block_wrapper.='<div class="new_item_list">
    <table class="forward_catalog_new catalog_table" style=" width: 100%; text-align: center; ">';
    $block_wrapper.='
    <tr style="">
    <th style=" width: 15%;">Артикул</th>
    <th style=" width: 15%;">ОЕМ</th>
    <th style=" width: 12%;">Год</th>
    <th style=" width: 40%;">Наименование</th>
    <th style=" width: 25%;">Цена,руб</th>
    </tr> ';
    $block_wrapper.='</table></div>';
    foreach($sect_new_list as $key_sect=>$val_sect) {
        $sect_name=CIBlockSection::GetByID($val_sect)->Fetch();
        $block_wrapper.='<div class="new_items_block_wrapper" style="clear: both;     width: 960px; border: 1px solid rgba(0,0,0,0.25); margin-top: 20px;">
        <div class="new_item_header" style="padding: 15px; box-sizing: border-box; font-size: 16px;">
        <span class="open_close_arrow"></span>
        <a href="http://www.autobody.ru/catalog/'.$val_sect.'/">'.$sect_name['NAME'].'</a>
        </div>';
        $block_wrapper.='<div class="new_item_list"><table class="forward_catalog_new catalog_table">';
        $elList = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>88, '>DATE_CREATE'=>date("d.m.Y 00:00:00", time()-604800), "SECTION_ID"=>$val_sect), false, false, array("ID", "CODE", "NAME", "PROPERTY_UNC", "PROPERTY_SIZE", "IBLOCK_SECTION_ID"));
        while ($elListFetch = $elList -> Fetch()) {
            $base_price=CPrice::GetBasePrice($elListFetch['ID']);
            $block_wrapper.='
            <tr style="width: 100%;">
            <td style=" width: 20%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: left; padding: 5px 0;">'.$elListFetch['CODE'].'</td>
            <td style=" width: 20%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: center; padding: 5px 0;">'.str_replace("/","<br>+",$elListFetch['PROPERTY_UNC_VALUE']).'</td>
            <td style=" width: 10%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: center; padding: 5px 0;">'.$elListFetch['PROPERTY_SIZE_VALUE'].'</td>
            <td style="width:60%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: left; padding: 5px 0;">
            <a style="margin: 0 15px; color: #000 !important; text-align: left; font-weight: bold; height: 20px;" href="http://www.autobody.ru/catalog/'.$elListFetch['IBLOCK_SECTION_ID'].'/'.$elListFetch['ID'].'/">'.$elListFetch['NAME'].'</a></td>
            <td style=" width: 20%; border-left: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; font-size: 14px; color: #808080; text-align: center; padding: 5px 0;">'.ceil(CCurrencyRates::ConvertCurrency($base_price['PRICE'], "USD", "RUR")).'</td></tr>';
        }
        $block_wrapper.='</table></div></div>';
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/doc_print/pdf/tcpdf/tcpdf.php';   
    $pdf = new TCPDF('P', 'mm', 'A3', true, 'UTF-8',false);

    $pdf->setFont('freeserif','',12);
    $pdf->SetMargins(20, 30, 20);
    $pdf->AddPage(); // Добавляем страницу
    $pdf->SetXY(20, 50); // Установка текущей точки (в мм)    
    $html= <<<EOF
 <style>  
.text {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; color: #1C1C1C; font-weight: normal;}
.newsdata{font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color: #346BA0; text-decoration:none;}
h1 {font-family: Verdana, Arial, Helvetica, sans-serif; color:#346BA0; font-size:15px; font-weight:bold; line-height: 16px; margin-bottom: 1mm;}
.open_close_arrow {
    width: 26px;
    height: 16px;
    background-image: url('/i/new_items_arrow.png');
    background-repeat: no-repeat no-repeat;
    background-position: 0 100%;
    display: inline-block;
    position: relative;
    top: 3px;
    margin-right: 20px;
}
.new_item_header {
    padding: 15px;
    box-sizing: border-box;
    font-size: 16px;
    cursor: pointer;
}
.new_items_block_wrapper {
    box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.25);
    margin-top: 20px;
}
.new_item_list {
    transition: all 400ms cubic-bezier(0.265, -0.175, 0.615, 1.165);
    overflow: hidden;
    height: 0; 
}
.catalog_table  {
    width:580px;
}
.forward_catalog_new td {
    border: 1px solid #E6E6E6;
    font-size: 11px;
    color: #808080;
    text-align: center;
    padding: 5px 0;
    line-height:17px;
}
.forward_catalog_new th {
text-align:center;
}

.forward_catalog_new td a {
  margin: 0 15px;
    color: #000 !important;
    text-align: left;
    font-weight: bold;
     height: 20px;  
}
</style> 
<p>
          <table width="350">
          <tr>
          <td style="width:350px;">
          <a href="http://www.autobody.ru/"><img src="$badge" width="150"></a>
          </td>
          </tr>
          </table>
          <div style="mi-width:960px; width:100%; clear: both; margin-top:120px;"><P>Новые товары за последние 7 дней. <br>C $date_pdf_start по $date_pdf_end</P>
          $block_wrapper
</div></p>
<P>www.autobody.ru<P>

EOF;
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Cell(30, 10, $tt);
    $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/doc_print/new_items.pdf', 'F');
?>

<a href="/doc_print/new_items.pdf">Посмотреть PDF-версию</a><br><br>
Данное сообщение отправлено автоматически, пожалуйста, не отвечайте на него. Воспользуйтесь <a href="/feedback/">формой обратной связи</a> <br>
Информация о стоимости товаров и услуг актуальна на момент отправки письма. </P><?
    //Получаем дату и время в правильном формате.
    $new_date = $DB->FormatDate(date("d.m.Y H:i:s"), "DD.MM.YYYY HH:MI:SS", CSite::GetDateFormat("FULL", "ru"));
    if(!empty($sect_new_list))
        return array(
            "SUBJECT"=>$SUBSCRIBE_TEMPLATE_RUBRIC["NAME"],
            "BODY_TYPE"=>"html",
            "CHARSET"=>"UTF-8",
            "DIRECT_SEND"=>"Y",
            "FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
            // "AUTO_SEND_FLAG"=>"Y",
            // "AUTO_SEND_TIME"=>$new_date,
            //"FILES"=>Array("0"=>CFile::MakeFileArray("/files/price_forward.zip")),
        );
    else  {
        return false;
    }
?>
