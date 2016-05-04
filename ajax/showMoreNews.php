<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>

<?
$arFilter=Array(
    "IBLOCK_ID" => 10, 
    "<ID" => $_POST['lastItem'], 
    "!ID" => $_POST['mainNews'],
    "IBLOCK_LID" => "s1",
    "ACTIVE" => "Y",
    "CHECK_PERMISSIONS" => "Y",
    "ACTIVE_DATE" => "Y",
    "PROPERTY_RETAIL_POST_VALUE" => "Y"
    );
$arSelectFields=Array("ID", "PREVIEW_PICTURE","NAME", "PREVIEW_TEXT",
    "DETAIL_PAGE_URL","DATE_CREATE_UNIX");
$res = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, Array("nTopCount"=>2), Array());

//$arRes=$res->GetNext();

?>

<?while($arRes=$res->GetNext()):
    $renderImage = CFile::ResizeImageGet($arRes["PREVIEW_PICTURE"], Array("width" => 365, "height" => 200 ), 
        BX_RESIZE_IMAGE_EXACT, false, false, false, false);
    ?>
    <div class="item-news"  data-count="<?=$arRes['ID']?>">
        <div class="item-news-left-section">  
            <div class="mask2">
                <div class="news-date-side1"><?=date("d/m",$arRes["DATE_CREATE_UNIX"])?></div>
                <div class="news-title-side1"><a class="url" href="<?=$arRes["DETAIL_PAGE_URL"]?>"><?=$arRes["NAME"]?></a></div>
                <div class="news-note-side1"><?=$arRes["PREVIEW_TEXT"]?></div>
            </div>
        </div>
        <div class="item-news-right-section">  
            <img src="<?=$renderImage["src"]?>" alt="<?=$arRes["NAME"]?>" title="<?=$arRes["NAME"]?>"/> 
            <div class="mask2">
                <!--<div class="item-news-arrow"></div>-->
            </div>
        </div>
        
    </div>    
<?endwhile;?>