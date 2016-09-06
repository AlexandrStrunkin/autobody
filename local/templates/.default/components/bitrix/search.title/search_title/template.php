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
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<div id="<?echo $CONTAINER_ID?>">
	<form action="<?echo $arResult["FORM_ACTION"]?>">
         <input type="hidden" name="p" value="name">
         <ul class="searchFilter">
         <li>
		    <input id="<?echo $INPUT_ID?>" class="search-input" type="text" name="q" value="<?if($_GET['q']){echo htmlspecialcharsbx($_GET['q']);}?>"  onclick="placeholder='';" onblur="placeholder='Воспользуйтесь удобным поиском по: артикулу, наименованию, по номеру производителя, по оригинальному номеру';" placeholder="Воспользуйтесь удобным поиском по: артикулу, наименованию, по номеру производителя, по оригинальному номеру" size="40" maxlength="50" autocomplete="off" />&nbsp;
         </li>
	</form>
	</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
    
    $(function(){
        var o = localStorage.getItem("setSearch");
        if(o!=null && o!=$('input[name="p"]').attr('value')){
            $('input[name="p"]').attr('value',o);
            $('.currentSOption').html($('li[data-search-param="'+o+'"]').html());
        }
        var curOption = $('input[name="p"]').attr('value');
        $('li[data-search-param="'+curOption+'"]').addClass('activeOption');
    })
</script>
