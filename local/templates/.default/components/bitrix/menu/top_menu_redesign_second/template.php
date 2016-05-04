<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>  
<div class="second_menu">      
    <table class="second_lvl_menu">
    
        <tr>

            <?
                foreach($arResult as $arItem):    ?>        
                <td class="sec_menu">
                <a href="<?=$arItem["LINK"]?>" class="url a_border <?if ($arItem["SELECTED"] =="1"){echo ("active_top_menu");}?>"  ><?=$arItem["TEXT"]?></a>
                </td>
                <td class="margin2"></td>
                <?
                  // if ($USER->IsAdmin()){arshow($arItem);} 
                ?>
                <?endforeach?>
                <td class="margin_td"></td>
              
        </tr>
    </table>
</div>
    <?endif?>



