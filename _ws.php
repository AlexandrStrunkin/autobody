<?
  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
  $APPLICATION->SetTitle("База наличия по складам");
?>
<h1>Наличие по складам</h1>
<?  
  
  global $DB;
  
  $warehouses = Array();
  $warehousesNames = Array();
  $wRes = $DB->Query("SELECT * FROM _warehouses order by real_id asc");
  while($row = $wRes->fetch()){
    $warehouse[] = $row["id"];
    $warehouseNames[$row["id"]] = $row["name"];
  }
  
  $offers = Array();
  $res = $DB->Query("SELECT * FROM _items order by vendor asc, id_warehouse asc");
  while($row = $res->Fetch()){
    $offers[$row["vendor"]][$row["id_warehouse"]] = $row["count"];
  }
  
  if(count($warehouse)){
    $totalTD = count($warehouse);
    $width = round(100 / ($totalTD+1));
    ?>
    <table class="ws-count-table">
      <tr class="ws-head-tr">
        <td style="width: <?=$width?>% !important;">Артикул / Cклад</td>
        <?
          foreach($warehouseNames as $value){
            ?><td style="width: <?=$width?>% !important;"><?=$value?></td><?
          }
        ?>
      </tr>      
      <?
        foreach($offers as $vendor => $value){
          ?>
          <tr>
            <td><?=$vendor?></td>
            <? foreach($warehouse as $wh){ ?>
              <td>
                <?
                  if($value[$wh]) echo intval($value[$wh]);
                  else echo "нет в наличии";
                ?>
              </td>
            <? } ?>
          </tr>
          <?
        }
      ?>
    </table>
    <?  
  }
    
  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>