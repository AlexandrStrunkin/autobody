<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "✔✔✔  Скачать прайс-лист на всю продукцию компании Форвард");
$APPLICATION->SetTitle("Прайс-листы");
?>
<h1> 
    <div>
    <?                              
      $APPLICATION->IncludeComponent(
        "bitrix:subscribe.form", 
        "autoBody_subscribe", 
        array(
            "USE_PERSONALIZATION" => "Y",
            "PAGE" => "#SITE_DIR#company/subscr_edit.php",
            "SHOW_HIDDEN" => "N",
            "ALLOW_ANONYMOUS" => "Y", 
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "CACHE_NOTES" => "",
            "COMPONENT_TEMPLATE" => "autoBody_subscribe"
        ),
        false
      );
    ?>
    </div>
</h1>
 
<div class="price-page"> 
  <div class="priceHeader"> 
    <h1>Прайс листы компании Форвард</h1>
   </div>
 <colspan> </colspan> 
  <table> <colgroup><col width="45"></col> <col width="545"></col> </colgroup> 
    <tbody> 
      <tr> <td><img class="pdf-icon" src="/images/pdf-icon.png"  /></td> <td> 
          <div class="discount">Cкидки на нашу продукцию</div>
         <a href="/files/Skidki_Forward_2015.pdf" > 
            <div class="download">Скачать &darr;</div>
           </a> </td> <td> 
          <div class="file_size"> 
            <br />
           </div>
         </td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceCSV.png&quot;);"></div>
         
          <br />
         </td> <td><a href="/files/price_forward_csv.zip" >Оптовый CSV Прайс лист с остатками в Москве и Омске (формат &quot;.CSV&quot;) &quot;.zip&quot; архив</a></td> <td style="font-family: &quot;clear_sansitalic&quot;;">Обновления ежедневно 
          <br />
         в 12.15, 15.12, 19.12</td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceXLS.png&quot;);"></div>
         
          <br />
         </td> <td><a href="/files/price_forward.zip" >Оптовый XLS Прайс лист с остатками в Москве и Омске (формат &quot;.xls&quot;) &quot;.zip&quot; архив</a></td> <td style="font-family: &quot;clear_sansitalic&quot;;">Обновления ежедневно 
          <br />
         в 12.15, 15.12, 19.12</td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceXLS.png&quot;);"></div>
         
          <br />
         </td> <td><a href="http://forwardsp.ru/files/price_forward.zip" >Оптовый Прайс лист с остатками в Санкт-Петербурге (формат &quot;.xls&quot;) &quot;.zip&quot; архив</a></td> <td style="font-family: &quot;clear_sansitalic&quot;;">Обновления ежедневно 
          <br />
         в 10.00</td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceXLS.png&quot;);"></div>
         
          <br />
         </td> <td><a href="http://autobody.ru/files/price_forward_ekat.zip" >Оптовый XLS Прайс лист с остатками в Екатеринбурге (формат &quot;.xls&quot;) &quot;.zip&quot; архив</a></td> <td style="font-family: &quot;clear_sansitalic&quot;;">Обновления ежедневно 
          <br />
         в 12.00, 15.00, 19.00</td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceXLS.png&quot;);"></div>
         
          <br />
         </td> <td><a href="/files/Katalog_Radiatorov_Forward.zip" >Каталог Радиаторов с фото (формат &quot;.xls&quot;) &quot;.zip&quot; архив</a></td> <td>- 4 мб</td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/pricePDF.png&quot;);"></div>
         
          <br />
         </td> <td><a href="/files/Katalog_Radiatorov_Forward.pdf" >Каталог Радиаторов с фото (формат &quot;.pdf&quot;)</a></td> <td>- 5 мб</td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceXLS.png&quot;);"></div>
         
          <br />
         </td> <td><a href="/files/Kompressor.xls" >Кросс компрессоров кондицонера, № Форвард - GERI - OEM. (формат &quot;.xls&quot;)</a></td> <td>- 63 кб</td> </tr>
     
      
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceHREF.png&quot;);"></div>
         
          <br />
         </td> <td><a href="https://webshop.nissens.com/main.asp" >ONLINE Каталог Радиаторов Nissens</a></td> <td>webshop.nissens.com</td> </tr>
     
      <tr> <td> 
          <div style="background-image: url(&quot;/i/priceHREF.png&quot;);"></div>
         
          <br />
         </td> <td><a href="https://www.nrf.eu/catalog/index.html" >ONLINE Каталог Радиаторов NRF</a></td> <td></td> </tr>
     </tbody>
   </table>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>