<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    global $this_count;
    $this_count = 0;
?>
<?foreach($arResult["STORES"] as $pid=>$arProperty):?>
    <?if ($arProperty["ID"] == GKCommon::GetSavedWarehouse()){  
        if (!$arProperty["NUM_AMOUNT"]) {$arProperty["NUM_AMOUNT"] = $arProperty["AMOUNT"];}
      $this_count = $arProperty["NUM_AMOUNT"];   
     
      // echo $arProperty["ID"]."-".$this_count."<br>";
      break;
    }
    else { }

    endforeach;?>
