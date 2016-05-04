<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
?>
<script type="text/javascript">
    $(function(){
        var lastItem=$(".news-wrapper").attr("data-count"); //id последней новости
        var mainNews=$(".news-section-main").attr("data-count"); //id главной новости
        
        function getCurLastItem() {
            var curLastItem=$(".item-news:last-child").attr("data-count"); //id последней новости текущей страницы
          
            //если обычных новостей нет
            if (curLastItem === undefined) {
                curLastItem=mainNews; //id последней новости если она главная    
          }
          return curLastItem;    
        }          
        
        function buttonHide() {
            var curLastItem=getCurLastItem();
            if (curLastItem==lastItem) $(".button-more-news").hide();   
        }
      
        buttonHide(); //если все новости помещаются на одну страницу не показывем кнопку 
        
        $(".show-more").click(function(){
          var curLastItem=getCurLastItem();
          
          //показываем надпись загрузка
          $("#show-more-load").show();
          $.post("/ajax/showMoreNewsRetail.php", {lastItem : curLastItem, mainNews : mainNews}, function(data){
              $("#show-more-load").hide();
              if (data)
                $(".news-wrapper").append(data);
              
              //скрываем кнопку
              buttonHide();
              //alert(data);
          })         
        }
        );            
   })
   
</script>


<?
//print_r($newsCounter);
 global $arRes;
 global $newsCounter;
//arshow($arRes);
?>
<?if (!($_REQUEST['item_id'])):?>

<div class="name-news-title">ВСЕ НОВОСТИ КОМПАНИИ</div>
 
<div class="news-page">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><br />
    <?endif;?>
    
    <?   
        $renderImage = CFile::ResizeImageGet($arRes["PREVIEW_PICTURE"], 
            Array("width" => 730, "height" => 360 ), 
            BX_RESIZE_IMAGE_EXACT, false, false, false, false); 
    ?>
    <div class="news-section-main">
        <img src="<?=$renderImage["src"]?>" alt="<?=$arRes["NAME"]?>" title="<?=$arRes["NAME"]?>"/>
        <div class="mask"> </div> 
        <div class="mask2">
            <div class="main-news-date"><?=date("d/m",$arRes["DATE_CREATE_UNIX"])?></div>
            <div class="main-news-title"><?=$arRes["NAME"]?></div>
            <div class="main-news-note"><?=$arRes["PREVIEW_TEXT"]?></div>
            <a class="url" href="<?=$arRes["DETAIL_PAGE_URL"]?>"><button class="detail-news-button" type="submit">ПОДРОБНЕЕ</button></a>
        </div> 
    </div>       
    
    
    <div class="news-wrapper" data-count="<?=$newsCounter["ID"]?>">        
    <?foreach($arResult["ITEMS"] as $arItem):
    
    if(!($arItem["PROPERTIES"]["RETAIL_POST"]["VALUE"]==="Y")) continue;
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], 
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], 
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), 
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], 
            Array("width" => 365, "height" => 200 ), 
            BX_RESIZE_IMAGE_EXACT, false, false, false, false);
        ?>
        <div class="item-news"  data-count="<?=$arItem['ID']?>">
            <div class="item-news-left-section">  
                <div class="mask2">
                    <div class="news-date-side1"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
                    <div class="news-title-side1"><a class="url" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
                    <div class="news-note-side1"><?=$arItem["PREVIEW_TEXT"]?></div>
                </div>
            </div>
            <div class="item-news-right-section">  
                <img src="<?=$renderImage["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/> 
                <div class="mask2">
                    <!--<div class="item-news-arrow"></div>-->
                </div>
            </div>
            
        </div>    
    <?endforeach;?>
    </div>
    
        
<?endif;?>

<a class="show-more" href="javascript:void(0)">
    <span id="show-more-load">загрузка...</span>
    <div class="button-more-news"> <button type="submit">ЗАГРУЗИТЬ БОЛЬШЕ НОВОСТЕЙ &darr;</button> </div>
</a>        
    
</div>

<?
    //arshow($items_on_page_count   
    
?>
