<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    header("Location: /"); 
    $APPLICATION->SetTitle("Бренды");
?>
<div id="marki">Группы *</div>
 
<div id="rightpart4"> <?
        $pictavtmarcs="pictavtmarcs=[";
        $count=1;
        $arFilter = Array('IBLOCK_ID'=>88, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>2);
        $db_list = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
        while($ar_result = $db_list->GetNext())
        {
            //print_r($ar_result[SECTION_PAGE_URL]);
            if (!$ar_result["DETAIL_PICTURE"]){
                $detpic="/bitrix/components/osg/catalog.sections/templates/.default/images/no_preview_picture.gif";
            }
            else
                $detpic=CFile::GetPath($ar_result["DETAIL_PICTURE"]);

            if (!$ar_result["PICTURE"])
                $pic="/bitrix/components/osg/catalog.sections/templates/.default/images/no_preview_picture.gif";
            else
                $pic=CFile::GetPath($ar_result["PICTURE"]);

            $pictavtmarcs.="['".$pic."','".$detpic."'],";

        ?> 
  <div class="brand_container"> <a href="<?=$ar_result["SECTION_PAGE_URL"];?>" title="<?=$ar_result["NAME"]?>" ><img rel="<?=$count;?>" id="peugeot" src="<?=$pic;?>"  /></a> 
    <br />
  <?=$ar_result["NAME"]?>
    <br />
   </div>
 <?
        }
        $pictavtmarcs.="];";

    ?> 
<script>
        //  <img id="bxid_351197" src="/bitrix/images/fileman/htmledit2/php.gif" border="0"  />
        //alert(pictavtmarcs[0]);
    </script>
 </div>
 
<br />
<div id="marki">* Товарные знаки и логотипы являются собственностью своих законных владельцев и правообладателей.</div>
<br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>