<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
  //arShow()
?>
<div class="graphite demo-container">
  <ul class="accordion" id="accordion-1">
    <?if (is_array($arResult['SECTIONS'][1])):?>
      <?foreach ($arResult['SECTIONS'][1] as $arSection):?>
        <li><a href="#"><span class="lv1"><?=$arSection['NAME']?></span></a>
          <?recursiveMenu(2, $arResult, $arSection["ID"])?>
        </li>
      <?endforeach;?>
    </ul>
  </div>
  <?endif?>

<?
  function recursiveMenu($DEPTH_LEVEL, $arResult, $sid){

    $first=0;
    $arFilter = Array('IBLOCK_ID'=>88, 'GLOBAL_ACTIVE'=>'Y', "SECTION_ID"=>$sid);
    $db_list = CIBlockSection::GetList(Array("NAME"=>"asc"), $arFilter, true);
    while($ar_result = $db_list->GetNext())
    {
      if ($first==0) { $first=1;?> <ul class="lmul_<?=$DEPTH_LEVEL?>"> <?}
        //print_r($ar_result);
      ?>
      <li><a href="<?=$ar_result["SECTION_PAGE_URL"]?>"><?=$ar_result["NAME"]?></a><?=recursiveMenu($DEPTH_LEVEL+1, $arResult, $ar_result["ID"]);?>
      </li>
      <?
      }
    if ($first==1) { ?> </ul> <?}
  }
?>






