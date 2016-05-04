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







