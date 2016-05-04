<?   require_once ($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

    global $SUBSCRIBE_TEMPLATE_RESULT;
    $SUBSCRIBE_TEMPLATE_RESULT=false;
    global $SUBSCRIBE_TEMPLATE_RUBRIC;
    $SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
    global $APPLICATION;
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
    require_once 'tcpdf/tcpdf.php'; // Подключаем библиотеку  
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
    $pdf->Output('test123.pdf');   
?>