<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode(true) ?>
<?

    //раскрываем тенкущие пункты меню
    $url = explode("/",$APPLICATION->GetCurPage());
    $cur_section = $url[2];
    //получаем родителя первого уровня
    $section =  CIBlockSection::GetById($cur_section);
    if ($arSection = $section->Fetch()) {
        $parent_first = $arSection["IBLOCK_SECTION_ID"];
    }
    ///

    //получаем родителя второго уровня
    $subsection =  CIBlockSection::GetById($parent_first);
    if ($arSubsection = $subsection->Fetch()) {
        $parent_second = $arSubsection["IBLOCK_SECTION_ID"];
    }


    if ($parent_second > 0) {?>
    <script>
        $(function(){
            get_submenu(<?=$parent_second?>, <?=$parent_first?>);
            ///////////////////////////////
        })
    </script>
    <?}

    else if ($parent_first > 0){?>
    <script>
        $(function(){
            get_submenu(<?=$parent_first?>,false);
            ///////////////////////////////
        })
    </script>
    <?}?>





<script>
    //функция раскрытия/закрытия бокового меню
    $(function(){
        $("body").on("click",".leftMenuLink",function(e) {
            e.preventDefault();
            get_submenu($(this).attr("rel"),false);
        })

    })


    function get_submenu(section_id, second_id){
        // скрываем остальные открытые пункты
        $(".s" + section_id).siblings("li").each(function(){
            $(this).find("ul").remove();
            $(this).removeClass("active");
        })

        //если клик по открытому разделу, то скрываем его содержимое
        if ($(".s" + section_id).find("ul").attr("id") == "ss" + section_id) {
            $("#ss" + section_id).remove();
            $(".s" + section_id).removeClass("active");
        }
        // в противном случае раскрываем подпункты
        else {
            $(".s" + section_id).addClass("active");

            $.post("/ajax/get_links.php", { section_id: section_id },
                function(data){
                    $(".s" + section_id).append(data);
                    if (second_id != false) {
                        get_submenu(second_id,false);
                    }

            });
        }
    }


</script>


<?
    $TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
    $CURRENT_DEPTH = $TOP_DEPTH;

    foreach($arResult["SECTIONS"] as $arSection)
    {
        $menu_item_count++;
        //проверяем дату создания
        $dateCreate = explode(".", substr($arSection["DATE_CREATE"],0,10));
        $curDate = date("U"); //текущая дата
        $dif = 86400 * 30; //30 дней
        $dateCreateLabel = mktime(0,0,0,$dateCreate[1],$dateCreate[0],$dateCreate[2]);  //метка времени даты создания



        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
        if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
        {
            echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul>";
        }
        elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
        {
            echo "</li>";
        }
        else
        {
            while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
            {
                echo "</li>";
                echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
                $CURRENT_DEPTH--;
            }
            echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
        }

        echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);


    ?>


    <li id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="s<?=$arSection['ID']?>">
    <? if ($menu_item_count==7) {   ?>
        <div class="left-menu-deliter"><img src="/images/left-menu-del.png"></div>
        <?
    } ?>
    <a href="/catalog/<?=$arSection["ID"]?>/" rel="<?=$arSection["ID"]?>" class="leftMenuLink">
        <?=$arSection["NAME"]?>
        <?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?>
        <?if (($curDate - $dateCreateLabel) < $dif) {/*?>
            <span class="catalog_section_new_label">NEW</span>
        <?*/}?>
    </a>
    <?



        $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
    }

    while($CURRENT_DEPTH > $TOP_DEPTH)
    {
        echo "</li>";
        echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"<li><a href='/new_products/' class='new_products_link' title='Новые товары за последние 30 дней'>НОВЫЕ ТОВАРЫ</a></li></ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
        $CURRENT_DEPTH--;
    }
?>